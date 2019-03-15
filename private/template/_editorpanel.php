<div id="editorpanel" style="display:table; width:100%; background-color:cornsilk; position:relative; z-index:1001; padding:4px; position:fixed; top:0; left:0;">
	<div style="display:table-cell; width:33%; text-align:left;">
		<a class="btn btn-xs btn-info" href="/pages/new.php">Новый релиз</a>
	</div>
	<div style="display:table-cell; width:34%; text-align:center;">Панель редактора: <?=$arrData['user']['login']?></div>
	<div style="display:table-cell; width:33%; text-align:right;">
		<?php if(($arrData['user'] ? $arrData['user']['access'] : 0) >= CONF_BUGREPORT_EDITOR_ACCESS){ ?>
			<?php
			require_once($_SERVER['DOCUMENT_ROOT'].'/private/model.bugreport.php');
			$bugsCount = getBugreportsCount();
			?>
			<a class="btn btn-xs btn-info" href="/pages/bugreport.php">Ошибок: <?php echo $bugsCount['bugs'] . '/' . $bugsCount['releases']; ?></a>
		<?php } ?>
	</div>
</div>
