<?php
require_once("../../config/config.php");
require_once DOC_ROOT . '/config/class.config.php';
require_once("../utils/security_mod.php");
  	
  $json_converter = new Services_JSON();
  $response = array();
  $response['success'] = false;
  $response['fieldErrors'] = array();

		$menu_show = "hide";
		if($_POST['menu_show']) $menu_show = 'show';
		$title_show = "hide";
		if($_POST['title_show']) $title_show = 'show';
		$description_show = "hide";
		if($_POST['description_show']) $description_show = 'show';
		$summary_show =  "hide";
		if($_POST['summary_show']) $summary_show = 'show';
		$hide =  "hide";
		if($_POST['hide']) $hide = 'show';
		$is_top = ($_POST["is_top"] ? $_POST["is_top"]  : "0");
		
		$fileDir = '../../files/images/service/';
		$ImgProp['ImgW'] = 141;
		$ImgProp['ImgH'] = 101;
		
 	if($_POST['retention'] == 'edit_page')
	{
		# 	Получаем содержимое 
   		$cl_sel_pages = new mysql_select($tbl_service);
		$InfoParent = $cl_sel_pages -> select_table_id( "WHERE lang_id = $_COOKIE[lang_id] AND sc_id='{$_POST['parent_id']}' ORDER BY pos ASC");
		$_POST['parent_in'] = 0;
		if($InfoParent) $_POST['parent_in'] = $InfoParent['parent_in'] + 1;
		//$_POST['description'] = addslashes($_POST['description']);
		//$_POST['summary'] = addslashes($_POST['summary']);
		
			$arr_update 		 = array("sc_id"	 		=> "'{$_POST[sc_id]}',",
										 "menu_words" 		=> "'{$_POST[menu_words]}',",
										 "title" 			=> "'{$_POST[title]}',",
										 "keywords_web" 	=> "'{$_POST[keywords_web]}',",
										 "description_web" 	=> "'{$_POST[description_web]}',",
										 "title_show" 		=> "'{$title_show}',",
										 "description" 		=> "'{$_POST[description]}',",
										 "description_show" => "'{$description_show}',",
										 "summary" 			=> "'{$_POST[summary]}',",
										 "summary_show" 	=> "'{$summary_show}',",
										 "pos" 				=> "{$_POST[pos]},",
										 "hide" 			=> "'{$hide}',",
										 "adress_template" 	=> "'',",
										 "parent_id" 		=> "'{$_POST[parent_id]}',",
										 "parent_in" 		=> "'{$_POST[parent_in]}'");
	
			$cl_page_update  = new mysql_select($tbl_service);
			$cl_page_update	->update_table("WHERE sc_id = '{$_POST[sc_id]}' AND lang_id = {$_COOKIE[lang_id]}",
											$arr_update);
		
		$response['success'] = true;
		header('Content-type: text/plain');
		echo $json_converter->encode($response);
	}
	
#	add ������� PAGE
	if($_POST['retention'] == 'add_page')
	{
		$_POST['sc_id'] = uniqid();
		# 	Получаем содержимое 
   		$cl_sel_pages = new mysql_select($tbl_service);
		$InfoParent = $cl_sel_pages -> select_table_id( "WHERE lang_id = $_COOKIE[lang_id] AND sc_id='{$_POST['parent_id']}' ORDER BY pos ASC");
		$_POST['parent_in'] = 0;
		if($InfoParent) $_POST['parent_in'] = $InfoParent['parent_in'] + 1;
		
		$InfoPos = $cl_sel_pages -> select_table_id( "WHERE lang_id = $_COOKIE[lang_id] AND dict_id='{$_POST['dict_id']}' ORDER BY pos DESC LIMIT 1");
		$_POST[pos] = ($_POST[pos] ? $_POST[pos]: $InfoPos[pos]+1);
		
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
		$query = "INSERT INTO $tbl_service
						 VALUES ('{$_POST[sc_id]}',
								 '{$_POST[title]}',
								 '{$title_show}',
								 '{$_POST[description]}',
								 '{$description_show}',
								 '{$_POST[summary]}',
								 '{$_POST[summary_show]}',
								 '',
								 {$_POST[pos]},
								 '{$hide}',
								 '',
								 '{$_POST[parent_id]}',	
								 '{$_COOKIE[lang_id]}',
								 '{$_POST[parent_in]}',
								 '{$_POST[menu_words]}',
								 '{$_POST[dict_id]}',
								 '{$_POST[keywords_web]}',
								 '{$_POST[description_web]}',
								  NOW());";
	
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
