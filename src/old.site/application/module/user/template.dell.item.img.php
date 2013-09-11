<?php 
	require_once("../../../config/config.php");
require_once DOC_ROOT . '/config/class.config.php';
	require_once("../../includes/mail/template.mail.text.php");
	require_once '../../includes/module/template.module.php';
	
	$query = "DELETE FROM $tbl_im_ph WHERE im_photo_id = '{$_POST[im_photo_id]}'";
    if(!mysql_query($query)) throw new ExceptionMySQL(mysql_error(),   $query,  "Ошибка при удалении IMAGE");
    
    $cl_photo_class = new mysql_select($tbl_im_ph);
	$ImPhotoFileType = $cl_photo_class -> select_table_id("WHERE im_photo_id = '{$_POST[im_photo_id]}'");
		
	if(file_exists("../../files/images/immovables/".$_POST[im_photo_id].".".$ImPhotoFileType[im_file_type]))
          @unlink("../../files/images/immovables/".$_POST[im_photo_id].".".$ImPhotoFileType[im_file_type]);
	if(file_exists("../../files/images/immovables/s_".$_POST[im_photo_id].".".$ImPhotoFileType[im_file_type]))
          @unlink("../../files/images/immovables/s_".$_POST[im_photo_id].".".$ImPhotoFileType[im_file_type]);		  
?>
