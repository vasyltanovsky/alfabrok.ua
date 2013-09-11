<?php 
	require_once '../utils/template.ajax/js.css.php';
	$query = "DELETE FROM $tbl_list_dictionaries WHERE ld_id = '{$_POST[ld_id]}'";
    if(!mysql_query($query)) throw new ExceptionMySQL(mysql_error(),   $query,  "Ошибка при удалении каталога");
    $query = "DELETE FROM $tbl_dictionaries WHERE ld_id = '{$_POST[ld_id]}'";
    if(!mysql_query($query)) throw new ExceptionMySQL(mysql_error(),   $query,  "Ошибка при удалении каталога");
?>
<script type="text/javascript">
	$.prompt('Элемент удален.');
</script>
