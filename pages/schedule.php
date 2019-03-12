<?php
require($_SERVER['DOCUMENT_ROOT'].'/private/config.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/mysql.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/memcache.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/session.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/var.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/func.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/auth.php');

$var['title'] = 'Новое аниме, онгоинги';

$var['page'] = 'schedule';

require($_SERVER['DOCUMENT_ROOT'].'/private/header.php');
?>

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
    width: 826px;
    margin-left: 7px;
}

.test {
	border-collapse: separate;
    border-spacing: 8px;
}

.goodcell .info[title] {
    background: #4a4a4a;
}

.goodcell img {
    border: 3px solid #4a4a4a;
    border-radius: 3px;
}

/* Schedule hover description */
.goodcell {
	position: relative;
}

.schedule-anime-desc {
	position: absolute;
	display: none;
	top: 0;
	left: 0;
	height: 100%;
	width: 100%;
	background-color: rgba(0,0,0,0.8);
	color: #fff;
	text-align: center;
	padding: 10px;
	border-radius: 3px;
}

.goodcell > a:hover .schedule-anime-desc {
	display: block;
	border: 3px solid #e04e4e;
}

.schedule-anime-desc > span {
	display: block;
}

.schedule-runame {
	font-size: 13pt;
	line-height: 13pt;
	margin-bottom: 5px;
	font-weight: bold;
}

.schedule-series {
	font-size: 12pt;
	margin-bottom: 40px;
}

.schedule-description {
	font-size: 11pt;
}
</style>

<div class="news-block">
	<!--<p style="text-align:center; font-size:13pt;">РАСПИСАНИЕ ВЫХОДА СЕРИЙ НА АНИЛИБРИИ*<br/>
	<span style="text-align:center; font-size: 11pt; font-style: italic;">*новые серии выходят в этот день недели +-1 день. В начале сезона расписание может не соответствовать действительности. Если серии задерживаются &mdash; это будет указано в статусе релиза (над постером).</span>
	</p> -->
	<div>
		<?php echo showSchedule(); ?>
	</div>
	<div class="clear"></div>
	<div style="margin-top:10px;"></div>
</div>

<?php require($_SERVER['DOCUMENT_ROOT'].'/private/footer.php');?>
