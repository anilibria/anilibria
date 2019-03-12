<?php
require($_SERVER['DOCUMENT_ROOT'].'/private/config.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/mysql.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/memcache.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/session.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/var.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/func.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/auth.php');

$var['title'] = 'Заявка в команду';

$var['page'] = 'request';

require($_SERVER['DOCUMENT_ROOT'].'/private/header.php');
?>

<style>
.req {
	float: left;
	width: 410px;
	font-size: 10pt;
}

.reqe {
	margin-left: 20px;
}
</style>

<div class="news-block">
	<div class="news-body">
		<div class="req">
			<font color="#800000" style="font-size: 16px;">
				<b>Технари</b>
			</font>
			<ul>
				<li>Возраст 16+</li>
				<li>Знание русского языка</li>
				<li>Наличие свободного времени</li>
				<li>Желание учиться, развиваться</li>
				<li>Умение работать в команде</li>
				<li>Умение внимательно слушать, понимать и соблюдать правила</li>
				<li>Наличие свободного места на ПК (150-200 Гб)</li>
				<li>Наличие хорошего и стабильного соединения с интернетом (не менее 10 Мбит/с)</li>
				<li>Умение работать в программах видео/аудиоредакторах (Adobe, Sony, etc)</li>
				<li>Обязательно держать связь через Telegram и Discord</li>
				<li>Опыт работы в данной сфере деятельности</li>
				<li>Базовые умения работы с субтитрами (ретайминг) / владение программой Aegisub</li>
				<li>Умение работать с комплексом программ MKVToolNix</li>
				<li><font color="red">Обязательно нужно выполнить задание ниже.</font></li>
				<a href="https://yadi.sk/d/DxwF92LskjizW">Ссылка на задание</a>
			</ul>
		</div>
		<div class="req reqe">
			<font color="#339966" style="font-size: 16px;">
				<b>Войсеры</b>
			</font>
			<ul>
				<li>Наличие свободного времени</li>
				<li>Умение читать, понимать и соблюдать правила</li>
				<li>Опыт работы в качестве войсера - не менее 12 серий</li>
				<li>Умение работать в команде, кооперироваться с другими<br>
					людьми для достижения одной цели</li>
				<li>Возможность держать связь через Telegram</li>
			</ul>
			<br/>
		</div>
		<div class="req reqe">
			<font color="#ff6600" style="font-size: 16px;">
				<b>Сабберы</b>
			</font>
			<ul>
			<li>Знание Русского языка!</li>
			<li>Наличие свободного времени</li>
			<li>Возраст 18+</li>
			<li>Умение читать, понимать и соблюдать правила</li>
			<li>Умение работать в программе Aegisub</li>
			<li>Умение работать в команде</li>
			<li>Возможность держать связь через Telegram</li>
			<li>Возможность перевода с английского и/или японского языка(Переводчик)</li>
			</ul>
			<br/>
		</div>
		<div class="req">
			<font color="green" style="font-size: 16px;">
				<b>Сидеры</b>
			</font>
			<ul>
			<li>Интернет-соединение (минимум 10 Мбит/с)</li>
			<li>Свободное место на HDD (минимум 500 ГБ)</li>
			<li>Включенная раздача (минимум 6 ч/сутки)</li>
			<li>Возможность держать связь через Telegram</li>
			</ul>
			<br/>
		</div>
		<div class="req reqe">
			<font color="#f2d20c" style="font-size: 16px;">
				<b>Пиарщики</b>
			</font>
			<ul>
				<li>Наличие свободного времени</li>
				<li>Желание бескорыстно помочь проекту</li>
				<li>Умение вежливо общаться с людьми</li>
				<li>Грамотное письмо(речь)</li>
			</ul>
			<br/>
		</div>
		<div class="req">
			<font style="font-size: 16px;">
				<b>Условия и обязанности</b>
			</font>
			<ul>
				<li><a href="/pages/login.php#rules">Ознакомиться с уставом проекта</a></li>
				<li>Слушать и прислушиваться к руководству.</li>
				<li>Нести ответственность за свою деятельность.</li>
				<li>Выполнять работу в указанные руководством сроки<br>
				(при невозможности исполнения этого пункта,<br>
				надлежащим образом уведомить заинтересованных лиц).</li>
				<li>Проверять свою работу на наличие ошибок.</li>
			</ul>
		</div>
	</div>
	<div class="clear"></div>
	<div style="margin-top:10px;"></div>
</div>

<div class="news-block">
	<div class="news-header">
		<h2 id="sendHHMes" class="news-name" style="float:left;">
			Пожалуйста, заполните
		</h2>
		<div class="clear"></div>	
	</div>
	<select id="rPosition" class="form-control" >
		<option value="" disabled="" selected="">Заявка</option>
		<option value="1">Технарь</option>
		<option value="2">Войсер</option>
		<option value="3">Саббер</option>
		<option value="4">Сидер</option>
		<option value="5">Пиарщик</option>
    </select>
	<input id="rName" class="form-control" style="margin-top: 7px;" placeholder="Имя" autocomplete="off">
	<input id="rNickname" class="form-control" style="margin-top: 7px;" placeholder="Никнейм/ творческий псевдоним (например: Lupin)" autocomplete="off">
	<input id="rAge" class="form-control" style="margin-top: 7px;" placeholder="Сколько вам лет?" autocomplete="off">
	<input id="rCity" class="form-control" style="margin-top: 7px;" placeholder="Город/ поселение проживания" autocomplete="off">
	<input id="rEmail" class="form-control" style="margin-top: 7px;" placeholder="Email" autocomplete="off">
	<input id="rTelegram" class="form-control" style="margin-top: 7px;" placeholder="Telegram" autocomplete="off">
	<textarea id="rAbout" class="form-control" style="margin-top: 7px; resize: vertical;" placeholder="Немного о себе" autocomplete="off"></textarea>
	<textarea id="rWhy" class="form-control" style="margin-top: 7px; resize: vertical;" placeholder="Почему вы выбрали именно наш проект (честно)" autocomplete="off"></textarea>
	<textarea id="rWhere" class="form-control" style="margin-top: 7px; resize: vertical;" placeholder="На каких проектах были, причина ухода" autocomplete="off"></textarea>
	<!-- Технарь -->
	<input id="techTask" class="form-control" style="margin-top: 7px; display: none;" placeholder="Ссылка на выполненное задание" autocomplete="off">
	<!-- Войсер -->
	<input id="voiceAge" class="form-control" style="margin-top: 7px; display: none;" placeholder="Сколько лет занимаетесь озвучкой" autocomplete="off">
	<input id="voiceEquip" class="form-control" style="margin-top: 7px; display: none;" placeholder="Модель микрофона и звуковой карты" autocomplete="off">
	<input id="voiceExample" class="form-control" style="margin-top: 7px; display: none;" placeholder="Ссылка на пример озвучки" autocomplete="off">
	<input id="voiceTiming" class="form-control" style="margin-top: 7px; display: none;" placeholder="Умеете ли вы сами таймить и сводить звук" autocomplete="off">
	<!-- Саббер -->
	<input id="subExp" class="form-control" style="margin-top: 7px; display: none;" placeholder="Опыт работы с субтитрами" autocomplete="off">
	<input id="subPosition" class="form-control" style="margin-top: 7px; display: none;" placeholder="Какую должность вы хотите занимать? (Переводчик / Оформитель)" autocomplete="off">
	
	<div style=" margin-top: 15px; ">
	<input id="rAccept" class="form-check-input" type="checkbox" value="1">
	<label class="form-check-label">
		С Условиями и обязанностями полностью согласен!
	</label>
	</div>
	<input id="sendRequest" data-send-request class="btn btn btn-default btn-block" style="float: left; margin-top: 10px; width: 100px; display: none;" type="submit" value="Отправить">
	<div class="clear"></div>
	<div style="margin-top:10px;"></div>
</div>

<div id="vk_comments" style="margin-top: 10px;"></div>

<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" style="width: 600px;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="avatarInfo">Заявка отправлена</h4>
			</div>
			<div  class="modal-body">
				Если вам долго не отвечают на почту, то возможно заявка попала в спам.<br/>
				Пожалуйста, напишите в telegram <a href="https://t.me/AniLibriaTP">@AniLibriaTP</a> и узнайте статус.
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>

<?php require($_SERVER['DOCUMENT_ROOT'].'/private/footer.php');?>
