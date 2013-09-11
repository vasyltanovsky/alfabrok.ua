<?php
	require_once("../../config/config.php");
require_once DOC_ROOT . '/config/class.config.php';
		
	if ($_POST['retention'] == 'add_video') {
		$fileVideoDir = '../../files/video/im/';
			
		$VideoId = uniqid();
		$extension = pathinfo($_FILES['video']['name']);
		$extension = strtolower($extension['extension']);
		$fileName = strtolower($VideoId.".".$extension);

		if($_FILES['video'])
			if(copy($_FILES['video']['tmp_name'], $fileVideoDir.''.$fileName)) {
					$query = "INSERT INTO {$tbl_im_vi} (`iv_id`, `im_id`, `iv_file_type`, `iv_date`, `hide`) VALUES
													 	('{$VideoId}', '{$_POST[im_id]}', '{$extension}', NOW(), 'show');";
					if(!mysql_query($query))  throw new ExceptionMySQL(mysql_error(), $query, "ERROR INSERT IM VIDEO");
				$location = "Location: index.php?dict_id=&msq=v_add&s_im_id={$_POST[im_id]}";
				header($location);	
			}
			die("ERROR NO ADD FILE VIDEO format");
	}
	
?>