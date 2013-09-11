<?php
  // Устанавливаем соединение с базой данных
  require_once("../../config/config.php");
  // Подключаем SoftTime FrameWork
require_once DOC_ROOT . '/config/class.config.php';

  require_once("../utils/cms.images.php"); 

  $Wimplementation = "";
  if(!empty($_GET[catalog_id])) $Wimplementation = "AND catalog_id = '{$_GET[catalog_id]}'";
  	
	# 	Получаем содержимое текущей страницы
   		$cl_sel_pages = new mysql_select($tbl_im_pl,
									   	 "WHERE lang_id={$_COOKIE[lang_id]} {$Wimplementation}",
									     "ORDER BY catalog_id ASC");
		$cl_sel_pages -> select_table("im_prop_id");
	# 	Получаем содержимое текущей страницы
   		$page = $cl_sel_pages -> table;	

   	# 	Получаем содержимое текущей страницы
   		$cl_sel_dict = new mysql_select($tbl_list_dictionaries,
									   	 "",
									     "ORDER BY ld_id ASC");
		$cl_sel_dict -> select_table("ld_id");
			
   		$dictionaries = new dictionaries();
	#формируем массив имени словарей
		$dct_list 	=	$dictionaries->buid_dictionaries_list($tbl_list_dictionaries);
	#формируем массив значений словарей
		$dct		=	 $dictionaries->buid_dictionaries($tbl_dictionaries,
									 	 				 "WHERE lang_id = {$_COOKIE[lang_id]}");
	#	задаем айди значение справочника новостей
		$dictionaries->do_dictionaries(19);
	#	my_list_dct - сам словарь
		$cartype_lst 	 = $dictionaries->my_list_dct;
	#	перечень значение словаря новостей
		$new_dct_arr	 = $dictionaries->my_dct;
	#	родитель, ребенок формирование массива
		$new_dct_value = $dictionaries->BuildArrayParentChild($new_dct_arr);
		
		if(empty($page)) {
			echo "<b>Нет позиций</b>";
			return ;
		}
		if($_GET['print'] == 'list_page')	require_once("template.print/print.list.pages.php");
?>
    	
        