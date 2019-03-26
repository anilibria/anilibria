#!/usr/bin/php
<?php

require('/var/www/anilibria/root/private/config.php');
require('/var/www/anilibria/root/private/init/memcache.php');

function sendApi($url, $data, $cookie = ''){
	$options = [
		'http' => [
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n".
			"Cookie: awuegfusvfkjasdf=$cookie\r\n",
			'method'  => 'POST',
			'content' => http_build_query($data)
		]
	];
	$context  = stream_context_create($options);
	return [file_get_contents($url, false, $context), $http_response_header];
}

function authPlayerJS(){
	global $cache, $conf;
	$result = $cache->get('playerAuth');
	if($result === false){
		$result = sendApi(
			'https://playerjs.com/php/apps/playerjs/sign.php', 
			[
				'l' => $conf['player_login'],
				'p' => $conf['player_passwd'],
			]
		);
		preg_match("/awuegfusvfkjasdf=(.*?);/s", $result['1']['6'], $phpsessid);
		$result = $phpsessid['1'];
		$cache->set('playerAuth', $result, 300);
	}
	return $result;
}

function simpleSend($url, $data){
	global $cookie;
	return sendApi($url, $data, $cookie)['0'];
}

function getStatAds(){
	global $cache; $ads = [];
	
	function updatePlayerStat($cache, $arr){
		$cache->set('playerStat', json_encode($arr), 86400);
	}
	
	$ads['mix'] = ['id' => 1288, 'price' => 100 ];
	$ads['rey'] = ['id' => 1446, 'price' => 75 ];
	
	$result = []; $result['all'] = 0;
	foreach($ads as $key => $val){
		$stat = simpleSend(
			'https://playerjs.com/php/apps/playerjs/vast_impressions.php', 
			[ 'x' => $val['id'], 'y' => 0, 'h' => '', 'p' => 0 ]
		);
		list($numbers, $date) = explode('/', $stat);
		list($hit, $mis) = explode('::', $numbers);
		$total = $hit+$mis;
		$result["$key"] = [
			'weight' => round($hit*100/$total*$val['price']),
			'hit' => $hit,
			'mis' => $mis,
			'total' => $total
		];
		$result['all'] += $result["$key"]['weight'];
	}
	
	$result['time'] = time()+60*60;
	$old = $cache->get('playerStat');
	if($old === false){
		updatePlayerStat($cache, $result);
	}else{
		$old = json_decode($old, true);
		if($old['time'] < time()){
			updatePlayerStat($cache, $result);
		}
		foreach($old as $key => $val){
			if($key == 'all' || $key == 'time'){
				continue;
			}
			
			if($result["$key"]['hit'] < $val['hit']){
				updatePlayerStat($cache, $result);
				break;
			}
			
			$result['all'] -= $result["$key"]['weight'];
			
			$hit = $result["$key"]['hit']-$val['hit'];
			$mis = $result["$key"]['mis']-$val['mis'];
			$total = $hit+$mis;
			
			if($hit > 0 && $mis > 0){
				$result["$key"]['hit'] = $hit;
				$result["$key"]['mis'] = $mis;
				$result["$key"]['total'] = $total;
				
				$result["$key"]['weight'] = round($hit*100/$total*$ads["$key"]['price']);
				$result['all'] += $result["$key"]['weight'];
			}
		}
	}
	unset($result['time']);
	
	foreach($result as $key => $val){
		if($key == 'all'){
			continue;
		}
		$result["$key"]['rate'] = round($val['weight']/$ads["$key"]['price']);
		$result["$key"]['percent'] = round($val['weight']*100/$result['all']);
		unset($result["$key"]['weight']);
	}
	
	unset($result['all']);
	$cache->set('playerStatAds', json_encode($result), 1800);
	//var_dump($result);
}

$cookie = authPlayerJS();
getStatAds();
