<?
  require_once("../../config/config.php");
  require_once("../utils/security_mod.php");
require_once DOC_ROOT . '/config/class.config.php';
  	
  $json_converter = new Services_JSON();
  $response = array();
  $response['success'] = false;
  $response['fieldErrors'] = array();

 	if($_POST['retention'] == 'edit_page')
	{
			$arr_update 		 = array("type_rs"	 		=> "'{$_POST[type_rs]}',",
										 "type_im" 			=> "'{$_POST[type_im]}',",
										 "type_im" 			=> "'{$_POST[type_im]}',",
										 "type_reg" 		=> "'{$_POST[type_reg]}',",
										 "it_text" 			=> "'{$_POST[it_text]}',",
										 "dict_id" 			=> "'{$_POST[dict_id]}'");
	
			$cl_page_update  = new mysql_select($tbl_im_text);
			$cl_page_update	->update_table("WHERE it_id = '{$_POST[it_id]}' AND lang_id = {$_COOKIE[lang_id]}",
											$arr_update);
		
		$response['success'] = true;
		header('Content-type: text/plain');
		echo $json_converter->encode($response);
	}
	
	if($_POST['retention'] == 'add_page')
	{
		$_POST['it_id'] = uniqid();
	
		
		if($_COOKIE['lang_id'] == 1) {
			$lang_f = 2;
			$lang_t = 3;
		}
		if($_COOKIE['lang_id'] == 2) {
			$lang_f = 1;
			$lang_t = 3;
		}
		if($_COOKIE['lang_id'] == 3) {
			$lang_f = 1;
			$lang_t = 2;
		}
		
		$query = "INSERT INTO $tbl_im_text
						 VALUES ('{$_POST[it_id]}',
								 {$_COOKIE[lang_id]},
								 '{$_POST[type_rs]}',
								 '{$_POST[type_im]}',
								 '{$_POST[type_reg]}',	
								 '{$_POST[il_text]}',
								 '{$_POST[dict_id]}');";
	
		if(!mysql_query($query))  throw new ExceptionMySQL(mysql_error(), $query, "Ошибка при + каталога");
		
		$response['success'] = true;
		header('Content-type: text/plain');
		echo $json_converter->encode($response);
	}

	if($_POST['retention'] == 'add_img')
	{
		$extension = pathinfo($_FILES['images']['name']);
		$extension = $extension['extension'];
		$fileName = $_POST['sc_id'].".".$extension;
		if($_FILES['images'])
			if(copy($_FILES['images']['tmp_name'], $fileDir.$fileName))
			{
				// Формируем малое изображение
				// *** 1) Initialise / load image
					$resizeObj = new resize($fileDir."".$fileName);
				// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
					$resizeObj -> resizeImage($ImgProp['ImgW'], $ImgProp['ImgH'], 'crop');
				// *** 3) Save image
					$resizeObj -> saveImage($fileDir.$fileName, 100);
					
				$arr_update 		 = array("img"	 		=> "'{$fileName}'");
	
				$cl_page_update  = new mysql_select($tbl_service);
				$cl_page_update	->update_table("WHERE sc_id = '{$_POST[sc_id]}'",
												$arr_update);
			}
	}
	
	if($_POST['retention'] == 'packet_page')
	{
		$arrNI = array('sc_id','retention','Clear');
		foreach($_POST as $key=>$value)
		{
			if(!in_array($key,$arrNI))
			{
				$insertPacketInfo .= "('{$key}','{$_POST[sc_id]}',1,''),";
				$insertPacketInfo .= "('{$key}','{$_POST[sc_id]}',2,''),";
			}
		}
		
		$insertPacketInfo = substr($insertPacketInfo,0,strlen($insertPacketInfo)-1);
		$query = "DELETE FROM $tbl_ps_info WHERE sc_id = '{$_POST[sc_id]}'";
    	if(!mysql_query($query)) throw new ExceptionMySQL(mysql_error(),   $query,  "Ошибка при удалении каталога");
		$query = "INSERT INTO $tbl_ps_info VALUES $insertPacketInfo;";
		if(!mysql_query($query)) throw new ExceptionMySQL(mysql_error(),   $query,  "Ошибка при + каталога");
	
		$response['success'] = true;
		header('Content-type: text/plain');
		echo $json_converter->encode($response);
	}
	
	
	if($_POST['retention'] == 'add_packet')
	{
		$query = "INSERT INTO $tbl_ps_list
						 VALUES ('{$_POST[ps_id]}',
						 		 '1',
								 '{$_POST[ps_name]}',
								 '{$_POST[ps_summary]}',
								 '{$hide}'),
								 ('{$_POST[ps_id]}',
						 		 '2',
								 '{$_POST[ps_name]}',
								 '{$_POST[ps_summary]}',
								 '{$hide}');";
	
		if(!mysql_query($query))  throw new ExceptionMySQL(mysql_error(), $query, "Ошибка при + каталога");
		
		$response['success'] = true;
		header('Content-type: text/plain');
		echo $json_converter->encode($response);	
	}
	
	if($_POST['retention'] == 'edit_packet')
	{
			$arr_update 		 = array("ps_name"	 		=> "'{$_POST[ps_name]}',",
										 "ps_summary" 		=> "'{$_POST[ps_summary]}',",
										 "hide" 			=> "'{$hide}'");
	
			$cl_page_update  = new mysql_select($tbl_ps_list);
			$cl_page_update	->update_table("WHERE ps_id = '{$_POST[ps_id]}' AND lang_id = {$_COOKIE[lang_id]}",
											$arr_update);
		
		$response['success'] = true;
		header('Content-type: text/plain');
		echo $json_converter->encode($response);
	}
?>
