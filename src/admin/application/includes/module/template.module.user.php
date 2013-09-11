<?php
//ttable_cim_page
	$ModuleTemplate['us_list_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"list_Flat_table_block\">
													<tr class=\"list_Flat_table_block_header\">
														<td class=\"TdLeftBorder\">{$arWords['user_table_subs_date']}</td>
														<td>{$arWords['TypeCatImName']}</td>															
														<td>{$arWords['ImSale']}</td>
														<td>{$arWords['ImRent']}</td>
														<td class=\"TdRightBorder\"></td>
													<tr>";	
	$ModuleTemplate['us_list_block_bottom'] = "</table>";
	$ModuleTemplate['us_list_block'] =  "<tr>
											<td class=\"TdListLeftBorder TdSubsListDate\">#us_date#</td>
											<td class=\"TdSubsListCatalog\">#us_im_catalog#</td>
											<td>#us_im_is_rent#</td>
											<td>#us_im_is_sale#</td>
											<td class=\"TdListRightBorder TdSubsListDell\"><a href=\"javascript:DellSubsId(#us_id#);\" class=\"UAddSome\" ><span class=\"ui-icon ui-icon-trash\"></span>{$arWords['user_btm_subs_dell']}</a></td>
										</tr>";	
?>