<?php
#
$ClImMinPrice = new ImListPrint ( "i WHERE i.im_is_hot=1 AND i.im_photo != 'imnoimage.png' ORDER BY RAND() LIMIT 15", $ModuleTemplate, $TemplateImList, $dictionaries, $arWords );

$pages->active_page ['im_list'] = $ClImMinPrice->GetContent ( 'div_im_list_ban_block', $arr = array ('title' => $arWords ['ImDivListHeaderHot'], 's_im_link' => 'hot_im', 'css_class' => 'links_block' ), 'DivListMinPrice' );
$pages->active_page ['div_navigation'] = "";
$pages->active_page ['catalog_menu'] = "";
$PartnersQuery = new mysql_select ( $tbl_partner, "WHERE hide='show'", "ORDER BY pos" );
$PartnersQuery->select_table ( "partner_id" );

# 	класс модулей сайта	
$cl_Module = new ModuleSite ( $ModuleTemplate );
$pages->active_page ['summary'] = $cl_Module->Handler_Template_Html ( 'partner_list_block', $PartnersQuery->table, array ('partner_logo' => array ('partner_logo', 'isset_pl' ), 'partner_url' => array ('partner_url', 'isset_pu' ) ) );

$PageContent = $cl_Module->For_HTML ( $ModuleTemplate ['template_table_standart_center_page'], $pages->active_page );
?>