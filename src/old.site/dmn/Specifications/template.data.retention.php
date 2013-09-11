<?
  // 
  require_once("../../config/config.php");
  //
  require_once("../utils/security_mod.php");
  //  SoftTime FrameWork
require_once DOC_ROOT . '/config/class.config.php';
 
  $json_converter = new Services_JSON();
  $response = array();
  $response['success'] = false;
  $response['fieldErrors'] = array();

    $fileDir = '../../files/images/prop/';
	$ImgProp['ImgW'] = 44;
	$ImgProp['ImgH'] = 44;
	
 	/*echo "<prE>";
	print_r($_POST); 
	echo "</prE>";*/
		
  
    $IsFieldForm = ($_POST["is_show_form"] ? $_POST["is_show_form"]  : "0");
    $IsPropRent = ($_POST["is_prop_rent"] ? $_POST["is_prop_rent"]  : "0");
    $IsPropSale = ($_POST["is_prop_sale"] ? $_POST["is_prop_sale"]  : "0");
    $IsFieldList = ($_POST["is_print_list"] ? $_POST["is_print_list"]  : "0");
    
    switch ($_POST['is_print']) {
    	case 'is_print_st': {
    		$IsPropSt = 1;
    		$IsPropAd = 0; 
    	break;
    	}
    	case 'is_print_ad': {
    		$IsPropSt = 0;
    		$IsPropAd = 1; 
    	break;
    	}
    }
      
    $_POST["ld_id"] = ($_POST["ld_id"] ? $_POST["ld_id"]  : "NULL");
 	$hide =  "hide";
	if($_POST['hide']) $hide = 'show';
	
#	EDIT PROPERTICE
	if($_POST['retention'] == 'edit_page')
	{
		$arr_update 		 = array("im_prop_name"	 			=> "'{$_POST[im_prop_name]}',",
									 "catalog_id"	 			=> "'{$_POST[catalog_id]}',",
									 "im_prop_value_dict_id"	=> "'{$_POST[im_prop_value_dict_id]}',",
									 "im_prop_style_id" 		=> "'{$_POST[im_prop_style_id]}',",
									 "is_show_form"				=> "{$IsFieldForm},",
									 "type_prop" 				=> "'{$_POST[type_prop]}',",
									 "hide" 					=> "'{$hide}',",
									 "ld_id" 					=> "{$_POST[ld_id]},",
									 "is_prop_rent" 			=> "{$IsPropRent},",
									 "is_prop_sale" 			=> "{$IsPropSale},",
									"is_print_list" 			=> "{$IsFieldList},",
									"is_print_st" 				=> "{$IsPropSt},",
									"is_print_ad" 				=> "{$IsPropAd}"
									);
		$cl_page_update  = new mysql_select($tbl_im_pl);
		$cl_page_update	->update_table("WHERE im_prop_id = '{$_POST[im_prop_id]}' AND lang_id = {$_COOKIE[lang_id]}",
										$arr_update);
		
		$response['success'] = true;
		header('Content-type: text/plain');
		echo $json_converter->encode($response);
	}
	
#	ADD PROPERTICE
	if($_POST['retention'] == 'add_page')
	{
		if($_COOKIE['lang_id'] == 1)
		{
			$lang_f = 2;
			$lang_t = 3;
		}
		if($_COOKIE['lang_id'] == 2)
		{
			$lang_f = 1;
			$lang_t = 3;
		}
		$id = uniqid();
		
		$query = "INSERT INTO $tbl_im_pl
						 VALUES ('$id',
						 		 {$_COOKIE[lang_id]},
								 '{$_POST[im_prop_name]}',
								 '{$_POST[catalog_id]}',
								 '',
								 '{$_POST[im_prop_style_id]}',
								 $IsFieldForm,
								 '{$_POST[type_prop]}',
								 '{$hide}',
								 {$_POST[ld_id]},
								 {$IsPropRent},
								 {$IsPropSale},
								 {$IsFieldList},
								 {$IsPropSt},
								 {$IsPropAd},
								 0),
								 
								('$id',
						 		 {$lang_f},
								 '{$_POST[im_prop_name]}',
								 '{$_POST[catalog_id]}',
								 '',
								 '{$_POST[im_prop_style_id]}',
								 $IsFieldForm,
								 '{$_POST[type_prop]}',
								 '{$hide}',
								 {$_POST[ld_id]},
								 {$IsPropRent},
								 {$IsPropSale},
								 {$IsFieldList},
								 {$IsPropSt},
								 {$IsPropAd},
								 0);";
	
		if(!mysql_query($query))  throw new ExceptionMySQL(mysql_error(), $query, "ERROR ADD PROP");
		
		$response['success'] = "testststst";
		header('Content-type: text/plain');
		echo $json_converter->encode($response);
	}
	
		
	if($_POST['retention'] == 'edit_position_page')
	{
			$arr_update 		 = array("ld_id" 			=> "'{$_POST[ld_id]}',",
										 "dict_code" 		=> "'{$_POST[dict_code]}',",
										 "dict_name" 		=> "'{$_POST[dict_name]}',",
										 "parent_id" 		=> "'{$_POST[parent_id]}'");
	
			$cl_page_update  = new mysql_select($tbl_dictionaries);
			$cl_page_update	->update_table("WHERE dict_id = '{$_POST[dict_id]}' AND lang_id = {$_COOKIE[lang_id]}",
											$arr_update);
		
			$arr_update 		 = array("cs_dict_id" 		=> "'{$_POST[cs_dict_id]}'");
	
			$cl_page_update  = new mysql_select($tbl_cs);
			$cl_page_update	->update_table("WHERE cs_cat_id = '{$_POST[dict_id]}'",
											$arr_update);
			
		$response['success'] = true;
		header('Content-type: text/plain');
		echo $json_converter->encode($response);
		
	}
	
	if($_POST['retention'] == 'add_position_page')
	{
		if($_COOKIE['lang_id'] == 1)
		{
			$lang_f = 2;
			$lang_t = 3;
		}
		if($_COOKIE['lang_id'] == 2)
		{
			$lang_f = 1;
			$lang_t = 3;
		}
		
		$query = "INSERT INTO $tbl_dictionaries
						 VALUES ('{$_POST[dict_id]}',
								 '{$_POST[ld_id]}',
								 '{$_COOKIE[lang_id]}',
								 '{$_POST[dict_code]}',
								 '{$_POST[dict_name]}',
								 '{$_POST[parent_id]}'),
								 
								 ('{$_POST[dict_id]}',
								 '{$_POST[ld_id]}',
								 '{$lang_f}',
								 '{$_POST[dict_code]}',
								 '{$_POST[dict_name]}',
								 '{$_POST[parent_id]}');";
	
		if(!mysql_query($query))  throw new ExceptionMySQL(mysql_error(), $query, "������ ���������� ���������� ���������");
		
		$query = "INSERT INTO $tbl_cs
						 VALUES ('{$_POST[dict_id]}',
								 '{$_POST[cs_dict_id]}')";
			
		if(!mysql_query($query))  throw new ExceptionMySQL(mysql_error(), $query, "������ ���������� ���������� ���������");	
		$response['success'] = "testststst";
		header('Content-type: text/plain');
		echo $json_converter->encode($response);
	}
	
	if($_POST['retention'] == 'add_img')
	{
		$extension = pathinfo($_FILES['images']['name']);
		$extension = $extension['extension'];
		$fileName = strtolower($_POST['im_prop_id'].".".$extension);
		
		if($extension != 'png') return "ERROR!! NO PNG";
		if($_FILES['images'])
			if(copy($_FILES['images']['tmp_name'], $fileDir.''.$fileName))
			{
				// *** 1) Initialise / load image
					$resizeObj = new resize($fileDir."".$fileName);
				// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
					$resizeObj -> resizeImage($ImgProp['ImgW'], $ImgProp['ImgH'], 'crop');
				// *** 3) Save image
					$resizeObj -> saveImage($fileDir.''.$fileName, 100);
				
				
				$arr_update 		 = array("prop_have_image" => "1");
				$cl_page_update  = new mysql_select($tbl_im_pl);
				$cl_page_update	->update_table("WHERE im_prop_id = '{$_POST[im_prop_id]}'",
												$arr_update);
				//echo "OK";
			}
	}
/*$response['fieldErrors']['title'] = "Passwords do not match";
if(sizeof($response['fieldErrors']) == 0)
{
	$response['success'] = true;
	header('Content-type: text/plain');
	echo $json_converter->encode($response);
} 
else
{
	
	header('Content-type: text/plain');
	echo $json_converter->encode($response);
}*/
?>
