			</div>
			<div class="side">
				<div class="asidehead" >
					<div style="width: 260px; padding-top: 11px; margin: 0 auto;">
						
						<div class="inner-addon right-addon">
    <i class="glyphicon glyphicon-search"></i>
    <input id="smallSearchInput" class="form-control" type="search" style="width: 100%; height: 30px;" placeholder="Найти аниме по названию" autocomplete="off">
</div>

				</div>
			</div>		
				
			<div id="smallSearch" class="smallSearch">
				<table id="smallSearchTable" style="margin-left: 13px; ">
					<tbody>
					</tbody>
				</table>
				</div>	
				
				<div class="clear"></div>
				
				<div class="torrent-block">
					<div class="torrent_block">
						<a href="/release/tokyo-ghoul-re.html"><img class="lasttorpic" src="/upload/poster/1.jpg" alt="" width="240" height="350"></a>
					</div>
				</div>
				
				<div class="torrent-block">
					<div class="torrent_block">
						<a href="/release/tokyo-ghoul-re.html"><img class="lasttorpic" src="/upload/poster/2.jpg" alt="" width="240" height="350"></a>
					</div>
				</div>
				
				<div class="torrent-block">
					<div class="torrent_block">
						<a href="/release/tokyo-ghoul-re.html"><img class="lasttorpic" src="/upload/poster/3.jpg" alt="" width="240" height="350"></a>
					</div>
				</div>
				
				<div class="torrent-block">
					<div class="torrent_block">
						<a href="/release/tokyo-ghoul-re.html"><img class="lasttorpic" src="/upload/poster/4.jpg" alt="" width="240" height="350"></a>
					</div>
				</div>
				
				<div class="torrent-block">
					<div class="torrent_block">
						<a href="/release/tokyo-ghoul-re.html"><img class="lasttorpic" src="/upload/poster/5.jpg" alt="" width="240" height="350"></a>
					</div>
				</div>
								
				<?php
					if(!empty($var['release'])){
						$tmpURL = 1;
						if(rand(1,10) > 5) $tmpURL = 2;
						echo "<img src=\"/img/pushall$tmpURL.jpg\" alt=\"\" width=\"280\">";
						unset($tmpURL);
					}
				?>
				
			</div>
		
		
		<style>
/* enable absolute positioning */
.inner-addon { 
    position: relative; 
}

/* style icon */
.inner-addon .glyphicon {
  position: absolute;
  padding: 7px;
  pointer-events: none;
}

/* align icon */
.left-addon .glyphicon  { left:  0px;}
.right-addon .glyphicon { right: 0px;}

/* add padding  */
.left-addon input  { padding-left:  30px; }
.right-addon input { padding-right: 30px; }
		</style>
		</div>
		<div class="clear"></div>
		<div class="footer">
			<div class="footer_left">
				<div class="footer_left2">
					<a href="http://www.animespirit.ru/"><img src="/img/button/1.jpg" alt=""></a>
					<a href="http://allmult.com/"><img src="/img/button/2.gif" alt=""></a>
					<a href="http://www.animag.ru/"><img src="/img/button/3.gif" alt=""></a>
					<a href="http://anidream.net/"><img src="/img/button/4.gif" alt=""></a>
					<a href="http://anires.ru/pages/mainmenu.php"><img src="/img/button/5.gif" alt=""></a>
					<a href="http://anibreak.ru/"><img src="/img/button/6.png" alt=""></a>
				</div>
			</div>
			<div class="footer_center">
				<div class="chat">
				<a  href="/pages/chat.php"><span class="chat-link"></span></a>
				</div>
			</div>
			<div class="footer_right">
				<ul>
					<li><a href="/pages/login.php#rules">Правила</a></li>
					<li><a href="">Реклама</a></li>
					<li><a href="/pages/cp.php">Личный кабинет</a></li>
					<?php 
						$tmpURL = "<li><a href=\"/pages/login.php\">Регистрация</a></li><li><a href=\"/pages/login.php\">Вход</a></li>";
						if($user) $tmpURL = "<li><a href=\"\">Избранное</a></li><li><a href=\"/public/logout.php\">Выход</a></li>";
						echo $tmpURL;
						unset($tmpURL);
					?>
				</ul>
				<p>
				Весь материал на сайте представлен исключительно для домашнего ознакомительного просмотра.<br/> В случаях нарушения авторских прав - обращайтесь на почту lupin@anilibria.tv 
				</p>
			</div>
		</div>
		<script src="<?php echo fileTime('/js/jquery.min.js');?>"></script>
		<script src="<?php echo fileTime('/js/jquery.bxslider.min.js');?>"></script>
		<script src="<?php echo fileTime('/js/bootstrap.min.js');?>"></script>
		<script src="<?php echo fileTime('/js/main.js');?>"></script>
		<?php echo footerJS(); ?>
		<script>console.log("<?php echo pageStat(); ?>");</script>
	</body>
</html>
