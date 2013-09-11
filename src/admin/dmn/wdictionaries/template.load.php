<?php

  // Устанавливаем соединение с базой данных
  require_once("../../config/config.php");
  // Подключаем SoftTime FrameWork
require_once DOC_ROOT . '/config/class.config.php';
  require_once "../utils/cms.images.php";
  
	# 	Получаем содержимое текущей страницы
   		$cl_sel_pages = new mysql_select($tbl_list_dictionaries,
									   	 "",
									     "ORDER BY ld_id ASC");
		$cl_sel_pages -> select_table("ld_id");
	# 	Получаем содержимое текущей страницы
   		$page = $cl_sel_pages -> table;	
   
	if($_GET['print'] == 'list_page')	require_once("template.print/print.list.pages.php");
	
	if($_GET['print'] == 'position_portfolio')
	{
		$AND = '';
		if($_GET[position_id])
			$AND = "AND ld_id= '{$_GET[position_id]}' ";
		# 	Получаем содержимое текущей страницы
   		$cl_sel_position = new mysql_select($tbl_dictionaries,
									   	 "WHERE lang_id = $_COOKIE[lang_id] $AND",
									     "ORDER BY ld_id ASC");
		$cl_sel_position -> select_table("dict_id");
		$TablePosition = $cl_sel_position->table;
//echo "<pre>";		
//print_r($cl_sel_position);
//echo "</pre>";
		require_once("template.print/print.list.position.php");
	}
?>
    	
        