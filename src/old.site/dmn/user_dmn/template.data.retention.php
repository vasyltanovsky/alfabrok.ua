<?php
// 
require_once ("../../config/config.php");
//
require_once ("../utils/security_mod.php");
//
require_once DOC_ROOT . '/config/class.config.php';


$json_converter = new Services_JSON ();
$response = array ();
$response ['success'] = false;
$response ['fieldErrors'] = array ();

$fileDir = '../../files/images/realtor/';
$hide = "hide";
if ($_POST ['hide'])
	$hide = 'show';
$IsShowIndex = 0;
if ($_POST ['is_show_index'])
	$IsShowIndex = 1;
	
//$_POST[news_summary] = addslashes($_POST[news_summary]);
//$_POST[news_description] = addslashes($_POST[news_description]);


#	
if ($_POST ['retention'] == 'edit_page') {
	$rool = "";
	
	foreach ( $_POST as $key => $value ) {
		if ((substr ( $key, 0, 1 ) == "4") || (substr ( $key, 0, 1 ) == "5"))
			$rool .= $value . ",";
	}
	
	if (! empty ( $_POST ['password_old'] ) or ! empty ( $_POST ['password'] ) or ! empty ( $_POST ['repassword'] )) {
		#проверка вверность старого пароля
		$UI = new mysql_select ( 'system_accounts' );
		$CheckUI = $UI->select_table_id ( "WHERE password = '" . md5 ( $_POST [password_old] ) . "' AND id_account='{$_POST[id_account]}'" );
		if (empty ( $CheckUI ))
			$response ['fieldErrors'] ['password_old'] = "Вы ввели не верный пароль!";
			
		#проверка на пароли
		if (empty ( $_POST ['password'] ))
			$response ['fieldErrors'] ['password'] = "Укажите новый пароль!";
		if ($_POST ['password'] != $_POST ['repassword'])
			$response ['fieldErrors'] ['repassword'] = "Указаны не одинаковые пароли!";
		
		if (empty ( $response ['fieldErrors'] )) {
			$arr_update = array ("rool" => "'{$_POST[rool]}',", "login" => "'{$_POST[login]}',", "fio" => "'{$_POST[fio]}',", "tel" => "'{$_POST[tel]}',", "rool" => "'{$rool}',", "type" => "'{$_POST[type]}',", "password" => "'" . md5 ( $_POST [password] ) . "'," , "ip" => "'" . $_POST [ip] . "'" );
			$cl_page_update = new mysql_select ( 'system_accounts' );
			$cl_page_update->update_table ( "WHERE id_account = '{$_POST[id_account]}'", $arr_update );
			
			$response ['success'] = true;
		}
		
		header ( 'Content-type: text/plain' );
		echo $json_converter->encode ( $response );
		exit ();
	}
	
	#проверка на существования пользователя с таким логином
	$UI = new mysql_select ( 'system_accounts' );
	$CheckUI = $UI->select_table_id ( "WHERE login = '{$_POST[login]}' AND id_account != {$_POST[id_account]}" );
	if (! empty ( $CheckUI ))
		$response ['fieldErrors'] ['login'] = "Указаный логин уже зарегестрирован! Введите другой!";
		
	#	
	if (empty ( $response ['fieldErrors'] )) {
		#
		$arr_update = array ("login" => "'{$_POST[login]}',", "fio" => "'{$_POST[fio]}',", "rool" => "'{$rool}',", "type" => "'{$_POST[type]}',", "tel" => "'{$_POST[tel]}'," , "ip" => "'{$_POST[ip]}'" );
		#	
		$cl_page_update = new mysql_select ( 'system_accounts' );
		$cl_page_update->update_table ( "WHERE id_account = '{$_POST[id_account]}'", $arr_update );
		
		$response ['success'] = true;
	}
	
	header ( 'Content-type: text/plain' );
	echo $json_converter->encode ( $response );
}

#	add  PAGE
if ($_POST ['retention'] == 'add_page') {
	
	#проверка на существования пользователя с таким логином
	$UI = new mysql_select ( 'system_accounts' );
	$CheckUI = $UI->select_table_id ( "WHERE login = '{$_POST[login]}'" );
	if (! empty ( $CheckUI ))
		$response ['fieldErrors'] ['login'] = "Указаный логин уже зарегестрирован! Введите другой!";
		
	#проверка на пароли
	if ($_POST ['password'] != $_POST ['repassword'])
		$response ['fieldErrors'] ['repassword'] = "Указаны не одинаковые пароли!";
		
	#	
	if (empty ( $response ['fieldErrors'] )) {
		$query = "INSERT INTO system_accounts
								 VALUES (NULL,
										 '{$_POST[login]}',
										 '" . md5 ( $_POST [password] ) . "',
										 '{$_POST[tel]}',
										 'show',
										 NULL,
										 NOW(),
										 '{$_POST[type]}',
										 '',
										 NULL,
										 '{$_POST[fio]}',
										 '{$_POST[ip]}');";
		
		if (! mysql_query ( $query ))
			throw new ExceptionMySQL ( mysql_error (), $query, "Error add user" );
		$response ['success'] = "true";
	}
	
	header ( 'Content-type: text/plain' );
	echo $json_converter->encode ( $response );
}

if ($_POST ['retention'] == 'add_img') {
	$extension = pathinfo ( $_FILES ['images'] ['name'] );
	$extension = $extension ['extension'];
	$fileName = uniqid () . "." . $extension;
	if ($_FILES ['images'])
		if (copy ( $_FILES ['images'] ['tmp_name'], $fileDir . $fileName )) {
			// Формируем малое изображение
			// *** 1) Initialise / load image
			//$resizeObj = new resize($fileDir."".$fileName);
			// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
			//$resizeObj -> resizeImage($ImgProp['ImgW'], $ImgProp['ImgH'], 'crop');
			// *** 3) Save image
			//$resizeObj -> saveImage($fileDir.$fileName, 100);
			$arr_update = array ("photo" => "'{$fileName}'" );
			$cl_page_update = new mysql_select ( 'system_accounts' );
			$cl_page_update->update_table ( "WHERE id_account = {$_POST[id_account]}", $arr_update );
		}
}
?>
