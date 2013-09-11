<?php 
	require_once '../utils/template.ajax/js.css.php';
	$cl_sel_pages = new mysql_select($tbl_service);
	$Data = $cl_sel_pages -> select_table_id("WHERE sc_id = '{$_POST[sc_id]}' AND lang_id = {$_COOKIE[lang_id]}");
		
	$query = "DELETE FROM $tbl_service WHERE sc_id = '{$_POST[sc_id]}' AND lang_id = {$_COOKIE[lang_id]}";
    if(!mysql_query($query)) throw new ExceptionMySQL(mysql_error(),   $query,  "Ошибка при удалении каталога");
    
    if(file_exists("../../files/images/service/".$Data['img']))
          @unlink(".../../files/images/service/".$Data['img']);
          
?>
<script type="text/javascript">
	$.prompt('Элемент удален.');
	$('#DivRequest').load('template.load.php?print=list_page');
</script>
