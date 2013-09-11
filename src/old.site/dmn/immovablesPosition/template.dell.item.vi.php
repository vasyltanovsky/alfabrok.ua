<?php 
	require_once '../utils/template.ajax/js.css.php';
	
	$query = "DELETE FROM $tbl_im_vi WHERE im_id = '{$_GET['im_id']}'";
    if(!mysql_query($query)) throw new ExceptionMySQL(mysql_error(),   $query,  "Ошибка при удалении IMAGE");
    
    if(file_exists("../../files/video/im/".$_GET['file_name']))
    	@unlink("../../files/video/im/".$_GET['file_name']);	  
?>
