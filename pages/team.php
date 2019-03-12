<?php
require($_SERVER['DOCUMENT_ROOT'].'/private/config.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/mysql.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/memcache.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/session.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/var.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/func.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/auth.php');

$var['title'] = 'Команда проекта';
$var['page'] = 'app';

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
}

.teamleft{
	float:left; margin-left: 6px;
}

.teamright{
	float:right; margin-right: 6px;
}

</style>

<div class="news-block">
	<div class="news-body">

		<p style="text-align: center;">
			<span style="color: #339966;"><span style="font-size: 16pt;">Войсеры / </span></span> <span style="color: #800000;"><span style="font-size: 16pt;">Технари / </span></span><span style="color: #ff6600;"><span style="font-size: 16pt;">Сабберы / </span></span> <span style="color: #000080;"><span style="font-size: 16pt;">Сидеры / </span></span> <span style="color: #33cccc;"><span style="font-size: 16pt;">Дизайнеры / </span></span> <span style="color: #f2d20c;"><span style="font-size: 16pt;">PR-команда</span></span>
		</p>
		<p style="text-align: center; font-size: 13pt; margin-top: 15px; margin-bottom: 15px;">	
		 
		</p>
		
		<div class="day">
				<div class="teamleft">Мы ищем таланты</div> 
				<div class="teamright"><a style="color: #FFF;" href="/pages/request.php">ПОДАТЬ ЗАЯВКУ</a></div>
		</div>

		<ul>
			<li><span style="color: #ff0000;"><a href="https://vk.com/lupintv" target="_blank"><span style="color: #00a650;">Lupin</span></a></span> - босс, войсер, бесспорно принадлежит 80%</li>
			<li>poiuty - босс, бесспорно принадлежит 20%</li>
		</ul>
			<div class="day">
				<div class="teamleft">&#8544; лига</div> 
				<div class="teamright">СОВЕТ</div>
			</div>
		<ul>
			<li><span style="color: #ff0000;"><a href="https://vk.com/silvanka" target="_blank"><span style="color: #00a650;">Silv</span></a></span> - войсер</li>
			<li><span style="color: #ff0000;"><a href="https://vk.com/flegontova1993" target="_blank"><span style="color: #00a650;">Itashi</span></a></span> - руководитель PR-команды, войсер</li>
			<li><span style="color: #339966;">Dejz</span> - руководитель академии войсеров, войсер</li>
			<li><span style="color: #800000;">Blaze</span> - руководитель технарей, технарь</li>
			<li><span style="color: #339966;">Sharon</span> - руководитель команды войсеров</li>
			<li><span style="color: #f7941d;">Timo</span> - руководитель команды сабберов</li>
		</ul>
			<div class="day">
				<div class="teamleft">&#8545; лига</div> 
				<div class="teamright">ВЫСШАЯ</div>
			</div>
		<ul>
			<li><span style="color: #000080;">Sekai</span> - руководитель подкоманды сидеров / оформитель</li>
			<li><span style="color: #800000;">Alkhorus </span> - технарь / куратор академии таймеров / помощник рук. технарей</li>
			<li><span style="color: #800000;">Hikariya</span>&nbsp;- технарь / помощник рук. сабберов (оформитель) / дизайнер</li>
			<li><span style="color: #339966;">Amikiri</span> - войсер</li>
			<li><span style="color: #339966;">Anzen</span> - руководитель команды дизайнеров, войсер</li>
			<li><span style="color: #339966;">Cleo-chan</span> - войсер</li>
			<li><span style="color: #339966;">MyAska</span> - войсер</li>
			<li><span style="color: #f7941d;">Falk</span> - переводчик, руководитель академии сабберов</li>
		</ul>
		<div class="day">
				<div class="teamleft">&#8546; лига</div> 
				<div class="teamright">МАСТЕРА</div>
		</div>
		<ul>
			<li><span style="color: #339966;">Ados</span> - войсер</li>
			<li><span style="color: #339966;">December</span> - войсер</li>
			<li><span style="color: #339966;">WhiteCroW</span> - войсер</li>
			<li><span style="color: #339966;">Malevich</span>&nbsp;- войсер</li>
			<li><span style="color: #800000;">Ninja-san</span> - технарь</li>
			<li><span style="color: #800000;">Quin</span> - технарь</li>
			<li><span style="color: #800000;">Ghost</span> - технарь</li>
			<li><span style="color: #800000;">Пиратехник</span> - технарь</li>
			<li><span style="color: #800000;">Hidan</span> - технарь</li>
			<li><span style="color: #800000;">DarkKnight</span> - технарь </li>
			<li><span style="color: #800000;">Pomidorchik</span> - технарь</li>
			<li><span style="color: #800000;">WhiteCat</span> - технарь </li>
			<li><span style="color: #800000;">Kosaka</span> - технарь </li>
			<li><span style="color: #800000;">Malinero</span> - технарь</li>   
			<li><span style="color: #800000;">Akkakken</span> - технарь / оформитель</li>
			<li><span style="color: #800000;">Luchano</span> - технарь</li>
			<li><span style="color: #f7941d;">N.O.</span> - переводчик</li>
			<li><span style="color: #f7941d;">Keitaro</span> - переводчик / оформитель </li>
			<li><span style="color: #f7941d;">ElViS</span> - оформитель</li>
			<li><span style="color: #f7941d;">Sсarlett</span> - оформитель</li>
			<li><span style="color: #f7941d;">Psycho</span> -  переводчик</li>
			<li><span style="color: #f7941d;">Aiso</span> - переводчик</li>
			<li><span style="color: #f7941d;">Flerion</span> - переводчик / оформитель</li>
			<li><span style="color: #f7941d;">Inari</span> - переводчик</li>
			<li><span style="color: #f2d20c;">Hant</span> - PR-команда</li>
			<li><span style="color: #f2d20c;">SineD</span> - PR-команда</li>
			<li><span style="color: #f2d20c;">Maximka</span> - PR-команда</li>
			<li><span style="color: #000080;">basegame</span> - сидер</li>
		</ul>
		<div class="day">
				<div class="teamleft">&#8547; лига</div> 
				<div class="teamright">ОСНОВА</div>
		</div>
		<ul>
			<li><span style="color: #339966;">HectoR</span> - войсер</li>
			<li><span style="color: #339966;">Gomer</span> - войсер</li>
			<li><span style="color: #339966;">Arato</span> - войсер</li>
			<li><span style="color: #339966;">Rexus</span> - войсер</li>
			<li><span style="color: #339966;">Derenn</span>&nbsp;- войсер </li>
			<li><span style="color: #339966;">Narea</span>&nbsp;- войсер</li>
			<li><span style="color: #339966;">OkanaTsoy</span>&nbsp;- войсер</li>
			<li><span style="color: #339966;">Hekomi</span> - войсер</li>
			<li><span style="color: #800000;">Psychosocial76</span> - технарь</li>
			<li><span style="color: #800000;">EncoR</span> - технарь</li>
			<li><span style="color: #800000;">EliteNoob </span> - технарь</li>
			<li><span style="color: #800000;">Karfosobos</span> - технарь</li>
			<li><span style="color: #800000;">Dr.One</span> - технарь</li>
			<li><span style="color: #f7941d;">Nomi</span> - переводчик</li>
			<li><span style="color: #f7941d;">Gamilton</span> - переводчик</li>
			<li><span style="color: #f7941d;">Suisei</span> - переводчик / оформитель</li>
			<li><span style="color: #f7941d;">Merky</span> - переводчик</li>
			<li><span style="color: #f7941d;">TiimeIrre</span> - переводчик</li>
			<li><span style="color: #f7941d;">Smallow</span> - переводчик</li>  
			<li><span style="color: #f7941d;">Nutsy</span> - переводчик</li>
            <li><span style="color: #f7941d;">The Magus</span> - переводчик / оформитель</li>
            <li><span style="color: #f7941d;">BONN</span> -  оформитель </li>
			<li><span style="color: #f7941d;">NaRVioN</span> - оформитель / сидер</li>
			<li><span style="color: #f7941d;">DiaZone</span> - оформитель</li> 
			<li><span style="color: #f7941d;">Длинный</span> - оформитель</li> 
			<li><span style="color: #f7941d;">Waspil</span> - оформитель</li>
			<li><span style="color: #33cccc;">Kell</span> - дизайнер</li>
			<li><span style="color: #33cccc;">Muvik</span> - дизайнер</li>
			<li><span style="color: #33cccc;">Toppi</span> - дизайнер</li>
			<li><span style="color: #000080;">Furry Lynx</span> - сидер</li>
			<li><span style="color: #000080;">New On</span> - сидер</li>
			<li><span style="color: #000080;">FLASHIx</span> - сидер</li>
			<li><span style="color: #000080;">Wan</span> - сидер</li>
			<li><span style="color: #000080;">Rossik666</span> - сидер</li>
		</ul>
		<div class="day">
				<div class="teamleft">&#8548; лига</div> 
				<div class="teamright">ЗАПАС</div>
		</div>
		<ul>
			<li><span style="color: #339966;">Nuts</span> - войсер (служит в армии)</li>
			<li><span style="color: #339966;">Kari</span> - войсер (в отпуске)</li>
			<li><span style="color: #339966;">Myuk</span> - войсер (в отпуске)</li>
			<li><span style="color: #f7941d;">LolWhat</span> - переводчик</li>
			<li><span style="color: #f7941d;">Constantum</span> - переводчик<br>
			</li><li><span style="color: #f7941d;">Vurdalak121</span> - переводчик</li>
			<li><span style="color: #f7941d;">Skaifai</span> - переводчик</li>
			<li><span style="color: #f7941d;">Valar</span> - переводчик</li>
			<li><span style="color: #800000;">Z3nC0rZ</span> - технарь (служит в армии) </li>
		</ul>
		<div class="day">
				<div class="teamleft">&#8549; лига</div> 
				<div class="teamright">АКАДЕМИЯ</div>
		</div>
		<ul>
			<li><span style="color: #339966;">Ashvoice</span>&nbsp;- войсер стажёр</li>
			<li><span style="color: #339966;">SlivciS</span>&nbsp;- войсер стажёр</li>
			<li><span style="color: #339966;">Kiyoko Koheiri</span>&nbsp;- войсер стажёр</li> 
			<li><span style="color: #800000;">WaFee</span> - таймер стажёр</li>                                      
			<li><span style="color: #f7941d;">Renko</span> - саббер стажёр</li>
		</ul>
		<div class="day">
			<div class="teamleft">
				Не поддаётся классификации лиговой системы
			</div>
		</div>
		<ul>
			<li>RadiationX - автор приложения, администратор сайта</li>
			<li>Lisitsa - администратор discord-сервера</li>
			<li>Kirja - вёрстка сайта, администратор сайта</li>
			<li>Fenix0904 - вёрстка сайта</li>
		</ul>
	</div>
	<div class="clear"></div>
	<div style="margin-top:10px;"></div>
</div>


<?php require($_SERVER['DOCUMENT_ROOT'].'/private/footer.php');?>
