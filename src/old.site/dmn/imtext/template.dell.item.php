<?php 
	require_once '../utils/template.ajax/js.css.php';
	$query = "DELETE FROM $tbl_im_text WHERE it_id = '{$_POST[it_id]}' AND lang_id = {$_COOKIE[lang_id]}";
    if(!mysql_query($query)) throw new ExceptionMySQL(mysql_error(),   $query,  "Ошибка при удалении каталога");
?>
<script type="text/javascript">
	$.prompt('Элемент удален.');
	$('#DivRequest').load('template.load.php?print=list_page');
</script>
