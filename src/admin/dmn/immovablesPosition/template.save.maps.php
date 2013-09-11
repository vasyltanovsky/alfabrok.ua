<?php
	require_once("../../config/config.php");
require_once DOC_ROOT . '/config/class.config.php';
	
	if ($_GET['action'] == 'save_coordinates') {
		$arr_update = array("im_maps_coo" 	=> "'{$_GET[coordinates]}'");
		$cl_page_update  = new mysql_select($tbl_im);
		$cl_page_update	->update_table("WHERE im_id = {$_GET[im_id]}",
										$arr_update);
		
	}
	if ($_GET['action'] == 'save_video') {
		$arr_update = array("im_maps_coo" 	=> "'{$_GET[coordinates]}'");
		$cl_page_update  = new mysql_select($tbl_im);
		$cl_page_update	->update_table("WHERE im_id = {$_GET[im_id]}",
										$arr_update);
		
	}
	
?>