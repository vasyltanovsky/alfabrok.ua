<?php
/* Функция: 
    * @param 
    * @return 
    */
function print_list_service() {
	global $tbl_service;
	global $ModuleTemplate;
	global $arWords;
	
	$CPSelect = new mysql_select ( $tbl_service, "WHERE dict_id = '4c7e1b724c295' AND lang_id={$_COOKIE[lang_id]} ORDER BY pos DESC" );
	$CPSelect->select_table ();
	$Data = $CPSelect->table;
	if (empty ( $Data ))
		return $arWords ['cp_no_position'];
	$CPList = new ModuleSite ( $ModuleTemplate );
	
	$Return = $CPList->Handler_Template_Html ( 'serice_list_block', $Data, array ('img' => array ('img', 'isset_info_img' ) ) );
	//$Return .= "<div class=\"clear\"></div><div class=\"DivPaging\">{$CPSelect}</div>";
	return $Return;
}
#
$ClImMinPrice = new ImListPrint ( "i WHERE i.im_is_hot=1 AND i.im_photo != 'imnoimage.png' ORDER BY RAND() LIMIT 15", $ModuleTemplate, $TemplateImList, $dictionaries, $arWords );

$Formation ['im_list'] = $ClImMinPrice->GetContent ( 'div_im_list_ban_block', $arr = array ('title' => $arWords ['ImDivListHeaderHot'], 's_im_link' => 'hot_im', 'css_class' => 'links_block' ), 'DivListMinPrice' );

if (isset ( $_GET ['sc_id'] )) {
	#вывод выбранной позиции
	$CPositionQuery = new mysql_select ( $tbl_service );
	$Data = $CPositionQuery->select_table_id ( "WHERE sc_id = '{$_GET[sc_id]}'" );
	$CPList = new ModuleSite ( $ModuleTemplate );
	$CPFULL = $CPList->For_HTML ( $ModuleTemplate ['serice_list_view_block'], $Data );
	$title_web = $Data ['keywords_web'] . ", " . $title_web;
	$keywords_web = $Data ['description_web'] . ", " . $keywords_web;
	$Formation ['catalog_title'] = $Data ['title'];
	$Formation ['catalog_navigation'] = "<a href=\"/service/{$_GET[page]}.html\" title=\"{$pages->active_page['title']}\">{$pages->active_page['title']}</a> &raquo; " . $Data ['title'];
	$Formation ['cp'] = $CPFULL;
}

if (! isset ( $_GET ['sc_id'] )) {
	$Formation ['catalog_title'] = $pages->active_page ['title'];
	$Formation ['catalog_navigation'] = "";
	#список позиций для вывода
	$Formation ['cp'] = print_list_service ();
}

# 	класс модулей сайта	
$cl_Module = new ModuleSite ( $ModuleTemplate );
$PageContent = $cl_Module->For_HTML ( $ModuleTemplate ['template_table_service_page'], $Formation );
?>