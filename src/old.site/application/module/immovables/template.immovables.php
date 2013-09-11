<?php
require_once DOC_ROOT . '/application/includes/immovables/setting.im.print.inc';

#выборка характеристик недвижимости	
$ImPropListInfo = new mysql_select ( $tbl_im_pl, "l left join {$tbl_im_pi} i ON l.im_prop_id = i.im_prop_id WHERE l.lang_id = {$_COOKIE['lang_id']} {$WPListInfo} AND i.lang_id = {$_COOKIE['lang_id']} AND l.catalog_id='{$ImCatArr[$_GET[1]]}' AND hide='show'", "ORDER BY im_prop_name ASC" );
$ImPropListInfo->select_table ( "im_prop_id" );

	
if (empty ( $_GET ['im_id'] ) && empty($_GET["im_code"])) {
	#класс обработчик заполнених полей формы поиска
	$SQForm = new ImSiteForm ( $_GET, 'ImFormSearchArray', 'SearchImCode', $dictionaries, $ImPropListInfo->buld_table );
	#формирование строки запроса
	$SQForm->StandartImQuery = $WhereQuery = " WHERE i.hide = 'show' AND i.im_catalog_id = '{$ImCatArr[$_GET[1]]}'" . $WIMTypeCat;
	$SQForm->StandartImQuery;
	#	
	if (strpos ( $_SERVER ['REQUEST_URI'], '?' )) {
		$ImFormSearchArray = substr ( $_SERVER ['REQUEST_URI'], strpos ( $_SERVER ['REQUEST_URI'], '?' ) + 1, strlen ( $_SERVER ['REQUEST_URI'] ) );
	}
	
	if (! empty ( $ImFormSearchArray )) {
		#при существование в куки данных по форме формируем запрос для выборки с $tbl_im_pl и $tbl_im	
		$CookieData = $SQForm->StringToArray ( $ImFormSearchArray );
		//getStatistictics("CookieData", $CookieData);
		$WhereQuery .= $SQForm->PostGetParser ( $CookieData );
		
		#данные модуль формирует город для тайтла, также текст по региональной принадлежности
		$RegDictList = $SQForm->getProtectedField ( 'RegDict' );
		$ImRegionText = NUL;
		if ($ImRegionText = getImRegionText ( $RegDictList )) {
			$title_web = $dictionaries->buld_table [$ImRegionText ['reg_id']] ['dict_name'] . "-" . $title_web;
			$description_web = $dictionaries->buld_table [$ImRegionText ['reg_id']] ['dict_name'] . "-" . $description_web;
		}
	}
	
	$WhereImmovableQuery = "i {$WhereQuery}";
	$WhereImmovableOrder = "ORDER BY i.{$_COOKIE[im_where_sort]} {$_COOKIE['im_where_sort_order']}";
	#сортировка таблицы если выбрано Спальных комнат
	if ($_COOKIE [im_where_sort] == 'im_val_room') {
		$WhereImmovableOrder = "";
	}
	
	if ($ImFormSearchArray)
		$ImFormSearchArray = '?' . htmlspecialchars ( urldecode ( $ImFormSearchArray ? $ImFormSearchArray : "" ) );
		#выборка недвижимоти
	$obj = new pager_mysql_right ( $tbl_im, $WhereImmovableQuery, $WhereImmovableOrder, $_COOKIE ['im_f_show_pnumber'], // Число позиций на странице
"5", // Число ссылок в постраничной навигации
"/$_GET[1]/$_GET[type_cat]", // Объявляем объект постраничной навигации
$ImFormSearchArray );
	$ImData = $obj->get_page ();
	
	if (empty ( $ImData )) {
		$ImPageContentArr ['error_text'] = $arWords ['cp_no_position_code'];
		$ImPageContentClass = new ModuleSite ( $ModuleTemplate );
		$ImPagesContent .= $ImPageContentClass->For_HTML ( $ModuleTemplate ['error_page'], $ImPageContentArr );
		return;
	}
	
	#преобразование данных характеристик и значений
	$ImPropData = new PropSort ( $ImPropListInfo->table );
	$ImPropData->GetArrToPrint ( 'im_id', array ('is_print_list', 'is_print_ad', 'is_print_st' ) );
	
	
	#формирование списка недвижимости
	$ModImPropP = new ModuleSiteIm ( $ModuleTemplate, $arWords, $dictionaries, $ImPropData->ImPropData, $ImPropData->ImPropArrData );
	$ImPagesContent = "<div class=\"DivPaging TopDivPaging\">" . $obj . "</div>";
	$ImPagesContent .= $ModImPropP->Handler_Template_Html ( $_GET [1] . '_' . $_GET ['type_cat'] . '_' . $_COOKIE ['im_f_show_style'] . '_block', $ImData, $TemplateImList [$_GET [1]] [$_GET ['type_cat']] );
	$ImPagesContent .= "<div class=\"DivPaging\">" . $obj . "</div>";
	$ImPagesContent .= $ImRegionText ['f_text'];
} else {
	//4c4069e4f04ec
	#
	$dictionaries->do_dictionaries ( 67 );
	$im_lang_arr = $dictionaries->my_dct;
	
	#выборка данных недвижимости	
	$ImDataOneClass = new mysql_select ( $tbl_im );
	if (empty($_GET['im_code']))
	{
		$ImDataOne = $ImDataOneClass->select_table_id ( "WHERE im_id = {$_GET['im_id']}" );
	}
	else
	{
		$ImDataOne = $ImDataOneClass->select_table_id ( "WHERE im_code = '{$_GET['im_code']}'" );
		$_GET["im_id"] = $ImDataOne["im_id"];
	}
	
	#выборка характеристик недвижимости	
	$ImPropListInfo = new mysql_select ( $tbl_im_pl, "l left join {$tbl_im_pi} i ON l.im_prop_id = i.im_prop_id WHERE l.lang_id = {$_COOKIE['lang_id']} {$WPListInfo} AND i.lang_id = {$_COOKIE['lang_id']} AND l.catalog_id='{$ImCatArr[$_GET[1]]}' AND hide='show' AND i.im_id = {$_GET[im_id]}", "ORDER BY im_prop_name ASC" );
	$ImPropListInfo->select_table ( "im_prop_id" );
	
	#преобразование данных характеристик и значений
	$ImPropData = new PropSort ( $ImPropListInfo->table );
	$ImPropData->GetArrToPrint ( 'im_id', array ('is_print_list', 'is_print_ad', 'is_print_st' ) );
	
	#для котеджей делаем (площаль участка в шапку оттображения)
	if ($_GET ['1'] == 'home') {
		$ImDataOne ['4c4069e4f04ec'] = $ImPropData->ImPropData ['is_print_ad'] [$_GET ['im_id']] ['4c4069e4f04ec'] ['im_prop_value'];
		unset ( $ImPropData->ImPropData ['is_print_ad'] [$_GET ['im_id']] ['4c4069e4f04ec'] );
	}
	
	$ImPageContentClass = new ModuleSite ( $ModuleTemplate );
	#формирование фотогалереи
	$ImOneConArray ['ImOneConPhotos'] = "";
	$PhotoQueryClass = new mysql_select ( $tbl_im_ph );
	$PhotoQueryClass->select_table_query("SELECT p.*, CONCAT(p.im_photo_id, '.', p.im_file_type) as im_photo_name, i.im_photo as im_main_photo FROM `immovables_photos` p
											left join immovables i on p.im_id = i.im_id
											WHERE p.im_id = {$_GET['im_id']} AND p.im_photo_type = '4c5a97c04ffa1' 
											ORDER BY p.im_photo_order", "im_photo_id");
	
	//$PhotoQueryClass = new mysql_select ( $tbl_im_ph, "f WHERE f.im_id = {$_GET['im_id']} AND f.im_photo_type = '4c5a97c04ffa1' order by f.im_photo_order" );
	//left join {$tbl_im_ph_label} l ON l.im_photo_id = l.im_photo_id
	//$PhotoQueryClass->select_table ( "im_photo_id" );
	
	//убераем 1 лишнию фотку
	if ($PhotoQueryClass->table) {
		$res = array();
		foreach($PhotoQueryClass->table as $key => $value) {
			if($value["im_photo_name"] != $value["im_main_photo"])
				$res[count($res)] = $value;
		}
		$PhotoQueryClass->table = $res;
		$ImOneConArray ['ImOneConPhotos'] = $ImPageContentClass->Handler_Template_Html ( 'table_fotogalery_immovable_block', $PhotoQueryClass->table );
	}
	#формирование описание недв.	
	$ImOneConArray ['DivSummaryLang'] = PrintLangSummary ( $im_lang_arr, $_GET ['im_id'] );
	$ImOneConArray ['DivSummaryLang'] .= "<script type=\"text/javascript\">$(document).ready(function(){SetImLang('4c5d58cd3898c', {$_GET[im_id]});});</script>";
	#формирование плана	
	$ImOneConArray ['ImOneConPlan'] = "";
	$PhotoQueryClass->select_table_query ( "select f.* from {$tbl_im_ph} f WHERE f.im_id = {$_GET['im_id']} AND f.im_photo_type = '4c5a97cea179d'" );
	if (isset ( $PhotoQueryClass->table )) {
		$Plans = $ImPageContentClass->Handler_Template_Html ( "im_view_plan_block_pos", $PhotoQueryClass->table );
		$ImOneConArray ['ImOneConPlan'] = $ImPageContentClass->For_HTML ( $ModuleTemplate ['im_view_plan_block'], array ('plans' => $Plans ) );
	}
	#формирование карты	
	$ImOneConArray ['ImOneConMap'] = "";
	#класс построения страницы недвижимости	
	$ModImPropP = new ModuleSiteIm ( $ModuleTemplate, $arWords, $dictionaries, $ImPropData->ImPropData, $ImPropData->ImPropArrData );
	$ImOneConArray ['ImOneConMap'] = $ModImPropP->BuildHTML ( $ImDataOne, $ModuleTemplate ['im_view_map_block'], $TemplateImOneData ['im_Data_map'] );
	#формирование видео	
	$ImOneConArray ['ImOneConVideo'] = "";
	$VideoQueryClass = new mysql_select ( $tbl_im_vi );
	$ImOneCoVideo = $VideoQueryClass->select_table_id ( "v WHERE v.im_id = {$_GET['im_id']}" );
	if (isset ( $ImOneCoVideo ))
		$ImOneConArray ['ImOneConVideo'] = $ImPageContentClass->For_HTML ( $ModuleTemplate ['im_view_video_block'], $ImOneCoVideo );
		#формирование данных недвижимости и характеристик недвижимости	 	
	$ImPagesContent = $ModImPropP->BuildHTML ( $ImDataOne, $ModuleTemplate ['table_one_immovable_block'] [$_GET ['type_cat']], $TemplateImOneData ['im_Data'] );
	
	$title_web = $keywords_web = $description_web = $res [$ImDataOne ['im_catalog_id']] . ", " . $res ['codeN'] . $ImDataOne ['im_code'] . ", " . $dictionaries->buld_table [$ImDataOne ['im_city_id']] ['dict_name'] . ", " . $dictionaries->buld_table [$ImDataOne ['im_adress_id']] ['dict_name'] . ", " . $ImDataOne ['im_space'] . " " . $dictionaries->buld_table [$ImDataOne ['im_space_value_id']] ['dict_name'] . ", " . $ImDataOne ['im_prace'] . " y.e";
	
	#сборка всей страницы	
	$ImPagesContent = $ImPageContentClass->For_HTML ( $ImPagesContent, $ImOneConArray );
	
	/****************************************************
	 * похожая недвижимость
	 *****************************************************/
	
	#выборка характеристик недвижимости	
	$ImPropListInfo = new mysql_select ( $tbl_im_pl, "l left join {$tbl_im_pi} i ON l.im_prop_id = i.im_prop_id WHERE l.lang_id = {$_COOKIE['lang_id']} {$WPListInfo} AND i.lang_id = {$_COOKIE['lang_id']} AND l.catalog_id='{$ImCatArr[$_GET[1]]}' AND type_prop='advanced' AND hide='show'", "ORDER BY im_prop_name ASC" );
	$ImPropListInfo->select_table ( "im_prop_id" );
	
	#преобразование данных характеристик и значений
	$ImPropData = new PropSort ( $ImPropListInfo->table );
	$ImPropData->GetArrToPrint ( 'im_id', array ('is_print_list', 'is_print_ad', 'is_print_st' ) );
	
	$IsListSimilar = false;
	$HTML = GetSimilarIm ( "WHERE hide='show' AND im_catalog_id='{$ImCatArr[$_GET[1]]}' AND im_area_id='{$ImDataOne[im_area_id]}' AND im_id != {$ImDataOne[im_id]} {$WIMTypeSimCat} ORDER BY im_date_add LIMIT 10 ", $dictionaries, $ImPropData, $ModuleTemplate, $TemplateImList, $ModuleTemplate ['im_similar'], 'im_similar_arr' );
	$HTML = GetSimilarIm ( "WHERE hide='show' AND im_catalog_id='{$ImCatArr[$_GET[1]]}' AND im_adress_id='{$ImDataOne[im_adress_id]}'  AND im_id != {$ImDataOne[im_id]}  {$WIMTypeSimCat} ORDER BY im_date_add LIMIT 10 ", $dictionaries, $ImPropData, $ModuleTemplate, $TemplateImList, $HTML, 'im_similar_str' );
	$HTML = GetSimilarIm ( "WHERE hide='show' AND im_catalog_id='{$ImCatArr[$_GET[1]]}' AND im_space<" . $ImDataOne [im_space] * 1.25 . " AND im_space>" . $ImDataOne [im_space] * 0.75 . "  {$WIMTypeSimCat} AND im_id != {$ImDataOne[im_id]}  ORDER BY im_date_add LIMIT 10 ", $dictionaries, $ImPropData, $ModuleTemplate, $TemplateImList, $HTML, 'im_similar_spa' );
	$HTML = GetSimilarIm ( "WHERE hide='show' AND im_catalog_id='{$ImCatArr[$_GET[1]]}' AND im_prace<" . $ImDataOne [im_prace] * 1.25 . " AND im_prace>" . $ImDataOne [im_prace] * 0.75 . " {$WIMTypeSimCat} AND im_id != {$ImDataOne[im_id]}  ORDER BY im_date_add LIMIT 10 ", $dictionaries, $ImPropData, $ModuleTemplate, $TemplateImList, $HTML, 'im_similar_pri' );
	//$HTML = GetSimilarIm ("WHERE hide='show' AND im_catalog_id='{$ImCatArr[$_GET[1]]}' AND im_prace_sq='{$ImDataOne[im_prace_sq]}'  AND im_id != {$ImDataOne[im_id]}  ORDER BY im_date_add LIMIT 10 ", $dictionaries, $ImPropData, $ModuleTemplate, $TemplateImList, $HTML, 'im_similar_pri_sq');
	

	if ($IsListSimilar) {
		$ImPagesContent .= $HTML;
	}
	
	#
	$query = "INSERT INTO immovables_stat (`im_id`, `wiev_count`) VALUES
												  ({$_GET['im_id']}, 1)
												  ON DUPLICATE KEY UPDATE wiev_count = wiev_count + 1;";
	if (! mysql_query ( $query ))
		throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT or UPDATE immovables_stat" );
}

//echo "<pre>";
//print_r($ImPropData->ImPropArrData);
//echo "</pre>";
?>