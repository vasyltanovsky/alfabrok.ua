<?php
require_once ("application/includes/mail/template.mail.text.php");
require_once 'application/includes/language/set.cookie.php';
//require_once 'application/includes/immovables/setting.im.print.inc';
require_once 'application/includes/module/template.module.php';

require_once 'application/module/immovables/f.immobles.php';
require_once 'application/includes/map_city/area.coords.php';
require_once 'function.map.inc';

if ($PG_ARRAY ['retention'] == 'get_index_ca_map') {
	#объявляем класс словаря
	$dictionaries = new dictionaries ();
	#формируем массив имени словарей
	$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries );
	#формируем массив значений словарей
	$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = {$_COOKIE['lang_id']} ORDER BY dict_name" );
	
	#айди город(сл)
	$dictionaries->do_dictionaries ( 12 );
	$BuildDictResult [12] = $dictionaries->my_dct;
	#айди район города(сл)
	$dictionaries->do_dictionaries ( 13 );
	$BuildDictResult [13] = $dictionaries->my_dct;
	#айди Массив района(сл)
	$dictionaries->do_dictionaries ( 15 );
	$BuildDictResult [15] = $dictionaries->my_dct;
	
	$ReturnContentArr ['SearchMapTitle'] = $arWords ['SearchImmovablesMap'];
	$ReturnContentArr ['RentSale'] = $arWords ['MapFormSaleRent'];
	$ReturnContentArr ['TypeIm'] = $arWords ['MapFormTypeIm'];
	$ReturnContentArr ['City'] = FormSelectCity ( $BuildDictResult [12] );
	$ReturnContentArr ['maps'] = BuildMapCityArea ( $BuildDictResult, $dictionaries, $AreaCoords );
	$ModuleSite = new ModuleSite ( $ModuleTemplate, $arWords );
	$ReturnContent = $ModuleSite->For_HTML ( $ModuleTemplate ['template_table_index_page_map'], $ReturnContentArr );
	
	echo $ReturnContent;
	return;
}

if ($PG_ARRAY ['retention'] == 'get_im_ca_map') {
	#объявляем класс словаря
	$dictionaries = new dictionaries ();
	#формируем массив имени словарей
	$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries );
	#формируем массив значений словарей
	$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = {$_COOKIE['lang_id']} ORDER BY dict_name" );
	
	#айди город(сл)
	$dictionaries->do_dictionaries ( 12 );
	$BuildDictResult [12] = $dictionaries->my_dct;
	#айди район города(сл)
	$dictionaries->do_dictionaries ( 13 );
	$BuildDictResult [13] = $dictionaries->my_dct;
	#айди Массив района(сл)
	$dictionaries->do_dictionaries ( 15 );
	$BuildDictResult [15] = $dictionaries->my_dct;
	
	$ReturnContentArr ['City'] = FormSelectCity ( $BuildDictResult [12] );
	$ReturnContentArr ['maps'] = BuildMapCityArea ( $BuildDictResult, $dictionaries, $AreaCoords );
	$ModuleSite = new ModuleSite ( $ModuleTemplate, $arWords );
	$ReturnContent = $ModuleSite->For_HTML ( $ModuleTemplate ['template_table_im_page_map'], $ReturnContentArr );
	
	echo $ReturnContent;
}
?>