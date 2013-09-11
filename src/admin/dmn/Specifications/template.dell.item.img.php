<?php 
	require_once '../utils/template.ajax/js.css.php';
	
	$arr_update 		 = array("prop_have_image"	 		=> "0");
	
	$cl_page_update  = new mysql_select($tbl_im_pl);
	$cl_page_update	->update_table("WHERE im_prop_id = '{$_GET[dict_id]}'",
									$arr_update);
	if(file_exists("../../files/images/prop/".$_GET[im_prop_id].".png"))
          @unlink(".../../files/images/prop/".$_GET[im_prop_id].".png");
		  
?>
<script type="text/javascript">
	$.prompt('Элемент изображение удален.');
	$('#DivRequestImg').load('template.add/form.add.img.php?im_prop_id=<?php echo $_GET['im_prop_id'];?>');
</script>
