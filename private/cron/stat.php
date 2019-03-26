#!/usr/bin/php
<?php
function onlineUpdate(){
	$sum = 0; 
	$json = file_get_contents("https://static.anilibria.tv/stat/", false, stream_context_create(['http'=> [ 'timeout' => 5 ]]));
	if($json === false){
		return;
	}
	$arr = json_decode($json, true);
	$data = [];
	foreach($arr as $key => $val){
		$name = trim(htmlspecialchars($val['Name'], ENT_QUOTES, 'UTF-8'));
		$url = base64_decode(htmlspecialchars($val['Url'], ENT_QUOTES, 'UTF-8'));
		$count = htmlspecialchars($val['Count'], ENT_QUOTES, 'UTF-8');
		$k = strtolower("$key");
		$data[] = [$name, $url, $count];
		$sum += $count;
	}
	usort($data, function($a, $b) {
		$rdiff = $a['2'] - $b['2'];
		if ($rdiff) return $rdiff; 
		return $a['2'] - $b['2']; 
	});
	krsort($data, true);
	$data = array_slice($data, 0, 20);
	$data['sum'] = $sum;
	file_put_contents('/var/www/anilibria/root/upload/stats.json', json_encode($data));
}

onlineUpdate();
