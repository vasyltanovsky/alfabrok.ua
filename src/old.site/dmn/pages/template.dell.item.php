<?php 
	require_once '../utils/template.ajax/js.css.php';
	$query = "DELETE FROM $tbl_pages WHERE page_id = '{$_POST[page_id]}' AND lang_id = {$_COOKIE[lang_id]}";
    if(!mysql_query($query)) throw new ExceptionMySQL(mysql_error(),   $query,  "Ошибка при удалении каталога");
?>
<script type="text/javascript">
	$.prompt('Элемент удален.');
</script>
