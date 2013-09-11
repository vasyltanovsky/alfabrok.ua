<?php
	require_once("../../../config/config.php");
require_once DOC_ROOT . '/config/class.config.php';
	require_once("../../includes/mail/template.mail.text.php");
	require_once '../../includes/module/template.module.php';
	//include_once '../../../includes/language/set.cookie.php';
		
	/*
	 * 
	 */
	function updateRegionDict($dict_id) {
		if (empty($dict_id))
			return ;
		global $tbl_dictionaries;
		$arr_update 		 = array("hide" => "1");
		$cl_page_update  = new mysql_select($tbl_dictionaries);
		$cl_page_update	->update_table("WHERE dict_id = '{$dict_id}' AND lang_id = {$_COOKIE[lang_id]}",
										$arr_update);
		return;								
	}	
	
	#
//$_POST['user_password_sec']		= mysql_real_escape_string($_POST['user_password_sec']);
#
#print_r($_GET);	
	
	$fileDir = 'files/user/logo/';
	
	#настройки для копирования изображений 
	$fileDir = '../../../files/images/immovables/';
	$fileVideoDir = '../../../files/video/im/';
	$ImgProp['ImgW'] = 65;
	$ImgProp['ImgH'] = 65;
	$ImgPropIndex['ImgW'] = 190;
	$ImgPropIndex['ImgH'] = 190;
	$ImgPropSt['ImgW'] = 140;
	$ImgPropSt['ImgH'] = 140;
	
	if(!isset($_COOKIE[user_id])) {
		$_COOKIE[user_id] = 0;
	}
	
	$ImgRetProp = array('ImgW'=>200, 'ImgH' => 200);
	if(!empty($_GET)) {
		/*
		 * количество избранных позиций недвиж.
		 */
		if($_GET['retention'] == 'GetImFavoritesCount')
		{
			$ImFavQueryClass = new pager_mysql_right($tbl_user_if, 
													"WHERE user_id = {$_COOKIE[user_id]}");
			echo $ImFavQueryClass ->get_total();
		}
		/*
		 * 
		 */
		if($_GET['retention'] == 'get_prop'){
				$dictionaries = new dictionaries();
				$dct_list 	=	$dictionaries->buid_dictionaries_list($tbl_list_dictionaries);
				$dct		=	 $dictionaries->buid_dictionaries	($tbl_dictionaries,
											 	 					 "WHERE lang_id = {$_COOKIE[lang_id]}");
				$dictionaries->do_dictionaries(11);
				$im_region_id_add	 = $dictionaries->my_dct;
				$dictionaries->do_dictionaries(15);
				$im_array_id_add	 = $dictionaries->my_dct;
				$dictionaries->do_dictionaries(24);
				$im_a_region_add	 = $dictionaries->my_dct;
				$dictionaries->do_dictionaries(12);
				$im_city_id_add	 	= $dictionaries->my_dct;		
				$dictionaries->do_dictionaries(13);
				$im_area_id_add	 	= $dictionaries->my_dct;	
				$dictionaries->do_dictionaries(14);
				$im_adress_id_add 	= $dictionaries->my_dct;
				$dictionaries->do_dictionaries(22);
				$sale_id_add 		= $dictionaries->my_dct;
				$BuildResult = array_merge_recursive($im_region_id_add, $im_array_id_add, $im_a_region_add, $im_city_id_add, $im_area_id_add);
				$BuildResult = $dictionaries->BuildArrayParentChild($BuildResult);
				//$PrintFormStandartArr = BuildFieldset($BuildResult, $dictionaries, $CookieData);
				
				$ImPropList = new mysql_select($tbl_im_pl,
									   "WHERE lang_id = {$_COOKIE['lang_id']} AND catalog_id='{$_GET['im_catalog_id']}' AND type_prop='advanced' AND hide='show'",
									   "ORDER BY im_prop_name ASC");
				$ImPropList->select_table("im_prop_id");
		
				$PrintPropForm = new ImPropAdvaced($ImPropList, $dictionaries, NULL);
				$PrintPropForm->ImPropListPrintField();
				echo $PrintPropForm->Form;
				
		}
		/*
		* сохраниение подписки на рассылку
		*/
		
		
		
		
		if($_GET['retention'] == 'ImFormSubs') {
			$ImCatalogId	= $_GET['im_catalog_id'];
			$ImIsSale 		= ($_GET['is_sale'] ? $_GET['is_sale']: 'NULL');
			$ImIsRent		= ($_GET['is_rent'] ? $_GET['is_rent']: 'NULL');
			
			unset ($_GET['im_catalog_id']);
			unset ($_GET['is_sale']);
			unset ($_GET['is_rent']);
			
			$SQForm = new ImSiteForm($_GET, 'ImFormSearchArray','SearchImCode');
			$UsGet	= $SQForm -> PostGetToString($_GET);
			
			$query = "INSERT INTO {$tbl_user_subs} (`us_id`, `user_id`, `us_get`, `us_date`, `us_im_list`, `us_im_catalog`, `us_im_is_rent`, `us_im_is_sale`)
													 VALUES (NULL, {$_COOKIE['user_id']}, '{$UsGet}', NOW(), NULL, '{$ImCatalogId}', {$ImIsRent}, {$ImIsSale});;";
			if(!mysql_query($query))  throw new ExceptionMySQL(mysql_error(), $query, "ERROR INSERT SUBS");
		}
		if($_GET['retention'] == 'dell_subs') {
			$query = "DELETE FROM $tbl_user_subs WHERE us_id = '{$_GET[us_id]}'";
   			if(!mysql_query($query)) throw new ExceptionMySQL(mysql_error(),   $query,  "ERROR dell SUBS");
   		}
		exit();
	}
	
	$json_converter = new Services_JSON();
	$response = array();
	$response['success'] = false;
	$response['fieldErrors'] = array();

	
	
	if($_POST['retention'] == 'add_img')
	{
		$extension = pathinfo($_FILES['images']['name']);
		$extension = $extension['extension'];
		$fileName = uniqid().".".$extension;
		
		if(empty($extension))
		{
			echo "<div id=\"UserAddLogoErrorRequery\">{$arWords['user_add_err']}</div>";
			require_once("template.add.form.php");
			return;
		}
		if($_FILES['images'])
			if(copy($_FILES['images']['tmp_name'], $fileDir.''.$fileName))
			{
				// *** 1) Initialise / load image
					$resizeObj = new resize($fileDir."".$fileName);
				// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
					$resizeObj -> resizeImage($ImgRetProp['ImgW'], $ImgRetProp['ImgH'], 'auto');
				// *** 3) Save image
					$resizeObj -> saveImage($fileDir.'sm_'.$fileName, 100);
				
				$query = "INSERT INTO $tbl_logo_user
								 VALUES (NULL,
										 '{$_COOKIE[user_id]}',
										 '{$fileName}',
										 '',
										 NOW(),
										 '{$_POST[ul_text]}');";
			
				if(!mysql_query($query))  throw new ExceptionMySQL(mysql_error(), $query, "������ ��� + img");
				
				$query 		= "SELECT * FROM $tbl_user_site WHERE user_id = '{$_COOKIE[user_id]}'";
				$sql_query 	= mysql_query($query);
				if(!$sql_query) die(mysql_error()."".$query."������ select system_accounts");
				$DataUser = mysql_fetch_array($sql_query);
				
				$ArrMass['logo_adress'] = "<a href=\"http://{$_SERVER['HTTP_HOST']}/files/user/logo/{$fileName}\">Image!</a>";
				$ArrMass['user_fio'] = $DataUser['user_fio'];
				$ArrMass['user_id'] = $DataUser['user_id'];
				$ArrMass['user_email'] = $DataUser['user_email'];
				$ArrMass['user_tel'] = $DataUser['user_phone_mobile'];
				$ArrMass['ul_text'] = $_POST['ul_text'];
	
				$cl_Module = new ModuleSite($mail_template);	
				$UserMassage = $cl_Module->For_HTML($mail_template['user_add_logo'], $ArrMass);
	
				$mail = new PHPMailer();
				$mail->From = "{$EmailAdmin}";      // �� ����
				$mail->CharSet = 'utf-8';
				$mail->FromName = $EmailAdminMame;   // �� ����
				$mail->AddAddress($EmailAdmin); 		// ���� - �����, ���
				$mail->IsHTML(true);        			// ���������� ������ ������ HTML
				$mail->Subject = $EmailTitle['user_add_logo'];  // ���� ������ 
				$mail->AddAttachment($fileDir."sm_".$fileName);
				$mail->Body = $UserMassage; 
				if (!$mail->Send()) die ('Mailer Error: '.$mail->ErrorInfo);
				
				echo "<div id=\"UserAddLogoErrorRequery\">{$arWords['user_add_ok']}</div>";
			}
	}
	
	/*
	 * отправка заявки
	 */	
	if($_POST['retention'] == 'order_add') {
		#
			$ClUserData = new mysql_select($tbl_user_site);
			$UserData = $ClUserData ->select_table_id("WHERE user_id = {$_COOKIE[user_id]}");
		#
			if(empty($UserData)) $response['fieldErrors']['order_text'] = "ERROR send order";
			else {
			#
				$UserData = array_merge_recursive($UserData, $_POST);
				$cl_Module = new ModuleSite($mail_template);	
				$UserMassage = $cl_Module->For_HTML($mail_template['user_add_order'], $UserData);
				//echo $UserData['user_email'];
			#
				$mail = new PHPMailer();
				$mail->From = "{$EmailAdmin}";      // от кого
				$mail->CharSet = 'utf-8';
				$mail->FromName = $EmailAdminMame;   // от кого
				$mail->AddAddress($EmailAdmin); 		// кому - адрес, Имя
				$mail->IsHTML(true);        			// выставляем формат письма HTML
				$mail->Subject = $EmailTitle['user_add_order'];  // тема письма 
				$mail->Body = $UserMassage; 
				// отправляем наше письмо
				if (!$mail->Send()) die ('Mailer Error: '.$mail->ErrorInfo);
				$response['success'] = true;
			}
			
		//$response['success'] = true;
		header('Content-type: text/plain');
		echo $json_converter->encode($response);
			
	}
	
	/*
	 * 
	 */
	
	
	if($_POST['retention'] == 'add_page') {
		
		$_POST[im_prace] 	= ($_POST[im_prace] ? $_POST[im_prace]: 'NULL');
		$_POST[im_prace_day] 	= ($_POST[im_prace_day] ? $_POST[im_prace_day]: 'NULL');
		$_POST[im_prace_manth]  = ($_POST[im_prace_manth] ? $_POST[im_prace_manth]: 'NULL');
		$_POST[im_prace_sq]  = ($_POST[im_prace_sq] ? $_POST[im_prace_sq]: 'NULL');
		$_POST['im_prace_sq']	=  intval ($_POST['im_prace']/$_POST['im_space']);
		
		updateRegionDict($_POST[im_array_id]);
		updateRegionDict($_POST[im_region_id]);
		updateRegionDict($_POST[im_a_region_id]);
		updateRegionDict($_POST[im_city_id]);
		updateRegionDict($_POST[im_area_id]);
		updateRegionDict($_POST[im_adress_id]);
		
		//
		$im_is_rent = ($_POST["im_is_rent"] ? $_POST["im_is_rent"]  : "0");
    	$im_is_sale = ($_POST["im_is_sale"] ? $_POST["im_is_sale"]  : "0");
		$im_is_special = ($_POST["im_is_special"] ? $_POST["im_is_special"]  : "0");
		//
		$ImDataOneClass = new mysql_select($tbl_im);
		$ImDataOne = $ImDataOneClass  -> select_table_id("ORDER BY im_id desc LIMIT 1");
		$ImDataCode =  $ImDataOne['im_id']+1;
		switch ($_POST['im_catalog_id']) {
				case '4c3ec3ec5e9b5' : 
					$c = "K".$ImDataCode;
					break;
				case '4c3ec3ec5e9b7' : 
					$c = "C".$ImDataCode;
					break;
				case '4c3ec51d537c0' : 
					$c = "H".$ImDataCode;
					break;
				case '4c3ec51d537c2' : 
					$c = "M".$ImDataCode;
					break;
				case '4c3ec51d537c3' : 
					$c = "T".$ImDataCode;
					break;
				default :
					$c = NULL;
			}
			
		$query = "INSERT INTO $tbl_im
						 VALUES (NULL,
								 '{$_POST[im_catalog_id]}',
								 '{$_POST[im_type_id]}',
								 '{$_POST[im_array_id]}',
								 '{$_POST[im_region_id]}',
								 '{$_POST[im_a_region_id]}',
								 '{$_POST[im_city_id]}',
								 '{$_POST[im_area_id]}',
								 '{$_POST[im_adress_id]}',
								 '{$_POST[im_adress_house]}',
								 {$_POST[im_prace]},
								 {$_POST[im_prace]},
								 {$_POST[im_prace_sq]},
								 {$_POST[im_prace_day]},
								 {$_POST[im_prace_manth]},
								 'imnoimage.png',
								 '{$_POST[im_space]}',
								 '{$_POST[im_space_value_id]}',
								 '{$_POST[im_sale_id]}',
								 'hide',
								 {$_COOKIE[user_id]},
								 NULL,
								 NULL,
								 0,
								 $im_is_sale,
								 $im_is_rent,
								 NOW(),
								 NULL,
								 '".mysql_escape_string($_POST[im_adress_flat])."',
								 '".mysql_escape_string($_POST[im_title])."',
								 NULL,
								 {$_COOKIE[user_id]},
								 '{$c}', 
								 '{$_POST[tel]}',
								  $im_is_special,
								  NULL);";
	
		if(!mysql_query($query))  throw new ExceptionMySQL(mysql_error(), $query, "Ошибка при + каталога".$query);
		
		$response['success'] = true;
		header('Content-type: text/plain');
		echo $json_converter->encode($response);
	}

	#	редактирование стандартных характеристик недвижимости
	if($_POST['retention'] == 'edit_page')
	{
		$_POST[im_prace_day] 	= ($_POST[im_prace_day] ? $_POST[im_prace_day]: 'NULL');
		$_POST[im_prace_manth]  = ($_POST[im_prace_manth] ? $_POST[im_prace_manth]: 'NULL');
		$_POST[im_prace_sq]  	= ($_POST[im_prace_sq] ? $_POST[im_prace_sq]: 'NULL');
		$_POST[pos]  			= ($_POST[pos] ? $_POST[pos]: 'NULL');
		$_POST['im_prace_sq']	=  intval ($_POST['im_prace']/$_POST['im_space']);
		
		$im_is_rent = ($_POST["im_is_rent"] ? $_POST["im_is_rent"]  : "0");
    	$im_is_sale = ($_POST["im_is_sale"] ? $_POST["im_is_sale"]  : "0");
		$im_is_special = ($_POST["im_is_special"] ? $_POST["im_is_special"]  : "0");
		
		updateRegionDict($_POST[im_array_id]);
		updateRegionDict($_POST[im_region_id]);
		updateRegionDict($_POST[im_a_region_id]);
		updateRegionDict($_POST[im_city_id]);
		updateRegionDict($_POST[im_area_id]);
		updateRegionDict($_POST[im_adress_id]);
		
			$arr_update = array("im_catalog_id" 			=> "'{$_POST[im_catalog_id]}',",
								"im_type_id" 				=> "'{$_POST[im_type_id]}',",
								"im_array_id" 				=> "'{$_POST[im_array_id]}',",
								"im_region_id" 				=> "'{$_POST[im_region_id]}',",
								"im_a_region_id" 			=> "'{$_POST[im_a_region_id]}',",
								"im_city_id" 				=> "'{$_POST[im_city_id]}',",
								"im_area_id" 				=> "'{$_POST[im_area_id]}',",
								"im_adress_id" 				=> "'{$_POST[im_adress_id]}',",
								"im_adress_house" 			=> "'{$_POST[im_adress_house]}',",
								"im_prace" 					=> "'{$_POST[im_prace]}',",
								"im_prace_sq" 				=> "{$_POST[im_prace_sq]},",
								"im_prace_day" 				=> "{$_POST[im_prace_day]},",
								"im_prace_manth" 			=> "{$_POST[im_prace_manth]},",
							    "im_space" 					=> "'{$_POST[im_space]}',",
								"im_space_value_id" 		=> "'{$_POST[im_space_value_id]}',",
								"im_is_sale" 				=> "{$im_is_sale},",								
								"im_is_rent" 				=> "{$im_is_rent},",
								"im_is_special" 		    => "{$im_is_special},",
								"im_adress_flat" 			=> "'{$_POST[im_adress_flat]}',",
								"im_title" 					=> "'{$_POST[im_title]}'");
								
			
			$cl_page_update  = new mysql_select($tbl_im);
			$cl_page_update	->update_table("WHERE im_id = {$_POST[im_id]}",
											$arr_update);
		
		$response['success'] = true;
		header('Content-type: text/plain');
		echo $json_converter->encode($response);
	}
	
	if($_POST['retention'] == 'add_im_prop_info') {
		if($_COOKIE['lang_id'] == 1) $lang_f = 2;
		if($_COOKIE['lang_id'] == 2) $lang_f = 1;
		
		#
		function PostField($PostFieldValue)
		{	
			$update = "";
			for($i = 0; $i<count($PostFieldValue); $i++)
			{
				if(!empty($PostFieldValue[$i])) $update .= "{$PostFieldValue[$i]} ";
			}
			if(empty($update)) return;
			return substr($update, 0, strlen($update)-1);
		}
		
		foreach($_POST as $key=>$value)
		{
			if($key != 'im_id' and $key != 'retention' and $key != 'Clear')
			{
				$FieldTupe = substr(substr($key, 0 , 2), 0 ,1);
				$key = substr($key, 2, strlen($key));
				
				if(!empty($value)){
					#
					if($FieldTupe == 's') {
						$query = "INSERT INTO {$tbl_im_pi} (`im_prop_id`, `im_id`, `lang_id`, `im_prop_value`, `im_prop_value_dict_id`, `im_prop_value_dict_list`) VALUES
											('{$key}', '{$_POST[im_id]}', '{$_COOKIE[lang_id]}','', '".mysql_escape_string($value)."', '')
											ON DUPLICATE KEY UPDATE im_prop_value_dict_id = '".mysql_escape_string($value)."', im_prop_value='', im_prop_value_dict_list='';";
						if(!mysql_query($query))  throw new ExceptionMySQL(mysql_error(), $query, "ERROR INSERT or UPDATE IM_PROP_INFO");					
						$query = "INSERT INTO {$tbl_im_pi} (`im_prop_id`, `im_id`, `lang_id`, `im_prop_value`, `im_prop_value_dict_id`, `im_prop_value_dict_list`) VALUES
											('{$key}', '{$_POST[im_id]}', '{$lang_f}','', '".mysql_escape_string($value)."', '')
											ON DUPLICATE KEY UPDATE im_prop_value_dict_id = '".mysql_escape_string($value)."', im_prop_value='', im_prop_value_dict_list='';";
						if(!mysql_query($query))  throw new ExceptionMySQL(mysql_error(), $query, "ERROR INSERT or UPDATE IM_PROP_INFO");
					}
					#
					if($FieldTupe == 't') {
						$query = "INSERT INTO {$tbl_im_pi} (`im_prop_id`, `im_id`, `lang_id`, `im_prop_value`, `im_prop_value_dict_id`, `im_prop_value_dict_list`) VALUES
											('{$key}', '{$_POST[im_id]}', '{$_COOKIE[lang_id]}','".mysql_escape_string($value)."', '', '')
											ON DUPLICATE KEY UPDATE im_prop_value = '".mysql_escape_string($value)."', im_prop_value_dict_id='', im_prop_value_dict_list='';";
						if(!mysql_query($query))  throw new ExceptionMySQL(mysql_error(), $query, "ERROR INSERT or UPDATE IM_PROP_INFO");					
						$query = "INSERT INTO {$tbl_im_pi} (`im_prop_id`, `im_id`, `lang_id`, `im_prop_value`, `im_prop_value_dict_id`, `im_prop_value_dict_list`) VALUES
											('{$key}', '{$_POST[im_id]}', '{$lang_f}','', '', '')
											ON DUPLICATE KEY UPDATE im_prop_value_dict_id='', im_prop_value_dict_list='';";
						if(!mysql_query($query))  throw new ExceptionMySQL(mysql_error(), $query, "ERROR INSERT or UPDATE IM_PROP_INFO");
					}
					#
					if($FieldTupe == 'm') {
						$PostField = PostField($value);
						if(!empty($PostField)) {
							$query = "INSERT INTO {$tbl_im_pi} (`im_prop_id`, `im_id`, `lang_id`, `im_prop_value`, `im_prop_value_dict_id`, `im_prop_value_dict_list`) VALUES
															   ('{$key}', '{$_POST[im_id]}', '{$_COOKIE[lang_id]}','', '', '".mysql_escape_string($PostField)."')
																ON DUPLICATE KEY UPDATE im_prop_value_dict_list = '".mysql_escape_string($PostField)."', im_prop_value='', im_prop_value_dict_id='';";
							if(!mysql_query($query))  throw new ExceptionMySQL(mysql_error(), $query, "ERROR INSERT or UPDATE IM_PROP_INFO");					
							$query = "INSERT INTO {$tbl_im_pi} (`im_prop_id`, `im_id`, `lang_id`, `im_prop_value`, `im_prop_value_dict_id`, `im_prop_value_dict_list`) VALUES
																('{$key}', '{$_POST[im_id]}', '{$lang_f}','', '', '".mysql_escape_string($PostField)."')
																ON DUPLICATE KEY UPDATE im_prop_value_dict_list = '".mysql_escape_string($PostField)."', im_prop_value='', im_prop_value_dict_id='';;";							
							if(!mysql_query($query))  throw new ExceptionMySQL(mysql_error(), $query, "ERROR INSERT or UPDATE IM_PROP_INFO");
						}
					}
					#
					if($FieldTupe == 'c') {
						$query = "INSERT INTO {$tbl_im_pi} (`im_prop_id`, `im_id`, `lang_id`, `im_prop_value`, `im_prop_value_dict_id`, `im_prop_value_dict_list`) VALUES
														   ('{$key}', '{$_POST[im_id]}', '{$_COOKIE[lang_id]}','".mysql_escape_string($value)."', '', '')
															ON DUPLICATE KEY UPDATE im_prop_value = '".mysql_escape_string($value)."', im_prop_value_dict_id='', im_prop_value_dict_list='';";
						if(!mysql_query($query))  throw new ExceptionMySQL(mysql_error(), $query, "ERROR INSERT or UPDATE IM_PROP_INFO");					
						$query = "INSERT INTO {$tbl_im_pi} (`im_prop_id`, `im_id`, `lang_id`, `im_prop_value`, `im_prop_value_dict_id`, `im_prop_value_dict_list`) VALUES
															('{$key}', '{$_POST[im_id]}', '{$lang_f}','', '', '')
															ON DUPLICATE KEY UPDATE `lang_id`= VALUES(`lang_id`), im_prop_value_dict_id='', im_prop_value_dict_list='';;";
						if(!mysql_query($query))  throw new ExceptionMySQL(mysql_error(), $query, "ERROR INSERT or UPDATE IM_PROP_INFO");
					}
				}
			}
		}
		
		$response['success'] = true;
		header('Content-type: text/plain');
		echo $json_converter->encode($response);
	}
	
	
	/*
	 *	Назначение главным иозб. недвиж. 
	 */
	if($_POST['retention'] == 'ImIndexPhoto') {
		#выборка с БД
			$cl_photo_class = new mysql_select($tbl_im_ph);
			$ImPhotoFileType = $cl_photo_class -> select_table_id("WHERE im_photo_id = '{$_POST[im_photo_id]}'");
		#обновление записи недвиж.
			$arr_update = array("im_photo" 	=> "'{$_POST[im_photo_id]}.{$ImPhotoFileType[im_file_type]}'");
			$cl_page_update = 	new mysql_select($tbl_im);
			$cl_page_update	->	update_table("WHERE im_id = {$_POST[im_id]}",
												$arr_update);
		#Формируем малое изображение
			#$resizeObj = new resize($fileDir.$_POST[im_photo_id].".".$ImPhotoFileType[im_file_type]);
			#$resizeObj -> resizeImage($ImgPropSt['ImgW'], $ImgPropSt['ImgH'], 'crop');
			#$resizeObj -> saveImage($fileDir.'st_'.$_POST[im_photo_id].".".$ImPhotoFileType[im_file_type], 100);
		#наложение логотипа
			#$ClassApplyignImage = new applying_image();
			#$ClassApplyignImage -> prepare_image($fileDir."st_".$_POST[im_photo_id].".".$ImPhotoFileType[im_file_type], $fileDir."st_".$_POST[im_photo_id].".".$ImPhotoFileType[im_file_type], "../../../files/images/bg/logo80.png", $ImgPropSt['ImgW'], $ImgPropSt['ImgH'], 40,20);
			exit();
	}
	
	/*
	 *	Назначение главным иозб. недвиж. 
	 */
	
	if($_POST['retention'] == 'edit_summary') {
		$query = "INSERT INTO {$tbl_im_su} (`im_su_id`, `im_id`, `lang_id`, `im_su_text`) VALUES
											(".($_POST['im_su_id'] ? $_POST['im_su_id'] : 'NULL').", {$_POST[im_id]}, '{$_POST[lang_id]}','".mysql_escape_string($_POST[im_su_text])."')
											ON DUPLICATE KEY UPDATE im_su_text = '".mysql_escape_string($_POST[im_su_text])."';";
		if(!mysql_query($query))  throw new ExceptionMySQL(mysql_error(), $query, "ERROR INSERT or UPDATE IM_SUMMARY");
		$response['success'] = true;
		header('Content-type: text/plain');
		echo $json_converter->encode($response);					
	}
?>