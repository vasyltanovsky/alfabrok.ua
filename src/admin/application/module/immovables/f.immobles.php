<?php
/* Функция: 
    * @param 
    * @param 
    * @return 
    */
function IsCookieCheck($CookieId, $CookieValue) {
	if ($_COOKIE [$CookieId] == $CookieValue)
		return "checked=\"checked\"";
	else
		return;
}
/* Функция: 
    * @param 
    * @param 
    * @return 
    */
function PrintLangSummary($arr_lang, $im_id) {
	for($i = 0; $i < count ( $arr_lang ); $i ++) {
		$ret .= "<a id=\"{$arr_lang[$i][dict_id]}\" href=\"javascript:SetImLang('{$arr_lang[$i][dict_id]}', $im_id);\" alt=\"{$arr_lang[$i]['dict_name']}\" title=\"{$arr_lang[$i]['dict_name']}\">{$arr_lang[$i]['dict_name']}</a>";
	}
	return $ret;
}
/* Функция: 
    * @param 
    * @param 
    * @return 
    */
function IsActiveLinkMenu($link_id) {
	if ($link_id == $_GET [1])
		return "AlinkActive";
	else
		return "AlinkNoActive";
}

/* Функция: 
    * @param 
    * @param 
    * @return 
    */
function getImRegionText($dict_arr) {
	global $tbl_im_text;
	global $ModuleTemplate;
	
	if (! is_array ( $dict_arr ))
		return;
	foreach ( $dict_arr as $key => $value ) {
		$dict_id = $value;
	}
	
	$ret ['reg_id'] = $dict_id;
	
	$it = new mysql_select ( $tbl_im_text );
	$irtext = $it->select_table_id ( "where dict_id = '{$dict_id}' and lang_id = {$_COOKIE['lang_id']}" );
	
	if (! empty ( $irtext )) {
		$m = new ModuleSite ( $ModuleTemplate );
		$ret ['f_text'] = $m->For_HTML ( $ModuleTemplate ['im_footer_text'], $irtext );
	}
	return $ret;
}

/* Функция: 
    * @param 
    * @param 
    * @return 
    */
function getImToYMapJS($imData, $ImPropData) {
	global $arWords;
	global $ModuleTemplate;
	global $dictionaries;
	global $TemplateImList;
	//	echo "<pre>";
	//	print_r($ImPropData->ImPropData['is_print_ad']);
	//	echo "</pre>";	
	//$returnArray = NULL;
	$ret = "";
	for($i = 0; $i < count ( $imData->table ); $i ++) {
		$imPos = $imData->table [$i];
		
		$ModImPropP = new ModuleSiteIm ( $ModuleTemplate, $arWords, $dictionaries, $ImPropData->ImPropData, $ImPropData->ImPropArrData );
		if ($imPos ['im_is_sale'])
			$imPos ['tempSale'] = str_replace ( '"', '\"', $ModImPropP->BuildHTML ( $imPos, $ModuleTemplate ['ymaps'] [$imPos ['im_catalog_id']] ['sale'], $TemplateImList [$imPos ['im_catalog_id']] ['sale'] ) );
		if ($imPos ['im_is_rent'])
			$imPos ['tempRent'] = str_replace ( '"', '\"', $ModImPropP->BuildHTML ( $imPos, $ModuleTemplate ['ymaps'] [$imPos ['im_catalog_id']] ['rent'], $TemplateImList [$imPos ['im_catalog_id']] ['rent'] ) );
			//$imPos ['tempSale'] = $imPos ['tempRent'] = 1;
		

		/*	*/
		$ret .= "imData[{$i}]=new Array();";
		foreach ( $imPos as $key => $value ) {
			if (! is_numeric ( $key )) {
				if ($key != 'im_title')
					//$value = substr ( stripslashes ( $value ), 0, 100 ) . "...";
					$ret .= "imData[{$i}]['{$key}']=\"{$value}\";";
			}
		}
		
		//квартиры
		//записываем количество комнат для квартиры	
		if (isset ( $ImPropData->ImPropData ['is_print_ad'] [$imData->table [$i] ['im_id']] ['4c400ed4e5797'] ))
			$ret .= "imData[{$i}]['im_room']=\"{$ImPropData->ImPropData['is_print_ad'][$imData->table [$i]['im_id']]['4c400ed4e5797']['im_prop_value']}\";";
		
	/*	*/
	//$returnArray [$i] = $imPos;
	}
	
	return $ret;
	$ret = "";
	for($i = 0; $i < count ( $data ); $i ++) {
		$ret .= "imData[{$i}]=new Array();";
		foreach ( $data [$i] as $key => $value ) {
			if (! is_numeric ( $key )) {
				if ($key == 'im_title')
					$value = substr ( stripslashes ( $value ), 0, 100 ) . "...";
				$ret .= "imData[{$i}]['{$key}']=\"{$value}\";";
			}
		}
		//определение аренда или продажа
		if ($data [$i] ['im_is_sale'])
			$ret .= "imData[{$i}]['saleRent']=\"sale\";";
		else
			$ret .= "imData[{$i}]['saleRent']=\"rent\";";
	}
	return $ret;
}

function sorterImLink($data, $template) {
	$array = array ('flatsale' => null, 'flatrent' => null, 'commercialsale' => null, 'commercialrent' => null, 'homesale' => null, 'homerent' => null, 'buildingssale' => null, 'buildingsrent' => null, 'landsale' => null );
	if (empty ( $data ))
		return;
	for($i = 0; $i < count ( $data ); $i ++) {
		//echo ModuleSite::For_HTML($data[$i], $template);
		$array [$data [$i] ['type_im'] . $data [$i] ['type_rs']] .= ModuleSite::For_HTML ( $template, $data [$i] );
	}
	return $array;
}

function getStatistictics($title, $param) {
	if (isset ( $_GET ["statistic"] )) {
		echo "<div style=\"margin:10px; border:1px solid red;\"><h4>{$title}</h4>";
		echo "<pre>";
		print_r ( $param );
		echo "</pre>";
	}
	return;
}
if (($_GET ['type_cat'] == 'sale') || !isset($_GET ['type_cat'])) {
	$WPListInfo = " AND l.is_prop_sale = 1 ";
	$WIMTypeCat = ' AND i.im_is_sale = 1 ';
	$WIMTypeSimCat = ' AND im_is_sale = 1 ';
}
if ($_GET ['type_cat'] == 'rent') {
	$WPListInfo = " AND l.is_prop_rent = 1 ";
	$WIMTypeCat = ' AND i.im_is_rent = 1 ';
	$WIMTypeSimCat = ' AND im_is_rent = 1 ';
}

function GetSimilarIm($query, $dictionaries, $ImPropData, $ModuleList, $TemplateList, $Html, $HtmlId) {
	global $tbl_im;
	global $arWords;
	global $IsListSimilar;
	
	$ImQueryClass = new mysql_select ( $tbl_im, $query );
	$ImQueryClass->select_table ( "im_id" );
	$ImData = $ImQueryClass->table;
	
	if (empty ( $ImData )) {
		$HtmlArr = array ($HtmlId => '', $HtmlId . '_h' => '' );
		$ClModuleHtml = new ModuleSite ( $ModuleList );
		$Html = $ClModuleHtml->For_HTML ( $Html, $HtmlArr );
	} else {
		$IsListSimilar = true;
		//echo $_GET[1].'_'.$_GET['type_cat'].'_'.$_COOKIE['im_f_show_style'].'_no_sort_block<br>';
		$HtmlArr [$HtmlId . '_h'] = $arWords [$HtmlId . '_h'];
		$ModImPropP = new ModuleSiteIm ( $ModuleList, $arWords, $dictionaries, $ImPropData->ImPropData, $ImPropData->ImPropArrData );
		$ImDataList [$HtmlId] = $ModImPropP->Handler_Template_Html ( $_GET [1] . '_' . $_GET ['type_cat'] . '_' . $_COOKIE ['im_f_show_style'] . '_no_sort_block', $ImData, $TemplateList [$_GET [1]] [$_GET ['type_cat']] );
		
		$ClModuleHtml = new ModuleSite ( $ModuleList );
		$HtmlArr [$HtmlId] = $ClModuleHtml->For_HTML ( $ModuleList [$HtmlId], $ImDataList );
		$Html = $ClModuleHtml->For_HTML ( $Html, $HtmlArr );
	}
	
	return $Html;
}
?>