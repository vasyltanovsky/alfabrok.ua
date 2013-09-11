<?php 
	require_once '../utils/template.ajax/js.css.php';
	$query = "DELETE FROM $tbl_im_pl WHERE im_prop_id = '{$_POST[im_prop_id]}'";
    if(!mysql_query($query)) throw new ExceptionMySQL(mysql_error(),   $query,  "Ошибка при удалении каталога");
?>
<script type="text/javascript">
	$.prompt('Элемент удален.');
</script>
