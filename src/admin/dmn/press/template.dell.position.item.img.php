<?php 
	require_once '../utils/template.ajax/js.css.php';
	
	$arr_update 		 = array("news_image" => "''");
	
	$cl_page_update  = new mysql_select($tbl_news);
	$cl_page_update	->update_table("WHERE news_id = '{$_GET[news_id]}'",
												   $arr_update);
	if(file_exists("../../files/portfolio/".$_GET['news_image']))
          @unlink(".../../files/portfolio/".$_GET['news_image']);
		  
?>
<script>
	$.prompt('Элемент изображение удален.');
	$('#DivRequestImg').load('template.add/form.add.img.php?news_id=<?php echo $_GET['news_id'];?>');
</script>
