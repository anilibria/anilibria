<?php
require($_SERVER['DOCUMENT_ROOT'].'/private/config.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/mysql.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/memcache.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/session.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/var.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/func.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/auth.php');

if($user){
	die(header("Location: https://".$_SERVER['SERVER_NAME']));
}

if(empty($_GET['id']) || empty($_GET['time']) || empty($_GET['hash'])){
	die(header("Location: https://".$_SERVER['SERVER_NAME']."/pages/error/403.php"));
}

$vktmp = json_encode(['id' => $_GET['id'], 'time' => $_GET['time'], 'hash' => $_GET['hash']]);
$var['title'] = 'Регистрация аккаунта';
$var['page'] = 'vk';

require($_SERVER['DOCUMENT_ROOT'].'/private/header.php');
?>

<div class="news-block">
		<div class="news-header">
			<h2 class="news-name" style="float:left;">
				Регистрация
			</h2>
			<h2 class="news-name" id="regMes" style="float:left; padding-left: 10px;"></h2>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
		<div>
			<input type="hidden" id="regVK" value='<?php echo $vktmp; ?>'>
			<input class="form-control" id="regLogin" placeholder="Логин" type="email" required="">
			<input class="form-control" id="regEmail" style="margin-top: 10px;" placeholder="E-mail" type="email" required="">
			<input class="form-control" id="regPasswd" style="margin-top: 10px;" placeholder="Пароль" type="password" required>
			<div id="RecaptchaField" style="margin-top: 10px; display: none;"></div>
			<input class="btn btn btn-success btn-block" style="margin-top: 10px;" type="submit" data-submit-register="" value="ОТПРАВИТЬ">
			<br/>
			<center>
			Вы первый раз авторизовались через VK на нашем сайте.
			Пожалуйста, <font color='green'>заполните форму</font>.
			</center>
		</div>
		<div class="clear"></div>
		<div style="margin-top:10px;"></div>
</div>

<div id="vk_comments" style="margin-top: 10px;"></div>

<?php require($_SERVER['DOCUMENT_ROOT'].'/private/footer.php');?>
