<?php

  // Устанавливаем соединение с базой данных
  require_once("../../config/config.php");
  // Подключаем SoftTime FrameWork
require_once DOC_ROOT . '/config/class.config.php';

  require_once("../utils/cms.images.php"); 
  
	# 	Получаем содержимое текущей страницы
   		$cl_sel_pages = new mysql_select($tbl_news,
									   	 "WHERE lang_id = $_COOKIE[lang_id] AND type_id = '4b3a3e17d522a'",
									     "ORDER BY news_date DESC");
		$cl_sel_pages -> select_table("news_id");
	# 	Получаем содержимое текущей страницы
   		$page = $cl_sel_pages -> table;	
   
	if($_GET['print'] == 'list_page')	require_once("template.print/print.list.pages.php");
	

?>
    	
        