<?php
#	задаем айди значение справочника новостей
$dictionaries->do_dictionaries ( 19 );
#	my_list_dct - сам словарь
$cartype_lst = $dictionaries->my_list_dct;
#	перечень значение словаря новостей
$new_dct_arr = $dictionaries->my_dct;
#	родитель, ребенок формирование массива
$new_dct_value = $dictionaries->BuildArrayParentChild ( $new_dct_arr );

#	
$PrintCatalog = new CatalogHadler ( $new_dct_arr, $dictionaries->buld_table, 'dict_name', 'dict_id', 'parent_id', '/production' );
$PrintCatalog->get_arr_formation ( true );
$Formation ['catalog_navigation'] = $PrintCatalog->get_string_navigation ( 'dict', $_GET ['pr_id'] );
$title_web = $PrintCatalog->get_meta ( 'dict', 'dict_name' );
$keywords_web = $PrintCatalog->get_meta ( 'dict', 'dict_code' );
$Formation ['catalog_title'] = $PrintCatalog->get_title ( 'dict' );
$CPquery = $PrintCatalog->get_select ( 'dict' );
$Formation ['catalog_menu'] = "<ul id=\"navigation\">{$PrintCatalog->get_tree_view_menu(NULL, 0, true)}</ul>";

/* Функция: 
    * @param 
    * @return 
    */
function print_list_catalog_position($guery) {
	global $tbl_cp;
	global $ModuleTemplate;
	global $arWords;
	
	if (empty ( $guery ))
		return;
	$CPSelect = new pager_mysql_right ( $tbl_cp, "WHERE cat_id IN ({$guery}) AND lang_id={$_COOKIE[lang_id]}", "ORDER BY cp_date_add DESC", 10, 10, "/" . $_GET ['dict'] );
	$Data = $CPSelect->get_page ();
	
	if (empty ( $Data ))
		return $arWords ['cp_no_position'];
	$CPList = new ModuleSite ( $ModuleTemplate );
	
	$StyleList = style_list ();
	$Return = $CPList->Handler_Template_Html ( $StyleList, $Data, array ('cp_image' => array ('cp_image', 'isset_img' ), 'cp_description' => array ('cp_description', 'isset_description' ) ) );
	
	$Return .= "<div class=\"clear\"></div><span class=\"DivPaging\">{$CPSelect}</span>";
	return $Return;
}

/* Функция: 
    * @param 
    * @return 
    */
function style_list($arr = array("cp_list_no_img_block","cp_list_block")) {
	global $tbl_cs;
	$cl_cat_style = new mysql_select ( $tbl_cs );
	$Data = $cl_cat_style->select_table_id ( "WHERE cs_cat_id = '{$_GET['dict']}'" );
	if ($Data ['cs_dict_id'] == "4c2483d1f21e6")
		return $arr [0];
	else
		return $arr [1];
}

/* Функция: 
    * @param 
    * @return 
    */
function print_list_default_cp() {
	global $tbl_cp;
	global $ModuleTemplate;
	global $arWords;
	
	$CPSelect = new pager_mysql_right ( $tbl_cp, "WHERE dict_id = '4c205b2072d5c' AND lang_id={$_COOKIE[lang_id]}", "ORDER BY cp_date_add DESC", 100, 100, "" );
	$Data = $CPSelect->get_page ();
	
	if (empty ( $Data ))
		return $arWords ['cp_no_position'];
	$CPList = new ModuleSite ( $ModuleTemplate );
	$Return = $CPList->Handler_Template_Html ( 'cp_list_block', $Data, array ('cp_image' => array ('cp_image', 'isset_img' ) ) );
	return $Return;
}

if (isset ( $_GET ['pc_id'] )) {
	#вывод выбранной позиции
	$CPositionQuery = new mysql_select ( $tbl_cp );
	$Data = $CPositionQuery->select_table_id ( "WHERE cp_id = '{$_GET[pc_id]}'" );
	$CPList = new ModuleSite ( $ModuleTemplate );
	$StyleFull = style_list ( array ("cp_full_no_image_block", "cp_full_block" ) );
	$CPFULL = $CPList->For_HTML_Propertis ( $ModuleTemplate [$StyleFull], $Data, array ('cp_image' => array ('cp_image', 'isset_img' ) ) );
	$Formation ['catalog_title'] = $Data ['cp_name'];
	$Formation ['catalog_navigation'] = $PrintCatalog->get_string_navigation ( 'dict', $_GET ['pr_id'], true );
	$Formation ['cp'] = $CPFULL;
	$title_web = $Data ['cp_name'] . ", " . $title_web;
	$keywords_web = $Data ['cp_keywords'] . ", " . $keywords_web;
}

if (isset ( $_GET ['dict'] ) and ! isset ( $_GET ['pc_id'] )) {
	#список позиций для вывода
	$Formation ['cp'] = print_list_catalog_position ( $CPquery );
}

if (! isset ( $_GET ['dict'] )) {
	$Formation ['catalog_navigation'] = "<h1 class=\"TitleStandartPage\">{$pages->active_page['title']}</h1>";
	#список позиций для вывода
	$Formation ['cp'] = print_list_default_cp ();
}

# 	класс модулей сайта	
$cl_Module = new ModuleSite ( $ModuleTemplate );
$PageContent = $cl_Module->For_HTML ( $ModuleTemplate ['template_table_catalog_page'], $Formation );
?>