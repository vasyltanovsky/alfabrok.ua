<?php
	#стисок недвижимостью 
		$ClImMinPrice = new ImListPrint("i WHERE i.im_is_hot=1 AND i.im_photo != 'imnoimage.png' ORDER BY RAND()", 
										$ModuleTemplate,
										$TemplateImList,
										$dictionaries,
										$arWords);
				
	#формирование блоков страницы
		$arrContent['catalog_menu'] 	= $arWords['user_private_link'];
		$arrContent['title'] 			= $pages->active_page['title'];
		$arrContent['div_navigation'] 	= $pages->navigation_string_htaccess();
		$arrContent['summary'] 			= $pages->active_page['summary'];
		$arrContent['list_im'] 			= $ClImMinPrice -> GetContent('div_im_list_ban_block', $arr = array('title' => $arWords['ImDivListHeaderHot'], 's_im_link' => 'hot_im', 'css_class' => 'links_block'), 'DivListMinPrice');
	#выборка выбранной недвижимости	
		$ImFavQueryClass = new mysql_select($tbl_im,
											"i left join {$tbl_user_if} f on i.im_id = f.im_id WHERE i.hide='show' AND f.user_id = {$_COOKIE[user_id]} GROUP BY i.im_id");
		$ImFavQueryClass ->select_table("im_id");
	if($ImFavQueryClass->table) {
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
			$arrContent['data'] = $ModImPropP -> Handler_Template_Html('im_favorites_list_block',  $ImFavQueryClass->table, $TemplateImList['search']);
	}
	else {
		$ImPageContentArr['error_text'] = $arWords['user_no_favorites'];
		$ImPageContentClass = new ModuleSite($ModuleTemplate);
		$arrContent['data'] = $ImPageContentClass	->For_HTML($ModuleTemplate['error_page'], $ImPageContentArr);
	}
	#вставка информации в шаблон	
		$cl_Module = new ModuleSite($ModuleTemplate);	
		$PageInfoReturn = $cl_Module->For_HTML($ModuleTemplate['ttable_cim_page'], $arrContent);
?>
