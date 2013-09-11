<?php 
	require_once '../utils/template.ajax/js.css.php';
		
	$query = "DELETE FROM realtor_tasks WHERE t_id = {$_POST[t_id]}";
    if(!mysql_query($query)) throw new ExceptionMySQL(mysql_error(),   $query,  "Ошибка при удалении каталога");
?>
<script type="text/javascript">
	$.prompt('Элемент удален.');
	 $('#DivRequest').load('template.load.php?<?php echo ($_POST['requery_id'] ? $_POST['requery_id']: 'print=list_page');?>');
</script>
