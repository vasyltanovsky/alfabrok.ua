<?php 
	require_once '../utils/template.ajax/js.css.php';
	
	$arr_update 		 = array("dict_have_image"	 		=> "0");
	
	$cl_page_update  = new mysql_select($tbl_dictionaries);
	$cl_page_update	->update_table("WHERE dict_id = '{$_GET[dict_id]}'",
									$arr_update);
	if(file_exists("../../files/images/dict/".$_GET[dict_id].".png"))
          @unlink(".../../files/images/dict/".$_GET[dict_id].".png");
		  
?>
<script type="text/javascript">
	$.prompt('Элемент изображение удален.');
	$('#DivRequestImg').load('template.add/form.add.img.php?dict_id=<?php echo $_GET['dict_id'];?>');
</script>
