<style>
	.bullet:before { content:''; display:inline-block; width:1ex; height:1ex; border-radius:50%; background:black; }
	#bugslist h4.bullet:before { margin:0 2ex 0 1ex; }

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

<div class="news-block" id="bugslist">
<h2><?=$arrData['header']?></h2>

<?php echo getTemplate('_paging.php', [
	    'curPage'=>$arrData['curPage'],
	    'maxPage'=>$arrData['pages'],
	    'link'=>'/pages/bugreport.php?page={page}',
	    'firstlink'=>'/pages/bugreport.php',
	]);
?>

<?php foreach($arrData['releases'] as $rid => $release){ ?>
<div class="row maindata">
	<table>
	<tr>
		<td colspan="3"><h4 class="bullet"><a href="/release/<?=$release['code']?>.html"><?=$release['name']?> / <?=$release['ename']?></a></h4></td>
	</tr>
	<?php foreach($release['bugs'] as $bug){ ?>
	<tr>
		<td class="first-col"></td>
		<td class="bug author">
			<div class="nick"><?php echo $bug['email'] ? '<b><a href="mailto:' . $bug['email'] . '">' . htmlspecialchars($bug['login']) . '</a></b>' : '-'; ?></div>
			<span class="date"><?=$bug['opened_at']?></span>
		</td>
		<td class="bug msg"><?php echo htmlspecialchars($bug['msg']); ?></td>
	</tr>
	<?php } ?>
	</table>
	<div class="show-all footer-buttons">
		<a class="btn btn-default" role="button" href="/pages/bugreport.php?release=<?=$rid?>">Показать все (<?=$release['bugs_open']?>) сообщения о багах релиза</a>
	</div>
</div>
<?php } ?>

<?php echo getTemplate('_paging.php', [
	    'curPage'=>$arrData['curPage'],
	    'maxPage'=>$arrData['pages'],
	    'link'=>'/pages/bugreport.php?page={page}',
	    'firstlink'=>'/pages/bugreport.php',
	]);
?>

</div>
