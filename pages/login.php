<?php
require($_SERVER['DOCUMENT_ROOT'].'/private/config.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/mysql.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/memcache.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/session.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/var.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/func.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/auth.php');

$var['title'] = 'Авторизация, правила';
$var['page'] = 'login';

require($_SERVER['DOCUMENT_ROOT'].'/private/header.php');

if(!$user){
?>
<div class="news-block">
		<div class="news-header">
			<h2 class="news-name" id="loginMes"></h2>
			<div class="clear"></div>	
		</div>
		<div class="clear"></div>
		<div>
			<input class="form-control" id="newMail" placeholder="Email или логин" type="text" required>
			<input class="form-control" id="newPasswd" style="margin-top: 10px;"  type="password" placeholder="Пароль" required>
			<input class="form-control" id="fa2code" style="margin-top: 10px;" type="text" placeholder="Оставьте поле пустым, если вы не настроили двухфакторную аутентификацию">
			<div style="margin-top: 10px;">
				<input class="btn btn btn-success" style="width: 418px;" type="submit" name="login" data-submit-login value="ВХОД ЧЕРЕЗ САЙТ">	
				<a href="<?php echo vkAuthLink(); ?>" role="button" class="btn btn btn-success" style="width: 417px;">ВХОД ЧЕРЕЗ VK.COM</a>
			</div>
		</div>
		<div class="clear"></div>
		<div style="margin-top:10px;"></div>
</div>

<div class="news-block">
		<div class="news-header">
			<h2 class="news-name" id="regMes"></h2>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
		<div>
			<input class="form-control" id="regLogin" placeholder="Логин" type="email" required>
			<input class="form-control" id="regEmail" style="margin-top: 10px;" placeholder="E-mail (если забыли пароль - заполняйте только это поле)" type="email" required>
			<input class="form-control" id="regPasswd" style="margin-top: 10px;" placeholder="Пароль" type="password" required>
			<div id="RecaptchaField" style="margin-top: 10px; display: none;"></div>
			<div style="margin-top: 10px;">
				<input class="btn btn btn-success" style="width: 418px;" type="submit" data-submit-register value="РЕГИСТРАЦИЯ" />
				<input class="btn btn btn-success" style="width: 417px;" type="submit" data-submit-passwdrecovery value="ВОССТАНОВИТЬ ПАРОЛЬ" />
			</div>
		</div>
		<div class="clear"></div>
		<div style="margin-top:10px;"></div>
</div>

<?php } ?>	

<style>
.day {
    background: #4a4a4a;
    text-align: center;
    margin: 10px 0 10px 0;
    height: 30px;
    font-size: 13pt;
    line-height: 30px;
    border-radius: 3px;
    color: white;
}

.teamleft {
    float: left;
    margin-left: 6px;
}
	
</style>

<div class="news-block" id="rules">
		<div class="news-header"></div>
		<div class="clear"></div>
		<div>
			<div class="day" style="width: 76px;">
				<div class="teamleft">Правила</div> 
			</div>
			<p>Все посты, оставляемые пользователями, должны быть конструктивными и нести смысловую нагрузку, ну или хотя бы быть весьма позитивными, а также не нарушать правил, описанных в данной теме.</p>
			
			<p>Нецензурные выражения, в том числе и завуалированные. Недопустимы в любом виде. Исключения могут быть сделаны только для материалов, в которых невозможно сохранить смысл без мата и ТОЛЬКО с разрешения супермодератора или администрации. При этом обязательно предупреждение, что в материалах содержится мат.</p>
			
			<p>Запрещены любые оскорбления личности.</p>
			
			<p>Запрещено использование нецензурных слов, а также слов, оскорбляющих других пользователей. Запрещена порнография. Ники состоящие только из чисел, содержащие разнообразные символы, только повторяющиеся символы, написанные одновременно на нескольких языках и тому подобное — недопустимы. Слишком большие/яркие подписи также недопустимы. Размещение огромных (как по размеру, так и по весу) картинок — запрещено.<br></p>
			<p>Запрещено использование ников, идентичных с именитыми фандаберами/членами команды АниЛибрии, если вы ими, конечно, не являетесь.</p>
			
			<p>Сообщения, не имеющие смысла и не относящиеся к теме, жестко караются. Чаще всего флуд — это посты из одного-двух слов, не относящиеся к теме, смайлики и т.п. Так-же удаляются "уродливые сообщения", например такие, в которых цитирование занимает большой объём страницы (больше 10 строчек). </p>

			<p>Запрещена любая рекламная и коммерческая деятельность на портале без согласования с администрацией.</p>
			<p>Запрещаются ссылки на любые ресурсы по озвучке аниме-сериалов и дорам.</p>
		</div>
		<div class="clear"></div>
		<div style="margin-top:10px;"></div>
</div>

<div id="vk_comments" style="margin-top: 10px;"></div>
	
<?php require($_SERVER['DOCUMENT_ROOT'].'/private/footer.php');?>
