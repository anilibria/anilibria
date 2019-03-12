<?php
require($_SERVER['DOCUMENT_ROOT'].'/private/config.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/mysql.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/memcache.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/session.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/var.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/func.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/auth.php');
$var['title'] = '403';
$var['page'] = '403';
header('HTTP/1.0 403 Forbidden');

require($_SERVER['DOCUMENT_ROOT'].'/private/header.php');
?>

<div class="news-block">
	<div>
		<center>			
		<img src="/img/403.png">
		</center>
	</div>
	<div class="clear"></div>
	<div class="news_footer"></div>
</div>

<div id="vk_comments" style="margin-top: 10px;"></div>

<?php require($_SERVER['DOCUMENT_ROOT'].'/private/footer.php');?>
