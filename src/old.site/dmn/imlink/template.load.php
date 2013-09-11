<?php

  // Устанавливаем соединение с базой данных
  require_once("../../config/config.php");
  // Подключаем SoftTime FrameWork
require_once DOC_ROOT . '/config/class.config.php';

  require_once("../utils/cms.images.php"); 
  
  		$im_catalog_id_add[0]['dict_id']	= "flat";
		$im_catalog_id_add[0]['dict_name'] 	= "Квартиры";
		$im_catalog_id_add['flat']['dict_name'] 	= "Квартиры";
		$im_catalog_id_add[1]['dict_id'] 	= "commercial";
		$im_catalog_id_add[1]['dict_name'] 	= "Коммерческая недвижимость";
		$im_catalog_id_add['commercial']['dict_name'] 	= "Коммерческая недвижимость";
		$im_catalog_id_add[2]['dict_id'] 	= "home";
		$im_catalog_id_add[2]['dict_name'] 	= "Коттеджи. Дома. Дачи.";
		$im_catalog_id_add['home']['dict_name'] 	= "Коттеджи. Дома. Дачи.";
		$im_catalog_id_add[3]['dict_id'] 	= "buildings";
		$im_catalog_id_add[3]['dict_name'] 	= "ОСЗ. Здания.";
		$im_catalog_id_add['buildings']['dict_name'] 	= "ОСЗ. Здания.";
		$im_catalog_id_add[4]['dict_id'] 	= "land";
		$im_catalog_id_add[4]['dict_name'] 	= "Земельные участки"; 
		$im_catalog_id_add['land']['dict_name'] 	= "Земельные участки"; 
		
	# 	Получаем содержимое текущей страницы
   		$cl_sel_pages = new mysql_select($tbl_im_link,
									   	 "WHERE lang_id = $_COOKIE[lang_id]",
									     "");
		$cl_sel_pages -> select_table("il_id");
	# 	Получаем содержимое текущей страницы
   		$page = $cl_sel_pages -> table;	
 
	if($_GET['print'] == 'list_page')	require_once("template.print/print.list.pages.php");
	

?>
    	
        