<?php 
	require_once '../utils/template.ajax/js.css.php';
	
	$arr_update 		 = array("photo" => "''");
	
	$cl_page_update  = new mysql_select('system_accounts');
	$cl_page_update	->update_table("WHERE id_account = '{$_GET[id_account]}'",
												   $arr_update);
	if(file_exists("../../files/images/realtor/".$_GET['photo']))
          @unlink(".../../files/images/realtor/".$_GET['photo']);
		  
?>
<script>
	$.prompt('Элемент изображение удален.');
	$('#DivRequestImg').load('template.add/form.add.img.php?id_account=<?php echo $_GET['id_account'];?>');
</script>
