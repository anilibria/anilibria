#!/usr/bin/php
<?php

require('/var/www/anilibria/root/private/config.php');
require('/var/www/anilibria/root/private/init/memcache.php');

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
	global $cache;
	$ads = [ 
		'player.mix.js' => ['id' => 1288, 'price' => 100 ],
		'player.zet.js' => ['id' => 1279, 'price' => 130 ],
		'player.reyden.js' => ['id' => 1446, 'price' => 70 ]
	];
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
			'weight' => round($hit/$total*$val['price']),
			'hit' => $hit,
			'mis' => $mis,
			'total' => $total
		];
		$result['all'] += $result["$key"]['weight'];
	}
	foreach($result as $key => $val){
		if($key == 'all'){
			continue;
		}
		$result["$key"]['percent'] = round($val['weight']*100/$result['all']);
		unset($result["$key"]['weight']);
	}
	unset($result['all']);
	$cache->set('playerStatAds', json_encode($result), 1800);
	//var_dump($result);
}
