<?php
require_once ("../../config/config.php");
require_once DOC_ROOT . '/config/class.config.php';
require_once ("../utils/security_mod.php");

/*
 * 
 */

function fulldel_dir($directory) {
	$dir = opendir ( $directory );
	while ( ($file = readdir ( $dir )) ) {
		// Если функция readdir() вернула файл - удаляем его
		if (is_file ( "$directory/$file" ))
			unlink ( "$directory/$file" );
			// Если функция readdir () вернула директорию и она
		// не равна текущей или родительской - осуществляем
		// для нее рекурсивный вызов fulldel_dir();
		elseif (is_dir ( "$directory/$file" ) && $file != "." && $file != "..") {
			fulldel_dir ( "$directory/$file" );
		}
	}
	closedir ( $dir );
	rmdir ( $directory );
}

function updateRegionDict($dict_id) {
	if (empty ( $dict_id ))
		return;
	global $tbl_dictionaries;
	$arr_update = array ("hide" => "1" );
	$cl_page_update = new mysql_select ( $tbl_dictionaries );
	$cl_page_update->update_table ( "WHERE dict_id = '{$dict_id}' AND lang_id = {$_COOKIE[lang_id]}", $arr_update );
	return;
}

if (isset ( $_GET ['action'] )) {
	if ($_GET ['action'] == 'GeoPosition') {
		#объявляем класс словаря
		$dictionaries = new dictionaries ( );
		#формируем массив имени словарей
		$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries, "ORDER BY ld_name ASC" );
		#формируем массив значений словарей
		$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = 1", "ORDER BY dict_name ASC" );
		
		$im_city_id = $dictionaries->buld_table [$_POST [im_city_id]] ['dict_name'];
		$im_adress_id = $dictionaries->buld_table [$_POST [im_adress_id]] ['dict_name'];
		$im_adress_house = $_POST [im_adress_house];
		echo $im_city_id . ', ' . $im_adress_id . ' ' . $im_adress_house;
	
	}
	if ($_GET ['action'] == 'SaveGeoPosition') {
		$arr_update = array ("im_geopos" => "'{$_GET[GeoPosition]}'" );
		$cl_page_update = new mysql_select ( $tbl_im );
		$cl_page_update->update_table ( "WHERE im_id = {$_GET[im_id]}", $arr_update );
	}
	if ($_GET ['action'] == 'getArchive') {
		$fotos = mysql_query ( "SELECT * FROM {$tbl_im_ph} WHERE im_id = {$_GET['im_id']}" ) or die ( mysql_error () );
		$title_res = mysql_query ( "SELECT im_code FROM immovables WHERE im_id = {$_GET['im_id']}" );
		
		function build_array($src) {
			while ( $row = mysql_fetch_assoc ( $src ) ) {
				$array [] = $row;
			}
			return $array;
		}
		
		$title = mysql_fetch_array ( $title_res );
		$fotos_aray = build_array ( $fotos );
		
		$t = 'alfabrok-' . $title ['im_code'];
		
		$path = $images_root . "/files/images/immovables/";
		mkdir ( $t, 0777 );
		
		$i = 1;
		foreach ( $fotos_aray as $foto ) {
			$old = $path . $foto ['im_photo_id'] . '.' . $foto ['im_file_type'];
			$new = $t . '/' . $i . '.jpg';
			$i += 1;
			@copy ( $old, $new );
		}
		
		$zip = new ZipArchive ( );
		
		if ($zip->open ( $t . ".zip", ZipArchive::CREATE ) !== true) {
			die ( "Could not open archive" );
		}
		
		$iterator = new RecursiveDirectoryIterator ( $t );
		foreach ( $iterator as $key => $value ) {
			$path = pathinfo ( $value );
			if ($path ['basename'] == '.' || $path ['basename'] == '..')
				continue;
			
			$zip->addFile ( realpath ( $key ), $key );
		}
		
		$zip->close ();
		
		$filename = $t . '.zip';
		header ( 'Content-type: application/octet-stream' );
		header ( 'Content-Disposition: attachment; filename="' . $filename . '"' );
		readfile ( $filename );
		unlink ( $filename );
		fulldel_dir ( $t );
	}
	
	if ($_GET ['action'] == 'getWithoutMark') {
		$fotos = mysql_query ( "SELECT * FROM {$tbl_im_ph} WHERE im_id = {$_GET['im_id']}" ) or die ( mysql_error () );
		$title_res = mysql_query ( "SELECT im_code FROM immovables WHERE im_id = {$_GET['im_id']}" );
		
		function build_array($src) {
			while ( $row = mysql_fetch_assoc ( $src ) ) {
				$array [] = $row;
			}
			return $array;
		}
		
		$title = mysql_fetch_array ( $title_res );
		$fotos_aray = build_array ( $fotos );
		
		$t = 'alfabrok-' . $title ['im_code'];
		
		$path = $images_root . "/files/images/immovables/";
		mkdir ( $t, 0777 );
		
		$i = 1;
		foreach ( $fotos_aray as $foto ) {
			$old = $path . 'big_' . $foto ['im_photo_id'] . '.' . $foto ['im_file_type'];
			$new = $t . '/' . $i . '.jpg';
			$i += 1;
			@copy ( $old, $new );
		}
		
		$zip = new ZipArchive ( );
		
		if ($zip->open ( $t . ".zip", ZipArchive::CREATE ) !== true) {
			die ( "Could not open archive" );
		}
		
		$iterator = new RecursiveDirectoryIterator ( $t );
		foreach ( $iterator as $key => $value ) {
			$path = pathinfo ( $value );
			if ($path ['basename'] == '.' || $path ['basename'] == '..')
				continue;
			
			$zip->addFile ( realpath ( $key ), $key );
		}
		
		$zip->close ();
		
		$filename = $t . '.zip';
		header ( 'Content-type: application/octet-stream' );
		header ( 'Content-Disposition: attachment; filename="' . $filename . '"' );
		readfile ( $filename );
		unlink ( $filename );
		fulldel_dir ( $t );
	}
	
	exit ();
}


$json_converter = new Services_JSON ( );
$response = array ();
$response ['success'] = false;
$response ['fieldErrors'] = array ();

#настройки для копирования изображений 
$fileDir = $images_folder;
$fileVideoDir = '../../files/video/im/';
$ImgProp ['ImgW'] = 65;
$ImgProp ['ImgH'] = 65;
$ImgPropIndex ['ImgW'] = 190;
$ImgPropIndex ['ImgH'] = 190;
$ImgPropPR ['ImgW'] = 285;
$ImgPropPR ['ImgH'] = 285;
$ImgPropSt ['ImgW'] = 140;
$ImgPropSt ['ImgH'] = 140;
#преобразование флажков
$hide = "hide";
if ($_POST ['hide'])
	$hide = 'show';
$im_is_hot = ($_POST ["im_is_hot"] ? $_POST ["im_is_hot"] : "0");
$im_is_rent = ($_POST ["im_is_rent"] ? $_POST ["im_is_rent"] : "0");
$im_is_sale = ($_POST ["im_is_sale"] ? $_POST ["im_is_sale"] : "0");
$im_is_special = ($_POST ["im_is_special"] ? $_POST ["im_is_special"] : "0");

//echo "<pre>";
//print_r($_POST);
// echo "</pre>";
//echo "<pre>";
// print_r($_FILES);
// echo "</pre>";
//exit();


#	добавление недвижимости (стандартные характеристики)
if ($_POST ['retention'] == 'add_page') {
	$response ['success'] = false;
	
	$provider = new mysql_select ( $tbl_im );
	$ImDataOne = $provider->select_table_id ( "where im_code = '{$_POST['im_code']}'" );
	
	if($ImDataOne) {
		$response ['fieldErrors'] ['im_code'] = "Данный код уже используется, укажите другой!";
		header ( 'Content-type: text/plain' );
		echo $json_converter->encode ( $response );
		exit();
	}
	
	$_POST [im_prace_day] = ($_POST [im_prace_day] ? $_POST [im_prace_day] : 'NULL');
	$_POST [im_prace_manth] = ($_POST [im_prace_manth] ? $_POST [im_prace_manth] : 'NULL');
	$_POST [im_prace_sq] = ($_POST [im_prace_sq] ? $_POST [im_prace_sq] : 'NULL');
	$_POST ['im_prace_sq'] = intval ( $_POST ['im_prace'] / $_POST ['im_space'] );
	
	updateRegionDict ( $_POST [im_array_id] );
	updateRegionDict ( $_POST [im_region_id] );
	updateRegionDict ( $_POST [im_a_region_id] );
	updateRegionDict ( $_POST [im_city_id] );
	updateRegionDict ( $_POST [im_area_id] );
	updateRegionDict ( $_POST [im_adress_id] );
	
	$operatorId = ($_COOKIE ["type"] == "4f4b95785a8c4" ? $_COOKIE ["id_account"] : "NULL");
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
								 " . ($_POST ['im_prace'] ? $_POST ['im_prace'] : 'NULL') . ",
								 " . ($_POST ['im_prace'] ? $_POST ['im_prace'] : 'NULL') . ",
								 " . ($_POST ['im_prace_sq'] ? $_POST ['im_prace_sq'] : 'NULL') . ",
								 " . ($_POST ['im_prace_day'] ? $_POST ['im_prace_day'] : 'NULL') . ",
								 " . ($_POST ['im_prace_manth'] ? $_POST ['im_prace_manth'] : 'NULL') . ",
								 'imnoimage.png',
								 '{$_POST[im_space]}',
								 '{$_POST[im_space_value_id]}',
								 '{$_POST[im_sale_id]}',
								 '{$hide}',
								 '',
								 " . ($_POST ['pos'] ? $_POST ['pos'] : 'NULL') . ",
								 '{$_POST[susr_id]}',
								 $im_is_hot,
								 $im_is_sale,
								 $im_is_rent,
								 NOW(),
								 NULL,
								 '{$_POST[im_adress_flat]}',
								 '{$_POST[im_title]}',
								 '{$_POST[im_geopos]}',
								 NULL,
								 '{$_POST[im_code]}',
								 '{$_POST[user_tel]}',
								 '{$_POST[user_notes]}',
								 $im_is_special,
								 $operatorId);";
	if (! mysql_query ( $query ))
		throw new ExceptionMySQL ( mysql_error (), $query, "Ошибка при + каталога" );
	
	$provider = new mysql_select ( $tbl_im );
	$ImDataOne = $provider->select_table_id ( "where im_code = '{$_POST['im_code']}'" );
	$response ['callbackArgs'] ["newImId"] = $ImDataOne['im_id'];
	
	$response ['success'] = true;
	header ( 'Content-type: text/plain' );
	echo $json_converter->encode ( $response );
}

#	редактирование стандартных характеристик недвижимости
if ($_POST ['retention'] == 'edit_page') {
	$_POST [im_prace] = ($_POST [im_prace] ? $_POST [im_prace] : 'NULL');
	$_POST [im_prace_old] = ($_POST [im_prace_old] ? $_POST [im_prace_old] : 'NULL');
	$_POST [im_prace_day] = ($_POST [im_prace_day] ? $_POST [im_prace_day] : 'NULL');
	$_POST [im_prace_manth] = ($_POST [im_prace_manth] ? $_POST [im_prace_manth] : 'NULL');
	$_POST [im_prace_sq] = ($_POST [im_prace_sq] ? $_POST [im_prace_sq] : 'NULL');
	$_POST [pos] = ($_POST [pos] ? $_POST [pos] : 'NULL');
	$_POST ['im_prace_sq'] = intval ( $_POST ['im_prace'] / $_POST ['im_space'] );
	
	updateRegionDict ( $_POST [im_array_id] );
	updateRegionDict ( $_POST [im_region_id] );
	updateRegionDict ( $_POST [im_a_region_id] );
	updateRegionDict ( $_POST [im_city_id] );
	updateRegionDict ( $_POST [im_area_id] );
	updateRegionDict ( $_POST [im_adress_id] );
	
	$_POST [im_date_add] = class_date::GetMysqlDateView ( $_POST [im_date_add] );
	
	$arr_update = array ("susr_id" => $_POST [susr_id] . ",", "user_tel" => "'{$_POST[user_tel]}',", "user_notes" => "'{$_POST[user_notes]}',", "im_type_id" => "'{$_POST[im_type_id]}',", "im_array_id" => "'{$_POST[im_array_id]}',", "im_region_id" => "'{$_POST[im_region_id]}',", "im_a_region_id" => "'{$_POST[im_a_region_id]}',", "im_city_id" => "'{$_POST[im_city_id]}',", "im_area_id" => "'{$_POST[im_area_id]}',", "im_adress_id" => "'{$_POST[im_adress_id]}',", "im_adress_house" => "'{$_POST[im_adress_house]}',", "im_prace" => "{$_POST[im_prace]},", "im_prace_old" => "{$_POST[im_prace_old]},", "im_prace_sq" => "{$_POST[im_prace_sq]},", "im_prace_day" => "{$_POST[im_prace_day]},", "im_prace_manth" => "{$_POST[im_prace_manth]},", "im_space" => "'{$_POST[im_space]}',", "im_space_value_id" => "'{$_POST[im_space_value_id]}',", "im_sale_id" => "'{$_POST[im_sale_id]}',", "im_provider" => "'{$_POST[im_provider]}',", "pos" => "{$_POST[pos]},", "im_is_hot" => "{$im_is_hot},", "im_is_sale" => "{$im_is_sale},", "im_is_rent" => "{$im_is_rent},", "im_is_special" => "{$im_is_special},", "hide" => "'{$hide}',", "im_adress_flat" => "'{$_POST[im_adress_flat]}',", "im_title" => "'{$_POST[im_title]}',", "im_geopos" => "'{$_POST[im_geopos]}',", "im_code" => "'{$_POST[im_code]}',", "im_date_add" => "'{$_POST[im_date_add]}'" );
	
	$old_product_select = new mysql_select ( $tbl_im );
	$old_product = $old_product_select->select_table_id("WHERE im_id = {$_POST[im_id]}");
	
	/*echo "<pre>";
	print_r($old_product);
	echo "</pre>";*/
	
	if ($old_product[susr_id] != $_POST[susr_id])
	{
		$operatorId = $_COOKIE ["id_account"];
		$query = "INSERT INTO immovables_logs
						 VALUES ({$_POST[im_id]},
								 'susr_id',
								 '{$old_product[susr_id]}',
								 '{$_POST[susr_id]}',
								 '{$operatorId}',
								 now());";
		if (! mysql_query ( $query ))
			throw new ExceptionMySQL ( mysql_error (), $query, "Ошибка при + каталога" );
	} 
	

	$cl_page_update = new mysql_select ( $tbl_im );
	$cl_page_update->update_table ( "WHERE im_id = {$_POST[im_id]}", $arr_update );
	
	$response ['success'] = true;
	header ( 'Content-type: text/plain' );
	echo $json_converter->encode ( $response );
}

#
if ($_POST ['retention'] == 'edit_im_prop_info') {
	if ($_COOKIE ['lang_id'] == 1)
		$lang_f = 2;
	if ($_COOKIE ['lang_id'] == 2)
		$lang_f = 1;
		
	#
	function PostField($PostFieldValue) {
		$update = "";
		for($i = 0; $i < count ( $PostFieldValue ); $i ++) {
			if (! empty ( $PostFieldValue [$i] ))
				$update .= "{$PostFieldValue[$i]} ";
		}
		if (empty ( $update ))
			return;
		return substr ( $update, 0, strlen ( $update ) - 1 );
	}
	
	foreach ( $_POST as $key => $value ) {
		if ($key != 'im_id' and $key != 'retention' and $key != 'Clear') {
			$FieldTupe = substr ( substr ( $key, 0, 2 ), 0, 1 );
			$key = substr ( $key, 2, strlen ( $key ) );
			
			if (! empty ( $value )) {
				#
				if ($FieldTupe == 's') {
					$query = "INSERT INTO {$tbl_im_pi} (`im_prop_id`, `im_id`, `lang_id`, `im_prop_value`, `im_prop_value_dict_id`, `im_prop_value_dict_list`) VALUES
											('{$key}', '{$_POST[im_id]}', '{$_COOKIE[lang_id]}','', '" . mysql_escape_string ( $value ) . "', '')
											ON DUPLICATE KEY UPDATE im_prop_value_dict_id = '" . mysql_escape_string ( $value ) . "', im_prop_value='', im_prop_value_dict_list='';";
					if (! mysql_query ( $query ))
						throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT or UPDATE IM_PROP_INFO" );
					$query = "INSERT INTO {$tbl_im_pi} (`im_prop_id`, `im_id`, `lang_id`, `im_prop_value`, `im_prop_value_dict_id`, `im_prop_value_dict_list`) VALUES
											('{$key}', '{$_POST[im_id]}', '{$lang_f}','', '" . mysql_escape_string ( $value ) . "', '')
											ON DUPLICATE KEY UPDATE im_prop_value_dict_id = '" . mysql_escape_string ( $value ) . "', im_prop_value='', im_prop_value_dict_list='';";
					if (! mysql_query ( $query ))
						throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT or UPDATE IM_PROP_INFO" );
				}
				#
				if ($FieldTupe == 't') {
					$query = "INSERT INTO {$tbl_im_pi} (`im_prop_id`, `im_id`, `lang_id`, `im_prop_value`, `im_prop_value_dict_id`, `im_prop_value_dict_list`) VALUES
											('{$key}', '{$_POST[im_id]}', '{$_COOKIE[lang_id]}','" . mysql_escape_string ( $value ) . "', '', '')
											ON DUPLICATE KEY UPDATE im_prop_value = '" . mysql_escape_string ( $value ) . "', im_prop_value_dict_id='', im_prop_value_dict_list='';";
					if (! mysql_query ( $query ))
						throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT or UPDATE IM_PROP_INFO" );
					$query = "INSERT INTO {$tbl_im_pi} (`im_prop_id`, `im_id`, `lang_id`, `im_prop_value`, `im_prop_value_dict_id`, `im_prop_value_dict_list`) VALUES
											('{$key}', '{$_POST[im_id]}', '{$lang_f}','', '', '')
											ON DUPLICATE KEY UPDATE im_prop_value_dict_id='', im_prop_value_dict_list='';";
					if (! mysql_query ( $query ))
						throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT or UPDATE IM_PROP_INFO" );
				}
				#
				if ($FieldTupe == 'm') {
					$PostField = PostField ( $value );
					if (! empty ( $PostField )) {
						$query = "INSERT INTO {$tbl_im_pi} (`im_prop_id`, `im_id`, `lang_id`, `im_prop_value`, `im_prop_value_dict_id`, `im_prop_value_dict_list`) VALUES
															   ('{$key}', '{$_POST[im_id]}', '{$_COOKIE[lang_id]}','', '', '" . mysql_escape_string ( $PostField ) . "')
																ON DUPLICATE KEY UPDATE im_prop_value_dict_list = '" . mysql_escape_string ( $PostField ) . "', im_prop_value='', im_prop_value_dict_id='';";
						if (! mysql_query ( $query ))
							throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT or UPDATE IM_PROP_INFO" );
						$query = "INSERT INTO {$tbl_im_pi} (`im_prop_id`, `im_id`, `lang_id`, `im_prop_value`, `im_prop_value_dict_id`, `im_prop_value_dict_list`) VALUES
																('{$key}', '{$_POST[im_id]}', '{$lang_f}','', '', '" . mysql_escape_string ( $PostField ) . "')
																ON DUPLICATE KEY UPDATE im_prop_value_dict_list = '" . mysql_escape_string ( $PostField ) . "', im_prop_value='', im_prop_value_dict_id='';;";
						if (! mysql_query ( $query ))
							throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT or UPDATE IM_PROP_INFO" );
					}
				}
				#
				if ($FieldTupe == 'c') {
					$query = "INSERT INTO {$tbl_im_pi} (`im_prop_id`, `im_id`, `lang_id`, `im_prop_value`, `im_prop_value_dict_id`, `im_prop_value_dict_list`) VALUES
														   ('{$key}', '{$_POST[im_id]}', '{$_COOKIE[lang_id]}','" . mysql_escape_string ( $value ) . "', '', '')
															ON DUPLICATE KEY UPDATE im_prop_value = '" . mysql_escape_string ( $value ) . "', im_prop_value_dict_id='', im_prop_value_dict_list='';";
					if (! mysql_query ( $query ))
						throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT or UPDATE IM_PROP_INFO" );
					$query = "INSERT INTO {$tbl_im_pi} (`im_prop_id`, `im_id`, `lang_id`, `im_prop_value`, `im_prop_value_dict_id`, `im_prop_value_dict_list`) VALUES
															('{$key}', '{$_POST[im_id]}', '{$lang_f}','', '', '')
															ON DUPLICATE KEY UPDATE `lang_id`= VALUES(`lang_id`), im_prop_value_dict_id='', im_prop_value_dict_list='';;";
					if (! mysql_query ( $query ))
						throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT or UPDATE IM_PROP_INFO" );
				}
			}
		}
	}
	
	$response ['success'] = true;
	header ( 'Content-type: text/plain' );
	echo $json_converter->encode ( $response );
}

if ($_POST ['retention'] == 'add_img') {
	#
	$photoId = uniqid ();
	$extension = pathinfo ( $_FILES ['Filedata'] ['name'] );
	$extension = strtolower ( $extension ['extension'] );
	$fileName = strtolower ( $photoId . "." . $extension );
	if ($_FILES ['Filedata'])
		if (copy ( $_FILES ['Filedata'] ['tmp_name'], $fileDir . '' . $fileName )) {
			#Формируем малое изображение
			$resizeObj = new resize ( $fileDir . "" . $fileName );
			$resizeObj->resizeImage ( $ImgProp ['ImgW'], $ImgProp ['ImgH'], 'crop' );
			$resizeObj->saveImage ( $fileDir . 's_' . $fileName, 100 );
			$resizeObj->resizeImage ( $ImgPropIndex ['ImgW'], $ImgPropIndex ['ImgH'], 'crop' );
			$resizeObj->saveImage ( $fileDir . 'si_' . $fileName, 100 );
			$resizeObj->resizeImage ( $ImgPropSt ['ImgW'], $ImgPropSt ['ImgH'], 'crop' );
			$resizeObj->saveImage ( $fileDir . 'st_' . $fileName, 100 );
			$resizeObj->resizeImage ( $ImgPropPR ['ImgW'], true, 'auto' );
			$resizeObj->saveImage ( $fileDir . 'pr_' . $fileName, 100 );
			$resizeObj->resizeImage ( 800, 600, 'crop' );
			$resizeObj->saveImage ( $fileDir . 'big_' . $fileName, 100 );
			
			$ClUserIm = new mysql_select ( $tbl_im_ph );
			$active_id = $ClUserIm->select_table_id ( "WHERE im_id = {$_POST[im_id]} ORDER BY im_photo_order DESC LIMIT 1" );
			
			if(!$active_id) 
				$active_id["im_photo_order"] = 1;
			else 
				$active_id["im_photo_order"] = $active_id["im_photo_order"] + 1;
			#
			$query = "INSERT INTO {$tbl_im_ph} (`im_photo_id`, `im_photo_type`, `im_id`, `im_photo_order`, `im_file_type`) VALUES
													 	('{$photoId}', '{$_POST[im_photo_type]}', {$_POST[im_id]}, {$active_id["im_photo_order"]}, '{$extension}');";
			
			if (! mysql_query ( $query ))
				throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT IM PHOTO" );
			
			$file = fopen ( "file.txt", "r+" );
			$str = $query;
			if (! $file) {
				echo ("Ошибка открытия файла");
			} else {
				fputs ( $file, $str );
			}
			fclose ( $file );
			
			#наложение логотипа
			$ImageBigSize = @getimagesize ( $fileDir . $fileName );
			$ClassApplyignImage = new applying_image ( );
			$ClassApplyignImage->prepare_image ( $fileDir . "st_" . $fileName, $fileDir . "st_" . $fileName, "../../files/images/bg/imposition-140.png", $ImgPropSt ['ImgW'], $ImgPropSt ['ImgH'], 70, 70 );
			
			$ClassApplyignImage = new applying_image ( );
			$ClassApplyignImageVoid = $ClassApplyignImage->prepare_image ( $fileDir . $fileName, $fileDir . $fileName, "../../files/images/bg/alfabrok.logo.big.png", $ImageBigSize [0], $ImageBigSize [1], 180, 150 );
			$ClassApplyignImageVoid = $ClassApplyignImage->prepare_image ( $fileDir . $fileName, $fileDir . $fileName, "../../files/images/bg/logo_full_btm.png", $ImageBigSize [0], $ImageBigSize [1], $ImageBigSize [0] / 2 - $ImageBigSize [0] + 355, $ImageBigSize [1] / 2 - $ImageBigSize [1] + 40 );
			$ClassApplyignImage->prepare_image ( $fileDir . "si_" . $fileName, $fileDir . "si_" . $fileName, "../../files/images/bg/imposition-190.png", $ImgPropIndex ['ImgW'], $ImgPropIndex ['ImgH'], 95, 95 );
			if ($_POST ['im_photo_type'] == '4c5a97c04ffa1') {
				$ClassApplyignImage->prepare_image ( $fileDir . 's_' . $fileName, $fileDir . "s_" . $fileName, "../../files/images/bg/imposition-65.png", $ImgProp ['ImgW'], $ImgProp ['ImgH'], 32.5, 32.5 );
			}
		
		}
	exit ();
}

if ($_POST ['retention'] == 'ImIndexPhoto') {
	#выборка с БД
	$cl_photo_class = new mysql_select ( $tbl_im_ph );
	$ImPhotoFileType = $cl_photo_class->select_table_id ( "WHERE im_photo_id = '{$_POST[im_photo_id]}'" );
	#обновление записи недвиж.
	$arr_update = array ("im_photo" => "'{$_POST[im_photo_id]}.{$ImPhotoFileType[im_file_type]}'" );
	$cl_page_update = new mysql_select ( $tbl_im );
	$cl_page_update->update_table ( "WHERE im_id = {$_POST[im_id]}", $arr_update );
	$arr_update = array ("im_photo_type" => "'4c5a97c04ffa1'" );
	$cl_page_update = new mysql_select ( $tbl_im_ph );
	$cl_page_update->update_table ( "WHERE im_photo_id = '{$_POST[im_photo_id]}'", $arr_update );
	exit ();
}
if ($_POST ['retention'] == 'ImPlanPhoto') {
	$arr_update = array ("im_photo_type" => "'4c5a97cea179d'" );
	$cl_page_update = new mysql_select ( $tbl_im_ph );
	$cl_page_update->update_table ( "WHERE im_photo_id = '{$_POST[im_photo_id]}'", $arr_update );
	exit ();
}

if ($_POST ['retention'] == 'edit_summary') {
	$query = "INSERT INTO {$tbl_im_su} (`im_su_id`, `im_id`, `lang_id`, `im_su_text`) VALUES
											(" . ($_POST ['im_su_id'] ? $_POST ['im_su_id'] : 'NULL') . ", {$_POST[im_id]}, '{$_POST[lang_id]}','{$_POST[im_su_text]}')
											ON DUPLICATE KEY UPDATE im_su_text = '{$_POST[im_su_text]}';";
	if (! mysql_query ( $query ))
		throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT or UPDATE IM_SUMMARY" );
	$response ['success'] = true;
	header ( 'Content-type: text/plain' );
	echo $json_converter->encode ( $response );
}

if ($_POST ['retention'] == 'add_video') {
	#
	$VideoId = uniqid ();
	$extension = pathinfo ( $_FILES ['video'] ['name'] );
	$extension = strtolower ( $extension ['extension'] );
	$fileName = strtolower ( $VideoId . "." . $extension );
	
	if ($_FILES ['video'])
		if (copy ( $_FILES ['video'] ['tmp_name'], $fileVideoDir . '' . $fileName )) {
			#
			$query = "INSERT INTO {$tbl_im_vi} (`iv_id`, `im_id`, `iv_file_type`, `iv_date`, `hide`) VALUES
													 	('{$VideoId}', '{$_POST[im_id]}', '{$extension}', NOW(), 'show');";
			if (! mysql_query ( $query ))
				throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT IM VIDEO" );
		}
}

if ($_POST ['retention'] == 'add_task') {
	//print_r($_POST);
	if (! empty ( $_POST ['t_date_do'] )) {
		$CLDate = new class_date ( );
		$_POST ['t_date_do'] = $CLDate->GetMysqlDateView ( $_POST ['t_date_do'] );
		$_POST ['t_date_do'] = "'{$_POST['t_date_do']}'";
	}
	$_POST [t_date_do] = ($_POST [t_date_do] ? $_POST [t_date_do] : 'NULL');
	#
	$query = "INSERT INTO realtor_tasks VALUES
											  (NULL, NOW(), {$_POST[t_date_do]}, '{$_POST[readltor_do]}', '{$_POST[t_title]}', '{$_POST[t_text]}', '', {$_POST[im_id]}, 0);";
	if (! mysql_query ( $query ))
		throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT IM TASKS" );
	$response ['success'] = true;
	header ( 'Content-type: text/plain' );
	echo $json_converter->encode ( $response );
}

?>
