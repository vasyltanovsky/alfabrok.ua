<?php
/*
	*		FLAT LIST PHOTO
	*/
	
		#		SALE
		
		$ModuleTemplate['flat_sale_im_list_table_no_sort_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td class=\"TdLisImImage\">{$arWords['ImFListHeaderImg']}</td>															
																	<td>{$arWords['ImFListHeaderSummary']}<br />({$arWords['ImFListHeaderArea']}/{$arWords['ImFListHeaderStreet']})</td>
																	<td>{$arWords['ImFListHeaderPrice']}</td>
																	<td class=\"ImFListHeaderM2\">{$arWords['ImFListHeaderM2']}</td>
																	<td>{$arWords['ImFListHeaderSqPl']}<br />{$arWords['ImFListHeaderSq']}/{$arWords['ImFListHeaderSqLive']}/{$arWords['ImFListHeaderSqKitchen']}</td>
																	<td>{$arWords['ImFListHeaderLavel']}</td>
																	<td>{$arWords['ImFListHeaderRoom']}</td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderMap']}</td>
																	</tr>";
		$ModuleTemplate['flat_sale_im_list_table_no_sort_block_bottom'] = "</table>";
		$ModuleTemplate['flat_sale_im_list_table_no_sort_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"ListTableImIndexImg\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\"><img src=\"/files/images/immovables/st_#im_photo#\" alt=\"#im_title#\"/></a></td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><div class=\"ImPropTable\">#im_prop_list#</div><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td class=\"TdTextCenter\">#im_prices# </td>
														<td>#im_prace_sq#</td>
														<td>#im_space#/#4c4012253a36f#/#4c40122f31138#</td>
														<td>#4c400ea1b5657#/#4c400ec87481e#</td>
														<td>#4c400ed4e5797#</td>
														<td class=\"TdListRightBorder\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html#YMapsID\">#im_map#</a></td>
														</tr>";	
		
		$ModuleTemplate['flat_sale_im_list_list_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/{$arWords['ImFListHeaderStreet']})</td>
																	<td>{$arWords['ImFListHeaderPrice']}</td>
																	<td>{$arWords['ImFListHeaderM2']}</td>
																	<td>{$arWords['ImFListHeaderSqPl']}<br />{$arWords['ImFListHeaderSq']}/{$arWords['ImFListHeaderSqLive']}/{$arWords['ImFListHeaderSqKitchen']}</td>
																	<td>{$arWords['ImFListHeaderLavel']}</td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderRoom']}</td>
																	</tr>";
		$ModuleTemplate['flat_sale_im_list_list_no_sort_block_bottom'] = "</table>";
		$ModuleTemplate['flat_sale_im_list_list_no_sort_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td>#im_prices_ni#</td>
														<td>#im_prace_sq#</td>
														<td>#im_space#/#4c4012253a36f#/#4c40122f31138#</td>
														
														<td>#4c400ea1b5657#/#4c400ec87481e#</td>
														<td class=\"TdListRightBorder\">#4c400ed4e5797#</td>
														</tr>";	
		
		#		RENT
			
		$ModuleTemplate['flat_rent_im_list_table_no_sort_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td class=\"TdLisImImage\">{$arWords['ImFListHeaderImg']}</td>															
																	<td>{$arWords['ImFListHeaderSummary']}<br />({$arWords['ImFListHeaderArea']}/{$arWords['ImFListHeaderStreet']})</td>
																	<td>{$arWords['FormSearchNamePriceManth']}</td>
																	<td>{$arWords['FormSearchNamePriceDay']}</td>
																	<td>{$arWords['ImFListHeaderSqPl']}<br />{$arWords['ImFListHeaderSq']}/{$arWords['ImFListHeaderSqLive']}/{$arWords['ImFListHeaderSqKitchen']}</td>
																	<td>{$arWords['ImFListHeaderLavel']}</td>
																	<td>{$arWords['ImFListHeaderRoom']}</a></td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderMap']}</td>
																	</tr>";
		$ModuleTemplate['flat_rent_im_list_table_no_sort_block_bottom'] = "</table>";
		$ModuleTemplate['flat_rent_im_list_table_no_sort_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"ListTableImIndexImg\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\"><img src=\"/files/images/immovables/st_#im_photo#\" alt=\"#im_title#\"/></a></td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><div class=\"ImPropTable\">#im_prop_list#</div><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td class=\"TdTextCenter\">#im_prace_manth# $</td>
														<td>#im_prace_day# $</td>
														<td>#im_space#/#4c4012253a36f#/#4c40122f31138#</td>
														<td>#4c400ea1b5657#/#4c400ec87481e#</td>
														<td>#4c400ed4e5797#</td>
														<td class=\"TdListRightBorder\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html#YMapsID\">#im_map#</a></td>
														</tr>";	
														
		$ModuleTemplate['flat_rent_im_list_list_no_sort_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</a></td>
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/{$arWords['ImFListHeaderStreet']})</td>
																	<td>{$arWords['FormSearchNamePriceManth']}</td>
																	<td>{$arWords['FormSearchNamePriceDay']}</td>
																	<td>{$arWords['ImFListHeaderSqPl']}<br />{$arWords['ImFListHeaderSq']}</a>/{$arWords['ImFListHeaderSqLive']}/{$arWords['ImFListHeaderSqKitchen']}</td>
																	<td>{$arWords['ImFListHeaderLavel']}</td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderRoom']}</td>
																	</tr>";
		$ModuleTemplate['flat_rent_im_list_list_no_sort_block_bottom'] = "</table>";
		$ModuleTemplate['flat_rent_im_list_list_no_sort_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</td>
														<td>#im_prace_manth# $</td>
														<td>#im_prace_day# $</td>
														<td>#im_space#/#4c4012253a36f#/#4c40122f31138#</td>
														
														<td>#4c400ea1b5657#/#4c400ec87481e#</td>
														<td class=\"TdListRightBorder\">#4c400ed4e5797#</td>
														</tr>";													
		
		/*
		*		COMMERCIAL LIST PHOTO
		*/
		
		#	SALE
		
		$ModuleTemplate['commercial_sale_im_list_table_no_sort_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td class=\"TdLisImImage\">{$arWords['ImFListHeaderImg']}</td>															
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/{$arWords['ImFListHeaderStreet']})</td>
																	<td>{$arWords['ImFListHeaderPrice']}</td>
																	<td>{$arWords['ImFListHeaderM2']}</td>
																	<td>{$arWords['ImFListHeaderSqPl']}<br />{$arWords['ImFListHeaderSq']}/{$arWords['ImFListHeaderSqLive']}</td>
																	<td>{$arWords['ImFListHeaderLavel']}</td>
																	<td>{$arWords['ImFListHeaderRoom']}</td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderMap']}</td>
																	</tr>";
		$ModuleTemplate['commercial_sale_im_list_table_no_sort_block_bottom'] = "</table>";
		$ModuleTemplate['commercial_sale_im_list_table_no_sort_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"ListTableImIndexImg\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\"><img src=\"/files/images/immovables/st_#im_photo#\" alt=\"#im_title#\"/></a></td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><div class=\"ImPropTable\">#im_prop_list#</div><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td class=\"price-center\">#im_prices# </td>
														<td>#im_prace_sq#</td>
														<td>#im_space#/#4c604016208bc#</td>
														<td>#4c4050fc797b1#/#4c404804b576c#</td>
														<td>#4c4050b294c4f#</td>
														<td class=\"TdListRightBorder\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html#YMapsID\">#im_map#</a></td>
														</tr>";	
														
		$ModuleTemplate['commercial_sale_im_list_list_no_sort_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/{$arWords['ImFListHeaderStreet']})</td>
																	<td>{$arWords['ImFListHeaderPrice']}</td>
																	<td>{$arWords['ImFListHeaderM2']}</td>
																	<td>{$arWords['ImFListHeaderSqPl']} {$arWords['ImFListHeaderSq']}/{$arWords['ImFListHeaderSqLive']}</td>
																	<td>{$arWords['ImFListHeaderLavel']}</td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderRoom']}</td>
																	</tr>";
		$ModuleTemplate['commercial_sale_im_list_list_no_sort_block_bottom'] = "</table>";
		$ModuleTemplate['commercial_sale_im_list_list_no_sort_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td>#im_prices_ni#</td>
														<td>#im_prace_sq#</td>
														<td>#im_space#/#4c604016208bc#</td>
														<td>#4c4050fc797b1#/#4c404804b576c#</td>
														<td class=\"TdListRightBorder\">#4c4050b294c4f#</td>
														</tr>";
	
		#	RENT
		
		$ModuleTemplate['commercial_rent_im_list_table_no_sort_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td class=\"TdLisImImage\">{$arWords['ImFListHeaderImg']}</td>															
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/{$arWords['ImFListHeaderStreet']})</td>
																																		<td>{$arWords['FormSearchNamePriceManth']}</a></td>
																	<td>{$arWords['FormSearchNamePriceDay']}</a></td>
																	<td>{$arWords['ImFListHeaderSqPl']}<br />{$arWords['ImFListHeaderSq']}/{$arWords['ImFListHeaderSqLive']}</td>
																	<td>{$arWords['ImFListHeaderLavel']}</td>
																	<td>{$arWords['ImFListHeaderRoom']}</td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderMap']}</td>
																	</tr>";
		$ModuleTemplate['commercial_rent_im_list_table_no_sort_block_bottom'] = "</table>";
		$ModuleTemplate['commercial_rent_im_list_table_no_sort_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"ListTableImIndexImg\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\"><img src=\"/files/images/immovables/st_#im_photo#\" alt=\"#im_title#\"/></a></td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><div class=\"ImPropTable\">#im_prop_list#</div><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td>#im_prace_manth# $</td>
														<td>#im_prace_day# $</td>
														<td>#im_space#/#4c604016208bc#</td>
														<td>#4c4050fc797b1#/#4c404804b576c#</td>
														<td>#4c4050b294c4f#</td>
														<td class=\"TdListRightBorder\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html#YMapsID\">#im_map#</a></td>
														</tr>";	
														
		$ModuleTemplate['commercial_rent_im_list_list_no_sort_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/{$arWords['ImFListHeaderStreet']})</td>
																	<td>{$arWords['FormSearchNamePriceManth']}</td>
																	<td>{$arWords['FormSearchNamePriceDay']}</td>
																	<td>{$arWords['ImFListHeaderSqPl']} {$arWords['ImFListHeaderSq']}/{$arWords['ImFListHeaderSqLive']}</td>
																	<td>{$arWords['ImFListHeaderLavel']}</td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderRoom']}</td>
																	</tr>";
		$ModuleTemplate['commercial_rent_im_list_list_no_sort_block_bottom'] = "</table>";
		$ModuleTemplate['commercial_rent_im_list_list_no_sort_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td>#im_prace_manth# $</td>
														<td>#im_prace_day# $</td>
														<td>#im_space#/#4c604016208bc#</td>
														<td>#4c4050fc797b1#/#4c404804b576c#</td>
														<td class=\"TdListRightBorder\">#4c4050b294c4f#</td>
														</tr>";

		/*
		*		HOME LIST PHOTO
		*/
		
		#	SALE
		
		$ModuleTemplate['home_sale_im_list_table_no_sort_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td class=\"TdLisImImage\">{$arWords['ImFListHeaderImg']}</td>															
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/{$arWords['ImFListHeaderStreet']})</td>
																	<td>{$arWords['ImFListHeaderPrice']}</td>
																	<td>{$arWords['ImFListHeaderM2']}</td>
																	<td>{$arWords['ImFListHeaderSqPl']}<br />{$arWords['ImFListHeaderSq']}/{$arWords['ImFListHeaderSqLive']}</td>
																	<td>{$arWords['ImFListHeaderRoom']}</td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderMap']}</td>
																	</tr>";
		$ModuleTemplate['home_sale_im_list_table_no_sort_block_bottom'] = "</table>";
		$ModuleTemplate['home_sale_im_list_table_no_sort_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"ListTableImIndexImg\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\"><img src=\"/files/images/immovables/st_#im_photo#\" alt=\"#im_title#\"/></a></td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><div class=\"ImPropTable\">#im_prop_list#</div><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td class=\"price-center\">#im_prices# </td>
														<td>#im_prace_sq#</td>
														<td>#im_space#/#4c402f924bc2a#</td>
														<td>#4c402f345c83d#</td>
														<td class=\"TdListRightBorder\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html#YMapsID\">#im_map#</a></td>
														</tr>";													

		$ModuleTemplate['home_sale_im_list_list_no_sort_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/{$arWords['ImFListHeaderStreet']})</td>
																	<td>{$arWords['ImFListHeaderPrice']}</td>
																	<td>{$arWords['ImFListHeaderM2']}</td>
																	<td>{$arWords['ImFListHeaderSqPl']} {$arWords['ImFListHeaderSq']}/{$arWords['ImFListHeaderSqLive']}</td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderRoom']}</td>
																	</tr>";
		$ModuleTemplate['home_sale_im_list_list_no_sort_block_bottom'] = "</table>";
		$ModuleTemplate['home_sale_im_list_list_no_sort_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td>#im_prices_ni#</td>
														<td>#im_prace_sq#</td>
														<td>#im_space#/#4c402f924bc2a#</td>
														<td class=\"TdListRightBorder\">#4c402f345c83d#</td>
														</tr>";	
														
		#	RENT
		
		$ModuleTemplate['home_rent_im_list_table_no_sort_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td class=\"TdLisImImage\">{$arWords['ImFListHeaderImg']}</td>															
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/{$arWords['ImFListHeaderStreet']})</td>
																	<td>{$arWords['FormSearchNamePriceManth']}</td>
																	<td>{$arWords['FormSearchNamePriceDay']}</td>
																	<td>{$arWords['ImFListHeaderSqPl']}<br />{$arWords['ImFListHeaderSq']}/{$arWords['ImFListHeaderSqLive']}</td>
																	<td>{$arWords['ImFListHeaderRoom']}</td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderMap']}</td>
																	</tr>";
		$ModuleTemplate['home_rent_im_list_table_no_sort_block_bottom'] = "</table>";
		$ModuleTemplate['home_rent_im_list_table_no_sort_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"ListTableImIndexImg\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\"><img src=\"/files/images/immovables/st_#im_photo#\" alt=\"#im_title#\"/></a></td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><div class=\"ImPropTable\">#im_prop_list#</div><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td>#im_prace_manth# $</td>
														<td>#im_prace_day# $</td>
														<td>#im_space#/#4c402f924bc2a#</td>
														<td>#4c402f345c83d#</td>
														<td class=\"TdListRightBorder\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html#YMapsID\">#im_map#</a></td>
														</tr>";													

		$ModuleTemplate['home_rent_im_list_list_no_sort_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/{$arWords['ImFListHeaderStreet']})</td>
																	<td>{$arWords['FormSearchNamePriceManth']}</td>
																	<td>{$arWords['FormSearchNamePriceDay']}</td>
																	<td>{$arWords['ImFListHeaderSqPl']} {$arWords['ImFListHeaderSq']}/{$arWords['ImFListHeaderSqLive']}</td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderRoom']}</td>
																	</tr>";
		$ModuleTemplate['home_rent_im_list_list_no_sort_block_bottom'] = "</table>";
		$ModuleTemplate['home_rent_im_list_list_no_sort_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td>#im_prace_manth# $</td>
														<td>#im_prace_day# $</td>
														<td>#im_space#/#4c402f924bc2a#</td>
														<td class=\"TdListRightBorder\">#4c402f345c83d#</td>
														</tr>";		
		/*
		*		BUILDINGS LIST PHOTO
		*/
		
		#		SALE
		
		$ModuleTemplate['buildings_sale_im_list_no_sort_table_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td class=\"TdLisImImage\">{$arWords['ImFListHeaderImg']}</td>															
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/{$arWords['ImFListHeaderStreet']})</td>
																	<td>{$arWords['ImFListHeaderPrice']}</td>
																	<td>{$arWords['ImFListHeaderM2']}</td>
																	<td>{$arWords['ImFListHeaderSqPl']} {$arWords['ImFListHeaderSq']}</td>
																	<td>{$arWords['ImFListHeaderRoom']}</td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderMap']}</td>
																	</tr>";
		$ModuleTemplate['buildings_sale_im_list_no_sort_table_block_bottom'] = "</table>";
		$ModuleTemplate['buildings_sale_im_list_no_sort_table_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_id#</td>
														<td class=\"ListTableImIndexImg\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\"><img src=\"/files/images/immovables/st_#im_photo#\" alt=\"#im_title#\"/></a></td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><div class=\"ImPropTable\">#im_prop_list#</div><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td class=\"price-center\">#im_prices# </td>
														<td>#im_prace_sq#</td>
														<td>#im_space#</td>
														<td>#4c40586e48e5f#</td>
														<td class=\"TdListRightBorder\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html#YMapsID\">#im_map#</a></td>
														</tr>";	
														
		$ModuleTemplate['buildings_sale_im_list_no_sort_list_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/{$arWords['ImFListHeaderStreet']})</td>
																	<td>{$arWords['ImFListHeaderPrice']}</td>
																	<td>{$arWords['ImFListHeaderM2']}</td>
																	<td>{$arWords['ImFListHeaderSqPl']} {$arWords['ImFListHeaderSq']} </td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderRoom']}</td>
																	</tr>";
		$ModuleTemplate['buildings_sale_im_list_no_sort_list_block_bottom'] = "</table>";
		$ModuleTemplate['buildings_sale_im_list_no_sort_list_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td>#im_prices_ni#</td>
														<td>#im_prace_sq#</td>
														<td>#im_space#</td>
														<td class=\"TdListRightBorder\">#4c40586e48e5f#</td>
														</tr>";	
														
		#		RENT
		
	    $ModuleTemplate['buildings_rent_im_list_no_sort_table_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td class=\"TdLisImImage\">{$arWords['ImFListHeaderImg']}</td>															
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/{$arWords['ImFListHeaderStreet']})</td>
																	<td>{$arWords['FormSearchNamePriceManth']}</td>
																	<td>{$arWords['FormSearchNamePriceDay']}</td>
																	<td>{$arWords['ImFListHeaderSqPl']} {$arWords['ImFListHeaderSq']}</td>
																	<td>{$arWords['ImFListHeaderRoom']}</td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderMap']}</td>
																	</tr>";
		$ModuleTemplate['buildings_rent_im_list_no_sort_table_block_bottom'] = "</table>";
		$ModuleTemplate['buildings_rent_im_list_no_sort_table_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"ListTableImIndexImg\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\"><img src=\"/files/images/immovables/st_#im_photo#\" alt=\"#im_title#\"/></a></td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><div class=\"ImPropTable\">#im_prop_list#</div><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td>#im_prace_manth# $</td>
														<td>#im_prace_day# $</td>
														<td>#im_space#</td>
														<td>#4c40586e48e5f#</td>
														<td class=\"TdListRightBorder\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html#YMapsID\">#im_map#</a></td>
														</tr>";	
														
		$ModuleTemplate['buildings_rent_im_list_no_sort_list_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/{$arWords['ImFListHeaderStreet']})</td>
																	<td>{$arWords['FormSearchNamePriceManth']}</td>
																	<td>{$arWords['FormSearchNamePriceDay']}</td>
																	<td>{$arWords['ImFListHeaderSqPl']} {$arWords['ImFListHeaderSq']}</td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderRoom']}</td>
																	</tr>";
		$ModuleTemplate['buildings_rent_im_list_no_sort_list_block_bottom'] = "</table>";
		$ModuleTemplate['buildings_rent_im_list_no_sort_list_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td>#im_prace_manth# $</td>
														<td>#im_prace_day# $</td>
														<td>#im_space#</td>
														<td class=\"TdListRightBorder\">#4c40586e48e5f#</td>
														</tr>";	
														
		/*
		*		LAND LIST PHOTO
		*/
		
		#		SALE
		
		$ModuleTemplate['land_sale_im_list_table_no_sort_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td class=\"TdLisImImage\">{$arWords['ImFListHeaderImg']}</td>															
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/{$arWords['ImFListHeaderStreet']})</td>
																	<td>{$arWords['ImFListHeaderPrice']}</td>
																	<td>{$arWords['ImFListHeaderSotku']}</td>
																	<td>{$arWords['ImFListHeaderSqPl']} {$arWords['ImFListHeaderSq']}</td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderMap']}</td>
																	</tr>";
		$ModuleTemplate['land_sale_im_list_table_no_sort_block_bottom'] = "</table>";
		$ModuleTemplate['land_sale_im_list_table_no_sort_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"ListTableImIndexImg\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\"><img src=\"/files/images/immovables/st_#im_photo#\" alt=\"#im_title#\"/></a></td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><div class=\"ImPropTable\">#im_prop_list#</div><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td class=\"price-center\">#im_prices# </td>
														<td>#im_prace_sq#</td>
														<td>#im_space#</td>
														<td class=\"TdListRightBorder\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html#YMapsID\">#im_map#</a></td>
														</tr>";													//print_r($_COOKIE);
			
		
		$ModuleTemplate['land_sale_im_list_list_no_sort_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/{$arWords['ImFListHeaderStreet']})</td>
																	<td>{$arWords['ImFListHeaderPrice']}</td>
																	<td>{$arWords['ImFListHeaderSotku']}</td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderSqPl']}  {$arWords['ImFListHeaderSq']} </td>
																	</tr>";
		$ModuleTemplate['land_sale_im_list_list_no_sort_block_bottom'] = "</table>";
		$ModuleTemplate['land_sale_im_list_list_no_sort_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td>#im_prices_ni#</td>
														<td>#im_prace_sq#</td>
														<td class=\"TdListRightBorder\">#im_space#</td>
														</tr>";		
		#		RENT
		
		$ModuleTemplate['land_rent_im_list_table_no_sort_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td class=\"TdLisImImage\">{$arWords['ImFListHeaderImg']}</td>															
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/{$arWords['ImFListHeaderStreet']})</td>
																	<td>{$arWords['FormSearchNamePriceManth']}</td>
																	<td>{$arWords['ImFListHeaderSqPl']} {$arWords['ImFListHeaderSq']} </td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderMap']}</td>
																	</tr>";
		$ModuleTemplate['land_rent_im_list_table_no_sort_block_bottom'] = "</table>";
		$ModuleTemplate['land_rent_im_list_table_no_sort_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"ListTableImIndexImg\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\"><img src=\"/files/images/immovables/st_#im_photo#\" alt=\"#im_title#\"/></a></td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><div class=\"ImPropTable\">#im_prop_list#</div><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td>#im_prace_manth# $</td>
														<td>#im_space#</td>
														<td class=\"TdListRightBorder\"><a href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html#YMapsID\">#im_map#</a></td>
														</tr>";													//print_r($_COOKIE);
			
		
		$ModuleTemplate['land_rent_im_list_list_no_sort_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
																<tr class=\"list_Flat_table_block_header\">
																	<td class=\"TdLeftBorder\">{$arWords['ImFListHeaderCode']}</td>
																	<td>{$arWords['ImFListHeaderSummary']}({$arWords['ImFListHeaderArea']}/{$arWords['ImFListHeaderStreet']})</td>
																	<td>{$arWords['FormSearchNamePriceManth']}</td>
																	<td class=\"TdRightBorder\">{$arWords['ImFListHeaderSqPl']}  {$arWords['ImFListHeaderSq']} </td>
																	</tr>";
		$ModuleTemplate['land_rent_im_list_list_no_sort_block_bottom'] = "</table>";
		$ModuleTemplate['land_rent_im_list_list_no_sort_block'] = "<tr>
														<td class=\"TdListLeftBorder\">#im_code#</td>
														<td class=\"TdListLeftAlight\"><p>#im_title#</p><p><b>#im_full_adress#</b></p><a class=\"AReadMore\" href=\"/immovables/{$_GET[1]}/{$_GET['type_cat']}/{$_GET['page']}/#im_id#.html\">{$arWords[REadMore]}</a></td>
														<td>#im_prace_manth# $</td>
														<td class=\"TdListRightBorder\">#im_space#</td>
														</tr>";	
?>