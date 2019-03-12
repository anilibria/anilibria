<?php
require($_SERVER['DOCUMENT_ROOT'].'/private/config.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/mysql.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/memcache.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/session.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/var.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/func.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/auth.php');

$var['title'] = 'Новый сайт';
$var['page'] = 'app';

require($_SERVER['DOCUMENT_ROOT'].'/private/header.php');
?>

<style>
    #post-image {
        width: 840px;
        height: auto;
    }
    #h3-zagolovok {
        font-size: 18pt;
        text-align: center;
		font-weight: bold;
    }
    #news-text {
        font-size: 12pt;
        text-align: center;
    }
</style>

<div class="news-block">
	<div class="news-body">
        <img src="/img/newSiteOpen.jpg" id="post-image" alt="Открытие нового сайта" />
        <h3 id="h3-zagolovok">НОВЫЙ САЙТ АНИЛИБРИИ</h3>
        <p id="news-text">
        С сегодняшнего дня, наш сайт начинает новую жизнь – всё было переделано с нуля, убраны лишние функции, добавлены новые. Большое количество новых, прекрасных тонкостей, которые сильно упростят пользование сайтом и просмотр аниме для вас – всё ещё в планах, сайт будет развиваться и улучшаться.
        <br/><br/>Спасибо Вам за поддержку, спасибо, что выбираете нас!
        </p>
    </div>
	<div class="clear"></div>
	<div style="margin-top:10px;"></div>
</div>

<div id="vk_comments" style="margin-top: 10px;"></div>


<?php require($_SERVER['DOCUMENT_ROOT'].'/private/footer.php');?>
