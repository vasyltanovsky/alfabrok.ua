<?php 
	require_once '../utils/template.ajax/js.css.php';
	$query = "DELETE FROM $tbl_news WHERE news_id = '{$_POST[news_id]}'  AND lang_id = {$_COOKIE[lang_id]}";
    if(!mysql_query($query)) throw new ExceptionMySQL(mysql_error(),   $query,  "Ошибка при удалении каталога");
		if(file_exists("../../files/portfolio/".$_POST['news_id'].".jpg"))
          @unlink(".../../files/portfolio/".$_GET['news_image'].".jpg");
?>
<script>
	$.prompt('Элемент удален.');
	$('#DivRequest').load('template.load.php?print=list_page');
</script>
