<?php
	#формирование блоков страницы
		$arrContent['catalog_menu'] 	= $arWords['user_private_link'];
		$arrContent['title'] 			= $pages->active_page['title'];
		$arrContent['div_navigation'] 	= $pages->navigation_string_htaccess();
		$arrContent['summary'] 			= $pages->active_page['summary'];
	#выборка выбранной недвижимости	
		$SubsQueryClass = new mysql_select($tbl_user_subs,
											"s WHERE s.user_id = {$_COOKIE[user_id]}");
		$SubsQueryClass ->select_table("us_id");
		
		$arrContent['data'] .= "<a id=\"\" class=\"UAddSome\" href=\"/user/2subs/3addsub.html\"><span class=\"ui-icon ui-icon-circle-plus\"></span>{$arWords['user_add_subs']}</a>";
	if($SubsQueryClass ->table) {
		$ClSubsMod = new ModuleSite($ModuleTemplate, $arWords);
		$arrContent['data'] .= $ClSubsMod -> Handler_Template_Html('us_list_block', 
																$SubsQueryClass->table, 
																array('us_date'	=>array('us_date','date'), 
																'us_im_catalog'	=>array('us_im_catalog','get_lang_id'), 
																'us_im_is_rent'	=>array('us_im_is_rent','get_img_ok'), 
																'us_im_is_sale'	=>array('us_im_is_sale','get_img_ok'))
																); 
	}
	else {
		$ImPageContentArr['error_text'] = $arWords['user_no_subs'];
		$ImPageContentClass = new ModuleSite($ModuleTemplate);
		$arrContent['data'] .= $ImPageContentClass	->For_HTML($ModuleTemplate['error_page'], $ImPageContentArr);
	}
	#вставка информации в шаблон	
		$cl_Module = new ModuleSite($ModuleTemplate);	
		$PageInfoReturn = $cl_Module->For_HTML($ModuleTemplate['ttable_cim_page'], $arrContent);
?>
