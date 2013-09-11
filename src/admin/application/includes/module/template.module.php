<?php
	require_once 'template.module.servicesite.php';
	require_once 'template.module.immovables.php';
	require_once 'template.module.user.php';
	require_once 'template.module.city.map.php';
	require_once 'template.immovables.similar.php';
	require_once 'template.module.ymap.php';
	
		//$ModuleTemplate['index_im_link_header'] = "<div style=\"margin-top:10px;\" class=\"DivListImBan\"><h3>{$arWords['index_im_link']}</h3>";
		//$ModuleTemplate['index_im_link_bottom'] = "<div class=\"clear\"></div></div>";
		$ModuleTemplate['index_im_link'] = "<a class=\"index_im_link\" alt=\"#il_title#\" title=\"#il_title#\" href=\"/immovables/#type_im#/#type_rs#.html?#dict_id#_#type_reg#=#il_name#\">#il_name#</a>";
		$ModuleTemplate['index_im_link_bock'] =
		"<div style=\"margin-top:10px;\" class=\"DivListImBan\"><h3>{$arWords['index_im_link']}</h3>
		<table id=\"tableIndexOneClick\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"tableIndexOneClick\">
			<tr class=\"header\">
				<th class=\"name\"></th>
				<th class=\"sale\">{$arWords['ImSale']}</th>
				<th class=\"rent\">{$arWords['ImRent']}</th>
			</tr>
			<tr class=\"flat\">
				<td class=\"name\">{$arWords['4c3ec3ec5e9b5']}</td>
				<td class=\"sale\">#flatsale#</td>
				<td class=\"rent\">#flatrent#</td>
			</tr>
			<tr class=\"commercial\">
				<td class=\"name\">{$arWords['4c3ec3ec5e9b7']}</td>
				<td class=\"sale\">#commercialsale#</td>
				<td class=\"rent\">#commercialrent#</td>
			</tr>
			<tr class=\"home\">
				<td class=\"name\">{$arWords['4c3ec51d537c0']}</td>
				<td class=\"sale\">#homesale#</td>
				<td class=\"rent\">#homerent#</td>
			</tr>
			<tr class=\"buildings\">
				<td class=\"name\">{$arWords['4c3ec51d537c2']}</td>
				<td class=\"sale\">#buildingssale#</td>
				<td class=\"rent\">#buildingsrent#</td>
			</tr>
			<tr class=\"land\">
				<td class=\"name\">{$arWords['4c3ec51d537c3']}</td>
				<td class=\"sale\">#landsale#</td>
				<td class=\"rent\"></td>
			</tr>
			</table>
		</div>";
		
		$ModuleTemplate['im_footer_text'] = "<div class=\"DivImFooterText\">#it_text#</div>";
		
		$ModuleTemplate['HTML_header']	= "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\"><html xmlns=\"http://www.w3.org/1999/xhtml\"><head><title></title><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /></head><body>";
		$ModuleTemplate['HTML_bottom']	= "</body></html>";
		$ModuleTemplate['HTML_print']	= "<script type=\"text/javascript\"> // Do print the page
								   		  if (typeof(window.print) != 'undefined') {
								        	window.print();
								   		  }</script>";
			
	
	
		$ModuleTemplate['template_table_center_page'] 	= 	"<div class=\"DivCenterPage\"><h1 class=\"TitleStandartPage\">#title#</h1>
																#div_navigation#
																<table class=\"TableStandartCenterPage\" cellpadding=\"0\" cellspacing=\"0\" >
																<tr>
														   		<td  class=\"TCPTdCenter\">#summary#</td>
												   		   		</tr> 
  															    </table></div>";
		
		$ModuleTemplate['template_table_standart_center_page'] 	= 	"<div class=\"DivCenterPage\"><h1 class=\"TitleStandartPage\">#title#</h1>
																		#div_navigation#
																		<table class=\"TableStandartCenterPage\" cellpadding=\"0\" cellspacing=\"0\">
																		<tr>
																		<td  class=\"TSCPTdCenter\">#summary#</td>
																		<td>#catalog_menu##im_list#</td>
																		</tr>
																		</table></div>";
		
		$ModuleTemplate['ttable_cim_page'] 	= 	"<div class=\"DivCenterPage\"><h1 class=\"TitleStandartPage\">#title#</h1>
																		<div class=\"DivNavigation\">#div_navigation#</div>
																		<table class=\"TableStandartCenterPage\" cellpadding=\"0\" cellspacing=\"0\">
																		<tr>
																		<td class=\"UserCabinetMenu\">#catalog_menu#</td>
																		<td class=\"UserTSCPTdCenter\">#summary#<div>#data#</div></td>
																		</tr>
																		</table></div>";
		
		$ModuleTemplate['ttable_cimui_page'] 	= 	"<div class=\"DivCenterPage\"><h1 class=\"TitleStandartPage\">#title#</h1>
																		<div class=\"DivNavigation\">#div_navigation#</div>
																		<table class=\"TableStandartCenterPage\" cellpadding=\"0\" cellspacing=\"0\">
																		<tr>
																		<td class=\"UserCabinetMenu\">#catalog_menu#</td>
																		<td class=\"UserTSCPTdCenter\">#summary#<div>#data#</div></td>
																		<td class=\"UserCabinetMenu\">#list_im_hot#</td>
																		</tr>
																		</table></div>";
																		
		$ModuleTemplate['template_table_two_rove_center_page'] 	= 	"<div class=\"DivCenterPage\"><h1 class=\"TitleStandartPage\">#title#</h1>
																		#div_navigation#
																		<table class=\"TableStandartCenterPage\" cellpadding=\"0\" cellspacing=\"0\">
																		<tr>
																		<td  class=\"TSCPTdCenter\">#summary#</td>
																		<td  class=\"TSCPTdRight\">#menu##description#</td>
																		</tr>
																		</table></div>";
																	
		$ModuleTemplate['template_table_catalog_page'] 	= 	"<div class=\"DivCenterPage\">
																		#catalog_navigation#
																		<table class=\"TableCatalogPage\" cellpadding=\"0\" cellspacing=\"0\">
																		<tr>
																		<td  class=\"TCTdLeft\">#catalog_menu#</td>
																		<td  class=\"TCTdList\"><h1 class=\"TitleCatalog\">#catalog_title#</h1><div class=\"DivTableCP\">#cp#</div></td>
																		</tr>
																		</table></div><div class=\"clear\"></div>";
				
		$ModuleTemplate['template_div_center_page'] 	= 	"<div class=\"DivCenterPage\">
																<div class=\"DivCenterPageLeft\"></div>
																<div class=\"DivCenterPageRight\"></div>
															<div>";
												   
		$ModuleTemplate['error_page']  = "<div style=\"padding: 0pt 0.7em;\" class=\"ui-state-error ui-corner-all\"> 
											<p><span style=\"float: left; margin-right: 0.3em;\" class=\"ui-icon ui-icon-alert\"></span> 
											<strong>#error_text#</strong></p>
										</div>";

#УСЛУГИ
	#	услуги главной страници
		$ModuleTemplate['service_block_index'] = "<div class=\"DivListServiceIndex\">
													<img src=\"/files/images/service/#img#\" width=\"100\" />
													<a class=\"ServiceCatalogA\"  title=\"#menu_words#\" href=\"service/#sc_id#.html\">
													#menu_words#
													</a>
													</div>";
	
	#	страница услуг service.php
		$ModuleTemplate['template_table_service_page'] 	= 	"<div class=\"DivCenterPage\">
																		#catalog_navigation#
																		<table class=\"TableCatalogPage\" cellpadding=\"0\" cellspacing=\"0\">
																		<tr>
																		<td class=\"TCTdList\"><h1 class=\"TitleCatalog\">#catalog_title#</h1><div class=\"DivTableCP\">#cp#</div></td>
																		<td>#im_list#</td>
																		</tr>
																		</table></div><div class=\"clear\"></div>";
	#	список услуг на странице service.php
		$ServicePageNum = ($_GET["page"] ? $_GET["page"]  : "1");
		
		$ModuleTemplate['serice_list_block_header'] = "<table class=\"TableInfo\"  border=\"0\" cellpadding=\"0\" cellspacing=\"0\">";
		$ModuleTemplate['serice_list_block_bottom'] = "</table>";		
		$ModuleTemplate['serice_list_block'] = "<tr><td class=\"TableInfoTdImage\">#img#</td><td class=\"TableInfoTdDescription\"><a class=\"ALinkInfo\" href=\"/service/1/#sc_id#.html\"  title=\"#menu_words#\" >#menu_words#</a>#description#</td></tr>";
		
		$ModuleTemplate['serice_list_view_block'] = "<div>#summary#</div>";
		
#ПРЕСС-ЦЕНТР		
	#	страница новостей press.php
		$ModuleTemplate['template_table_press_page'] 	= 	"<div class=\"DivCenterPage\">
																		#catalog_navigation#
																		<h1 class=\"TitleStandartPage\">#catalog_title#</h1>
																		<table class=\"TableCatalogPage\" cellpadding=\"0\" cellspacing=\"0\">
																		<tr>
																		<td class=\"TCTdList\"><div class=\"DivTableCP\">#cp#</div></td>
																		<td>#im_list#</td>
																		</tr>
																		</table></div><div class=\"clear\"></div>";
	#	список услуг на странице service.php
		$NewsPageNum = ($_GET["page"] ? $_GET["page"]  : "1");
		$ModuleTemplate['press_list_block_header'] = "";
		$ModuleTemplate['press_list_block_bottom'] = "";
		
		$ModuleTemplate['press_list_block_header'] = "<table class=\"TableInfo\"  border=\"0\" cellpadding=\"0\" cellspacing=\"0\">";
		$ModuleTemplate['press_list_block_bottom'] = "</table>";		
		$ModuleTemplate['press_list_block'] = "<tr><td class=\"TableInfoTdDescription\"><a class=\"ALinkInfo\" title=\"#news_title#\" href=\"/press/{$NewsPageNum}/#news_id#.html\">#news_title#</a>#news_description#</td></tr>";
		
		$ModuleTemplate['press_view_block'] = "<div class=\"\"><div class=\"\">#news_summary#</div></div>";	
			
	#	портфолио последние работы	
		$ModuleTemplate['portfolio_pos_block_header'] = "<div class=\"CenterPortfolioPos\" >";
		$ModuleTemplate['portfolio_pos_block_bottom'] = "</div>";
		$ModuleTemplate['portfolio_pos_block'] = "<div>
													<img src=\"/files/portfolio/#pp_img#\" width=\"160\">
													<a title=\"#title#\" href=\"portfolio.html\">
													#title#
													</a>
													</div>";	

#ПАРТНЕРЫ
	#	страница новостей partner.php
		$ModuleTemplate['template_table_partner_page'] 	= 	"<div class=\"DivCenterPage\">
																		<table class=\"TableCatalogPage\" cellpadding=\"0\" cellspacing=\"0\">
																		<tr>
																		<td  class=\"TCTdList\"><h1 class=\"TitleCatalog\">#title#</h1><div class=\"DivTableCP\">#summary#</div></td>
																		</tr>
																		</table></div><div class=\"clear\"></div>";
	#	партнеры 	
		$ModuleTemplate['partner_list_block_header']	= "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"\">";
		$ModuleTemplate['partner_list_block_bottom']	= "</table>";
		$ModuleTemplate['partner_list_block'] = "<tr>
												<td class=\"PartnerListImage\">#partner_logo#</td>
												<td class=\"PartnerListText\"><p class=\"PPName\"><b>#partner_name#</b></p>#partner_text#<p class=\"PPUrl\">#partner_url#</p></td>";

		
		#	Список новостей для динамического блока
			$ModuleTemplate['news_dynamic_block_header'] = "<div class=\"DivListImBan\"><h3>{$arWords[block_news]}</h3>";
			$ModuleTemplate['news_dynamic_block_borrom'] = "</div>";
			$ModuleTemplate['news_dynamic_block']  = "<a class=\"DynamicNews\" title=\"#news_title#\" href=\"/press/dict/#news_id#.html\">#news_title#</a>";
		
		#	Список новостей для страницы новостей 
			$ModuleTemplate['news_list_header'] = "<div>";
			$ModuleTemplate['news_list_header'] = "</div>";
			$ModuleTemplate['news_list_block']  = "<div></div>";
	
			
#НЕДВИЖИМОСТЬ СПИСОК			
		function WhatSort($id)
		{
			if($_COOKIE['im_where_sort'] == $id) return "STHactive";
			else return "STHNactive";
		}
	/*
	*		FLAT LIST PHOTO
	*/
	
		#		SALE
		
		$ModuleTemplate['flat_sale_im_list_table_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td class=\"TdLisImImage\">{$arWords['ImFListHeaderImg']}</td>															
																	<td>{$arWords['ImFListHeaderSummary']}<br />({$arWords['ImFListHeaderArea']}/<a href=\"javascript:setSortTable('im_adress_id');\" class=\"".WhatSort("im_adress_id")."\">{$arWords['ImFListHeaderStreet']}</a>)</td>
																	<td><a href=\"javascript:setSortTable('im_prace');\" class=\"".WhatSort("im_prace")."\">{$arWords['ImFListHeaderPrice']}</a></td>
																	<td class=\"ImFListHeaderM2\"><a href=\"javascript:setSortTable('im_prace_sq');\" class=\"".WhatSort("im_prace_sq")."\">{$arWords['ImFListHeaderM2']}</a></td>
																	<td>{$arWords['ImFListHeaderSqPl']}<br /><a href=\"javascript:setSortTable('im_space');\" class=\"".WhatSort("im_space")."\">{$arWords['ImFListHeaderSq']}</a>/{$arWords['ImFListHeaderSqLive']}/{$arWords['ImFListHeaderSqKitchen']}</td>
																	<td>{$arWords['ImFListHeaderLavel']}</td>
																	<td>{$arWords['ImFListHeaderRoom']}</td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderMap']}</td>
																	</tr>";
		$ModuleTemplate['flat_sale_im_list_table_block_bottom'] = "</table>";
		$ModuleTemplate['flat_sale_im_list_table_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"ListTableImIndexImg\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\"><img src=\"/files/images/immovables/st_#im_photo#\" alt=\"#im_title#\"/></a></td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><div class=\"ImPropTable\">#im_prop_list#</div><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td class=\"TdTextCenter\">#im_prices# </td>
														<td>#im_prace_sq# </td>
														<td>#im_space#/#4c4012253a36f#/#4c40122f31138#</td>
														<td>#4c400ea1b5657#/#4c400ec87481e#</td>
														<td>#4c400ed4e5797#</td>
														<td class=\"TdListRightBorder\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html#YMapsID\">#im_map#</a></td>
														</tr>";	
		
		$ModuleTemplate['flat_sale_im_list_list_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/<a href=\"javascript:setSortTable('im_adress_id');\" class=\"".WhatSort("im_adress_id")."\">{$arWords['ImFListHeaderStreet']}</a>)</td>
																	<td><a href=\"javascript:setSortTable('im_prace');\" class=\"".WhatSort("im_prace")."\">{$arWords['ImFListHeaderPrice']}</a></td>
																	<td class=\"ImFListHeaderM2\"><a href=\"javascript:setSortTable('im_prace_sq');\" class=\"".WhatSort("im_prace_sq")."\">{$arWords['ImFListHeaderM2']}</a></td>
																	<td>{$arWords['ImFListHeaderSqPl']}<br /><a href=\"javascript:setSortTable('im_space');\" class=\"".WhatSort("im_space")."\">{$arWords['ImFListHeaderSq']}</a>/{$arWords['ImFListHeaderSqLive']}/{$arWords['ImFListHeaderSqKitchen']}</td>
																	<td>{$arWords['ImFListHeaderLavel']}</td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderRoom']}</td>
																	</tr>";
		$ModuleTemplate['flat_sale_im_list_list_block_bottom'] = "</table>";
		$ModuleTemplate['flat_sale_im_list_list_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td>#im_prices_ni#</td>
														<td>#im_prace_sq# </td>
														<td>#im_space#/#4c4012253a36f#/#4c40122f31138#</td>
														
														<td>#4c400ea1b5657#/#4c400ec87481e#</td>
														<td class=\"TdListRightBorder\">#4c400ed4e5797#</td>
														</tr>";	
		
		#		RENT
			
		$ModuleTemplate['flat_rent_im_list_table_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td class=\"TdLisImImage\">{$arWords['ImFListHeaderImg']}</td>															
																	<td>{$arWords['ImFListHeaderSummary']}<br />({$arWords['ImFListHeaderArea']}/<a href=\"javascript:setSortTable('im_adress_id');\" class=\"".WhatSort("im_adress_id")."\">{$arWords['ImFListHeaderStreet']}</a>)</td>
																	<td><a href=\"javascript:setSortTable('im_prace_manth');\" class=\"".WhatSort("im_prace_manth")."\">{$arWords['FormSearchNamePriceManth']} ($)</a></td>
																	<td><a href=\"javascript:setSortTable('im_prace_day');\" class=\"".WhatSort("im_prace_day")."\">{$arWords['FormSearchNamePriceDay']} ($)</a></td>
																	<td>{$arWords['ImFListHeaderSqPl']}<br /><a href=\"javascript:setSortTable('im_space');\" class=\"".WhatSort("im_space")."\">{$arWords['ImFListHeaderSq']}</a>/{$arWords['ImFListHeaderSqLive']}/{$arWords['ImFListHeaderSqKitchen']}</td>
																	<td>{$arWords['ImFListHeaderLavel']}</td>
																	<td><a href=\"javascript:setSortTable('im_val_room');\" class=\"".WhatSort("im_val_room")."\">{$arWords['ImFListHeaderRoom']}</a></td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderMap']}</td>
																	</tr>";
		$ModuleTemplate['flat_rent_im_list_table_block_bottom'] = "</table>";
		$ModuleTemplate['flat_rent_im_list_table_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"ListTableImIndexImg\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\"><img src=\"/files/images/immovables/st_#im_photo#\" alt=\"#im_title#\"/></a></td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><div class=\"ImPropTable\">#im_prop_list#</div><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td class=\"TdTextCenter\">#im_prace_manth# </td>
														<td>#im_prace_day# </td>
														<td>#im_space#/#4c4012253a36f#/#4c40122f31138#</td>
														<td>#4c400ea1b5657#/#4c400ec87481e#</td>
														<td>#4c400ed4e5797#</td>
														<td class=\"TdListRightBorder\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html#YMapsID\">#im_map#</a></td>
														</tr>";	
														
		$ModuleTemplate['flat_rent_im_list_list_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/<a href=\"javascript:setSortTable('im_adress_id');\" class=\"".WhatSort("im_adress_id")."\">{$arWords['ImFListHeaderStreet']}</a>)</td>
																	<td><a href=\"javascript:setSortTable('im_prace_manth');\" class=\"".WhatSort("im_prace_manth")."\">{$arWords['FormSearchNamePriceManth']}</a></td>
																	<td><a href=\"javascript:setSortTable('im_prace_day');\" class=\"".WhatSort("im_prace_day")."\">{$arWords['FormSearchNamePriceDay']}</a></td>
																	<td>{$arWords['ImFListHeaderSqPl']}<br /><a href=\"javascript:setSortTable('im_space');\" class=\"".WhatSort("im_space")."\">{$arWords['ImFListHeaderSq']}</a>/{$arWords['ImFListHeaderSqLive']}/{$arWords['ImFListHeaderSqKitchen']}</td>
																	<td>{$arWords['ImFListHeaderLavel']}</td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderRoom']}</td>
																	</tr>";
		$ModuleTemplate['flat_rent_im_list_list_block_bottom'] = "</table>";
		$ModuleTemplate['flat_rent_im_list_list_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td class=\"price-center\">#im_prace_manth# </td>
														<td>#im_prace_day# </td>
														<td>#im_space#/#4c4012253a36f#/#4c40122f31138#</td>
														
														<td>#4c400ea1b5657#/#4c400ec87481e#</td>
														<td class=\"TdListRightBorder\">#4c400ed4e5797#</td>
														</tr>";													
		
		/*
		*		COMMERCIAL LIST PHOTO
		*/
		
		#	SALE
		
		$ModuleTemplate['commercial_sale_im_list_table_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td class=\"TdLisImImage\">{$arWords['ImFListHeaderImg']}</td>															
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/<a href=\"javascript:setSortTable('im_adress_id');\" class=\"".WhatSort("im_adress_id")."\">{$arWords['ImFListHeaderStreet']}</a>)</td>
																	<td><a href=\"javascript:setSortTable('im_prace');\" class=\"".WhatSort("im_prace")."\">{$arWords['ImFListHeaderPrice']})</a></td>
																	<td class=\"ImFListHeaderM2\"><a href=\"javascript:setSortTable('im_prace_sq');\" class=\"".WhatSort("im_prace_sq")."\">{$arWords['ImFListHeaderM2']}</a></td>
																	<td>{$arWords['ImFListHeaderSqPl']}<br /><a href=\"javascript:setSortTable('im_space');\" class=\"".WhatSort("im_space")."\">{$arWords['ImFListHeaderSq']}</a>/{$arWords['ImFListHeaderSqLive']}</td>
																	<td>{$arWords['ImFListHeaderLavel']}</td>
																	<td>{$arWords['ImFListHeaderRoom']}</td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderMap']}</td>
																	</tr>";
		$ModuleTemplate['commercial_sale_im_list_table_block_bottom'] = "</table>";
		$ModuleTemplate['commercial_sale_im_list_table_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"ListTableImIndexImg\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\"><img src=\"/files/images/immovables/st_#im_photo#\" alt=\"#im_title#\"/></a></td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><div class=\"ImPropTable\">#im_prop_list#</div><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td class=\"price-center\">#im_prices# </td>
														<td class=\"TdTextCenter\">#im_prace_sq# </td>
														<td>#im_space#/#4c604016208bc#</td>
														<td>#4c4050fc797b1#/#4c404804b576c#</td>
														<td>#4c400ed4e5797#</td>
														<td class=\"TdListRightBorder\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html#YMapsID\">#im_map#</a></td>
														</tr>";	
														
		$ModuleTemplate['commercial_sale_im_list_list_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/<a href=\"javascript:setSortTable('im_adress_id');\" class=\"".WhatSort("im_adress_id")."\">{$arWords['ImFListHeaderStreet']}</a>)</td>
																	<td><a href=\"javascript:setSortTable('im_prace');\" class=\"".WhatSort("im_prace")."\">{$arWords['ImFListHeaderPrice']}</a></td>
																	<td class=\"ImFListHeaderM2\"><a href=\"javascript:setSortTable('im_prace_sq');\" class=\"".WhatSort("im_prace_sq")."\">{$arWords['ImFListHeaderM2']}</a></td>
																	<td>{$arWords['ImFListHeaderSqPl']} <a href=\"javascript:setSortTable('im_space');\" class=\"".WhatSort("im_space")."\">{$arWords['ImFListHeaderSq']}</a>/{$arWords['ImFListHeaderSqLive']}</td>
																	<td>{$arWords['ImFListHeaderLavel']}</td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderRoom']}</td>
																	</tr>";
		$ModuleTemplate['commercial_sale_im_list_list_block_bottom'] = "</table>";
		$ModuleTemplate['commercial_sale_im_list_list_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td>#im_prices_ni#</td>
														<td>#im_prace_sq# </td>
														<td>#im_space#/#4c604016208bc#</td>
														<td>#4c4050fc797b1#/#4c404804b576c#</td>
														<td class=\"TdListRightBorder\">#4c400ed4e5797#</td>
														</tr>";
	
		#	RENT
		
		$ModuleTemplate['commercial_rent_im_list_table_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td class=\"TdLisImImage\">{$arWords['ImFListHeaderImg']}</td>															
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/<a href=\"javascript:setSortTable('im_adress_id');\" class=\"".WhatSort("im_adress_id")."\">{$arWords['ImFListHeaderStreet']}</a>)</td>
																																		<td><a href=\"javascript:setSortTable('im_prace_manth');\" class=\"".WhatSort("im_prace_manth")."\">{$arWords['FormSearchNamePriceManth']} ($)</a></td>
																	<td><a href=\"javascript:setSortTable('im_prace_day');\" class=\"".WhatSort("im_prace_day")."\">{$arWords['FormSearchNamePriceDay']} ($)</a></td>
																	<td>{$arWords['ImFListHeaderSqPl']}<br /><a href=\"javascript:setSortTable('im_space');\" class=\"".WhatSort("im_space")."\">{$arWords['ImFListHeaderSq']}</a>/{$arWords['ImFListHeaderSqLive']}</td>
																	<td>{$arWords['ImFListHeaderLavel']}</td>
																	<td>{$arWords['ImFListHeaderRoom']}</td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderMap']}</td>
																	</tr>";
		$ModuleTemplate['commercial_rent_im_list_table_block_bottom'] = "</table>";
		$ModuleTemplate['commercial_rent_im_list_table_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"ListTableImIndexImg\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\"><img src=\"/files/images/immovables/st_#im_photo#\" alt=\"#im_title#\"/></a></td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><div class=\"ImPropTable\">#im_prop_list#</div><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td class=\"price-center\">#im_prace_manth# </td>
														<td>#im_prace_day# </td>
														<td>#im_space#/#4c604016208bc#</td>
														<td>#4c4050fc797b1#/#4c404804b576c#</td>
														<td>#4c400ed4e5797#</td>
														<td class=\"TdListRightBorder\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html#YMapsID\">#im_map#</a></td>
														</tr>";	
														
		$ModuleTemplate['commercial_rent_im_list_list_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/<a href=\"javascript:setSortTable('im_adress_id');\" class=\"".WhatSort("im_adress_id")."\">{$arWords['ImFListHeaderStreet']}</a>)</td>
																	<td><a href=\"javascript:setSortTable('im_prace_manth');\" class=\"".WhatSort("im_prace_manth")."\">{$arWords['FormSearchNamePriceManth']}</a></td>
																	<td><a href=\"javascript:setSortTable('im_prace_day');\" class=\"".WhatSort("im_prace_day")."\">{$arWords['FormSearchNamePriceDay']}</a></td>
																	<td>{$arWords['ImFListHeaderSqPl']} <a href=\"javascript:setSortTable('im_space');\" class=\"".WhatSort("im_space")."\">{$arWords['ImFListHeaderSq']}</a>/{$arWords['ImFListHeaderSqLive']}</td>
																	<td>{$arWords['ImFListHeaderLavel']}</td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderRoom']}</td>
																	</tr>";
		$ModuleTemplate['commercial_rent_im_list_list_block_bottom'] = "</table>";
		$ModuleTemplate['commercial_rent_im_list_list_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td class=\"price-center\">#im_prace_manth# </td>
														<td>#im_prace_day# </td>
														<td>#im_space#/#4c604016208bc#</td>
														<td>#4c4050fc797b1#/#4c404804b576c#</td>
														<td class=\"TdListRightBorder\">#4c400ed4e5797#</td>
														</tr>";

		/*
		*		HOME LIST PHOTO
		*/
		
		#	SALE
		
		$ModuleTemplate['home_sale_im_list_table_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td class=\"TdLisImImage\">{$arWords['ImFListHeaderImg']}</td>															
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/<a href=\"javascript:setSortTable('im_adress_id');\" class=\"".WhatSort("im_adress_id")."\">{$arWords['ImFListHeaderStreet']}</a>)</td>
																	<td><a href=\"javascript:setSortTable('im_prace');\" class=\"".WhatSort("im_prace")."\">{$arWords['ImFListHeaderPrice']} </a></td>
																	<td class=\"ImFListHeaderM2\"><a href=\"javascript:setSortTable('im_prace_sq');\" class=\"".WhatSort("im_prace_sq")."\">{$arWords['ImFListHeaderM2']}</a></td>
																	<td>{$arWords['ImFListHeaderSqPl']}<br /><a href=\"javascript:setSortTable('im_space');\" class=\"".WhatSort("im_space")."\">{$arWords['ImFListHeaderSq']}</a>/{$arWords['ImFListHeaderSqLive']}</td>
																	<td>{$arWords['ImFListHeaderRoom']}</td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderMap']}</td>
																	</tr>";
		$ModuleTemplate['home_sale_im_list_table_block_bottom'] = "</table>";
		$ModuleTemplate['home_sale_im_list_table_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"ListTableImIndexImg\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\"><img src=\"/files/images/immovables/st_#im_photo#\" alt=\"#im_title#\"/></a></td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><div class=\"ImPropTable\">#im_prop_list#</div><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td class=\"TdTextCenter\">#im_prices#</td>
														<td>#im_prace_sq# </td>
														<td>#im_space#/#4c402f924bc2a#</td>
														<td>#4c400ed4e5797#</td>
														<td class=\"TdListRightBorder\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html#YMapsID\">#im_map#</a></td>
														</tr>";													

		$ModuleTemplate['home_sale_im_list_list_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/<a href=\"javascript:setSortTable('im_adress_id');\" class=\"".WhatSort("im_adress_id")."\">{$arWords['ImFListHeaderStreet']}</a>)</td>
																	<td><a href=\"javascript:setSortTable('im_prace');\" class=\"".WhatSort("im_prace")."\">{$arWords['ImFListHeaderPrice']}</a></td>
																	<td class=\"ImFListHeaderM2\"><a href=\"javascript:setSortTable('im_prace_sq');\" class=\"".WhatSort("im_prace_sq")."\">{$arWords['ImFListHeaderM2']}</a></td>
																	<td>{$arWords['ImFListHeaderSqPl']} <a href=\"javascript:setSortTable('im_space');\" class=\"".WhatSort("im_space")."\">{$arWords['ImFListHeaderSq']}</a>/{$arWords['ImFListHeaderSqLive']}</td>
																	<td class=\"TdListRightBorder\">{$arWords['ImFListHeaderRoom']}</td>
																	</tr>";
		$ModuleTemplate['home_sale_im_list_list_block_bottom'] = "</table>";
		$ModuleTemplate['home_sale_im_list_list_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td class=\"TdTextCenter\">#im_prices_ni#</td>
														<td>#im_prace_sq# </td>
														<td>#im_space#/#4c402f924bc2a#</td>
														<td class=\"TdListRightBorder\">#4c400ed4e5797#</td>
														</tr>";	
														
		#	RENT
		
		$ModuleTemplate['home_rent_im_list_table_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td class=\"TdLisImImage\">{$arWords['ImFListHeaderImg']}</td>															
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/<a href=\"javascript:setSortTable('im_adress_id');\" class=\"".WhatSort("im_adress_id")."\">{$arWords['ImFListHeaderStreet']}</a>)</td>
																	<td><a href=\"javascript:setSortTable('im_prace_manth');\" class=\"".WhatSort("im_prace_manth")."\">{$arWords['FormSearchNamePriceManth']} ($)</a></td>
																	<td><a href=\"javascript:setSortTable('im_prace_day');\" class=\"".WhatSort("im_prace_day")."\">{$arWords['FormSearchNamePriceDay']} ($)</a></td>
																	<td>{$arWords['ImFListHeaderSqPl']}<br /><a href=\"javascript:setSortTable('im_space');\" class=\"".WhatSort("im_space")."\">{$arWords['ImFListHeaderSq']}</a>/{$arWords['ImFListHeaderSqLive']}</td>
																	<td>{$arWords['ImFListHeaderRoom']}</td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderMap']}</td>
																	</tr>";
		$ModuleTemplate['home_rent_im_list_table_block_bottom'] = "</table>";
		$ModuleTemplate['home_rent_im_list_table_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"ListTableImIndexImg\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\"><img src=\"/files/images/immovables/st_#im_photo#\" alt=\"#im_title#\"/></a></td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><div class=\"ImPropTable\">#im_prop_list#</div><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td class=\"price-center\">#im_prace_manth# </td>
														<td>#im_prace_day# </td>
														<td>#im_space#/#4c402f924bc2a#</td>
														<td>#4c400ed4e5797#</td>
														<td class=\"TdListRightBorder\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html#YMapsID\">#im_map#</a></td>
														</tr>";													

		$ModuleTemplate['home_rent_im_list_list_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/<a href=\"javascript:setSortTable('im_adress_id');\" class=\"".WhatSort("im_adress_id")."\">{$arWords['ImFListHeaderStreet']}</a>)</td>
																	<td><a href=\"javascript:setSortTable('im_prace_manth');\" class=\"".WhatSort("im_prace_manth")."\">{$arWords['FormSearchNamePriceManth']}</a></td>
																	<td><a href=\"javascript:setSortTable('im_prace_day');\" class=\"".WhatSort("im_prace_day")."\">{$arWords['FormSearchNamePriceDay']}</a></td>
																	<td>{$arWords['ImFListHeaderSqPl']} <a href=\"javascript:setSortTable('im_space');\" class=\"".WhatSort("im_space")."\">{$arWords['ImFListHeaderSq']}</a>/{$arWords['ImFListHeaderSqLive']}</td>
																	<td class=\"TdListRightBorder\">{$arWords['ImFListHeaderRoom']}</td>
																	</tr>";
		$ModuleTemplate['home_rent_im_list_list_block_bottom'] = "</table>";
		$ModuleTemplate['home_rent_im_list_list_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td class=\"price-center\">#im_prace_manth# </td>
														<td>#im_prace_day# </td>
														<td>#im_space#/#4c402f924bc2a#</td>
														<td class=\"TdListRightBorder\">#4c400ed4e5797#</td>
														</tr>";		
		/*
		*		BUILDINGS LIST PHOTO
		*/
		
		#		SALE
		
		$ModuleTemplate['buildings_sale_im_list_table_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td class=\"TdLisImImage\">{$arWords['ImFListHeaderImg']}</td>															
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/<a href=\"javascript:setSortTable('im_adress_id');\" class=\"".WhatSort("im_adress_id")."\">{$arWords['ImFListHeaderStreet']}</a>)</td>
																	<td><a href=\"javascript:setSortTable('im_prace');\" class=\"".WhatSort("im_prace")."\">{$arWords['ImFListHeaderPrice']} </a></td>
																	<td><a href=\"javascript:setSortTable('im_prace_sq');\" class=\"".WhatSort("im_prace_sq")."\">{$arWords['ImFListHeaderM2']}</a></td>
																	<td>{$arWords['ImFListHeaderSqPl']} <a href=\"javascript:setSortTable('im_space');\" class=\"".WhatSort("im_space")."\">{$arWords['ImFListHeaderSq']}</a></td>
																	<td>{$arWords['ImFListHeaderRoom']}</td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderMap']}</td>
																	</tr>";
		$ModuleTemplate['buildings_sale_im_list_table_block_bottom'] = "</table>";
		$ModuleTemplate['buildings_sale_im_list_table_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"ListTableImIndexImg\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\"><img src=\"/files/images/immovables/st_#im_photo#\" alt=\"#im_title#\"/></a></td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><div class=\"ImPropTable\">#im_prop_list#</div><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td class=\"TdTextCenter\">#im_prices#</td>
														<td>#im_prace_sq# </td>
														<td>#im_space#</td>
														<td>#4c400ed4e5797#</td>
														<td class=\"TdListRightBorder\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html#YMapsID\">#im_map#</a></td>
														</tr>";	
														
		$ModuleTemplate['buildings_sale_im_list_list_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/<a href=\"javascript:setSortTable('im_adress_id');\" class=\"".WhatSort("im_adress_id")."\">{$arWords['ImFListHeaderStreet']}</a>)</td>
																	<td><a href=\"javascript:setSortTable('im_prace');\" class=\"".WhatSort("im_prace")."\">{$arWords['ImFListHeaderPrice']}</a></td>
																	<td class=\"ImFListHeaderM2\"><a href=\"javascript:setSortTable('im_prace_sq');\" class=\"".WhatSort("im_prace_sq")."\">{$arWords['ImFListHeaderM2']}</a></td>
																	<td>{$arWords['ImFListHeaderSqPl']} <a href=\"javascript:setSortTable('im_space');\" class=\"".WhatSort("im_space")."\">{$arWords['ImFListHeaderSq']}</a> </td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderRoom']}</td>
																	</tr>";
		$ModuleTemplate['buildings_sale_im_list_list_block_bottom'] = "</table>";
		$ModuleTemplate['buildings_sale_im_list_list_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td class=\"TdTextCenter\">#im_prices_ni#</td>
														<td>#im_prace_sq# </td>
														<td>#im_space#</td>
														<td class=\"TdListRightBorder\">#4c400ed4e5797#</td>
														</tr>";	
														
		#		RENT
		
	    $ModuleTemplate['buildings_rent_im_list_table_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td class=\"TdLisImImage\">{$arWords['ImFListHeaderImg']}</td>															
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/<a href=\"javascript:setSortTable('im_adress_id');\" class=\"".WhatSort("im_adress_id")."\">{$arWords['ImFListHeaderStreet']}</a>)</td>
																	<td><a href=\"javascript:setSortTable('im_prace_manth');\" class=\"".WhatSort("im_prace_manth")."\">{$arWords['FormSearchNamePriceManth']} ($)</a></td>
																	<td><a href=\"javascript:setSortTable('im_prace_day');\" class=\"".WhatSort("im_prace_day")."\">{$arWords['FormSearchNamePriceDay']} ($) </a></td>
																	<td>{$arWords['ImFListHeaderSqPl']} <a href=\"javascript:setSortTable('im_space');\" class=\"".WhatSort("im_space")."\">{$arWords['ImFListHeaderSq']}</a></td>
																	<td>{$arWords['ImFListHeaderRoom']}</td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderMap']}</td>
																	</tr>";
		$ModuleTemplate['buildings_rent_im_list_table_block_bottom'] = "</table>";
		$ModuleTemplate['buildings_rent_im_list_table_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"ListTableImIndexImg\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\"><img src=\"/files/images/immovables/st_#im_photo#\" alt=\"#im_title#\"/></a></td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><div class=\"ImPropTable\">#im_prop_list#</div><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td class=\"price-center\">#im_prace_manth# </td>
														<td>#im_prace_day# </td>
														<td>#im_space#</td>
														<td>#4c400ed4e5797#</td>
														<td class=\"TdListRightBorder\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html#YMapsID\">#im_map#</a></td>
														</tr>";	
														
		$ModuleTemplate['buildings_rent_im_list_list_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/<a href=\"javascript:setSortTable('im_adress_id');\" class=\"".WhatSort("im_adress_id")."\">{$arWords['ImFListHeaderStreet']}</a>)</td>
																	<td><a href=\"javascript:setSortTable('im_prace_manth');\" class=\"".WhatSort("im_prace_manth")."\">{$arWords['FormSearchNamePriceManth']}</a></td>
																	<td><a href=\"javascript:setSortTable('im_prace_day');\" class=\"".WhatSort("im_prace_day")."\">{$arWords['FormSearchNamePriceDay']}</a></td>
																	<td>{$arWords['ImFListHeaderSqPl']} <a href=\"javascript:setSortTable('im_space');\" class=\"".WhatSort("im_space")."\">{$arWords['ImFListHeaderSq']}</a> </td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderRoom']}</td>
																	</tr>";
		$ModuleTemplate['buildings_rent_im_list_list_block_bottom'] = "</table>";
		$ModuleTemplate['buildings_rent_im_list_list_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td class=\"price-center\">#im_prace_manth# </td>
														<td>#im_prace_day# </td>
														<td>#im_space#</td>
														<td class=\"TdListRightBorder\">#4c400ed4e5797#</td>
														</tr>";	
														
		/*
		*		LAND LIST PHOTO
		*/
		
		#		SALE
		
		$ModuleTemplate['land_sale_im_list_table_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td class=\"TdLisImImage\">{$arWords['ImFListHeaderImg']}</td>															
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/<a href=\"javascript:setSortTable('im_adress_id');\" class=\"".WhatSort("im_adress_id")."\">{$arWords['ImFListHeaderStreet']}</a>)</td>
																	<td><a href=\"javascript:setSortTable('im_prace');\" class=\"".WhatSort("im_prace")."\">{$arWords['ImFListHeaderPrice']}</a></td>
																	<td class=\"ImFListHeaderM2\"><a href=\"javascript:setSortTable('im_prace_sq');\" class=\"".WhatSort("im_prace_sq")."\">{$arWords['ImFListHeaderSotku']} ($)</a></td>
																	<td>{$arWords['ImFListHeaderSqPl']} <a href=\"javascript:setSortTable('im_space');\" class=\"".WhatSort("im_space")."\">{$arWords['ImFListHeaderSq']}</a> </td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderMap']}</td>
																	</tr>";
		$ModuleTemplate['land_sale_im_list_table_block_bottom'] = "</table>";
		$ModuleTemplate['land_sale_im_list_table_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"ListTableImIndexImg\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\"><img src=\"/files/images/immovables/st_#im_photo#\" alt=\"#im_title#\"/></a></td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><div class=\"ImPropTable\">#im_prop_list#</div><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td class=\"TdTextCenter\">#im_prices#</td>
														<td>#im_prace_sq# </td>
														<td>#im_space#</td>
														<td class=\"TdListRightBorder\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html#YMapsID\">#im_map#</a></td>
														</tr>";													//print_r($_COOKIE);
			
		
		$ModuleTemplate['land_sale_im_list_list_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/<a href=\"javascript:setSortTable('im_adress_id');\" class=\"".WhatSort("im_adress_id")."\">{$arWords['ImFListHeaderStreet']}</a>)</td>
																	<td><a href=\"javascript:setSortTable('im_prace');\" class=\"".WhatSort("im_prace")."\">{$arWords['ImFListHeaderPrice']}</a></td>
																	<td class=\"ImFListHeaderM2\"><a href=\"javascript:setSortTable('im_prace_sq');\" class=\"".WhatSort("im_prace_sq")."\">{$arWords['ImFListHeaderSotku']}</a></td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderSqPl']}  <a href=\"javascript:setSortTable('im_space');\" class=\"".WhatSort("im_space")."\">{$arWords['ImFListHeaderSq']}</a> </td>
																	</tr>";
		$ModuleTemplate['land_sale_im_list_list_block_bottom'] = "</table>";
		$ModuleTemplate['land_sale_im_list_list_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td class=\"TdTextCenter\">#im_prices_ni#</td>
														<td>#im_prace_sq# </td>
														<td>#im_space#</td>
														<td class=\"TdListRightBorder\">#im_date_add#</td>
														</tr>";		
		#		RENT
		
		$ModuleTemplate['land_rent_im_list_table_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td class=\"TdLisImImage\">{$arWords['ImFListHeaderImg']}</td>															
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/<a href=\"javascript:setSortTable('im_adress_id');\" class=\"".WhatSort("im_adress_id")."\">{$arWords['ImFListHeaderStreet']}</a>)</td>
																	<td><a href=\"javascript:setSortTable('im_prace_manth');\" class=\"".WhatSort("im_prace_manth")."\">{$arWords['FormSearchNamePriceManth']}($)</a></td>
																	<td>{$arWords['ImFListHeaderSqPl']} <a href=\"javascript:setSortTable('im_space');\" class=\"".WhatSort("im_space")."\">{$arWords['ImFListHeaderSq']}</a> </td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderMap']}</td>
																	</tr>";
		$ModuleTemplate['land_rent_im_list_table_block_bottom'] = "</table>";
		$ModuleTemplate['land_rent_im_list_table_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"ListTableImIndexImg\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\"><img src=\"/files/images/immovables/st_#im_photo#\" alt=\"#im_title#\"/></a></td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><div class=\"ImPropTable\">#im_prop_list#</div><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td class=\"price-center\">#im_prace_manth# </td>
														<td>#im_space#</td>
														<td>#im_date_add#</td>
														<td class=\"TdListRightBorder\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html#YMapsID\">#im_map#</a></td>
														</tr>";													//print_r($_COOKIE);
			
		
		$ModuleTemplate['land_rent_im_list_list_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/<a href=\"javascript:setSortTable('im_adress_id');\" class=\"".WhatSort("im_adress_id")."\">{$arWords['ImFListHeaderStreet']}</a>)</td>
																	<td><a href=\"javascript:setSortTable('im_prace_manth');\" class=\"".WhatSort("im_prace_manth")."\">{$arWords['FormSearchNamePriceManth']}</a></td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderSqPl']}  <a href=\"javascript:setSortTable('im_space');\" class=\"".WhatSort("im_space")."\">{$arWords['ImFListHeaderSq']}</a> </td>
																	</tr>";
		$ModuleTemplate['land_rent_im_list_list_block_bottom'] = "</table>";
		$ModuleTemplate['land_rent_im_list_list_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td class=\"price-center\">#im_prace_manth# </td>
														<td class=\"TdListRightBorder\">#im_space#</td>
														</tr>";	
														
		/*
		 * 	SEARCH
		 */
		$ModuleTemplate['search_list_table_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block search_list_table\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td>{$arWords['ImFListHeaderImg']}</td>															
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/ {$arWords['ImFListHeaderStreet']})</td>
																	<td>{$arWords['TypeCatImName']}</td>
																	<td>{$arWords['ImFListHeaderPrice']}</td>
																	<td>{$arWords['ImFListHeaderM2Sotku']}</td>
																	<td width=\"50\">{$arWords['FormSearchNamePriceManth']} ($)</td>
																	<td>{$arWords['ImFListHeaderSq']} {$arWords['ImFListHeaderSqPl']}</td>
																	<td>{$arWords['ImSale']}/ {$arWords['ImRent']}</td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderMap']}</td>
																	</tr>";
		$ModuleTemplate['search_list_table_block_bottom'] = "</table>";
		$ModuleTemplate['search_list_table_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"ListTableImIndexImg\"><a href=\"/immovables/#im_link#/1/#im_id#.html\"><img src=\"/files/images/immovables/st_#im_photo#\" alt=\"#im_title#\"/></a></td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p>#im_region_id# #im_a_region_id#<p><b>#im_full_adress#</b></p><div class=\"ImPropTable\">#im_prop_list#</div><a class=\"AReadMore\" href=\"/immovables/#im_link#/1/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td>#im_catalog_id#</td>
														<td class=\"price-center\">#im_prices# </td>
														<td>#im_prace_sq# </td>
														<td>#im_prace_manth# </td>
														<td>#im_space# #im_space_value_id#</td>
														<td>#is_sale##is_rent#</td>
														<td class=\"TdListRightBorder\"><a href=\"/immovables/#im_link#/1/#im_id#.html#YMapsID\">#im_map#</a></td>
														</tr>";													
														
		/*
		 *	user immovables add 
		 */
		
		$ModuleTemplate['im_user_im_add_list_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td>{$arWords['ImFListHeaderImg']}</td>	
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/{$arWords['ImFListHeaderStreet']})</td>
																	<td>{$arWords['TypeCatImName']}</td>	
																	<td>{$arWords['ImFListHeaderPrice']}</td>
																	<td>{$arWords['ImFListHeaderM2Sotku']}</td>
																	<td>{$arWords['ImFListHeaderSqPl']}</td>
																	<td>{$arWords['ImSale']}/ {$arWords['ImRent']}</td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderAction']}</td>
																	</tr>";
		$ModuleTemplate['im_user_im_add_list_block_bottom'] = "</table>";
		$ModuleTemplate['im_user_im_add_list_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"ListTableImIndexImg\"><img src=\"/files/images/immovables/st_#im_photo#\" alt=\"\"/></td>
														<td class=\"TdListLeftAlight\">#im_city_id#/#im_adress_id#/#im_adress_house#<br><a class=\"AReadMore\" href=\"/immovables/#im_link#/1/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td>#im_catalog_id#</td>
														<td class=\"price-center\">#im_prices# </td>
														<td>#im_prace_sq# </td>
														<td>#im_space# #im_space_value_id#</td>
														<td>#is_sale##is_rent#</td>
														<td class=\"TdListRightBorder\">
															<a id=\"\" title=\"{$arWords['im_edit_info']}\" href=\"/user/2imlist/2imedit.html?i=#im_id#\"></span>{$arWords['im_edit_info']}</a>
															<a id=\"\" title=\"{$arWords['im_edit_prop']}\" href=\"/user/2imlist/2imeditprop.html?i=#im_id#\"></span>{$arWords['im_edit_prop']}</a>
															<a id=\"\" title=\"{$arWords['im_edit_img']}\" href=\"/user/2imlist/2imeditimg.html?i=#im_id#\"></span>{$arWords['im_edit_img']}</a>
															<a id=\"\" title=\"{$arWords['im_edit_text']}\" href=\"/user/2imlist/2imeditsum.html?i=#im_id#&l=4c5d58cd3898c\"></span>{$arWords['im_edit_text']}</a>
														</td>
														</tr>";		
		/*
		 * 	SEARCH
		 */
		//
		$ModuleTemplate['im_favorites_list_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td>{$arWords['ImFListHeaderImg']}</td>	
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/{$arWords['ImFListHeaderStreet']})</td>
																	<td>{$arWords['TypeCatImName']}</td>	
																	<td>{$arWords['ImFListHeaderPrice']}</td>
																	<td>{$arWords['ImFListHeaderM2Sotku']}</td>
																	<td>{$arWords['ImFListHeaderSqPl']}</td>
																	<td class=\"TdRightBorder\">{$arWords['ImSale']}/ {$arWords['ImRent']}</td>
																	</tr>";
		$ModuleTemplate['im_favorites_list_block_bottom'] = "</table>";
		$ModuleTemplate['im_favorites_list_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"ListTableImIndexImg\"><img src=\"/files/images/immovables/st_#im_photo#\" alt=\"\"/></td>
														<td class=\"TdListLeftAlight\">#im_city_id#/#im_adress_id#/#im_adress_house#<br><a class=\"AReadMore\" href=\"/immovables/#im_link#/1/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td>#im_catalog_id#</td>
														<td class=\"price-center\">#im_prices# </td>
														<td>#im_prace_sq# </td>
														<td>#im_space# #im_space_value_id#</td>
														<td class=\"TdListRightBorder\">#is_sale##is_rent#</td>
														</tr>";		
		
		$ModuleTemplate['table_one_immovable_block']['sale'] = "<div class=\"DivImOneTitle\"><a href=\"javascript: history.go(-1)\" alt=\"{$arWords[btm_back]}\" title=\"{$arWords[btm_back]}\"><span class=\"ui-icon ui-icon-circle-triangle-w\"></span>{$arWords[btm_back]}</a><span class=\"DivTitleImOneSpan\">#im_title#</span></div><div class=\"DivImOne\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"TableOneImmovableHeder\">
														  <tr>
														    <td class=\"TOIItdPhotoIndex\">
															<a onclick=\"return hs.expand(this)\" href=\"/files/images/immovables/#im_photo#\" class=\"highslide\">
															<img src=\"/files/images/immovables/si_#im_photo#\" alt=\"#im_title#\" title=\"#im_title#\"/>
															</a>
															</td>
														    <td class=\"TOIItdPhotos\">#ImOneConPhotos#</td>
														    <td class=\"TOIItdIminfo\"><div class=\"DivImTableAdressName\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"ImTableAdressName\">#im_adress_table#</table></div><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"ImTablePrice\">#im_price_table#</table>#im_other_price#</td>
														    <td class=\"TOIItdPropStandart\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"TOIITablePropStandartListTr\">#im_last_data##im_prop_standart#</table></td>
														    <td class=\"TOIItdFunctional\"><a id=\"\" href=\"/report_center.php?im_id=#im_id#&lang_id={$_COOKIE[lang_id]}&act=word\" alt=\"{$arWords[SubmitImWord]}\" title=\"{$arWords[SubmitImWord]}\"><img src=\"/files/images/submit/submitWord.png\" alt=\"{$arWords[SubmitImWord]}\" title=\"{$arWords[SubmitImWord]}\"/></a><br/>
															<a id=\"submitPDF\" href=\"/application/topdf/examples/pdf.php?im_id=#im_id#&lang_id={$_COOKIE[lang_id]}\" alt=\"{$arWords[SubmitPdf]}\" target=\"_blank\" title=\"{$arWords[SubmitPdf]}\"><img src=\"/files/images/submit/submitPdf.png\" alt=\"{$arWords[SubmitImPrint]}\" title=\"{$arWords[SubmitPdf]}\"/></a>
															<br/><a id=\"\" href=\"javascript:SendImToFriend(#im_id#);\" alt=\"{$arWords[SubmitImFriend]}\" title=\"{$arWords[SubmitImFriend]}\"><img src=\"/files/images/submit/submitMailFrient.png\" alt=\"{$arWords[SubmitImFriend]}\" title=\"{$arWords[SubmitImFriend]}\"/></a><br/><a id=\"\" href=\"javascript:SetImFavorites(#im_id#, ".($_COOKIE[user_id] ? $_COOKIE[user_id] : 0).");\" alt=\"{$arWords[SubmitImFavorit]}\" title=\"{$arWords[SubmitImFavorit]}\"><img src=\"/files/images/submit/submitFaworit.png\" alt=\"{$arWords[SubmitImFavorit]}\" title=\"{$arWords[SubmitImFavorit]}\"/></a><a id=\"\" href=\"/report_center.php?im_id=#im_id#&lang_id={$_COOKIE[lang_id]}&act=print\" alt=\"{$arWords[SubmitImPrint]}\" target=\"_blank\" title=\"{$arWords[SubmitImPrint]}\"><img src=\"/files/images/submit/submitPrint.png\" alt=\"{$arWords[SubmitImPrint]}\" title=\"{$arWords[SubmitImPrint]}\"/></a>
															
															<script>
                                                                                                                            $(document).keydown(function(objEvent) {       
                                                                                                                                if (objEvent.ctrlKey) {         
                                                                                                                                    if (objEvent.keyCode == 80) {               
                                                                                                                                        objEvent.preventDefault();           
                                                                                                                                        objEvent.stopPropagation();
                                                                                                                                        location.href = '/report_center.php?im_id=#im_id#&lang_id={$_COOKIE[lang_id]}&act=print';
                                                                                                                                        return false;
                                                                                                                                    }           
                                                                                                                                }       
    });
                                                                                                                        </script>
															
															</td>
														
														
														
														
														
														
														  </tr>
														
														
														
														</table>
														<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"TableOneImmovableInfo\">
														<tr>
															<td class=\"TOIItdText\"><h3 class=\"ImSummaryHeader\">{$arWords[ImSummaryHeader]}</h3><div id=\"DivSummaryLang\">#DivSummaryLang#</div><div id=\"DivSummaryTextId\"></div></td>
															<td class=\"TOIItdProp\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"TablePropAdvased\">#im_prop_advaced#</table></td>
														</tr>
														</table>
														<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"TableOneImmovableMapVideo\">
														<tr>
															<td class=\"TOIMVtdMap\"><span id=\"showFullOneMap\"><span>&nbsp;</span>{$arWords['formYMapSearchFullScreenTitle']}</span><div id=\"divYScreen\"><span id=\"hideFullOneMap\">{$arWords['formYMapSearchStrtScreenTitle']}</span><div><a id=\"aShowPanorama\" target=\"_blank\" href=\"\" class=\"AYPanorama\"><span>&nbsp;</span>{$arWords['viewImYPanorama']}</a>#ImOneConMap#<div name=\"YMapsID\" id=\"YMapsID\" style=\"width:500px;height:400px\"></div></div></td>
															<td class=\"TOIMVtdVideo\">
															<div id=\"accordionVideo\">#ImOneConPlan##ImOneConVideo#</div>
															</td>
														</tr>
														</table></div>";

		$ModuleTemplate['table_one_immovable_block']['rent'] = "<div class=\"DivImOneTitle\"><a href=\"javascript: history.go(-1)\" alt=\"{$arWords[btm_back]}\" title=\"{$arWords[btm_back]}\"><span class=\"ui-icon ui-icon-circle-triangle-w\"></span>{$arWords[btm_back]}</a><span class=\"DivTitleImOneSpan\">#im_title#</span></div><div class=\"DivImOne\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"TableOneImmovableHeder\">
														  <tr>
														    <td class=\"TOIItdPhotoIndex\">
															<a onclick=\"return hs.expand(this)\" href=\"/files/images/immovables/#im_photo#\" class=\"highslide\">
															<img src=\"/files/images/immovables/si_#im_photo#\" alt=\"#im_title#\" title=\"#im_title#\"/>
															</a>
															</td>
														    <td class=\"TOIItdPhotos\">#ImOneConPhotos#</td>
														    <td class=\"TOIItdIminfo\"><div class=\"DivImTableAdressName\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"ImTableAdressName\">#im_adress_table#</table></div>
															<div class=\"DivImTablePrice\">#im_prace_manth#</div>#im_other_price#</td>
														    <td class=\"TOIItdPropStandart\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"TOIITablePropStandartListTr\">#im_last_data##im_prop_standart#</table></td>
														    <td class=\"TOIItdFunctional\"><a id=\"\" href=\"/report_center.php?im_id=#im_id#&lang_id={$_COOKIE[lang_id]}&act=word\" alt=\"{$arWords[SubmitImWord]}\" title=\"{$arWords[SubmitImWord]}\"><img src=\"/files/images/submit/submitWord.png\" alt=\"{$arWords[SubmitImWord]}\" title=\"{$arWords[SubmitImWord]}\"/></a><br/>
																												
	<a id=\"TOIItdFunctional\" href=\"/application/topdf/examples/pdf.php?im_id=#im_id#&lang_id={$_COOKIE[lang_id]}\" alt=\"{$arWords[SubmitPdf]}\" target=\"_blank\" title=\"{$arWords[SubmitPdf]}\"><img src=\"/files/images/submit/submitPdf.png\" alt=\"{$arWords[SubmitImPrint]}\" title=\"{$arWords[SubmitPdf]}\"/></a>
															
				
				<br/><a id=\"\" href=\"javascript:SendImToFriend(#im_id#);\" alt=\"{$arWords[SubmitImFriend]}\" title=\"{$arWords[SubmitImFriend]}\"><img src=\"/files/images/submit/submitMailFrient.png\" alt=\"{$arWords[SubmitImFriend]}\" title=\"{$arWords[SubmitImFriend]}\"/></a><br/><a id=\"\" href=\"javascript:SetImFavorites(#im_id#, ".($_COOKIE[user_id] ? $_COOKIE[user_id] : 0).");\" alt=\"{$arWords[SubmitImFavorit]}\" title=\"{$arWords[SubmitImFavorit]}\"><img src=\"/files/images/submit/submitFaworit.png\" alt=\"{$arWords[SubmitImFavorit]}\" title=\"{$arWords[SubmitImFavorit]}\"/></a><a id=\"\" href=\"/report_center.php?im_id=#im_id#&lang_id={$_COOKIE[lang_id]}&act=print\" alt=\"{$arWords[SubmitImPrint]}\" target=\"_blank\" title=\"{$arWords[SubmitImPrint]}\"><img src=\"/files/images/submit/submitPrint.png\" alt=\"{$arWords[SubmitImPrint]}\" title=\"{$arWords[SubmitImPrint]}\"/></a>
												</td>													
														
														  </tr>
														</table>
														
														
														
														<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"TableOneImmovableInfo\">
														<tr>
															<td class=\"TOIItdText\"><h3 class=\"ImSummaryHeader\">{$arWords[ImSummaryHeader]}</h3><div id=\"DivSummaryLang\">#DivSummaryLang#</div><div id=\"DivSummaryTextId\"></div></td>
															<td class=\"TOIItdProp\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"TablePropAdvased\">#im_prop_advaced#</table></td>
														</tr>
														</table>
														<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"TableOneImmovableMapVideo\">
														<tr>
															<td class=\"TOIMVtdMap\"><span id=\"showFullOneMap\"><span>&nbsp;</span>{$arWords['formYMapSearchFullScreenTitle']}</span><div id=\"divYScreen\"><span id=\"hideFullOneMap\">{$arWords['formYMapSearchStrtScreenTitle']}</span><div><a id=\"aShowPanorama\" target=\"_blank\" href=\"\" class=\"AYPanorama\"><span>&nbsp;</span>{$arWords['viewImYPanorama']}</a></div>#ImOneConMap#<div  name=\"YMapsID\"  id=\"YMapsID\" style=\"width:500px;height:400px\"></div></td>
															<td class=\"TOIMVtdVideo\">
															<div id=\"accordionVideo\">#ImOneConPlan##ImOneConVideo#</div>
															</td>
														</tr>
														</table></div>";

		$ModuleTemplate['table_one_immovable_mail_block'] = "<style>table td{padding-bottom:10px; vertical-align:top} img{ margin-right:5px; margin-bottom:5px;}</style><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"800px\">
																<tr>
																	<td align=\"left\">#kode#</td>
																	<td align=\"center\"><img src=\"sid:alfabrok.jpg\" width=\"180\" height=\"120\"/></td>
																	<td align=\"left\">#realtor#</td>
																</tr>												  
																<tr>
																 	<td align=\"left\" width=\"190px\">
																		<img src=\"sid:si_#im_photo#\" alt=\"##\" title=\"\"/>
																	</td>
																<td align=\"left\" width=\"300px\">
																	#im_adress_table#
																	<b style=\"color:#C9A72B; font-size:16px;\">#im_price_table#</b>
																</td>
																<td align=\"left\" width=\"310px\">
																	#im_prop_standart#
																</td>
																</tr>
																<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"800px\">
																	<tr>
																		<td align=\"left\"  width=\"400px\">#summary#</td>
																		<td align=\"left\"  width=\"400px\" style=\"padding-left:15px;\">#im_prop_advaced#</td>
																	</tr>	
																</table>
																<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"800px\">
																	<tr>
																		<td align=\"left\">#img#</td>
																	</tr>
																	<tr>
																		<td align=\"center\"><br>© 2010-2012 www.alfabrok.ua All rights reserved</td>
																	</tr>		
																</table>";
															
	$ModuleTemplate['table_one_immovable_print_block'] = "<style>table td{padding-bottom:10px; vertical-align:top} img{ margin-right:5px; margin-bottom:5px;}</style><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"1024px\">
																<tr>
																	<td align=\"left\">#kode#</td>
																	<td align=\"center\"><img src=\"/files/images/bg/alfabrok.logo.png\"/></td>
																	<td align=\"left\">#realtor#</td>
																</tr>												  
																<tr>
																 	<td align=\"left\">
																		<img src=\"/files/images/immovables/si_#im_photo#\" alt=\"##\" title=\"\"/>
																	</td>
																<td align=\"left\">
																	#im_adress_table#
																	<b style=\"color:#C9A72B; font-size:16px;\">#im_price_table#</b>
																</td>
																<td align=\"left\">
																	#im_prop_standart#
																</td>
																</tr>
																<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"1024px\">
																	<tr>
																		<td align=\"left\"  width=\"50%\">#summary#</td>
																		<td align=\"left\"  width=\"50%\" style=\"padding-left:15px;\">#im_prop_advaced#</td>
																	</tr>	
																</table>
																<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"1024px\">
																	<tr>
																		<td align=\"left\">#img#</td>
																	</tr>
																	<tr>
																		<td align=\"center\"><br>© 2010-2012 www.alfabrok.ua All rights reserved</td>
																	</tr>		
																</table>";
	
	$ModuleTemplate['im_foto_print_list'] = "<img src=\"files/images/immovables/si_#im_photo_id#.#im_file_type#\">";
	$ModuleTemplate['im_foto_mail_list'] = "<img src=\"sid:si_#im_photo_id#.#im_file_type#\">";																	

																
	$ModuleTemplate['table_fotogalery_immovable_block_header'] = "<div class=\"highslide-gallery\">";	
	$ModuleTemplate['table_fotogalery_immovable_block_bottom'] = "</div>";
	$ModuleTemplate['table_fotogalery_immovable_block'] = "<a class=\"highslide\" href=\"/files/images/immovables/#im_photo_id#.#im_file_type#\" onclick=\"return hs.expand(this)\" ><img src=\"/files/images/immovables/s_#im_photo_id#.#im_file_type#\"/></a>";
	$ModuleTemplate['table_plangalery_immovable_block'] = "<a class=\"highslide\" href=\"/files/images/immovables/#im_photo_id#.#im_file_type#\" onclick=\"return hs.expand(this)\" ><img src=\"/files/images/immovables/si_#im_photo_id#.#im_file_type#\"/></a>";
	$ModuleTemplate['table_fotogalery_immovable_mail_block'] = "<img src=\"http://{$_SERVER['HTTP_HOST']}/files/images/immovables/s_#im_photo_id#.#im_file_type#\"/>";
	$ModuleTemplate['table_plangalery_immovable_mail_block'] = "<img src=\"http://{$_SERVER['HTTP_HOST']}/files/images/immovables/si_#im_photo_id#.#im_file_type#\"/>";
	
	
	$ModuleTemplate['div_im_list_ban_block_header'] = "<div class=\"DivListImBan #css_class#\" id=\"\"><h3>#title#</h3>
		<div id=\"linksListBan\">
			<!--<input type=\"radio\" name=\"type_cat\" onchange=\"javascript:SetImLinkPage('sale');\" id=\"type_sale\" value=\"sale\"/><label>{$arWords['ImSale']}</label>
			<input type=\"radio\" name=\"type_cat\" onchange=\"javascript:SetImLinkPage('rent');\" id=\"type_rent\" value=\"rent\"/><label class=\"SpanImFromLityType\">{$arWords['ImRent']}</label>-->
			<span id=\"linkBan-flat\" class=\"AlinkNoActive\" rel=\"flat\" title=\"{$arWords['ImLinkFlat']}\">{$arWords['ImLinkFlat']}</span>
			<span id=\"linkBan-commercial\" class=\"AlinkNoActive\" rel=\"commercial\" title=\"{$arWords['ImLinkCommercial']}\">{$arWords['ImLinkCommercial']}</span>
			<span id=\"linkBan-home\" class=\"AlinkNoActive\" rel=\"home\" title=\"{$arWords['ImLinkHome']}\">{$arWords['ImLinkHome']}</span>
			<span id=\"linkBan-buildings\" class=\"AlinkNoActive\" rel=\"buildings\" title=\"{$arWords['ImLinkBuildings']}\">{$arWords['ImLinkBuildings']}</span>
			<span id=\"linkBan-land\" class=\"AlinkNoActive\" rel=\"land\" title=\"{$arWords['ImLinkLand']}\">{$arWords['ImLinkLand']}</span>
		</div>
		<div id=\"positionListBan\">";
	
	$ModuleTemplate['div_im_list_ban_block_bottom'] = "<div class=\"clear\"></div></div><a  class=\"DivListImBanAViewAll\" href=\"/s_immovables.html?action=#s_im_link#\" title=\"#title#\">{$arWords[ViewAll]}</a></div>";
	$ModuleTemplate['div_im_list_ban_block']		= "<div class=\"DivListImBanIn\" id=\"#im_id#\" rel=\"#im_link#\">
															<div class=\"DivListImBanIm\">
																<a href=\"/immovables/#im_link#/1/#im_id#.html\"  title=\"#im_title#\">
																	<img src=\"http://{$_SERVER['HTTP_HOST']}/files/images/immovables/s_#im_photo#\" alt=\"#im_title#\" title=\"#im_title#\"/>
																</a>
																</div>
															<div class=\"DivListImBanText\">
																<p><a href=\"/immovables/#im_link#/1/#im_id#.html\" title=\"#im_title#\">#im_title#</a></p><span>#im_prace#</span>
															</div>
															</div>";
	
	$ModuleTemplate['div_im_list_hot_block_header'] = "<div class=\"DivListImHot\"><h3>#title#</h3>";
	$ModuleTemplate['div_im_list_hot_block_bottom'] = "<div class=\"clear\"></div><a class=\"DivListImHotAViewAll\" href=\"/s_immovables.html?action=#s_im_link#\" title=\"#title#\">{$arWords[ViewAll]}</a><div class=\"clear\"></div></div>";
	$ModuleTemplate['div_im_list_hot_block']		= "<div class=\"DivListImHotIn\">
																<div class=\"DivListImHotIm\">
																<a href=\"/immovables/#im_link#/1/#im_id#.html\" title=\"##\">
																	<img src=\"http://{$_SERVER['HTTP_HOST']}/files/images/immovables/si_#im_photo#\" alt=\"#im_title#\" title=\"#im_title#\"/>
																</a>
																<span class=\"DivListImHotImSpan\">#im_prace#</span>
																#im_prace_manth#
																</div>
															<div class=\"DivListImHotText\">
																<p><a href=\"/immovables/#im_link#/1/#im_id#.html\"  title=\"#im_title#\">#im_title#</a></p>
															</div>
															</div>";		
															
	$ModuleTemplate['div_stat_site']		= "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"div_table_stat_site\">
	<tr><td class=\"div_table_stat_site_td\">{$arWords[PageStatPosAll]}</td><td> #PageStatPosAll# </td></tr>
	<tr><td>{$arWords[PageStatPosSegodnja]} </td><td> #PageStatPosSegodnja#</td></tr>
	<tr><td>{$arWords[PageStatPosNedely]} </td><td> #PageStatPosNedely#</td></tr>
	<tr><td>{$arWords[PageStatPosMesjac]} </td><td> #PageStatPosMesjac#</td></tr></table>";															

        
        ?>
