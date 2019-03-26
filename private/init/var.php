<?php
$var['title'] = 'AniLibria - так звучит аниме!';
$var['description'] = '';
$var['og'] = '';
$var['page'] = '';
$var['release'] = [];
$var['time'] = time();
$var['ip'] = $_SERVER['REMOTE_ADDR'];
$var['user_agent'] = '';
if(!empty($_SERVER['HTTP_USER_AGENT'])){
	$var['user_agent'] = htmlspecialchars($_SERVER['HTTP_USER_AGENT'], ENT_QUOTES, 'UTF-8');
}
$var['default_user_values'] = '{"name":"","age":"","sex":"","vk":"","telegram":"","steam":"","phone":"","skype":"","facebook":"","instagram":"","youtube":"","twitch":"","twitter":""}';

$var['app_version'] = 45;

$var['sex'] = [
	'Не указано',
	'Мужской',
	'Женский'
];

$var['status'] = [
	'1' => 'В работе',
	'2' => 'Завершен',
	'3' => 'Скрыт',
	'4' => 'Неонгоинг'
];

$var['group'] = [
	'1' => 'Пользователь',
	'2' => 'Сидер',
	'3' => 'Редактор',
	'4' => 'Админ'
];

$var['day'] = [ 
	'1' => 'Понедельник',
	'2' => 'Вторник',
	'3' => 'Среда',
	'4' => 'Четверг',
	'5' => 'Пятница',
	'6' => 'Суббота',
	'7' => 'Воскресенье',
];

$var['announce'] = [ 
	'1' => 'Новая серия каждый понедельник',
	'2' => 'Новая серия каждый вторник',
	'3' => 'Новая серия каждую среду',
	'4' => 'Новая серия каждый четверг',
	'5' => 'Новая серия каждую пятницу',
	'6' => 'Новая серия каждую субботу',
	'7' => 'Новая серия каждое воскресенье',
];

$var['user_values'] = [
	'access' => 'Доступ', 
	'register_date' => 'Дата регистрации', 
	'last_activity' => 'Последняя активность',
	'name' => 'Имя',
	'age' => 'Возраст',
	'sex' => 'Пол', 
	'vk' => 'Вконтакте', 
	'telegram' => 'Телеграм',
	'steam' => 'SteamID',
	'phone' => 'Телефон',
	'skype' => 'Skype',
	'facebook' => 'Facebook',
	'instagram' => 'Instagram',
	'youtube' => 'Youtube',
	'twitch' => 'Twitch',
	'twitter' => 'Twitter',
	'telegram' => 'Telegram'
];

$var['error'] = [
	'success' => 'Успех',
	'empty' => 'Пустое значение, заполните все поля',
	'wrong' => 'Неправильное значение',
	'authorized' => 'Уже авторизован',
	'registered' => 'Уже зарегистрирован',
	'long' => 'Слишком длинное значение',
	'short' => 'Слишком короткое значение',
	'wrongLogin' => 'Неправильный логин',
	'wrongEmail' => 'Неправильный email',
	'wrongUserAgent' => 'Неправильный user agent',
	'invalidUser' => 'Неправильный пользователь',
	'wrong2FA' => 'Неправильный код 2FA',
	'wrongPasswd' => 'Неправильный пароль',
	'wrongNewPasswd' => 'Новый пароль не совпадает',
	'samePasswd' => 'Использован старый пароль',
	'noUser' => 'Нет такого пользователя',
	'wrongHash' => 'Неправильный hash',
	'wrongLink' => 'Неправильная ссылка',
	'reCaptchaFail' => 'reCaptcha test failed',
	'reCaptcha3' => 'reCaptcha test failed: score too low',
	'coinhive' => 'Coinhive проверка не пройдена',
	'checkEmail' => 'Проверьте почту',
	'unauthorized' => 'Неавторизованный пользователь',
	'2FA' => '2FA уже активирована',
	'2FAdisabled' => '2FA выключена',
	'2FAenabled' => '2FA включена',
	'access' => 'Доступ запрещен',
	'same' => 'Одинаковые данные',
	'used' => 'Уже занято',
	'noUploadFile' => 'Неудачная загрузка',
	'uploadError' => 'Неудачная загрузка',
	'wrongType' => 'Неправильный формат файла',
	'maxSize' => 'Слишком большой файл',
	'maxarg' => 'Слишком много аргументов',
	'wrongData' => 'Неправильные данные',
	'wrongRelease' => 'Неправильный релиз',
	'exitTorrent' => 'Торрент уже добавлен',
];

$var['season'] = ['winter' => 'зима', 'spring' => 'весна', 'summer' => 'лето', 'autumn' => 'осень'];

$var['youtube']['2017winter'] = 'OXBO4h3l3rM';
$var['youtube']['2017spring'] = '1c7WG8XpmYs';
$var['youtube']['2017summer'] = 'wOcpVolqCs';
$var['youtube']['2018autumn'] = 'Sv4u2-YdUXE';
	
$var['youtube']['2018winter'] = '3Ib5MsPkjPk';
$var['youtube']['2018spring'] = 'GYOG_XUhWpw';
$var['youtube']['2018summer'] = '7g0tp6tMoU0';
$var['youtube']['2018autumn'] = 'eocPilzfxXE';
	
$var['youtube']['2019winter'] = 'PYh5yYkHZok';
$var['youtube']['2019spring'] = '2MNMguWS7ss';
