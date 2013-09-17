<?php
//константы
define ( 'SLASH', '/' );
define ( 'DOC_ROOT', $_SERVER ['DOCUMENT_ROOT'] );
define ( 'DEBUG', 1 );
session_start ();
/*
//защита POST, GET
include DOC_ROOT . '/application/module/security.php';
//поключение конфига
include DOC_ROOT . '/config/config.php';
if (empty ( $_SERVER ['DOCUMENT_ROOT'] ))
	$_SERVER ['DOCUMENT_ROOT'] = 'D:/apache/localhost/www';

//подключение классов
include DOC_ROOT . '/config/class.config.php';
include DOC_ROOT . '/dmn/utils/functions/f.encodestring.php';

//подключение обработчика версии языка
include_once DOC_ROOT . '/application/module/languages/set.cookie.php';
include DOC_ROOT . '/application/controls/controls.php';
include DOC_ROOT . '/application/includes/templates/temps.inc';
include DOC_ROOT . '/application/module/modules.php';
//подключение провайдеров
include DOC_ROOT . '/application/module/providers.php';
*/
include DOC_ROOT . '/config/class.inc'; //подключение классов
include DOC_ROOT . '/config/config.php'; //поключение конфига
//echo "<pre>";
//print_r ( $_POST );
//echo "</pre>";
//////
//echo "<pre>";
//print_r ( $_GET );
//echo "</pre>";

$json_converter = new jsonClass();
$response = array ();
$response ['success'] = false;

$_REQUEST = array_merge ( $_GET, $_POST );
print_r($_REQUEST);
if (isset ( $_REQUEST ["zone"] )) {
	if ($_REQUEST ["zone"] == "site") {
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
	
	$response = $result;
	header ( 'Content-type: text/plain' );
	echo $json_converter->encode ( $response );
}

exit ();
//обработка обращений POST
if (! empty ( $_POST )) {
	//обьявляем класс JSON	
	$json_converter = new Services_JSON ( );
	$response = array ();
	$response ['success'] = false;
	$response ['fieldErrors'] = array ();
	if (! empty ( $_POST ['iQapTcha'] )) {
		$response ['fieldErrors'] ['iQapTcha'] = $arWords ['QapTcha_TXT_ERROR'];
		header ( 'Content-type: text/plain' );
		echo $json_converter->encode ( $response );
		exit ();
	}
}

//обработка обращений GET
if (! empty ( $_GET )) {
	//формирование корзины на страницах
	if ($_GET ['act'] == 'getShopsForArea') {
		//
		$dictionaries = new dictionaries ( );
		$dictionaries->buid_dictionaries_list ( $tbl ['list_dict'] ['name'] );
		$dictionaries->buid_dictionaries ( $tbl ['dict'] ['name'], "WHERE lang_id = {$_COOKIE['lang_id']} ORDER BY dict_code ASC" );
		$return ['dict_name'] = $dictionaries->buld_table [$_GET ['ar_id']] ['dict_name'];
		//выборка данных
		$ShopsData = new mysql_select ( );
		$ShopsData->select_table_query ( "select c.*, ci.ct_photo_id, ci.ct_photo_file_type, ci.is_main from {$tbl['catalog']['name']}  c
										 left join {$tbl['ct_photos']['name']} ci on ci.ct_id = c.ct_id and ci.is_main = 1
										 WHERE c.lang_id = {$_COOKIE['lang_id']} and c.dict_id = '4d3c422be8b29' and c.ct_array = '{$_GET['ar_id']}' ORDER BY c.{$tbl['catalog']['order']}", "ct_id" );
		
		$ModSite = new ModuleSite ( $temp );
		if (! empty ( $ShopsData->table )) {
			$html = $temp ['Shops_header'];
			for($i = 0; $i < count ( $ShopsData->table ); $i ++) {
				//получаем бренды данного магазина
				//выборка данных
				$BrandData = new mysql_select ( );
				$BrandData->select_table_query ( "select bs.*, c.*, ci.ct_photo_id, ci.ct_photo_file_type from {$tbl['brands_shops']['name']} bs
												  left join {$tbl['catalog']['name']} c on bs.brand_id = c.ct_id
												  left join {$tbl['ct_photos']['name']} ci on c.ct_id = ci.ct_id and ci.is_main = 1
												  where bs.shop_id = '{$ShopsData->table [$i] ['ct_id']}' and c.hide = 1 and c.dict_id = '4d3c421816e39' order by c.{$tbl['catalog']['order']}", "ct_id" );
				if (! empty ( $BrandData->table )) {
					//обработка данных (вставка в шаблон)
					$ModSite = new ModuleSite ( $temp );
					$ShopsData->table [$i] ['brands'] = $ModSite->Handler_Template_Html ( 'BrandsShops', $BrandData->table, $propArr );
				} else
					$ShopsData->table [$i] ['brands'] = NULL;
					//обработка данных (вставка в шаблон)
				$html .= $ModSite->For_HTML_Propertis ( $temp ['Shops'], $ShopsData->table [$i], array ('ct_photo_id' => array ('ct_photo_id', 'isset_shop_img' ), 'ct_url' => array ('ct_url', 'isset_shop_url' ) ) );
			}
			$html .= $temp ['Shops_bottom'];
			//ответ
			$return ['list_shops'] = $html;
		} else
			$return ['list_shops'] = $temp ['AreaShopListNoPos'];
		
		echo $ModSite->For_HTML ( $temp ['AreaShopList'], $return );
		exit ();
	}
}

Header ( "Location: 404.html" );

?>