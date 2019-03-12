<?php
require($_SERVER['DOCUMENT_ROOT'].'/private/config.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/mysql.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/sphinx.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/memcache.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/session.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/var.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/func.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/auth.php');

$var['title'] = 'Алфавитный указатель';
$var['page'] = 'alphabet';

require($_SERVER['DOCUMENT_ROOT'].'/private/header.php');
?>


<style>
.day {
    background: #4a4a4a;
    margin: 10px 0 10px 0;
    height: 30px;
    font-size: 13pt;
    line-height: 30px;
    border-radius: 3px;
    color: white;
    width: 826px;
    margin-left: 7px;
}

.day span{
	float: left;
	padding-left:5px;
}

.test {
	border-collapse: separate;
    border-spacing: 8px;
}

.goodcell .info[title] {
    background: #4a4a4a;
}

.goodcell img {
	display: block;
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
	<div>
		<?php echo showAscReleases(); ?>
	</div>
	<div class="clear"></div>
	<div style="margin-top:10px;"></div>
</div>

<?php require($_SERVER['DOCUMENT_ROOT'].'/private/footer.php');?>
