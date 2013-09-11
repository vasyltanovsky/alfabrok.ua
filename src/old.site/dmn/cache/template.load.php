<?php

  // Устанавливаем соединение с базой данных
  require_once("../../config/config.php");
  // Подключаем SoftTime FrameWork
require_once DOC_ROOT . '/config/class.config.php';

	# 	Получаем содержимое текущей страницы
   		$cl_sel_pages = new mysql_select($tbl_cache_site);
		$cl_sel_pages -> select_table("cs_id");
	# 	Получаем содержимое текущей страницы
   		$page = $cl_sel_pages -> table;	
	
	if($_GET['print'] == 'list_page')	require_once("template.print/print.list.pages.php");
	

?>
    	
        