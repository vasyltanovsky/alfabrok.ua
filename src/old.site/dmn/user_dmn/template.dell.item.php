<?php 
	require_once '../utils/template.ajax/js.css.php';
	$query = "DELETE FROM system_accounts WHERE id_account = '{$_POST[id_account]}'";
    if(!mysql_query($query)) throw new ExceptionMySQL(mysql_error(),   $query,  "Ошибка при удалении id_account");
	
?>
<script>
	$.prompt('Элемент удален.');
	$('#DivRequest').load('template.load.php?print=list_page');
</script>
