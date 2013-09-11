<?php
	#формирование блоков страницы
		$arrContent['catalog_menu'] 	= $arWords['user_private_link'];
		$arrContent['title'] 			= $pages->active_page['title'];
		$arrContent['div_navigation'] 	= $pages->navigation_string_htaccess();
		$arrContent['summary'] 			= $pages->active_page['summary'];
	#выборка выбранной недвижимости	
		$ImUserQueryClass = new mysql_select($tbl_im,
											"i WHERE i.im_provider = {$_COOKIE[user_id]}
											ORDER BY i.im_date_add DESC");
		$ImUserQueryClass ->select_table("im_id");
		
		$arrContent['data'] .= "<a id=\"\" class=\"UAddSome\" href=\"/user/2imadd.html\"><span class=\"ui-icon ui-icon-circle-plus\"></span>{$arWords['user_add_user_im']}</a>";
	if($ImUserQueryClass ->table) {
		#выборка характеристик недвижимости	
			$ImPropListInfo = new mysql_select($tbl_im_pl,
												"l left join {$tbl_im_pi} i ON l.im_prop_id = i.im_prop_id WHERE l.lang_id = {$_COOKIE['lang_id']} AND i.lang_id = {$_COOKIE['lang_id']} AND type_prop='advanced' AND hide='show'",
												"ORDER BY im_prop_name ASC");
			$ImPropListInfo->select_table("im_prop_id");
		#преобразование данных характеристик и значений
			$ImPropData = new PropSort($ImPropListInfo->table);
			$ImPropData ->GetArrToPrint('im_id', array('is_print_list', 'is_print_ad', 'is_print_st'));
		#формирование списка недвижимости
			$ModImPropP = new ModuleSiteIm($ModuleTemplate, $arWords, $dictionaries, $ImPropData->ImPropData, $ImPropData->ImPropArrData);
			$arrContent['data'] .= $ModImPropP -> Handler_Template_Html('im_user_im_add_list_block',  $ImUserQueryClass->table, $TemplateImList['search']);
	}
	else {
		$ImPageContentArr['error_text'] = $arWords['user_no_add_user_im'];
		$ImPageContentClass = new ModuleSite($ModuleTemplate);
		$arrContent['data'] .= $ImPageContentClass	->For_HTML($ModuleTemplate['error_page'], $ImPageContentArr);
	}
	#вставка информации в шаблон	
		$cl_Module = new ModuleSite($ModuleTemplate);	
		$PageInfoReturn = $cl_Module->For_HTML($ModuleTemplate['ttable_cim_page'], $arrContent);
?>
