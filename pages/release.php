<?php
require($_SERVER['DOCUMENT_ROOT'].'/private/config.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/mysql.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/memcache.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/session.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/init/var.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/func.php');
require($_SERVER['DOCUMENT_ROOT'].'/private/auth.php');

$var['page'] = 'release';
$tmpPage = showRelease();

require($_SERVER['DOCUMENT_ROOT'].'/private/header.php');

?>

<style>
.tableCenter {
	text-align: center;
}
.onlineStat>.table-borderless td,
.onlineStat>.table-borderless th {
    border: 0;
    padding: 0px;
}
.onlineStat>.table-condensed>tbody>tr>td, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>td, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>thead>tr>th {
    padding: 0px;
}
.onlineStat>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 0px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 0px;
}
</style>

<div class="light-off"></div>

<?php echo $tmpPage; ?>

<div style="margin-top: 10px;">
	<a href="https://vk.com/anilibria" target="_blank"><img src="/img/other/a1.png" width="283" style="border-radius: 4px;"></a>
	<a href="https://tele.click/anilibria_tv" target="_blank"><img src="/img/other/a2.png" width="283" style="margin-left: 12px; border-radius: 4px;"></a>
	<a href="https://discordapp.com/invite/anilibria" target="_blank"><img src="/img/other/a3.png" width="283" style="float: right; border-radius: 4px;"></a>
</div>

<div id="vk_comments" style="margin-top: 10px;"></div>

<div class="modal fade" id="statModal" tabindex="-1" role="dialog" aria-hidden="true" >
	<div class="modal-dialog" style="width: 480px;">
		<div class="modal-content">
			<div class="modal-header">
				<center><h4 class="modal-title">ТОП-20 ПРЯМО СЕЙЧАС</h4></center>
			</div>
			<div  class="modal-body">
				<div class="tableStat">
					<table class="onlineStat table table-borderless table-condensed table-hover">
						<tr>
							<th>ТАЙТЛ</th>
							<th class="tableCenter">ОНЛАЙН</th>
						</tr>
						<?php echo wsInfoShow(); ?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="editTorrent" tabindex="-1" role="dialog" aria-hidden="true" >
	<div class="modal-dialog" style="width: 830px;">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="changeAnnounceMes">Редактирование торрентов</h4>
			</div>
			
			<div class="modal-body">
				<table style="margin-bottom: 10px;">
					<tbody>
						<tr>
							<td><input class="form-control" style="width: 265px;" type="text" id="torrentFile"  placeholder="File" readonly></td>
							<td><input class="form-control" style="margin-left: 5px; width: 130px;" id="torrentFileUpdateID" type="text" placeholder="ID"></td>
							<td><input class="form-control" style="margin-left: 5px; width: 258px;" id="torrentFileSeries" type="text" placeholder="1-8"></td>
							<td><input class="form-control" style="margin-left: 5px; width: 130px;" id="torrentFileSeriesQuality" type="text" placeholder="HDTVRip 720p"></td>
						</tr>
					</tbody>
				</table>
				<hr/>
				<table id="editTorrentTable" style="margin-bottom: 10px;">
					<tbody>
						<?php echo showEditTorrentTable(); ?>
					</tbody>
				</table>
			</div>
			<div class="clear"></div>
			<div class="modal-footer">
				<label class="btn btn-default">Загрузить <input id="uploadTorrent" type="file" name="test" style="display: none;"></label>
				<button type="button" data-send-torrent class="btn btn-default">Сохранить</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="changeAnnounce" tabindex="-1" role="dialog" aria-hidden="true" >
	<div class="modal-dialog" style="width: 480px;">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="changeAnnounceMes">Изменить анонс</h4>
			</div>
			<div  class="modal-body">
				<input class="form-control" id="announce" type="text" placeholder="Серия выходит в понедельник" >
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-default">Закрыть</button>
				<button type="button" data-send-announce class="btn btn-default">Сохранить</button>
			</div>
		</div>
	</div>
</div>

<?php require($_SERVER['DOCUMENT_ROOT'].'/private/footer.php');?>
