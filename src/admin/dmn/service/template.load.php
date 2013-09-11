<?php

  // Устанавливаем соединение с базой данных
  require_once("../../config/config.php");
  // Подключаем SoftTime FrameWork
require_once DOC_ROOT . '/config/class.config.php';

  require_once("../utils/cms.images.php"); 
  
	# 	Получаем содержимое текущей страницы
   		$cl_sel_pages = new mysql_select($tbl_service,
									   	 "WHERE lang_id = $_COOKIE[lang_id] AND dict_id='4c7e1b724c295'",
									     "ORDER BY pos DESC");
		$cl_sel_pages -> select_table("sc_id");
	# 	Получаем содержимое текущей страницы
   		$page = $cl_sel_pages -> table;	
    #	класс постоения дерева каталога
   		$cl_tree_pages = new cl_build_tree($page,
											"sc_id",
											"parent_id");
		$cl_tree_pages -> b_t_id();

	if($_GET['print'] == 'list_page')	require_once("template.print/print.list.pages.php");
	

?>
    	
        