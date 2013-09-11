<?php 
	require_once '../utils/template.ajax/js.css.php';
	$query = "DELETE FROM $tbl_dictionaries WHERE dict_id = '{$_POST[dict_id]}'";
    if(!mysql_query($query)) throw new ExceptionMySQL(mysql_error(),   $query,  "Ошибка при удалении каталога");
    
    if(file_exists("../../files/images/prop/".$_POST[dict_id].".png"))
          @unlink(".../../files/images/prop/".$_POST[dict_id].".png");
    
?>
<script type="text/javascript">
	$.prompt('Элемент удален.');
</script>
