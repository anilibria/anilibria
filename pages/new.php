<?php
require($_SERVER['DOCUMENT_ROOT'].'/private/config.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/mysql.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/memcache.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/session.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/var.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/func.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/auth.php');

if(!$user || $user['access'] < 2){
	header('HTTP/1.0 403 Forbidden');
	header('Location: /pages/error/403.php');
	die;
}

require($_SERVER['DOCUMENT_ROOT'].'/private/header.php');

$var['page'] = 'new';
?>

<div class="news-block">
		<div class="news-header">
			<h2 class="news-name" style="float:left;">
				Новый релиз
			</h2>
		
		<button data-release-new type="button" class="btn btn-default" style="float: right; height: 30px; padding: 0px 12px; ">Save</button>
		<label class="btn btn-default" style="float: right; height: 30px; padding: 4px 12px; margin-right: 7px;">Upload <input id="uploadPosterAdmin" type="file" name="test" style="display: none;"></label>
			
			<div class="clear"></div>	
		</div>
		<div class="clear"></div>
		<div class="detail_torrent_info" style="height: 511px;">
			<input id="nName" class="form-control" type="text" placeholder="Название: О моём перерождении в слизь" required="">
			<input id="nEname" class="form-control" style="margin-top: 6px;" type="text" placeholder="Английское название: Tensei shitara Slime Datta Ken" required="">
			<input id="nAname" class="form-control" style="margin-top: 6px;" type="text" placeholder="Альтернативное название: Вторжение титанов" required="">
			<div style="margin-top: 6px;">
				<input id="nYear" class="form-control" style="width: 30%; display: inline-block;" type="text" placeholder="Год выхода: 2018" required="">
				<input id="nType" class="form-control" style="width: 33%; display: inline-block;" type="text" placeholder="Тип: ТВ 24 эпизода" required="">
				<input id="nBlock" title="Блокировка" class="form-control" style="width: 35%; display: inline-block;" type="text" placeholder="Блокировка: RU, DE" required="">
			</div>
			<div style="margin-top: 6px;">
				<select class="form-control chosen" data-placeholder="Жанры: фэнтези, приключения ..." name="tags[]" multiple style="">
					<?php echo getGenreList(); ?>
				</select>
			</div>
			<input id="nVoice" class="form-control" style="margin-top: 6px;" type="text" placeholder="Озвучка: Silv, Hekomi, Malevich, December" required="">
			<div style="margin-top: 6px;">
				<input id="nTranslator" title="Перевод" class="form-control" style="width: 25%; display: inline-block;" type="text" placeholder="Перевод" required="">
				<input id="nEditing" title="Редактура" class="form-control" style="width: 24%; display: inline-block;" type="text" placeholder="Редактура" required="">
				<input id="nDecor" title="Оформление" class="form-control" style="width: 24%; display: inline-block;" type="text" placeholder="Оформление" required="">
				<input id="nTiming" title="Тайминг" class="form-control" style="width: 24%; display: inline-block;" type="text" placeholder="Тайминг" required="">
			</div>
			<select id="nDay" class="form-control" style="margin-top: 6px;">
				<option value="" disabled selected>Серия выходит</option>
				<option value="1">Понедельник</option>
				<option value="2">Вторник</option>
				<option value="3">Среда</option>
				<option value="4">Четверг</option>
				<option value="5">Пятница</option>
				<option value="6">Суббота</option>
				<option value="7">Воскресенье</option>
			</select>
			
			<select id="nStatus" class="form-control" style="margin-top: 6px;">
				<option value="" disabled selected>Состояние релиза</option>
				<option value="1">В работе</option>
				<option value="2">Завершен</option>
				<option value="3">Скрыт</option>
				<option value="4">Неонгоинг</option>
			</select>
			<input id="nMoon" class="form-control" style="margin-top: 7px;" type="text" placeholder="moonwalk: https://streamguard.cc/serial/ecd3786bcde7f9b28b4f6..." required="">
<pre style="margin-top: 7px; max-height: 100px; overflow-y: scroll;">[b]жирный шрифт[/b] => <b>жирный шрифт</b>
[i]наклонный шрифт[/i] => <i>наклонный шрифт</i>
[u]подчеркнутый текст[/u] => <u>подчеркнутый текст</u>
[s]зачеркнутый шрифт[/s] => <s>зачеркнутый шрифт</s><br/>
[url]http://google.ru[/url] => <a href="http://google.ru" target="_blank">http://google.ru</a>
[url]https://google.ru[/url] => <a href="https://google.ru" target="_blank">https://google.ru</a><br>
[url=http://google.ru]google[/url] => <a href="http://google.ru" target="_blank"> google</a>
[url=https://google.ru]google[/url] => <a href="https://google.ru" target="_blank">google</a>
</pre>

		</div>
		
	<div class="detail_torrent_side">
		<div class="detail_pic_corner">
			<img id="adminPoster" class="detail_torrent_pic" border="0" src="/upload/release/350x500/default.jpg" width="350" height="500" alt="">
		</div>
	</div>	
		<div class="clear"></div>
 
<div>
	<textarea id="nDescription" class="form-control" style="margin-top: 7px; resize: vertical;" rows="10" placeholder="Описание: Одинокий тридцатисемилетний Сато́ру Мика́мию ..."></textarea>
</div>
<div style="margin-top:10px;"></div>
</div>



<div class="news-block">
	<div class="news-header">
		<h2 class="news-name">
			Релизы
		</h2>
		<div class="clear"></div>	
	</div>
	<div class="clear"></div>
	<div>
		<style> td,th { text-align: center; vertical-align: middle; } </style>
		<table id="tableRelease" class="table table-striped table-bordered" style="width:100%">
		<thead>
			<tr>
				<th>ID</th>
				<th>Название</th>
				<th>Статус</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		</tbody>
		</table>
	</div>
	<div class="clear"></div>
	<div style="margin-top:10px;"></div>
</div>

<div id="vk_comments" style="margin-top: 10px;"></div>

<?php require($_SERVER['DOCUMENT_ROOT'].'/private/footer.php');?>
