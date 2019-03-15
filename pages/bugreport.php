<?php
require($_SERVER['DOCUMENT_ROOT'].'/private/config.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/mysql.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/memcache.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/session.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/var.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/func.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/auth.php');

if(!$user || $user['access'] < CONF_BUGREPORT_EDITOR_ACCESS){
	header('HTTP/1.0 403 Forbidden');
	header('Location: /pages/error/403.php');
	die;
}

require_once($_SERVER['DOCUMENT_ROOT'].'/private/model.bugreport.php');

$page = (isset($_GET['page']) && $_GET['page'] > 1) ? (int)$_GET['page'] : 1;

if(isset($_GET['release']) && $_GET['release'] >= 1){
	$release_id = (int)$_GET['release'];
	$state = (isset($_GET['state']) && $_GET['state'] === 'close') ? 'close' : 'open';
	$bugs = getBugreports($release_id, $state, $page);
	$release_data = getReleaseBugsCounts($release_id);
	$var['title'] = 'Ошибки релиза &quot;' . $release_data['name'] . '&quot;' . ($page > 1 ? ' - страница ' . $page : '');
	$content = getTemplate('bugreport-release.php', [ 'bugs'=>$bugs[0], 'curPage'=>$page, 'pages'=>$bugs[1], 'release'=>$release_data, 'state'=>$state ]);
}else{
	$bugs = getBugreportsReleases($page);
	$var['title'] = 'Список релизов с ошибками' . ($page > 1 ? ' - страница ' . $page : '');
	$content = getTemplate('bugreport-index.php', [ 'releases'=>$bugs[0], 'curPage'=>$page, 'pages'=>$bugs[1], 'header'=>$var['title'] ]);
}

require($_SERVER['DOCUMENT_ROOT'].'/private/header.php');
echo $content;
require($_SERVER['DOCUMENT_ROOT'].'/private/footer.php');
