<style>
	.bullet:before { content:''; display:inline-block; width:1ex; height:1ex; border-radius:50%; background:black; }
	.breadcrumbs.bullet::before { margin:.1ex; }
	.breadcrumbs { list-style-type:none; padding-inline-start:0px; margin:1ex; }
	.breadcrumbs li { display:inline; }
	.breadcrumbs li:last-child::after { content:''; }
	.breadcrumbs li::after { content:'::'; margin-left:.5ex; font-weight:bold; }

	#bugslist .row:nth-of-type(even) { background-color:#ddd; }
	#bugslist .row:nth-of-type(odd) { background-color:#F3F3F3; }

	#bugslist table { width:100%; }
	#bugslist thead { background:black; color:wheat; }
	#bugslist .maindata td { padding:2px 4px; vertical-align:top; }
	#bugslist .first-col { width:4ex; }
	form#bugslist .author, form#bugslist .msg { border-left:1px gray solid; }
	#bugslist .author { width:14ex; }
	#bugslist .msg, #bugslist .nick { word-break:break-all; }
	#bugslist .date { white-space:nowrap; background:khaki; }
	#bugslist .bug { border-bottom:1px gray solid; }
	form#bugslist .bug { border-bottom:1px #F3F3F3 solid; }
	#bugslist tr:last-child .bug { border-bottom:none; }
	#bugslist .row.selected { background-color:lightgreen; }
	#bugslist input.cbox { transform:scale(1.8); margin:7px; }
	#bugslist .show-all { text-align:right; padding:4px 1ex 6px; }
	#bugslist .footer-buttons { margin-top:1em; }
</style>

<div class="news-block">
<ul class="breadcrumbs bullet">
	<li><a href="/pages/bugreport.php">Список релизов с ошибками</a></li>
	<li>Релиз</li>
</ul>

<h2><a href="/release/<?=$arrData['release']['code']?>.html"><?=$arrData['release']['name']?> / <?=$arrData['release']['ename']?></a></h2>

<a class="btn <?php echo ($arrData['state'] == 'close') ? 'btn-default' : 'btn-primary'; ?>" href="/pages/bugreport.php?release=<?=$arrData['release']['id']?>">Открытые (<?=$arrData['release']['count_open']?>)</a>
<a class="btn <?php echo ($arrData['state'] == 'close') ? 'btn-primary' : 'btn-default'; ?>" href="/pages/bugreport.php?release=<?=$arrData['release']['id']?>&amp;state=close">Закрытые (<?=$arrData['release']['count_close']?>)</a>


<?php echo getTemplate('_paging.php', [
	    'curPage'=>$arrData['curPage'],
	    'maxPage'=>$arrData['pages'],
	    'link'=>'/pages/bugreport.php?release=' . $arrData['release']['id'] . ($arrData['state'] == 'close' ? '&amp;state=close' : '') . '&amp;page={page}',
	    'firstlink'=>'/pages/bugreport.php?release=' . $arrData['release']['id'] . ($arrData['state'] == 'close' ? '&amp;state=close' : ''),
	]);
?>

<form method="post" id="bugslist">
	<input type="hidden" name="action" value="<?php echo ($arrData['state'] == 'close') ? 'open' : 'close'; ?>">
	<input type="hidden" name="release" value="<?=$arrData['release']['id']?>">

	<table class="maindata">
	<thead><tr>
		<td class="first-col"></td>
		<td class="author">Создал</td>
		<td class="msg">Сообщение</td>
		<?php if($arrData['state'] == 'close'){ ?><td class="author">Закрыл</td><?php } ?>
	</tr></thead>
	<tbody>
	<?php foreach($arrData['bugs'] as $bug){ ?>
	<tr class="row">
		<td class="bug"><input type="checkbox" name="bugs[<?=$bug['id']?>]" class="cbox"></td>
		<td class="author bug">
			<div class="nick"><?php echo $bug['open_mail'] ? '<b><a href="mailto:' . $bug['open_mail'] . '">' . htmlspecialchars($bug['open_login']) . '</a></b>' : '-'; ?></div>
			<span class="date"><?=$bug['opened_at']?></span>
			<br><?=$bug['open_ip']?>
		</td>
		<td class="msg bug"><?php echo nl2br(htmlspecialchars($bug['msg'])); ?></td>
		<?php if($arrData['state'] == 'close'){ ?>
		<td class="author bug"><b><?php echo htmlspecialchars($bug['close_login']); ?></b>
			<br><?=$bug['closed_at']?>
		</td>
		<?php } ?>
	</tr>
	<?php } ?>
	</tbody>
	</table>

	<table class="footer-buttons">
	<tr>
		<td width="50%"><button name="act-checked" class="btn btn-success" type="button" disabled><?php echo ($arrData['state'] == 'close') ? 'Открыть' : 'Закрыть'; ?> отмеченные</button></td>
		<?php if($arrData['state'] != 'close'){ ?>
		<td width="50%" align="right"><button name="act-all" class="btn btn-warning" type="button">Закрыть все</button></td>
		<?php } ?>
	</tr>
	</table>
</form>

<?php echo getTemplate('_paging.php', [
	    'curPage'=>$arrData['curPage'],
	    'maxPage'=>$arrData['pages'],
	    'link'=>'/pages/bugreport.php?release=' . $arrData['release']['id'] . ($arrData['state'] == 'close' ? '&amp;state=close' : '') . '&amp;page={page}',
	    'firstlink'=>'/pages/bugreport.php?release=' . $arrData['release']['id'] . ($arrData['state'] == 'close' ? '&amp;state=close' : ''),
	]);
?>
</div>

<script>
document.addEventListener("DOMContentLoaded", function(){
	if($('form#bugslist .cbox:checked').closest('.row').addClass('selected').length){
		$('[name="act-checked"]').prop('disabled', false);
	}

	$('form#bugslist').on('click', '.row', function(e){
		$(this).toggleClass('selected');
		$(this).find('.cbox').prop('checked', $(this).hasClass('selected'));
		if($('#bugslist .row.selected').length){
			$('[name="act-checked"]').prop('disabled', false);
		}else{
			$('[name="act-checked"]').prop('disabled', true);
		}
	});

	$('[name="act-checked"], [name="act-all"]').on('click', function(e){
		e.preventDefault();
		var data = $('#bugslist .cbox, #bugslist input[type="hidden"]').serializeArray();
		data.push({'name':'csrf_token', 'value':csrf_token});
		data.push({'name':'button', 'value':$(this).attr('name')});
		$.post('/public/bugreport/change-state.php', $.param(data), null, 'json')
		.done(function(json){
			console.log(json);
			if(json.err==='error'){
				alert(json['key'] + ': ' + json.mes);
			}else{
				location.reload();
			}
		})
		.fail(function(jqXHR){
			console.log(jqXHR);
		});
	});
});
</script>
