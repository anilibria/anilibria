<?php

// @return array('releases'=>число релизов с открытыми багами, 'bugs'=>общее число багов)
function getBugreportsCount(){
	global $db, $cache;

	if(!($row = $cache->get('bugreports_count'))){
		$query = $db->query('SELECT COUNT(`rid`) as `releases`, SUM(`count_open`) as `bugs` FROM `bugreport_index` WHERE `lastopen_at` > 0');
		$row = $query->fetch();
		$cache->set('bugreports_count', $row);
	}
	return $row;
}

// $page - номер страницы
// @return array(Список релизов с открытыми багами и несколько последних багов по каждому из них, число страниц)
function getBugreportsReleases(int $page){
	global $db;

	$limit = 10;//число релизов на странице
	$bugs = 3;//сколько последних багов показать для каждого релиза

	$query = $db->prepare('SELECT SQL_CALC_FOUND_ROWS bi.`rid`, bi.`count_open`, x.`code`, x.`name`, x.`ename`, x.`aname`
	    FROM `bugreport_index` bi LEFT JOIN `xrelease` x ON bi.`rid`=x.`id`
	    WHERE bi.`lastopen_at` > 0 ORDER BY bi.`lastopen_at` DESC LIMIT :start, :limit');
	$query->bindValue(':start', $limit * ($page - 1), PDO::PARAM_INT);
	$query->bindValue(':limit', $limit, PDO::PARAM_INT);
	$query->execute();

	$releases = array();
	$bugs_query = $bugs_values = array();
	while($row = $query->fetch()){
		$releases[ $row['rid'] ] = array(
			'rid' => $row['rid'],
			'bugs' => array(),
			'bugs_open' => $row['count_open'],
			'code' => $row['code'],
			'name' => $row['name'],
			'ename' => $row['ename'],
			'aname' => $row['aname'],
		);

		$bugs_query[] = '(SELECT u.`login`, u.`mail`, b.* FROM `bugreport` b LEFT JOIN `users` u ON b.`opened_by`=u.`id` WHERE `rid` = ? AND `state` = "open" ORDER BY `opened_at` DESC LIMIT ' . (int)$bugs .')';
		$bugs_values[] = $row['rid'];
	}

	$query = $db->query('SELECT FOUND_ROWS()');
	$found = $query->fetchColumn();
	$pages = ceil($found / $limit);

	$query = $db->prepare( implode("\nUNION\n", $bugs_query) );
	$query->execute($bugs_values);

	while($row = $query->fetch()){
		$releases[ $row['rid'] ]['bugs'][] = array(
			'id' => $row['id'],
			'uid' => $row['opened_by'],
			'login' => $row['login'],
			'email' => $row['mail'],
			'opened_at' => $row['opened_at'],
			'msg' => $row['msg'],
		);
	}

	return array($releases, $pages);
}

// $release_id - номер релиза
// $state - какие багрепорты показывать ("open" || "close")
// $page - номер страницы
// @return array(Список багов для конкретного релиза и указанной страницы, число страниц)
function getBugreports(int $release_id, string $state, int $page){
	global $db;

	$limit = 10;//число багов на странице

	$query = $db->prepare('SELECT SQL_CALC_FOUND_ROWS u_open.`login` as open_login, u_open.`mail` as open_mail, u_close.`login` as close_login,
	    INET6_NTOA(b.`opened_ip`) as open_ip, b.*
	    FROM `bugreport` b LEFT JOIN `users` u_open ON b.`opened_by`=u_open.`id` LEFT JOIN `users` u_close ON b.`closed_by`=u_close.`id`
	    WHERE `state` = :state AND b.`rid` = :rid ORDER BY b.`opened_at` DESC LIMIT :start, :limit');
	$query->bindValue(':state', $state);
	$query->bindValue(':rid', $release_id, PDO::PARAM_INT);
	$query->bindValue(':start', $limit * ($page - 1), PDO::PARAM_INT);
	$query->bindValue(':limit', $limit, PDO::PARAM_INT);
	$query->execute();
	$bugs = $query->fetchAll(PDO::FETCH_ASSOC);

	$query = $db->query('SELECT FOUND_ROWS()');
	$found = $query->fetchColumn();
	$pages = ceil($found / $limit);

	return array($bugs, $pages);
}

function getReleaseBugsCounts(int $release_id){
	global $db;

	$query = $db->prepare('SELECT x.`id`, x.`code`, x.`name`, x.`ename`, x.`aname`,
	     IFNULL(bi.`count_open`, 0) as `count_open`, IFNULL(bi.`count_close`, 0) as `count_close`
	    FROM `xrelease` x LEFT JOIN `bugreport_index` bi ON x.`id` = bi.`rid`
	    WHERE x.`id` = :rid');
	$query->bindValue(':rid', $release_id, PDO::PARAM_INT);
	$query->execute();
	$release_data = $query->fetch(PDO::FETCH_ASSOC);

	return $release_data;
}

// @return bool
function addBugreport(int $release_id, int $user_id = NULL, string $ip, string $message){
	global $db;

	$dt = new DateTime();
	$datetime = $dt->format("Y-m-d H:i:s");

	$query = $db->prepare('INSERT INTO `bugreport_index` (`rid`, `lastopen_at`) VALUES (:rid, :datetime) ON DUPLICATE KEY UPDATE `lastopen_at`=VALUES(`lastopen_at`)');
	$query->bindValue(':rid', $release_id);
	$query->bindValue(':datetime', $datetime);
	if(!$query->execute()){
		trigger_error(print_r($query->errorInfo(), true));
		return false;
	}

	$query = $db->prepare('INSERT INTO `bugreport` (`state`, `rid`, `id`, `opened_by`, `opened_at`, `opened_ip`, `closed_by`, `closed_at`, `msg`)
	    SELECT "open", :rid, IFNULL(MAX(id)+1, 0), :uid, :datetime, INET6_ATON(:ip), NULL, 0, :msg FROM `bugreport` WHERE `rid` = :rid_where FOR UPDATE');
	$query->bindValue(':rid', $release_id, PDO::PARAM_INT);
	$query->bindValue(':uid', $user_id, PDO::PARAM_INT);//int или NULL
	$query->bindValue(':datetime', $datetime);
	$query->bindValue(':ip', $ip);
	$query->bindValue(':rid_where', $release_id, PDO::PARAM_INT);
	$query->bindValue(':msg', trim($message));
	if(!$query->execute()){
		trigger_error(print_r($query->errorInfo(), true));
		return false;
	}

	countBugreportIndex([ $release_id ]);
	return true;
}

// @return bool
function changeBugreportState(int $release_id, int $user_id, array $bugs_ids, string $state){
	global $db;

	$in = [];
	foreach($bugs_ids as $id) $in[] = '?';
	$bugs_ids = array_values($bugs_ids);

	$query = $db->prepare('UPDATE `bugreport` SET `state` = ?, `closed_by` = ?, closed_at = NOW()
	    WHERE `rid` = ?' . (empty($bugs_ids) ? ' AND `state` = "open"' : ' AND `id` IN (' . implode(',', $in) . ')'));
	$query->bindValue(1, $state);
	$query->bindValue(2, $user_id, PDO::PARAM_INT);
	$query->bindValue(3, $release_id, PDO::PARAM_INT);
	foreach($bugs_ids as $num => $id){
		$query->bindValue($num + 4, $id, PDO::PARAM_INT);
	}
	if(!$query->execute()){
		trigger_error(print_r($query->errorInfo(), true));
		return false;
	}

	countBugreportIndex([ $release_id ]);
	if($state === 'close') deleteOldBugreports();
	return true;
}

// @return bool
//private
function countBugreportIndex(array $releases_ids){
	global $db, $cache;

	$in = [];
	foreach($releases_ids as $id) $in[] = '?';
	$releases_ids = array_values($releases_ids);

	$query = $db->prepare('UPDATE
	    (SELECT bi.`rid`, SUM(IF(b.`state`="open", 1, 0)) as count_open,
	      SUM(IF(b.`state`="close", 1, 0)) as count_close,
	      MAX(IF(b.`state`="open", b.`opened_at`, 0)) as max_time
	     FROM `bugreport_index` bi LEFT JOIN `bugreport` b USING(`rid`)
	     WHERE bi.`rid` IN (' . implode(',', $in) . ') GROUP BY bi.`rid`
	    ) b
	    LEFT JOIN `bugreport_index` bi ON b.`rid` = bi.`rid`
	    SET bi.`count_open` = b.`count_open`, bi.`count_close` = b.`count_close`, bi.`lastopen_at` = b.`max_time`');
	foreach($releases_ids as $num => $id){
		$query->bindValue($num + 1, $id, PDO::PARAM_INT);
	}
	$result = $query->execute();

	$cache->delete('bugreports_count');
	return $result;
}

// $days - багрепорты, закрытые столько (и больше) дней назад, будут удалены
// @return bool
//private
function deleteOldBugreports(int $days = 92){
	global $db;

	$dt = new DateTime();
	$datetime = $dt->format("Y-m-d H:i:s");

	$query = $db->query('SELECT `rid` FROM `bugreport` WHERE `state`="close" AND `closed_at` < DATE_SUB("' . $datetime . '", INTERVAL ' . $days . ' DAY) GROUP BY `rid`');
	$releases_ids = array_column($query->fetchAll(PDO::FETCH_ASSOC), 'rid');
	if(!empty($releases_ids)){
		$query = $db->query('DELETE FROM `bugreport` WHERE `state`="close" AND `closed_at` < DATE_SUB("' . $datetime . '", INTERVAL ' . $days . ' DAY)');
		countBugreportIndex($releases_ids);
		$query = $db->query('DELETE FROM `bugreport_index` WHERE `lastopen_at` = 0 AND `count_open` = 0 AND `count_close` = 0');
		return $query;
	}

	return true;
}
