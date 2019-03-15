<?php
require($_SERVER['DOCUMENT_ROOT'].'/private/config.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/mysql.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/memcache.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/session.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/var.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/func.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/auth.php');

checkCSRF();

if(
	($user ? $user['access'] : 0) < CONF_BUGREPORT_BUTTON_ACCESS
	|| empty($_POST['msg']) || trim($_POST['msg']) === ''
){
	_message('empty', 'error');
}

if(empty($_POST['rid']) || $_POST['rid'] < 1){
	_message('wrongRelease', 'error');
}


require_once($_SERVER['DOCUMENT_ROOT'].'/private/model.bugreport.php');

if(addBugreport($_POST['rid'], ($user ? $user['id'] : NULL), $_SERVER['REMOTE_ADDR'], $_POST['msg'])){
	_message2('Спасибо за помощь!');
}else{
	_message('wrongData', 'error');
}
