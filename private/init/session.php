<?php

function sessionHandler(){
	// http://php.net/manual/en/function.session-id.php
	// Warning: session_start(): The session id is too long or contains illegal characters, valid characters are a-z, A-Z, 0-9 and '-,'
	if(isset($_COOKIE['PHPSESSID']) && !preg_match('/^[-,a-zA-Z0-9]{22,64}$/', $_COOKIE['PHPSESSID'])){
		setcookie('PHPSESSID', '', time() - 86400, '/', $_SERVER['SERVER_NAME'], true, true);
		unset($_COOKIE['PHPSESSID']);
		return;
	}

	$lifetime = 60*60*24*30;
	session_set_cookie_params($lifetime, '/', $_SERVER['SERVER_NAME'], true, true);

	// https://github.com/php-memcached-dev/php-memcached/issues/269
	// try use redis
	session_start();
	
	if(empty($_SESSION['secret'])){
		$_SESSION['secret'] = bin2hex(random_bytes(32));
	}
	
	// https://stackoverflow.com/questions/17301114/php-session-set-cookie-params-lifetime-doesnt-work
	// http://php.net/manual/ru/function.session-set-cookie-params.php
	// As PHP's Session Control does not handle session lifetimes correctly when using session_set_cookie_params()
	// we need to do something in order to change the session expiry time every time the user visits our site. So, here's the problem.
	if(random_int(1, 10) == 1){
		setcookie(session_name(), session_id(), time()+$lifetime, '/', $_SERVER['SERVER_NAME'], true, true);
	}
}

sessionHandler();
