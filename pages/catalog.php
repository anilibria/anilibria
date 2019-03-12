<?php
require($_SERVER['DOCUMENT_ROOT'].'/private/config.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/mysql.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/sphinx.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/memcache.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/session.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/var.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/func.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/auth.php');

$var['title'] = 'Топ аниме по жанрам';
$var['page'] = 'catalog';

require($_SERVER['DOCUMENT_ROOT'].'/private/header.php');
?>

<style>
.simpleFilter {
	background-color: #3e3e3e;
	padding: 25px 25px;
	margin-top: 10px;
	min-height: 150px;
	border-radius: 4px;
}

.torrent_pic {
	border-radius: 4px;
}

.simpleCatalog tr:not(:first-child) td {
	padding-top: 30px;
}

.simpleCatalog tr:not(:first-child) td .anime_info_wrapper {
	margin-top: 30px;
	height: calc(100% - 30px);
}

.simpleCatalog tr td:nth-child(1){
	text-align:left;
	width: 306px;
}

.simpleCatalog tr td:nth-child(2) {
    text-align:left;
}

.simpleCatalog tr td:nth-child(3) {
    text-align:right;
}

.simpleCatalog tr td:nth-child(3) .anime_info_wrapper {
    margin-left: 17px;
}

.simpleCatalog td {
	position: relative;
}

.anime_info_wrapper {
	display: none;
	position: absolute;
	top: 0;
	left: 0;
	width: 270px;
	height: 100%;
	background-color: rgba(0,0,0,0.8);
	color: white;
	text-align: center;
	border-radius: 4px;
}

.simpleCatalog td:hover .anime_info_wrapper {
	display: table-cell;
}

.anime_info_wrapper {
	padding: 10px;
	overflow: hidden;
}

.anime_info_wrapper span {
	display: block;
}

.anime_info_wrapper .anime_name {
	font-size: 14pt;
	line-height: 14pt;
	margin-bottom: 5px;
	font-weight: bold;
}
.anime_info_wrapper .anime_number {
	font-size: 14pt;
	margin-bottom: 120px;
}
.anime_info_wrapper .anime_description {
	font-size: 12pt;
}

.btn:focus {
  outline: none !important;
}

</style>

<div class="simpleFilter">
	<div>
		<div style="margin-bottom: 25px; width: 515px; float: left;">
			<select id="catalogGenre" class="form-control chosen" data-placeholder="Выбрать жанры ..." name="tags[]" multiple style="">
				<?php echo getGenreList(); ?>
			</select>
		</div>

		<div style="margin-bottom: 25px; margin-left: 10px; width: 305px; float: left;">
			<select id="catalogYear" class="form-control chosen" data-placeholder="Выбрать год ..." name="tags[]" multiple style="">
				<?php echo catalogYear(); ?>
			</select>
		</div>
	</div>
	<div class="clear"></div>
	<div>
		<div style="float: left; margin-top: 0px;" >
			<input id="switcher" type="checkbox" data-toggle="toggle" data-on="Новое" data-off="Популярное" data-onstyle="default" data-offstyle="default">
		</div>
		
		<div style="float: right; margin-top: 7px;" >
			<a href="/pages/alphabet.php" style="color: #FFF;">АЛФАВИТНЫЙ УКАЗАТЕЛЬ</a>
		</div>
		
		<input data-catalog-update class="btn btn btn-default btn-block" style="float: left; margin-top: 0px; margin-left: 10px; width: 100px;" type="submit" value="Показать">
		<span class="button-checkbox" style="float: left; margin-top: 0px; margin-left: 10px; width: 150px;">
			<button id="catalogFinish" type="button" class="btn btn-default" data-color="default"><i class="state-icon glyphicon glyphicon-unchecked"></i>&nbsp;Релиз завершен</button>
			<input type="checkbox" class="hidden">
		</span>
	</div>
	<div class="clear"></div>
</div>

<div style="margin-top: 12px;">
	<table class="simpleCatalog" style="width: 100%;">
	<tbody>

	</tbody>	
	</table>
</div>
	
<div id="xpagination" style="display: table; text-align: center; margin: 30px auto 0; padding: none;"></div>

</div>

<?php require($_SERVER['DOCUMENT_ROOT'].'/private/footer.php');?>
