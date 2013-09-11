<?php

// Устанавливаем соединение с базой данных
require_once ("../../config/config.php");
// Подключаем SoftTime FrameWork
require_once DOC_ROOT . '/config/class.config.php';

require_once ("../utils/cms.images.php");

# 	Получаем содержимое текущей страницы
$cl_sel_pages = new mysql_select ( "system_accounts", "", "ORDER BY id_account" );
$cl_sel_pages->select_table ( "news_id" );
# 	Получаем содержимое текущей страницы
$page = $cl_sel_pages->table;

#объявляем класс словаря
$dictionaries = new dictionaries ();
#формируем массив имени словарей
$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries );
#формируем массив значений словарей
$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = {$_COOKIE["lang_id"]}" );

if ($_GET ['print'] == 'list_page')
	require_once ("template.print/print.list.pages.php");

?>
    	
        