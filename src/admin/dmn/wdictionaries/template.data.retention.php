<?php

require_once ("../../config/config.php");
require_once DOC_ROOT . '/config/class.config.php';
require_once ("../utils/security_mod.php");
require_once '../utils/functions/f.encodestring.php';

$json_converter = new Services_JSON ( );
$response = array ();
$response ['success'] = false;
$response ['fieldErrors'] = array ();

$fileDir = '../../files/images/dict/';
$ImgProp ['ImgW'] = 44;
$ImgProp ['ImgH'] = 44;

#	 PAGE
if ($_POST ['retention'] == 'edit_page') {
	#	
	$arr_update = array ("ld_code" => "'{$_POST[ld_code]}',", "ld_name" => "'{$_POST[ld_name]}',", "ld_descr" => "'{$_POST[ld_descr]}',", "ld_parent" => "'{$_POST[ld_parent]}'" );
	
	#	
	$cl_page_update = new mysql_select ( $tbl_list_dictionaries );
	$cl_page_update->update_table ( "WHERE ld_id = '{$_POST[ld_id]}'", $arr_update );
	
	$response ['success'] = true;
	header ( 'Content-type: text/plain' );
	echo $json_converter->encode ( $response );
}

#	add PAGE
if ($_POST ['retention'] == 'add_page') {
	$_POST ['ld_code'] = mysql_real_escape_string ( $_POST ['ld_code'] ? $_POST ['ld_code'] : substr ( translit ( $_POST [ld_name] ), 0, 12 ) );
	$query = "INSERT INTO $tbl_list_dictionaries
						 VALUES (NULL,
								 '{$_POST[ld_code]}',
								 '{$_POST[ld_name]}',
								 '{$_POST[ld_descr]}',
								 '{$_POST[ld_parent]}');";
	if (! mysql_query ( $query ))
		throw new ExceptionMySQL ( mysql_error (), $query, "ERROR" );
	
	$response ['success'] = "testststst";
	header ( 'Content-type: text/plain' );
	echo $json_converter->encode ( $response );
}

if ($_POST ['retention'] == 'edit_position_page') {
	$_POST ['hide'] = ($_POST ['hide'] ? $_POST ['hide'] : 0);
	#	
	$arr_update = array ("ld_id" => "'{$_POST[ld_id]}',", "dict_code" => "'{$_POST[dict_code]}',", "dict_name" => "'{$_POST[dict_name]}',", "parent_id" => "'{$_POST[parent_id]}',", "hide" => "{$_POST[hide]}" );
	
	#	
	$cl_page_update = new mysql_select ( $tbl_dictionaries );
	$cl_page_update->update_table ( "WHERE dict_id = '{$_POST[dict_id]}' AND lang_id = {$_COOKIE[lang_id]}", $arr_update );
	
	$response ['success'] = true;
	header ( 'Content-type: text/plain' );
	echo $json_converter->encode ( $response );

}

if ($_POST ['retention'] == 'add_position_page') {
	//$_POST['dict_code'] = mysql_escape_string($_POST['dict_code'] ? $_POST['dict_code']: substr(translit($_POST[dict_name]), 0, 11));
	$_POST ['dict_code'] = ($_POST ['dict_code'] ? $_POST ['dict_code'] : NULL);
	$_POST ['dict_id'] = ($_POST ['dict_id'] ? $_POST ['dict_id'] : uniqid ());
	$_POST ['hide'] = ($_POST ['hide'] ? $_POST ['hide'] : 0);
	if ($_COOKIE ['lang_id'] == 1) {
		$lang_f = 2;
		$lang_t = 3;
	}
	if ($_COOKIE ['lang_id'] == 2) {
		$lang_f = 1;
		$lang_t = 3;
	}
	
	$query = "INSERT INTO $tbl_dictionaries
						 VALUES ('{$_POST[dict_id]}',
								 '{$_POST[ld_id]}',
								 '{$_COOKIE[lang_id]}',
								 '{$_POST[dict_code]}',
								 '{$_POST[dict_name]}',
								 '{$_POST[parent_id]}',
								 0,
								 {$_POST['hide']}),
								 
								 ('{$_POST[dict_id]}',
								 '{$_POST[ld_id]}',
								 '{$lang_f}',
								 '{$_POST[dict_code]}',
								 '{$_POST[dict_name]}',
								 '{$_POST[parent_id]}',
								 0,
								 {$_POST['hide']});";
	
	if (! mysql_query ( $query ))
		throw new ExceptionMySQL ( mysql_error (), $query, "ERROR" );
	
	$response ['success'] = "testststst";
	header ( 'Content-type: text/plain' );
	echo $json_converter->encode ( $response );
}

if ($_POST ['retention'] == 'add_img') {
	$extension = pathinfo ( $_FILES ['images'] ['name'] );
	$extension = $extension ['extension'];
	$fileName = strtolower ( $_POST ['dict_id'] . "." . $extension );
	
	if ($extension != 'png')
		return "ERROR!! NO PNG";
	if ($_FILES ['images'])
		if (copy ( $_FILES ['images'] ['tmp_name'], $fileDir . '' . $fileName )) {
			if (isset ( $_POST ['IsResize'] )) {
				// *** 1) Initialise / load image
				$resizeObj = new resize ( $fileDir . "" . $fileName );
				// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObj->resizeImage ( $ImgProp ['ImgW'], $ImgProp ['ImgH'], 'crop' );
				// *** 3) Save image
				$resizeObj->saveImage ( $fileDir . '' . $fileName, 100 );
			}
			
			$arr_update = array ("dict_have_image" => "1" );
			$cl_page_update = new mysql_select ( $tbl_dictionaries );
			$cl_page_update->update_table ( "WHERE dict_id = '{$_POST[dict_id]}'", $arr_update );
			//echo "OK";
		}
}

if (isset ( $_GET )) {
	//для jquery autocomplete json
	if ($_GET ['retention'] == 'GetJsonDicts') {
		$query = "";
		if ($_GET ['ld_id'])
			$query = "and ld_id = '{$_GET['ld_id']}'";
		$cl_sel_position = new mysql_select ( $tbl_dictionaries, "WHERE lang_id = $_COOKIE[lang_id] and dict_name like '%{$_GET['term']}%'", "ORDER BY dict_name ASC" );
		$cl_sel_position->select_table_query ( "select dict_id as id, dict_name as value, dict_name as label from {$tbl_dictionaries} where lang_id = $_COOKIE[lang_id] {$query} and dict_name like '%{$_GET['term']}%' ORDER BY dict_name asc", "id" );
		$response = $cl_sel_position->table;
		header ( 'Content-type: text/plain' );
		echo $json_converter->encode ( $response );
	}
	
//http //alfabrok.loc/dmn/wdictionaries/template.data.retention.php?retention=GetJsonDicts&ld_id=&term=ghbdt
//$response ['success']
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
