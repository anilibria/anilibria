<?php
require($_SERVER['DOCUMENT_ROOT'].'/private/config.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/mysql.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/sphinx.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/memcache.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/session.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/var.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/func.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/auth.php');

$tmpPage = showNewSeason();

$var['page'] = 'new-season';
require($_SERVER['DOCUMENT_ROOT'].'/private/header.php');
?>

<style>
	
	#upcoming_page_heading {
	text-align: center;
}

#upcoming_page_heading h2 {
	margin: 0;
	padding: 0;
	font-size: 18pt;
	line-height: 18pt;
}

#upcoming_page_heading p {
	margin: 10px;
	padding: 0;
	font-size: 10pt;
	line-height: 10pt;
}
	
	.upcoming_season_block {
		background-color: #fafafa;
		display: block;
		position: relative;
		border-radius: 4px;
		width: 100%;
		padding: 20px;
		margin: 10px 0;
	}

	.upcoming_float_left {
		float: left;
		width: calc(100% - 290px);
		color: #383838;
	}

	.upcoming_season_name {
		display: block;
		margin: 0;
		padding: 0;
		font-size: 14pt;
		line-height: 14pt;
		font-weight: bold;
		margin-bottom: 10px;
	}
	.upcoming_season_genres {
		display: block;
	}

	.upcoming_season_time {
		display: block;
		margin-bottom: 10px;
	}

	.upcoming_season_description {
		display: block;
		margin-bottom: 80px;
	}

	.upcoming_season_image {
		float: right;
		width: 270px;
		height: 390px;
	}

	.upcoming_season_btn_wrapper {
		position: absolute;
		bottom: 20px;
		left: 20px;
	}

	.upcoming_season_like,
	.upcoming_season_like:visited {
		display: block;
		font-size: 10pt;
		line-height: 10px;
		padding: 10px 10px 5px 10px;
		text-decoration: none;
		color: #fff;
		background: #e22052;
		margin-bottom: 5px;
	}
	.upcoming_season_like:hover {
		color: #fff;
		text-decoration: none;
	}

	.upcoming_season_votes,
	.upcoming_season_voted{
		display: inline-block;
	}
</style>

<?php  echo $tmpPage; ?>



<div id="vk_comments" style="margin-top: 10px;"></div>

<?php require($_SERVER['DOCUMENT_ROOT'].'/private/footer.php');?>
