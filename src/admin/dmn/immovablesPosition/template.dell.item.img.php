<?php 
	require_once '../utils/template.ajax/js.css.php';
	
	$query = "DELETE FROM $tbl_im_ph WHERE im_photo_id = '{$_POST[im_photo_id]}'";
    if(!mysql_query($query)) throw new ExceptionMySQL(mysql_error(),   $query,  "Ошибка при удалении IMAGE");
    
    $cl_photo_class = new mysql_select($tbl_im_ph);
	$ImPhotoFileType = $cl_photo_class -> select_table_id("WHERE im_photo_id = '{$_POST[im_photo_id]}'");
		
	if(file_exists($images_folder.$_POST[im_photo_id].".".$ImPhotoFileType[im_file_type]))
          @unlink($images_folder.$_POST[im_photo_id].".".$ImPhotoFileType[im_file_type]);
	if(file_exists($images_folder."s_".$_POST[im_photo_id].".".$ImPhotoFileType[im_file_type]))
          @unlink($images_folder."s_".$_POST[im_photo_id].".".$ImPhotoFileType[im_file_type]);		  
?>
