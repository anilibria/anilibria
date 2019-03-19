<?php
require($_SERVER['DOCUMENT_ROOT'].'/private/config.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/mysql.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/memcache.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/session.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/var.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/func.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/auth.php');

$var['title'] = 'Поддержать проект';
$var['page'] = 'donate';

require($_SERVER['DOCUMENT_ROOT'].'/private/header.php');
?>

<div class="news-block">
	<div class="news-body">
		


	<div class="xplayer" id="anilibriaPlayer" style="display: block; margin-bottom: 15px; border-top-left-radius: 4px; border-top-right-radius: 4px;"></div>
	
	<!--<div style="border-radius: 4px; overflow: hidden; z-index: 1; height: 530px; width: 840px;">
		<iframe width="840" height="530" src="https://www.youtube.com/embed/xGYsezJddlw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	</div>
	<div style="margin-top:10px;"></div> -->
	<div class="clear"></div>
	
	
	<div id="yandexMoney" style="float:left;"></div>
	<table class="table table-bordered" style="width: 450px; float:right; margin-top:0px; margin-left:30px; margin-bottom: 10px;">
			<tbody>
				<tr>
					<td>QIWI</td>
					<td>79660956323</td>
				</tr>
				<tr>
					<td>Яндекс деньги</td>
					<td>41001990134497</td>
				</tr>
				<tr>
					<td>Webmoney</td>
					<td>R211016581718, Z720752385996</td>
				</tr>

				<tr>
					<td>Bitcoin</td>
					<td><a href="https://www.blockchain.com/btc/address/3CarFNZickTNb1nx2Bgk6VammB8CYCBSJd" target="_blank">3CarFNZickTNb1nx2Bgk6VammB8CYCBSJd</a></td>
				</tr>
			</tbody>
		</table>
		
		<div style="width: 450px; float:right;">
			
			<center style="margin-top:0px;"><a href="https://www.patreon.com/anilibria" target="_blank">https://www.patreon.com/anilibria</a> - ежемесячный платёж!<br/> Самый лучший способ поддержать проект.</center>
		
		</div>
		
	</div>
	<div class="clear"></div>
	<div style="margin-top:10px;"></div>
</div>

<div id="vk_comments" style="margin-top: 10px;"></div>

<?php require($_SERVER['DOCUMENT_ROOT'].'/private/footer.php');?>
