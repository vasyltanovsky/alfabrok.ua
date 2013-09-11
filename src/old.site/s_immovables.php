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
#настройки отображение недвижимости на страницы
require_once  DOC_ROOT . '/application/includes/immovables/settings.s.im.inc';

#	кэширование страницы
$cl_cache = new CacheSite ( );
$cl_cache->page_name_end = $_COOKIE ['user_id'];
#	выборка с БД
$cl_cache->checking_inclusion ();
#	проверка на существования кешированной страницы	
$cl_cache->checking_existence ();

#очистка COOKIE - выборки недвижимости	
$ImSiteForm = new ImSiteForm ( NULL, 'ImFormSearchArray', 'SearchImCode' );
$ImSiteForm->Clean ();

#обявление класса pages, ядра системы !!фишка!! 	
$pages = new pages ( $_SERVER ['PHP_SELF'], $_GET, "pages", "WHERE hide = 'show' AND lang_id = " . $_COOKIE['lang_id'], "ORDER BY pos" );
#селест таблицы, формирование сайта
$pages->select_table ();

$pages->update_get_array ( true );
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
#объявляем класс словаря
$dictionaries = new dictionaries ( );
#формируем массив имени словарей
$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries );
#формируем массив значений словарей
$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = {$_COOKIE['lang_id']} ORDER BY dict_name" );

if (isset ( $_GET ['im_id'] ))
	$header = "application/html/header.im.php";
else
	$header = "application/html/header.im.list.php";
	//if($adress_template)	require_once $adress_template;
require_once 'application/module/immovables/template.s.immovables.php';
#	подключение HTML шапки сайта
require_once $header;
?>
<div class="DivCenterPage"><!-- PAGE CONTENT -->
	<?php
	echo "<h1 class=\"TitleStandartPage\">{$title_page}</h1>";
	echo $CodesList;
	echo $ImPagesContent;
	?>
	<div id="DivRequest"></div>
</div>

<!--FOOTER-->
<?php
include ("application/html/footer.php");
#	кэширование страницы, создания кешированной страницы
$cl_cache->creation_page ();
?>