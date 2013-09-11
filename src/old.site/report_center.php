<?php
error_reporting ( E_ERROR );
#подключение к БД
require_once ("config/config.php");
#подключение классов
require_once DOC_ROOT . '/config/class.config.php';

require_once ("application/includes/mail/template.mail.text.php");
include_once 'application/includes/language/set.cookie.php';
require_once 'application/includes/module/template.module.php';
require_once 'application/module/immovables/f.immobles.php';
require_once 'class/rtf/Rtf.php';
require_once 'class/rtflite/PHPRtfLite.php';
require_once 'class/rtflite/PHPRtfLite/Font.php';
require_once 'class/rtflite/PHPRtfLite/Border.php';
$im_id = $_REQUEST ['im_id'];
$_COOKIE ['lang_id'] = $_COOKIE ['lang_id'];

$file_name = "../files/report/$fn.rtf";

if (file_exists ( $file_name )) {
	//header('Content-Type: image/png');
//readfile($file_name);
//return;		
}

function build_array($src) {
	while ( $row = mysql_fetch_assoc ( $src ) ) {
		$array [] = $row;
	}
	return $array;
}

/*
	 *	функция возвращает количество строк для таблицы с фотографиями недвижимости 
	 */
function GetCountRtfTableRows($table_image = NULL) {
	$count_img = count ( $table_image );
	$count_rows = intval ( $count_img / 3 ) + 1;
	for($i = 0; $i < $count_rows; $i ++) {
		$ret [] = 5;
	}
	return $ret;
}

function Generate($text) {
	global $ImDataOne;
	foreach ( $ImDataOne as $key => $value ) {
		$text = str_replace ( "#" . $key . "#", $value, $text );
	}
	return $text;
}
function PReplase($text) {
	$text = str_replace ( "<p>", "<br>", $text );
	$text = str_replace ( "</p>", "", $text );
	return $text;
}
function GetImFildsDictValue($data) {
	global $arWords;
	global $dictionaries;
	$AdrArr = array ('im_region_id' => 'FormSearchNameRegion', 'im_a_region_id' => 'FormSearchNameRRegion', 'im_city_id' => 'FormSearchNameCity', 'im_area_id' => 'FormSearchNameRCIty', 'im_array_id' => 'FormSearchNameACity', 'im_adress_id' => 'FormSearchNameAdress' );
	foreach ( $AdrArr as $key => $value ) {
		if (! empty ( $data [$key] )) {
			switch ($key) {
				case 'im_adress_id' :
					{
						$return .= "<b>{$arWords[$value]} - {$dictionaries->buld_table[$data[$key]][dict_name]}, {$data[im_adress_house]}</b><br>";
						break;
					}
				default :
					{
						$return .= "{$arWords[$value]} - {$dictionaries->buld_table[$data[$key]][dict_name]}<br>";
						break;
					}
			}
		}
	}
	return $return;
}
function GetImFildsValue($data) {
	global $arWords;
	$AdrArr = array ('im_prace_sq' => 'ImFListHeaderM2Sotku', 'im_prace_day' => 'FormSearchNamePriceDay', 'im_prace_manth' => 'FormSearchNamePriceManth', 'im_space' => 'FormSearchNameSqMS', '4c4069e4f04ec' => 'FormSearchNameSqYchastka' );
	foreach ( $AdrArr as $key => $value ) {
		if (! empty ( $data [$key] )) {
			switch ($key) {
				default :
					{
						$return .= "{$arWords[$value]} - {$data[$key]}<br>";
						break;
					}
			}
		}
	}
	return $return;
}

if (empty ( $im_id ) or empty ( $_COOKIE ['lang_id'] ))
	die ( "ERROR no im_id or lang_id" );
	
#объявляем класс словаря
$dictionaries = new dictionaries ( );
#формируем массив имени словарей
$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries );
#формируем массив значений словарей
$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = {$_COOKIE['lang_id']} ORDER BY dict_name" );
$ImPageContentClass = new ModuleSite ( $ModuleTemplate );
#выборка данных недвижимости	
$ImDataOneClass = new mysql_select ( $tbl_im );
$ImDataOne = $ImDataOneClass->select_table_id ( "WHERE im_id = {$_GET['im_id']}" );
$ImDataOne["im_prace"] = $ImDataOne ["im_prace"]*$_COOKIE['exchange_USD']; 
$ImDataOne["im_prace_old"] = $ImDataOne ["im_prace_old"]*$_COOKIE['exchange_USD']; 
$ImDataOne["im_prace_sq"] = $ImDataOne ["im_prace_sq"]*$_COOKIE['exchange_USD']; 
$ImDataOne["im_prace_sq"] = $ImDataOne ["im_prace_sq"]*$_COOKIE['exchange_USD'];
$ImDataOne["im_prace_day"] = $ImDataOne ["im_prace_day"]*$_COOKIE['exchange_USD']; 
$ImDataOne["im_prace_manth"] = $ImDataOne ["im_prace_manth"]*$_COOKIE['exchange_USD'];

$im_code = $ImDataOne ['im_code'];
#выборка характеристик недвижимости	
$ImPropListInfo = new mysql_select ( $tbl_im_pl, "l left join {$tbl_im_pi} i ON l.im_prop_id = i.im_prop_id WHERE l.lang_id = {$_COOKIE['lang_id']} AND i.lang_id = {$_COOKIE['lang_id']} AND l.catalog_id='{$ImDataOne['im_catalog_id']}' AND hide='show' AND i.im_id = {$_GET[im_id]}", "ORDER BY im_prop_name ASC" );
$ImPropListInfo->select_table ( "im_prop_id" );
#преобразование данных характеристик и значений
$ImPropData = new PropSort ( $ImPropListInfo->table );
$ImPropData->GetArrToPrint ( 'im_id', array ('is_print_list', 'is_print_ad', 'is_print_st' ) );
#для котеджей делаем (площаль участка в шапку оттображения)
if ($ImDataOne ['im_catalog_id'] == '4c3ec51d537c0') {
	$ImDataOne ['4c4069e4f04ec'] = $ImPropData->ImPropData ['is_print_ad'] [$_GET ['im_id']] ['4c4069e4f04ec'] ['im_prop_value'];
	unset ( $ImPropData->ImPropData ['is_print_ad'] [$_GET ['im_id']] ['4c4069e4f04ec'] );
}
$RetImFieldInfo = GetImFildsDictValue ( $ImDataOne );
$RetImFieldInfo .= GetImFildsValue ( $ImDataOne );

#выборка фотографий
$PhotoQueryClass = new mysql_select ( $tbl_im_ph, "f WHERE f.im_id = {$_GET['im_id']} ORDER BY im_photo_order DESC" );
$PhotoQueryClass->select_table ( "im_photo_id" );
#формирование характеристик едвижимости
$ClassPropPrint = new PropPrint ( $dictionaries );
$RetPropStandart = $ClassPropPrint->GetPrint ( $ImPropData->ImPropData ['is_print_st'] [$ImDataOne ['im_id']], 'GetTextWord' );
$RetPropAdvased = $ClassPropPrint->GetPrint ( $ImPropData->ImPropData ['is_print_ad'] [$ImDataOne ['im_id']], 'GetTextWord' );
#формирование описание недв.	
$ImSuQClass = new mysql_select ( $tbl_im_su );
$active_id = $ImSuQClass->select_table_id ( "WHERE lang_id = '4c5d58cd3898c' AND im_id = {$_GET[im_id]}" );
$SummaryIm ['im_su_text'] = $active_id ['im_su_text'];
$SummaryIm ['title'] = $ImDataOne ['title'];
$SummaryIm = $ImPageContentClass->For_HTML ( "<b>#title#</b>#im_su_text#", $SummaryIm );
$RetSummaryIm = PReplase ( $SummaryIm );

if ($_COOKIE ['lang_id'] == 1) {
	$res ["im_prace"] = "#im_prace_# грн.<br>";
	$res ["im_prace_manth"] = "#im_prace# грн.<br>";
	
	$res ["im_prace_old"] = "(#im_prace_old# грн.) - старая цена<br>";
	$res ['readmore'] = "подробнее..<br>";
	$res ['4c3ec3ec5e9b5'] = "Квартиры";
	$res ['4c3ec3ec5e9b7'] = "Коммерческая недвижимость";
	$res ['4c3ec51d537c0'] = "Коттеджи. Дома. Дачи";
	$res ['4c3ec51d537c2'] = "ОСЗ. Здания";
	$res ['4c3ec51d537c3'] = "Земельные участки";
	$res ['code'] = "Код: #im_code#";
	$res ['codeN'] = "Код:";
	$res ['rooms'] = "к.";
	$res ["realtor"] = "Имя: #fio#<br>E-mail: #login#<br>Тел.: #tel#";
} else if ($_COOKIE ['lang_id'] == 2) {
	$res ["doc_im_header_1"] = "Недвижимость от www.alfabrok.ua<br>";
	$res ["doc_im_header_2_price"] = "Цена: #im_price#$<br>";
	$res ['readmore'] = "подробнее..<br>";
}

$CodeValue = $ImPageContentClass->For_HTML ( $res ["code"], $ImDataOne, array () );
// обработка цен недвижимости
$ImPriceOld = "";
if ($ImDataOne ['im_is_sale'] == 1) {
	$ImPrice = $ImPageContentClass->For_HTML ( $res ["im_prace"], $ImDataOne, array () );
	if ($ImDataOne ['im_prace_old'] != $ImDataOne ['im_prace_old']) {
		$ImPriceOld = $ImPageContentClass->For_HTML ( $res ["im_prace_old"], $ImDataOne, array () );
	}
} else {
	$ImPrice = $ImPageContentClass->For_HTML ( $res ["im_prace_manth"], $ImDataOne, array () );
}

$RealtorData = "";
$ImDataOne ['susr_id'] = ($_COOKIE ['id_account'] ? $_COOKIE ['id_account'] : $ImDataOne ['susr_id']);
if ($ImDataOne ['susr_id']) {
	$SusrIDCl = new mysql_select ( $tbl_accounts );
	$RealtorData = $SusrIDCl->select_table_id ( "WHERE id_account	= {$ImDataOne['susr_id']}" );
	$RealtorData = $ImPageContentClass->For_HTML ( $res ["realtor"], $RealtorData );
}

/*
	 *	для имени документа добвление в название слов:
	 */
//		print_r($ImPropData);
//		echo "</pre>";


switch ($ImDataOne ['im_catalog_id']) {
	case '4c3ec3ec5e9b5' :
		{
			//   Количество комнат;
			$DonNameFile = $ImPropData->ImPropData ['is_print_st'] [$ImDataOne ['im_id']] ['4c400ed4e5797'] ['im_prop_value'] . $res ['rooms'];
			break;
		}
	case '4c3ec3ec5e9b7' :
		{
			//'4c4050b294c4f' Количество комнат ;
			$DonNameFile = $ImPropData->ImPropData ['is_print_st'] [$ImDataOne ['im_id']] ['4c4050b294c4f'] ['im_prop_value'] . $res ['rooms'];
			break;
		}
	case '4c3ec51d537c0' :
		{
			//'4c402f345c83d' Количество комнат ;
			$DonNameFile = $ImPropData->ImPropData ['is_print_st'] [$ImDataOne ['im_id']] ['4c402f345c83d'] ['im_prop_value'] . $res ['rooms'];
			break;
		}
	case '4c3ec51d537c2' :
		{
			//'4c40586e48e5f' Количество комнат ;
			$DonNameFile = $ImPropData->ImPropData ['is_print_st'] [$ImDataOne ['im_id']] ['4c40586e48e5f'] ['im_prop_value'] . $res ['rooms'];
			break;
		}
	case '4c3ec51d537c3' :
		{
			//4c4057205e1d3  Целевое назначение ;
			$DonNameFile = $ImPropData->ImPropData ['is_print_ad'] [$ImDataOne ['im_id']] ['4c4057205e1d3'] ['im_prop_value'];
			break;
		}
	default :
		break;
}

//имя документа
$fn = str_replace ( " ", "", $res [$ImDataOne ['im_catalog_id']] . "." . $res ['codeN'] . $im_code . "." . $dictionaries->buld_table [$ImDataOne ['im_city_id']] ['dict_name'] . "." . $dictionaries->buld_table [$ImDataOne ['im_adress_id']] ['dict_name'] . $DonNameFile . "" . $ImDataOne ['im_space'] . $dictionaries->buld_table [$ImDataOne ['im_space_value_id']] ['dict_name'] . "." . $ImDataOne ['im_prace'] . "y.e" );

//echo $fn;
//exit();


if (($_GET ['act'] == 'word') || ($_GET ['action'] == 'set_friend_im')) {
	$rowCount = 3;
	$rowHeight = 3;
	$columnCount = 3;
	$columnWidth = 5;
	$font_small = new PHPRtfLite_Font ( 9, 'Arial' );
	$font_common = new PHPRtfLite_Font ( 10, 'Arial' );
	$red = new PHPRtfLite_Font ( 13, 'Arial', '#cc0000' );
	
	PHPRtfLite::registerAutoloader ();
	$rtf = new PHPRtfLite ( );
	$sect = $rtf->addSection ();
	
	$table = $sect->addTable ();
	$table->addRows ( $rowCount, $rowHeight );
	$table->addColumnsList ( array_fill ( 0, $columnCount, $columnWidth ) );
	for($rowIndex = 1; $rowIndex <= $rowCount; $rowIndex ++) {
		for($columnIndex = 1; $columnIndex <= $columnCount; $columnIndex ++) {
			$cell = $table->getCell ( $rowIndex, $columnIndex );
			//$cell->writeText("Cell $rowIndex:$columnIndex"); //Промаркировать колонки для отладки!!!!!!!!!!!!!!!!!!!!!!
			$cell->setTextAlignment ( PHPRtfLite_Table_Cell::TEXT_ALIGN_JUSTIFY );
			$cell->setVerticalAlignment ( PHPRtfLite_Table_Cell::VERTICAL_ALIGN_CENTER );
		}
	}
	$border = PHPRtfLite_Border::create ( $rtf, 1, '#FFF' );
	$table->setBorderForCellRange ( $border, 2, 1, 3, 3 );
	$table->mergeCellRange ( 3, 1, 3, 3 );
	$cell = $table->getCell ( 1, 1 );
	$cell->writeText ( $CodeValue . "<br><br>" . $ImPrice );
	$cell->setPaddingLeft ( 1 );
	$cell->setFont ( $red );
	$cell = $table->getCell ( 1, 2 );
	$cell->addImage ( 'files/images/bg/alfabrok.logo.png', null );
	$cell = $table->getCell ( 1, 3 );
	$cell->writeText ( $RealtorData );
	$cell->setFont ( $font_common );
	$cell->setPaddingLeft ( 1 );
	$cell = $table->getCell ( 2, 1 );
	$cell->addImage ( 'files/images/immovables/si_' . $ImDataOne ['im_photo'] );
	$cell = $table->getCell ( 2, 2 );
	$cell->writeText ( $RetPropAdvased, $font_small );
	$cell = $table->getCell ( 2, 3 );
	$cell->writeText ( $RetPropStandart, $font_common );
	$cell->setPaddingLeft ( 1 );
	$cell = $table->getCell ( 3, 1 );
	$cell->writeText ( strip_tags ( $RetSummaryIm ) );
	
	if ($PhotoQueryClass->table) {
		$rowCount = 3;
		$rowHeight = 3;
		$columnCount = 3;
		$columnWidth = 5;
		
		$foto_count = count ( $PhotoQueryClass->table );
		$rows_count = ceil ( $foto_count );
		$table2 = $sect->addTable ();
		
		$table2->addRows ( $rows_count, ceil ( ($foto_count - 6) / 15 ) );
		$table2->addColumnsList ( array_fill ( 0, $columnCount, $columnWidth ) );
		$curent_foto = 0;
		$white_border = PHPRtfLite_Border::create ( $rtf, 0, '#FFFFFF' );
		for($rowIndex = 1; $rowIndex <= $rows_count; $rowIndex ++) {
			for($columnIndex = 1; $columnIndex <= $columnCount; $columnIndex ++) {
				if ($curent_foto < $foto_count) {
					$ImgName = $PhotoQueryClass->table [$curent_foto] ['im_photo_id'] . "." . $PhotoQueryClass->table [$curent_foto] ['im_file_type'];
					$cell = $table2->getCell ( $rowIndex, $columnIndex );
					$cell->addImage ( 'files/images/immovables/si_' . $ImgName );
					$cell->setBorder ( $white_border );
					$curent_foto = $curent_foto + 1;
				}
			}
		}
	}
	
	if ($_GET ['act'] == 'word') {
		$rtf->save ( 'files/images/rft.rtf' );
		header ( 'Content-type: application/octet-stream' );
		header ( 'Content-Disposition: attachment; filename="' . $fn . '.rtf"' );
		readfile ( "files/images/rft.rtf" );
		unlink ( "files/images/rft.rtf" );
	} else {
		//unlink ( 'files/bufer/word/' . $ImDataOne ["im_code"] . '.rtf' );
		$rtf->save ( 'files/bufer/word/' . $ImDataOne ["im_code"] . '.rtf' );
	}
}

if ($_GET ['action'] == 'set_friend_im') {
	require_once ("application/includes/mail/template.mail.text.php");
	
	$ModArray ['kode'] = $CodeValue;
	$ModArray ['realtor'] = $RealtorData;
	$ModArray ['im_photo'] = $ImDataOne ['im_photo'];
	$ModArray ['im_adress_table'] = $RetImFieldInfo;
	$ModArray ['im_price_table'] = $ImPrice;
	$ModArray ['summary'] = $RetSummaryIm;
	$ModArray ['im_prop_standart'] = $RetPropStandart;
	$ModArray ['im_prop_advaced'] = $RetPropAdvased;
	
	#формирование плана	
	$ModArray ['img'] = "";
	$PhotoQueryClass = new mysql_select ( $tbl_im_ph );
	$ImOneConPlan = $PhotoQueryClass->select_table_id ( "f WHERE f.im_id = {$_GET['im_id']} AND f.im_photo_type = '4c5a97cea179d'" );
	if (isset ( $ImOneConPlan ))
		$ModArray ['img'] = $ImPageContentClass->For_HTML ( $ModuleTemplate ['im_foto_mail_list'], $ImOneConPlan );
	
	$ReturnHtmlPage = $ImPageContentClass->For_HTML ( $mail_template ["friend_mail"], $_GET );
	$ReturnHtmlPage .= $ImPageContentClass->For_HTML ( $ModuleTemplate ['table_one_immovable_mail_block'], $ModArray );
	
	$fotos = mysql_query ( "SELECT * FROM {$tbl_im_ph} WHERE im_id = {$_GET['im_id']} order by im_photo_order limit 15" ) or die ( mysql_error () );
	$fotos_aray = build_array ( $fotos );
	
	$mail = new PHPMailer ( );
	$mail->From = "{$EmailAdmin}"; // от кого
	$mail->CharSet = 'utf-8';
	$mail->FromName = $EmailAdminMame; // от кого
	$mail->AddAddress ( $_GET ['email'] ); // кому - адрес, Имя
	$mail->IsHTML ( true ); // выставляем формат письма HTML
	$mail->Subject = $EmailTitle ['send_im_for_friend']; // тема письма 
	$mail->Body = $ReturnHtmlPage;
	$mail->AddAttachment ( "files/bufer/word/" . $ImDataOne ["im_code"] . ".rtf" );
	if ($ImDataOne ['im_photo']) {
		$mail->AddAttachment ( "files/images/immovables/si_" . $ImDataOne ['im_photo'] );
	}
	if (count ( $fotos_aray ) > 0) {
		foreach ( $fotos_aray as $foto ) {
			$mail->AddAttachment ( "files/images/immovables/si_" . $foto ['im_photo_id'] . '.' . $foto ['im_file_type'] );
		}
	}
	$mail->AddAttachment ( "files/images/bg/alfabrok.jpg" );
	// отправляем наше письмо
	if (! $mail->Send ())
		die ( 'Mailer Error: ' . $mail->ErrorInfo );
	$response ['success'] = true;
}

//версия для печати
if ($_GET ['act'] == 'print') {
	$ModArray ['kode'] = $CodeValue;
	$ModArray ['realtor'] = $RealtorData;
	$ModArray ['im_photo'] = $ImDataOne ['im_photo'];
	$ModArray ['im_adress_table'] = $RetImFieldInfo;
	$ModArray ['im_price_table'] = $ImPrice;
	$ModArray ['summary'] = $RetSummaryIm;
	$ModArray ['im_prop_standart'] = $RetPropStandart;
	$ModArray ['im_prop_advaced'] = $RetPropAdvased;
	$ModArray ['img'] = "";
	if ($PhotoQueryClass->table) {
		$ModArray ['img'] = $ImPageContentClass->Handler_Template_Html ( 'im_foto_print_list', $PhotoQueryClass->table );
	}
	$ReturnHtmlPage = $ImPageContentClass->For_HTML ( $ModuleTemplate ['table_one_immovable_print_block'], $ModArray );
	echo $ModuleTemplate ['HTML_header'];
	echo $ModuleTemplate ['HTML_print'];
	echo $ReturnHtmlPage;
	echo $ModuleTemplate ['HTML_bottom'];
}
?>


