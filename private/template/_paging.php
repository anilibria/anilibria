<style>
	.paging { text-align:center; margin:2ex; }
</style>


<div class="paging">
<?php

$items = 5;//сколько страниц показывать в начале и в конце


$printPage = function($i) use($arrData){
	if($i == 1){
		if($arrData['curPage'] != 1) echo '<a href="' . ($arrData['curPage'] == 2 ? $arrData['firstlink'] : str_replace('{page}', $arrData['curPage']-1, $arrData['link'])) . '">';
		echo '<span class="prev">&lt;--</span>';
		if($arrData['curPage'] != 1) echo '</a>';
		echo '&nbsp;&nbsp;&nbsp;';
		echo "\n";
	}

	if($i != $arrData['curPage']) echo '<a href="' . ($i == 1 ? $arrData['firstlink'] : str_replace('{page}', $i, $arrData['link'])) . '">';
	echo '<span>' . $i . '</span>';
	if($i != $arrData['curPage']) echo '</a>';
	echo "\n";

	if($i == $arrData['maxPage']){
		echo '&nbsp;&nbsp;&nbsp;';
		if($arrData['curPage'] != $arrData['maxPage']) echo '<a href="' . str_replace('{page}', $arrData['curPage']+1, $arrData['link']) . '">';
		echo '<span class="next">--&gt;</span>';
		if($arrData['curPage'] != $arrData['maxPage']) echo '</a>';
	}
};

//начало
for(
    $i=1;
    $i<=$arrData['maxPage'] && $i<=$items;
    $i++
){
	$printPage($i);
}
$last = $i;
$dots = true;

//середина
for(
    $i=(($arrData['curPage'] - $items) > ($items + 2) ? $arrData['curPage'] - $items + 1 : $items + 1);
    $i<=(($arrData['curPage'] + $items - 1) < ($arrData['maxPage'] - $items - 2) ? $arrData['curPage'] + $items - 1 : $arrData['maxPage'] - $items);
    $i++
){
	if($dots && $i > $last+1) echo "...\n";
	$dots = false;
	$printPage($i);
}
if(!$dots) $last = $i;
$dots = true;

//конец
for(
    $i=(($arrData['maxPage'] - $items) > $items ? $arrData['maxPage'] - $items + 1 : $items + 1);
    $i<=$arrData['maxPage'];
    $i++
){
	if($dots && $i > $last+1) echo "...\n";
	$dots = false;
	$printPage($i);
}

?>
</div>
