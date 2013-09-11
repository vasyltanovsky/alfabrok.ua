<?php
/* Функция: 
    * @param 
    * @return 
    */
function print_list_news() {
	global $tbl_news;
	global $ModuleTemplate;
	global $arWords;
	
	$CPSelect = new pager_mysql_right ( $tbl_news, "WHERE type_id = '4b3a3e17d522a' AND lang_id={$_COOKIE[lang_id]} AND hide = 'show'", "ORDER BY news_date DESC", 10, 10, "" );
	$Data = $CPSelect->get_page ();
	
	if (empty ( $Data ))
		return $arWords ['cp_no_position'];
	$CPList = new ModuleSite ( $ModuleTemplate );
	
	$Return = $CPList->Handler_Template_Html ( 'press_list_block', $Data, array ('news_image' => array ('news_image', 'iseet_news_img' ) ) );
	$Return .= "<div class=\"clear\"></div><div class=\"DivPaging\">{$CPSelect}</div>";
	return $Return;
}

#
$ClImMinPrice = new ImListPrint ( "i WHERE i.im_is_hot=1 AND i.im_photo != 'imnoimage.png' ORDER BY RAND()", $ModuleTemplate, $TemplateImList, $dictionaries, $arWords );

$Formation ['im_list'] = $ClImMinPrice->GetContent ( 'div_im_list_ban_block', $arr = array ('title' => $arWords ['ImDivListHeaderHot'], 's_im_link' => 'hot_im' ), 'DivListMinPrice' );

if (isset ( $_GET ['news_id'] )) {
	#вывод выбранной позиции
	$CPositionQuery = new mysql_select ( $tbl_news );
	$Data = $CPositionQuery->select_table_id ( "WHERE news_id = '{$_GET[news_id]}'" );
	$CPList = new ModuleSite ( $ModuleTemplate );
	$CPFULL = $CPList->For_HTML ( $ModuleTemplate ['press_view_block'], $Data );
	
	$title_web = $Data ['news_title'] . ", " . $title_web;
	$keywords_web = $Data ['news_title'] . ", " . $keywords_web;
	$Formation ['catalog_title'] = $Data ['news_title'];
	$Formation ['catalog_navigation'] = "<a href=\"/press/{$_GET[page]}.html\" title=\"{$pages->active_page['title']}\">{$pages->active_page['title']}</a> &raquo; " . $Data ['news_title'];
	$Formation ['cp'] = $CPFULL;
}

if (! isset ( $_GET ['news_id'] )) {
	$Formation ['catalog_title'] = $pages->active_page ['title'];
	$Formation ['catalog_navigation'] = "";
	#список позиций для вывода
	$Formation ['cp'] = print_list_news ();
}

# 	класс модулей сайта	
$cl_Module = new ModuleSite ( $ModuleTemplate );
$PageContent = $cl_Module->For_HTML ( $ModuleTemplate ['template_table_press_page'], $Formation );
?>