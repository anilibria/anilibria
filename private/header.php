<?php
if(!empty($_SESSION['csrf'])){
	$csrf_token = json_encode(csrf_token());
}else{
	$csrf_token = '';
}

function headerAds(){
	global $cache, $var; $result = []; $left = 0;
	$img = '/img/29.png';
	$result['ads'] = false;

	$data[] = ['img' => 'ragnarok', 'left' => '0px', 'url' => '/ro'];
	$data[] = ['img' => 'bs', 'left' => '-195px', 'url' => '/bs'];
	//$data[] = ['img' => 'storm', 'left' => '0px', 'url' => '/storm'];
	//$data[] = ['img' => 'cro', 'left' => '0px', 'url' => '/cro'];
	$data[] = ['img' => 'rise', 'left' => '0px', 'url' => '/rise'];

	if(checkADS()){
		//$cday = date('j', $var['time']);
		//$key = $cache->get('adsCurrent');
		//$day = $cache->get('adsCurrentDay');
		//if($key === false || $day === false || $day != $cday){
		//	if($key === false){
		//		$key = 0;
		//	}else{
		//		$key++;
		//	}
		//	if($key > count($data)-1){
		//		$key = 0;
		//	}
		//	//$key = random_int(0, count($data)-1);
		//	$cache->set('adsCurrent', $key, 172800);
		//	$cache->set('adsCurrentDay', $cday, 172800);
		//}

		$key = 0;
		$ads = $data["$key"];
		
		$img = '/img/other/a/'.$ads['img'].'.jpg';
		$left = $ads['left'];
		$result['url'] = $ads['url'];
		$result['ads'] = true;
		
	}
	
	$left = '350px;'; 
	$img = '/img/31.jpg';
	$result['url'] = '/season/2019spring.html';
	$css = getTemplate('header');
	$css = str_replace('{img}', $img, $css);
	$css = str_replace('{left}', $left, $css);
	$result['css'] = $css;
	return $result;
}

$xcss = headerAds();
?>

<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#">
	<head>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-44944415-2"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());
		  gtag('config', 'UA-44944415-2');
		</script>
			
		<?php echo $var['og']; ?>
		<title><?php echo $var['title']; ?></title>
		<meta charset="UTF-8">
		<meta name="description" content="<?php echo strip_tags($var['description']); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo fileTime('/css/bootstrap.min.css');?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo fileTime('/css/main.css');?>" />
		<style><?php echo $xcss['css']; ?></style>
	</head>
	<body>
		<input type="hidden" id="csrf_token" value='<?php echo $csrf_token; ?>'>
		<!-- 
			https://github.com/AdguardTeam/AdguardFilters/pull/30164
			https://forums.lanik.us/viewtopic.php?f=102&t=34618
		-->
		<div id="headercontent"></div>
		<div class="link">
		<?php
			//if($xcss['ads']){
				echo '<a href="'.$xcss['url'].'"></a>';
			//}
		?>
		</div>
		<div class="header">
			<?php
				//if($xcss['ads']){
					echo "<div class='headercontent'></div>";
				//}
			?>
		</div>
		<div class="main">
			<div class="content">
				<div class="contentmenu">
					<ul class="main-navigation">
						<li><a id="activelink0" href="/">ГЛАВНАЯ</a></li>
						<li><a id="activelink1" href="/pages/catalog.php">РЕЛИЗЫ</a></li>
						<li><a id="activelink2" href="/pages/schedule.php">РАСПИСАНИЕ</a></li>
						<li><a data-random-release id="activelink3" href="/public/random.php">СЛУЧАЙНОЕ</a></li>
						<li><a id="activelink4" href="/pages/app.php">ПРИЛОЖЕНИЕ</a></li>
						<li><a id="activelink5" href="/pages/team.php">КОМАНДА</a></li>
						<li><a id="activelink6" href="/pages/donate.php">ПОДДЕРЖАТЬ ПРОЕКТ</a></li>
					</ul>
				</div>

