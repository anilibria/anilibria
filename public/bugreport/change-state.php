<?php
require($_SERVER['DOCUMENT_ROOT'].'/private/config.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/mysql.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/memcache.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/session.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/var.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/func.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/auth.php');

checkCSRF();

if(($user ? $user['access'] : 0) < CONF_BUGREPORT_EDITOR_ACCESS){
	_message('access', 'error');
}

if(empty($_POST['release']) || $_POST['release'] < 1){
	_message('wrongRelease', 'error');
}
$release_id = (int)$_POST['release'];

switch($_POST['button']){
	case 'act-checked':
		$ids = array_keys($_POST['bugs']);
		if(empty($ids)) _message('wrongData', 'error');
		break;
	case 'act-all':
		$ids = [];
		$_POST['bugs'] = [];
		break;
	default:
		_message('wrongData', 'error');
}

if($_POST['action'] !== 'open' && $_POST['action'] !== 'close'){
	_message('wrongData', 'error');
}


require_once($_SERVER['DOCUMENT_ROOT'].'/private/model.bugreport.php');

if(changeBugreportState($release_id, $user['id'], $ids, $_POST['action'])){
	_message('success');
}else{
	_message('wrongData', 'error');
}
