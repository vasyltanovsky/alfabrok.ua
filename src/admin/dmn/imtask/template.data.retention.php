<?php
require_once("../../config/config.php");
require_once DOC_ROOT . '/config/class.config.php';
require_once("../utils/security_mod.php");
  	
  $json_converter = new Services_JSON();
  $response = array();
  $response['success'] = false;
  $response['fieldErrors'] = array();

 	if($_POST['retention'] == 'edit_task') {
		$CLDate = new class_date();
	    $_POST['t_date_reminder'] = $CLDate -> GetMysqlDateView($_POST['t_date_reminder']);
	    $_POST['t_date_reminder'] = "'{$_POST['t_date_reminder']}'";
	    $_POST[t_date_reminder]  = ($_POST[t_date_reminder] ? $_POST[t_date_reminder]: 'NULL');
		 
	    $is_do = 0;
		if($_POST['hide']) $is_do = 1;
	
		$arr_update 		 = array("t_title" => "'{$_POST['t_title']}',", "t_text" => "'{$_POST['t_text']}',", "im_id" => "'{$_POST['im_id']}',", "is_do" => $is_do.",", "t_date_reminder" => $_POST['t_date_reminder']);
	
		$cl_page_update  = new mysql_select('realtor_tasks');
		$cl_page_update	->update_table("WHERE t_id = {$_POST[t_id]}",
											$arr_update);
		
		$response['success'] = true;
		header('Content-type: text/plain');
		echo $json_converter->encode($response);
	}
	
	if($_POST['retention'] == 'add_task')
	{
		if(!empty($_POST['t_date_do'])) {
	    	$CLDate = new class_date();
	    	$_POST['t_date_do'] = $CLDate -> GetMysqlDateView($_POST['t_date_do']);
	    	$_POST['t_date_do'] = "'{$_POST['t_date_do']}'";
	    	
	    	$_POST['t_date_reminder'] = $CLDate -> GetMysqlDateView($_POST['t_date_reminder']);
	    	$_POST['t_date_reminder'] = "'{$_POST['t_date_reminder']}'";
	     }
	    $_POST[im_id]  = ($_POST[im_id] ? $_POST[im_id]: 'NULL');
	    $_POST[t_date_do]  = ($_POST[t_date_do] ? $_POST[t_date_do]: 'NULL');
	    $_POST[t_date_reminder]  = ($_POST[t_date_reminder] ? $_POST[t_date_reminder]: 'NULL');
		#
		$query = "INSERT INTO realtor_tasks VALUES
											  (NULL, NOW(), {$_POST[t_date_do]}, '{$_POST[readltor_do]}', '{$_POST[t_title]}', '{$_POST[t_text]}', '', '{$_POST[im_id]}', 0, {$_POST[t_date_reminder]});";
		if(!mysql_query($query))  throw new ExceptionMySQL(mysql_error(), $query, "ERROR INSERT IM TASKS");
		$response['success'] = true;
		header('Content-type: text/plain');
		echo $json_converter->encode($response);
	}
?>