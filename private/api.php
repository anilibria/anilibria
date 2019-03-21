<?php

function safeApiList() {
    wrapApiResponse(function() {
        return apiList();
    });
}

function unsafeApiList() {
    $response = apiList();
    die(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}

function wrapApiResponse($func){
	$response = (new ApiResponse()) -> proceed($func);
    die(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}

function apiList(){
    //only for testing
    //updateApiCache();
    
	global $cache, $var; $result = [];
	$count = $cache->get('apiInfo');
	$info = [];
	$torrent = json_decode($cache->get('apiTorrent'), true);
	for($i=0; $i < $count; $i++){
		$tmp = json_decode($cache->get("apiInfo$i"), true);
		if(is_array($tmp)){
			foreach($tmp as $k => $v){
				$info["$k"] = $v; 
			}
		}
	}
    
	if($info === null || $torrent === null || $info === false || $torrent === false){
        throw new ApiException('API is not ready', 400);
	}
    
	if(!isset($_POST['query'])){
        throw new ApiException('No query', 400);
	}
    
	function apiGetTorrentsMap($torrents, $idsString){
		$result = [];
		$ids = array_unique(explode(',', $idsString));
		if(!empty($ids)){
			foreach($ids as $id){
				if(array_key_exists($id, $torrents)){
					$result["$id"] = $torrents["$id"];
				}
			}
		}
		return $result;
	}
    
    function apiGetTorrentsList($torrents, $id){
        if(array_key_exists($id, $torrents)){
            return $torrents["$id"];
        }
		return [];
	}
    
    function apiGetReleaseById($info, $torrent, $rid) {
        if(array_key_exists($rid, $info)){
            $releases = array($info[$rid]);
            return proceedReleases($releases, $torrent)[0];
        }
		throw new ApiException("Release by id=$rid not found", 404);
	}
    
    function apiGetReleaseByCode($info, $torrent, $rcode) {
        foreach($info as $key => $val){
            if($val['code'] == $rcode){
                $releases = array($val);
				return proceedReleases($releases, $torrent)[0];
			}
        }
		throw new ApiException("Release by code=$rcode not found", 404);
	}

	function apiGetReleasesByIdsString($info, $torrent, $rid){
        $list = [];
		if(!empty($rid)){
			$list = array_unique(explode(',', $rid));
		}
		return apiGetReleasesByIdsArray($info, $torrent, $list);
	}
	
	function apiGetCatalog($info, $torrent, $items){
		if(!isset($items)){
			$items = [];
		}
		$ids = array_map(function($item){
			return $item['id'];
		}, $items);
		$pagination = createPagination(count($info));
        $items = apiGetReleasesByIdsArray($info, $torrent, $ids);
        return [
            'items' => $items,
            'pagination' => proceedPagination($pagination)
        ];
	}
	
    function apiSearchReleases($info, $torrent, $items){
		if(!isset($items)){
			$items = [];
		}
        $ids = array_map(function($item){
			return $item['id'];
		}, $items);
		return apiGetReleasesByIdsArray($info, $torrent, $ids);
    }
	
	function apiGetReleasesByIdsArray($info, $torrent, $ids) {
		$releases = [];
		foreach($ids as $id){
            if(!array_key_exists($id, $info)){
				continue;
			}
            $releases[] = $info["$id"];
        }
		return proceedReleases($releases, $torrent);
	}
    
    function apiGetReleases($info, $torrent){
        $pagination = createPagination(count($info));
        $startIndex = $pagination['startIndex'];
        $perPage = $pagination['perPage'];
        $releases = array_slice($info, $startIndex, $perPage);
        $items = proceedReleases($releases, $torrent);
        return [
            'items' => $items,
            'pagination' => proceedPagination($pagination)
        ];
    }
    
    function proceedPagination($pagination){
        unset($pagination['startIndex'], $pagination['endIndex']);
        $pagination['page'] = $pagination['page'] + 1;
        $pagination['allPages'] = $pagination['allPages'] + 1;
        return $pagination;
    }
	
	function preparePagination() {
		$startIndex = 0;
        $endIndex = 0;
        $page = 0;
        $perPage = 10;
        if(!empty($_POST['page'])){
            $page = intval($_POST['page']);
            if($page <= 1){
                $page = 0;
            }else{
                $page = $page - 1;
            }
        }
        
        if(!empty($_POST['perPage'])){
            $perPage = intval($_POST['perPage']);
            if($perPage <= 0){
                $perPage = 1;
            }
        }
        
        $startIndex = $perPage * $page;
        $endIndex = $startIndex + $perPage - 1;
		
		return [
            'page' => $page,
            'perPage' => $perPage,
            'startIndex' => $startIndex,
            'endIndex' => $endIndex
        ];
	}
    
    function createPagination($allItemsCount) {
		$prepared = preparePagination();
        return [
            'page' => $prepared['page'],
            'perPage' => $prepared['perPage'],
            'startIndex' => $prepared['startIndex'],
            'endIndex' => $prepared['endIndex'],
            'allPages' => intval($allItemsCount / $prepared['perPage']),
            'allItems' => $allItemsCount
        ];
    }
    
    function proceedReleases($releases, $torrent){
		$result = []; 
		$filter = ['code', 'names', 'series', 'poster', /*'rating',*/ 'last', 'moon', 'status', 'type', 'genres', 'voices', 'year', 'day', 'description', 'announce', 'blockedInfo', 'playlist', 'torrents', 'favorite'];
        foreach($releases as $key => $val){
            $unsettedFileds = [];
			$names = $val['names'];
			if(isset($_POST['filter'])){
				$filterList = array_unique(explode(',', $_POST['filter']));
                
				foreach($filter as $v){
					if(!isset($_POST['rm'])){
						if(!in_array($v, $filterList)){
                            $unsettedFileds[] = "$v";
							unset($val["$v"]);
						}
					}else{
						if(in_array($v, $filterList)){
                            $unsettedFileds[] = "$v";
							unset($val["$v"]);
						}
					}
				}
			}
			if(!empty($val['playlist']['online'])){
				$host = anilibria_getHost($val['playlist']['online']);
				foreach($val['playlist'] as $k => $v){
					if(empty($val['playlist']["$k"]['sd']) || empty($val['playlist']["$k"]['hd'])){
						continue;
					}
					$val['playlist']["$k"]['sd'] = str_replace('{host}', $host, $val['playlist']["$k"]['sd']);
					$val['playlist']["$k"]['hd'] = str_replace('{host}', $host, $val['playlist']["$k"]['hd']);
					if(!empty($val['playlist']["$k"]['file'])){
						$epNumber = $val['playlist']["$k"]['id'];
						$epName = $names[1];
						$val['playlist']["$k"]['srcSd'] = mp4_link($val['playlist']["$k"]['file'].'-sd.mp4')."?download=$epName-$epNumber-sd.mp4";
						$val['playlist']["$k"]['srcHd'] = mp4_link($val['playlist']["$k"]['file'].'.mp4')."?download=$epName-$epNumber-hd.mp4";
            			unset($val['playlist']["$k"]['file']);
					}
				}
			}
            if(!in_array('torrents', $unsettedFileds)) {
                $val['torrents'] = apiGetTorrentsList($torrent, $val['id']);   
            }
            if(!in_array('favorite', $unsettedFileds)) {
                $val['favorite'] = apiGetFavoriteField($val);
            }
            if(!empty($val['blockedInfo'])){
				$val['blockedInfo']['blocked'] = isBlock($val['blockedInfo']['blocked']);        
			}    
            unset($val['rating']);
            unset($val['playlist']['online']);
			$result[] = $val;
		}
		return $result;
    }
    
    function apiGetFavoriteField($release){
        global $user;
		$count = countRatingRelease($release['id']);
        return [
            'rating' => intval($count),
            'added' => isFavorite($user['id'], $release['id'])
        ]; 
    }
    
    
    function apiFavorites($info, $torrent){
        global $db, $user;
        $favIds = [];
        if($user){
            $query = $db->prepare('SELECT `rid` FROM `favorites` WHERE `uid` = :uid');
            $query->bindParam(':uid', $user['id']);
            $query->execute();
            while($row=$query->fetch()){
                $favIds[] = $row['rid'];
            }
        } else {
            throw new ApiException("No user", 401);
        }
        $favReleases = [];
        foreach($favIds as $favId){
            if(!array_key_exists("$favId", $info)){
				continue;
			}
            $favReleases["$favId"] = $info["$favId"];
        }
		$_POST['perPage'] = '9999';
		$result = apiGetReleases($favReleases, $torrent);
		$result['items'] = array_reverse($result["items"]);
        return $result;
    }
    
    function apiGetUser(){
        global $db, $user;
        if(!$user) {
            throw new ApiException("No user", 401);
        }
		if(!empty($user['avatar'])){
			$tmpAvatar = "{$user['dir']}/{$user['avatar']}.jpg";
		}else{
			$tmpAvatar = 'noavatar.jpg';
		}
        return [
            "id" => intval($user['id']),
            "login" => $user['login'],
            "avatar" => "/upload/avatars/$tmpAvatar"
        ];
    }

    
    function releaseFavoriteAction($info, $torrent){
        global $db, $user;
        if(!$user){
            throw new ApiException("No user", 401);
        }
        if(empty($_POST['id'])){
            throw new ApiException("No release id", 400);
        }
        if(empty($_POST['action'])){
            throw new ApiException("No action", 400);
        }
        if(!array_key_exists($_POST['id'], $info)){
            throw new ApiException("Release not found", 404);
        }
        
        $isFavorite = isFavorite($user['id'], $_POST['id']);
        
        switch($_POST['action']){
            case 'add':
                if($isFavorite){
                    throw new ApiException("Already added", 400);
                }
                $query = $db->prepare('INSERT INTO `favorites` (`uid`, `rid`) VALUES (:uid, :rid)');
                $query->bindParam(':uid', $user['id']);
                $query->bindParam(':rid', $_POST['id']);
                $query->execute();
            break;
                
            case 'delete':
                if(!$isFavorite){
                    throw new ApiException("Already deleted", 400);
                }
                $query = $db->prepare('DELETE FROM `favorites` WHERE `uid` = :uid AND `rid` = :rid');
                $query->bindParam(':uid', $user['id']);
                $query->bindParam(':rid', $_POST['id']);
                $query->execute();
            break;
        }
        
        return apiGetReleaseById($info, $torrent, $_POST['id']);
    }
    
    function getRawFeed() {
        global $db;
		$result = [];
		
		$pagination = preparePagination();
        $startIndex = $pagination['startIndex'];
        $perPage = $pagination['perPage'];
		
		$releaseQueryStr = "SELECT 'release' as type, `id` as id, `last` as timestamp FROM `xrelease`";
		$youtubeQueryStr = "SELECT 'youtube' as type, `id` as id, `time` as timestamp FROM `youtube`";
		$feedQueryStr = "SELECT type, id, timestamp FROM ($releaseQueryStr WHERE 1 UNION $youtubeQueryStr WHERE 1) AS feed";
		$queryStr = "$feedQueryStr ORDER BY timestamp DESC LIMIT {$startIndex}, {$perPage}";
		
		$query = $db->query($queryStr);
        while($row = $query->fetch()){
            $result[] = [
                'id' => intval($row['id']),
                'type' => $row['type'],
                'timestamp' => intval($row['timestamp'])
            ];
        }
		
		return $result;
	}
	
	function apiGetFeed($info, $torrent) {
        global $db;
		$result = [];
		$rawFeed = getRawFeed();
		
		foreach($rawFeed as $feedItem){
            switch($feedItem['type']){
				case 'release':
					$result[] = ['release' => apiGetReleaseById($info, $torrent, $feedItem['id'])];
				break;
					
				case 'youtube':
					$query = $db->prepare('SELECT * FROM `youtube` WHERE `id` = :id');
					$query->bindParam(':id', $feedItem['id']);
					$query->execute();
					if($row = $query->fetch()){
						$result[] = ['youtube' => createYoutubeFromRow($row)];
					}
				break;
			}
        }
		
		return $result;
	}
	
	function createYoutubeFromRow($row){
		return [
			'id' => intval($row['id']),
			'title' => $row['title'],
			'image' => '/upload/youtube/'.hash('crc32', $row['vid']).'.jpg',
			'vid' => $row['vid'],
			'views' => intval($row['view']),
			'comments' => intval($row['comment']),
			'timestamp' => intval($row['time'])
		];
	}
	
    function apiGetYoutube(){
        global $db;
        $countQuery = $db->query('SELECT COUNT(*) FROM `youtube`');
        $count = intval($countQuery->fetch()[0]);
        
        $pagination = createPagination($count);
        $startIndex = $pagination['startIndex'];
        $perPage = $pagination['perPage'];
        
        $result = [];
        $query = $db->query("SELECT * FROM `youtube` ORDER BY `time` DESC LIMIT {$startIndex}, {$perPage}");
        while($row=$query->fetch()){
            $result[] = createYoutubeFromRow($row);
        }
        
        return [
            'items' => $result,
            'pagination' => proceedPagination($pagination)
        ];
    }
    
    function apiGetGenres(){
        global $db; 
        $result = []; 
        $query = $db->query('SELECT `name` from `genre`');
        while($row = $query->fetch()){
            $result[] = $row['name'];
        }
        sort($result);
        return $result;
    }
	
	function apiGetYears(){
		global $sphinx, $cache;
		$result = $cache->get('apiYears');
		if($result === false){
			$result = [];
			$tmpl = '<option value="{year}">{year}</option>';
			$arr = array_reverse(range(1990, date('Y', time())));		
			foreach($arr as $search){
				$query = $sphinx->prepare("SELECT `id` FROM anilibria WHERE MATCH(:search) LIMIT 1");
				$query->bindValue(':search', "@(year) ($search)");
				$query->execute();
				if($query->rowCount() > 0){
					$result[] = strval($search);
				}
			}
			$cache->set('apiYears', $result, 300);
		}
		return $result;
	}
	
	function apiGetSocialAuth() {
		$result = [];
		
		$result[] = [
			'key' => 'vk',
			'title' => 'ВКонтакте',
			'socialUrl' => 'https://oauth.vk.com/authorize?client_id=5315207&redirect_uri=https://www.anilibria.tv/public/vk.php',
			'resultPattern' => 'https?:\/\/(?:(?:www|api)?\.)?anilibria\.tv\/public\/vk\.php([?&]code)',
			'errorUrlPattern' => 'https?:\/\/(?:(?:www|api)?\.)?anilibria\.tv\/pages\/vk\.php'
		];
		return $result;
	}
													
	
	function apiGetSchedule($info, $torrent) {
		global $db, $var;
		$result = [];
		foreach($var['day'] as $key => $val){
			$query = $db->prepare('SELECT `id` FROM `xrelease` WHERE `day` = :day AND `status` = 1');
			$query->bindParam(':day', $key);
			$query->execute();
			$dayReleases = [];
			while($row = $query->fetch()){
				$dayReleases[] = apiGetReleaseById($info, $torrent, $row['id']);
			}
			$result[] = [
				'day' => $key,
				'items' => $dayReleases
			];
		}
		return $result;
	}
	
	function apiGetRandomRelease() {
		$randomCode = randomRelease();
		return [
			'code' => $randomCode
		];
	}
	
	function proceedBridge($funcSrc, $funcDst){
		register_shutdown_function(function() use ($funcSrc, $funcDst) {
			// Получаем то, что было выведено во время работы $funcSrc
			$message = ob_get_contents();
			ob_end_clean();
			// Оборачиваем результат в баозовый ответ
			wrapApiResponse(function() use ($message, $funcDst) {
				$messageJson = json_decode($message, true);
				if(!empty($messageJson['err']) && $messageJson['err']!=='ok'){
					throw new ApiException($messageJson['mes'], 400);
				}
				// Выполняем функцию, которая обрабатывает данные, которые вывела $funcSrc
				return $funcDst($messageJson);
			});
		});
		ob_start();
		// Выполняем функцию, которая только выводит данные (функции из func.php)
		$_POST['json'] = '';
		$funcSrc();
		ob_end_clean();	
	}
	
	function checkIsStringOrInteger($value, $key){
		$type = gettype($value);
		if($type != "string" && $type != "integer"){
			throw new ApiException("Invalid type for $key", 400);
		}
	}
	function checkIsString($value, $key){
		$type = gettype($value);
		if($type != "string"){
			throw new ApiException("Invalid type for $key", 400);
		}
	}
    
	switch($_POST['query']){
		case 'torrent':
			if(!empty($_POST['id'])){
				checkIsStringOrInteger($_POST['id'], 'id');
				return apiGetTorrentsMap($torrent, $_POST['id']);
			}else{
				return $torrent;
			}
		break;
            
		case 'info':
			checkIsStringOrInteger($_POST['id'], 'id');
			return apiGetReleasesByIdsString($info, $torrent, $_POST['id']);
		break;
            
        case 'release':
            if(!empty($_POST['id'])){
				checkIsStringOrInteger($_POST['id'], 'id');
                return apiGetReleaseById($info, $torrent, $_POST['id']);
            } elseif(!empty($_POST['code'])) {
				checkIsString($_POST['code'], 'code');
                return apiGetReleaseByCode($info, $torrent, $_POST['code']);
            } else {
                throw new ApiException("No id or code for release", 400);
            }
        break;
			
		case 'random_release':
			return apiGetRandomRelease();
		break;
            
        case 'list':
            return apiGetReleases($info, $torrent);
        break;
            
		case 'schedule':
            return apiGetSchedule($info, $torrent);
        break;
			
		case 'feed':
            return apiGetFeed($info, $torrent);
        break;
			
        case 'genres':
            return apiGetGenres();
        break;
			
		case 'years':
            return apiGetYears();
        break;
            
        case 'favorites':
            if(!empty($_POST['id'])||!empty($_POST['action'])){
				checkIsStringOrInteger($_POST['id'], 'id');
				checkIsString($_POST['action'], 'action');
                return releaseFavoriteAction($info, $torrent);
            }else{
                return apiFavorites($info, $torrent);
            }
        break;
            
        case 'youtube':
            return apiGetYoutube();
        break;
            
        case 'user':
            return apiGetUser();
        break;
			
		case 'catalog':
            return proceedBridge(
				function() {
					showCatalog();
				},
				function($bridgeData) use ($info, $torrent) {
					return apiGetCatalog($info, $torrent, $bridgeData['table']);
				}
			);
        break;
			
		case 'search':
            return proceedBridge(
				function() {
					xSearch();
				},
				function($bridgeData) use ($info, $torrent) {
					return apiSearchReleases($info, $torrent, $bridgeData['mes']);
				}
			);
        break;
			
		case 'vkcomments':
            return [
				'baseUrl' => 'https://www.anilibria.tv/',
				'script' => '<div id="vk_comments"></div><script type="text/javascript" src="https://vk.com/js/api/openapi.js?160" async onload="VK.init({apiId: 5315207, onlyWidgets: true}); VK.Widgets.Comments(\'vk_comments\', {limit: 8, attach: false});" ></script>'
			];
        break;
			
		case 'app_update':
			$version = $var['app_version'];
			$src = file_get_contents($_SERVER['DOCUMENT_ROOT']."/private/app_updates/version_$version.txt");
			return json_decode($src, true);
        break;
			
		case 'empty':
			return [];
        break;
			
		case 'social_auth':
			return apiGetSocialAuth();
        break;
	}
    //Вместо default case
    throw new ApiException("Unknown query", 400);
}

function updateApiCache(){
	global $db, $cache, $user, $var;
	$query = $db->query('SELECT `id`, `name`, `ename`, `rating`, `last`, `moonplayer`, `description`, `announce`, `day`, `year`, `genre`, `voice`, `type`, `status`, `code`, `block` FROM `xrelease` WHERE `status` != 3 ORDER BY `last` DESC');
	while($row=$query->fetch()){
        
        $names = [];
        $firstName = trim($row['name']);
        $secondName = trim($row['ename']);
        if(!empty($firstName)){
            $names[] = $firstName;
        }
        if(!empty($secondName)){
            $names[] = $secondName;
        }
        
        $poster = $_SERVER['DOCUMENT_ROOT'].'/upload/release/350x500/'.$row['id'].'.jpg';
        if(!file_exists($poster)){
            $poster = '/upload/release/350x500/default.jpg';
        }else{
            $poster = fileTime($poster);
        }

        $genres = [];
        $genresTmp = array_unique(explode(',', $row['genre']));
        foreach($genresTmp as $genre){
            $genres[] = trim($genre);
        }
        
        $voices = [];
        $voicesTmp = array_unique(explode(',', $row['voice']));
        foreach($voicesTmp as $voice){
            $voices[] = trim($voice);
        }
        
        $playlist = getApiPlaylist($row['id']);
        
        $series = NULL;
		$episodesIds = [];
        $minId = PHP_INT_MAX;
        $maxId = PHP_INT_MIN;
        foreach($playlist as $key => $episode) {
			if($key === 'online'){
				continue;
			}
            $id = intval($episode['id']);
			$episodesIds[] = $id;
        }
		if(!empty($episodesIds)){	
			$minId = min($episodesIds);
			$maxId = max($episodesIds);
		}
        
        if ($minId == PHP_INT_MAX && $maxId == PHP_INT_MIN){
            $series = NULL;
        } elseif ($minId == $maxId){
            $minId = max($minId, 1);
            $series = "$minId";
        } else {
            $series = "$minId-$maxId";
        }
		
		$moon = NULL;
		if(!empty($row['moonplayer'])){
			$moon = $row['moonplayer'];
		}
		
		$announce = $row['announce'];
		if(!empty($announce)) {
			$announce = trim($announce);
		}
		if(empty($announce)) {
			$announce = NULL;
		}
		
		$info[$row['id']] = [
			'id' => intval($row['id']),
			'code' => $row['code'],
			'names' => $names, 
            'series' => $series,
            'poster' => $poster,
            'rating' => $row['rating'],
			'last' => $row['last'],
			'moon' => $moon,
			'announce' => $announce,
			'status' => $var['status'][$row['status']],
			'type' => $row['type'],
			'genres' => $genres,
			'voices' => $voices,
			'year' => $row['year'],
			'day' => $row['day'],
			'description' => $row['description'],
            //Для блокировки релизов
            'blockedInfo' => [
                'blocked' => $row['block'],
                'reason' => NULL
            ],
            'playlist' => $playlist
		];
        
		$tmp = $db->prepare('SELECT `fid`, `info_hash`, `leechers`, `seeders`, `completed`, `info` FROM `xbt_files` WHERE `rid` = :rid');
		$tmp->bindParam(':rid', $row['id']);
		$tmp->execute();
		while($xrow=$tmp->fetch()){
			$data = json_decode($xrow['info'], true);
            $link = NULL;
            if($user){
				$link = "/public/torrent/download.php?id={$xrow['fid']}";
			}else{
				$link = "/upload/torrents/{$xrow['fid']}.torrent";
			}
			$torrent[$row['id']][] = [
				'id' => intval($xrow['fid']),
				'hash' => unpack('H*', $xrow['info_hash'])['1'],
				'leechers' => intval($xrow['leechers']),
				'seeders' => intval($xrow['seeders']),
				'completed' => intval($xrow['completed']),
				'quality' => $data['0'],
				'series' => $data['1'],
				'size' => intval($data['2']),
                'url' => $link
			];
		}
	}
	$chunk = array_chunk($info, 100, true);
	foreach($chunk as $k => $v){
		$cache->set("apiInfo$k", json_encode($v), 300);
	}
	$cache->set('apiInfo', count($chunk), 300);
	$cache->set('apiTorrent', json_encode($torrent), 300);
}

function getApiPlaylist($id){
	global $conf;
	$playlist = [];
	$episodesSrc = getRemote($conf['nginx_domain'].'/?id='.$id.'&v2=1', 'video'.$id);
	if($episodesSrc){
		$episodesArr = json_decode($episodesSrc, true);
		$host = anilibria_getHost($episodesArr['online']);
		if(!empty($episodesArr) && !empty($episodesArr['updated'])){
			unset($episodesArr['updated']);
			foreach($episodesArr as $key => $episodeSrc) {
				if($key == 'online' || $key == 'new'){
					continue;
				}
				$download = '';
				if(!empty($episode['file'])){
					$download = mp4_link($episodeSrc['file'].'.mp4');
				}
				if($host){
					$episodeSrc['new2'] = str_replace('[720p]', 'https:', $episodeSrc['new2']);
					$episodeSrc['new2'] = str_replace('[480p]', 'https:', $episodeSrc['new2']);
					$q = explode(',', $episodeSrc['new2']);
					$episode = [
						"id" => $key,
						"title" => "Серия $key",
						"sd" => $q['1'],
						"hd" => $q['0'],
						"file" => $episodeSrc['file']
					];
				}
                if(!empty($episodeSrc['file'])){
					$episode['srcSd'] = mp4_link($episodeSrc['file'].'.mp4');
				}
                $playlist[] = $episode;
			}
		}
		if($host){
			$playlist['online'] = $episodesArr['online'];
		}
	}
	return $playlist;
}

class ApiResponse {
    private $status = FALSE;
    private $data = NULL;
    private $error = NULL;
    
    public function proceed($func){
        try {
            $data = $func();
            $this->success($data);
        } catch(ApiException $e) {
            $this->error(
                $e->getMessage(),
                $e->getCode(),
                $e->getDescription()
            );
        } catch (Throwable $e) {
			$this->error(
                $e->getMessage(),
                $e->getCode()
            );
		} catch(Exception $e) {
            $this->error(
                $e->getMessage(),
                $e->getCode()
            );
        } finally {   
            return $this->build();
        }
    }
    
    public function success($data) {
        $this->status = TRUE;
        $this->error = NULL;
        $this->data = $data;
        return $this->build();
    }
    
    public function error($message = "Default API error", $code = 400, $description = NULL) {
        $this->status = FALSE;
        $this->data = NULL;
        $this->error = [
            'code' => $code,
            'message' => $message,
            'description' => $description
        ];
        return $this->build();
    }
    
    private function build(){
        return [
            'status' => $this->status,
            'data' => $this->data,
            'error' => $this->error
        ];
    }
}

class ApiException extends \Exception {
    protected $description = NULL;
    
    public function __construct($message = "Default API error", $code = 400, $description = NULL){
        parent::__construct($message, $code);
        $this->description = $description;
    }
    
    public function getDescription() { return $this->description; }
}
