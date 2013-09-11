<?php 
	require_once '../utils/template.ajax/js.css.php';
	$arr_update 		 = array("img"	 		=> "''");
	
	$cl_page_update  = new mysql_select($tbl_service);
	$CPData = $cl_page_update -> select_table_id("WHERE sc_id = '{$_GET[sc_id]}'");
	$cl_page_update	->update_table("WHERE sc_id = '{$_GET[sc_id]}'",
									$arr_update);
									
	if(file_exists("../../files/images/service/".$CPData['img']))
          @unlink(".../../files/images/service/".$CPData['img']);
		  
?>
<script type="text/javascript">
	$.prompt('Элемент изображение удален.');
	$('#DivRequestImg').load('template.add/form.add.img.php?sc_id=<?php echo $_GET['sc_id'];?>');
</script>
