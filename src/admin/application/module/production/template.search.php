<?php
/* Функция: 
    * @param 
    * @return 
    */
function print_search_list_catalog_position() {
	global $tbl_cp;
	global $ModuleTemplate;
	global $arWords;
	
	if (empty ( $_GET ['brand'] ))
		return $arWords ['no_value_search_field'];
	$_GET ['brand'] = addslashes ( $_GET ['brand'] );
	$CPSelect = new pager_mysql ( $tbl_cp, "WHERE cp_name LIKE '%{$_GET[brand]}%' AND lang_id={$_COOKIE[lang_id]}", "ORDER BY cp_date_add DESC", 10, 10, "&" . $_GET ['brand'] );
	$Data = $CPSelect->get_page ();
	
	if (empty ( $Data ))
		return $arWords ['search_no_position'];
	$CPList = new ModuleSite ( $ModuleTemplate );
	$Return = $CPList->Handler_Template_Html ( 'cp_list_block', $Data, array ('cp_image' => array ('cp_image', 'isset_img' ) ) );
	$Return .= "<div class=\"pages\">{$CPSelect}</div>";
	return $Return;
}

$Formation ['title'] = $title;
$Formation ['div_navigation'] = '';
$Formation ['summary'] = print_search_list_catalog_position ();

# 	класс модулей сайта	
$cl_Module = new ModuleSite ( $ModuleTemplate );
$PageContent = $cl_Module->For_HTML ( $ModuleTemplate ['template_table_center_page'], $Formation );
?>	
	