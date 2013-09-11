<?php
#подключение к БД
require_once ("config/config.php");
#подключение классов
require_once DOC_ROOT . '/config/class.config.php'; 
#обработчик языка
require_once DOC_ROOT . '/application/includes/language/set.cookie.php';
#шаблоны сайта
require_once DOC_ROOT . '/application/includes/module/template.module.php';
#настройки отображение недвижимости на страницы
require_once DOC_ROOT . '/application/includes/immovables/setting.im.print.inc';

#очистка COOKIE - выборки недвижимости	
$ImSiteForm = new ImSiteForm ( );
$ImSiteForm->Clean ();

#объявление класса pages, ядра системы !!фишка!! 	
$pages = new pages ( $_SERVER ['PHP_SELF'], $_GET, "pages", "WHERE hide = 'show' AND lang_id = " . $_COOKIE['lang_id'] . "", "ORDER BY pos" );
$pages->update_get_array ( true );
#селест таблицы, формирование сайта
$pages->select_table ();
#формирование меню сайта 	
list ( $ret_menu_index, $ret_menu_link, $ret_menu_footer, $ret_submenu_index ) = $DateMenuSite = $pages->Return_Menu_Site ();
#переменные заголовков страницы					
$title_web = $pages->active_page_item ( 'title_web' );
$keywords_web = $pages->active_page_item ( 'keywords_web' );
$description_web = $pages->active_page_item ( 'description_web' );
#переменные текстовки страницы	
$title = $pages->active_page_item ( 'title', 'show' );
$description = $pages->active_page_item ( 'description', 'show' );
$summary = $pages->active_page_item ( 'summary', 'show' );
$adress_template = $pages->active_page_item ( 'adress_template' );
#
$ClImHOT = new ImListPrint ( "i WHERE i.im_is_hot=1 AND i.im_photo != 'imnoimage.png' ORDER BY RAND()", $ModuleTemplate, $TemplateImList, $dictionaries, $arWords );

$Formation ['im_list'] = $ClImHOT->GetContent ( 'div_im_list_ban_block', $arr = array ('title' => $arWords ['ImDivListHeaderHot'], 's_im_link' => 'hot_im', 'css_class' => 'links_block' ), 'DivListMinPrice' );

#класс модулей сайта		
$cl_Module = new ModuleSite ( $ModuleTemplate );

#класс проверяет параметры для формирования стандарта для страницы
if ($pages->build_default_page ( $ret_submenu_index ))
	$PageInfoReturn = $cl_Module->For_HTML ( $ModuleTemplate ['template_table_standart_center_page'], $pages->active_page );
#подключение HTML шапки сайта
require_once ("application/html/header.php");
echo $PageInfoReturn;
if ($adress_template)
	require_once ("$adress_template");
include ("application/html/footer.php");			