<?php
/**
 * Error reporting
 */
error_reporting ( E_ALL | E_STRICT );
//define ( 'SLASH', '/' );
//define ( 'DOC_ROOT', $_SERVER ['DOCUMENT_ROOT'] );

#	функция формирует списов возможный родителей, справочник меню
function sel_parent_id($arr, $sel = 'NULL', $name_id = 'pc_id', $echo_id = 'menu_words') {
	$str = NULL;
	for($i = 0; $i < count ( $arr ); $i ++) {
		$selecteOption = NULL;
		if ($sel)
			if ($sel == $arr [$i] [$name_id])
				$selecteOption = "selected=\"selected\"";
		$str .= "<option {$selecteOption} value=\"{$arr[$i][$name_id]}\">{$arr[$i][$echo_id]}</option>";
	}
	return $str;
}

include_once '../config/config.php';
include DOC_ROOT . '/config/class.config.php';
include_once DOC_ROOT . '/dmn/utils/language/set.cookie.php';
include_once DOC_ROOT . '/dmn/utils/dmn.models.php';
include DOC_ROOT . '/application/module/providers.php';

$json_converter = new Services_JSON ( );
$response = array ();
$response ['success'] = false;

$_REQUEST = array_merge ( $_GET, $_POST );

//print_R($_COOKIE);

//print_r($_REQUEST);
if (isset ( $_REQUEST ["zone"] )) {
	if ($_REQUEST ["zone"] == "dmn") {
		$class = new $_REQUEST ["cont"] ( );
		$result = $class->$_REQUEST ["action"] ( $_REQUEST );
		if (isset ( $_REQUEST ["dataType"] )) {
			switch ($_REQUEST ["dataType"]) {
				case "html" :
					echo $result;
					break;
				case "json" :
					{
						$response = $result;
						header ( 'Content-type: text/plain' );
						echo $json_converter->encode ( $response );
						break;
					}
				default :
					{
						$response = $result;
						header ( 'Content-type: text/plain' );
						echo $json_converter->encode ( $response );
						break;
					}
			}
		}
		return;
	}
}
$response = $result;
header ( 'Content-type: text/plain' );
echo $json_converter->encode ( $response );

//echo "<pre>";
//print_r($_GET);
//echo "</pre>";