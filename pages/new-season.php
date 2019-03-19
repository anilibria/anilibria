<?php
require($_SERVER['DOCUMENT_ROOT'].'/private/config.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/mysql.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/sphinx.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/memcache.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/session.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/var.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/func.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/auth.php');

$var['title'] = 'Анонс весны 2019';
$var['page'] = 'new-season';

require($_SERVER['DOCUMENT_ROOT'].'/private/header.php');
?>

<div class="news-block">
    <div id="upcoming_page_heading">
        <h2>Анонс аниме-весна 2019 года</h2>
        <p>Внимание! Голосовать могут только авторизованные пользователи.</p>
    </div>
	<div>
		<?php echo showNewSeason(); ?>
	</div>
	<div class="clear"></div>
	<div style="margin-top:10px;"></div>
</div>

<?php require($_SERVER['DOCUMENT_ROOT'].'/private/footer.php');?>
