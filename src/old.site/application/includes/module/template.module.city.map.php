<?php
if (strpos($_SERVER['REQUEST_URI'], '?')) {
	$IMHLoc = substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '?') + 1);
}
else {
	$IMHLoc = '/immovables/'.$_GET[1].'/'.$_GET[type_cat].'.html?';
}
$ModuleTemplate['template_table_index_page_map'] = 
		  "<table class=\"TableIndexMap\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
		  <tr>
		  <td class=\"TdTableIndexMapH\"><h3 class=\"TableIndexMapH\">#SearchMapTitle#</h3></td>
		  <td class=\"TdTableIndexMapRentSale\">#RentSale#</td>
		  <td class=\"TdTableIndexMapCityTypeIm\">#City##TypeIm#</td>
		  </tr>
		  <tr><td colspan=\"3\" class=\"TdIndexMap\"><form id=\"MapSearchFormIm\" name=\"MapSearchFormIm\" enctype=\"application/x-www-form-urlencoded\" action=\"\" method=\"get\"><div id=\"DivMap\" class=\"DivMap\">#maps#</div><div class=\"clear\"></div><input type=\"hidden\" name=\"SearchImCode\" value=\"".time()."\"/><input type=\"hidden\" name=\"action\" value=\"ImFormSearch\"/></form></td></tr>
		  <tr><td colspan=\"3\" class=\"TdIndexMapBtmSearchMap\"><a href=\"javascript:BtmSearchMap();\" alt=\"{$arWords['SearchBottom']}\" title=\"{$arWords['SearchBottom']}\" class=\"DivViewFormAreaA\" id=\"BtmSearchMap\"><span class=\"ui-icon ui-icon-search\"></span>{$arWords['SearchBottom']}</a></td></tr>
		  </tr>
		  </table>";
		  
$ModuleTemplate['template_table_im_page_map'] = 
		  "<table class=\"TableIndexMap\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
		  <tr>
		  <td class=\"TdTableIndexMapCityTypeIm\">#City#</td>
		  </tr>
		  <tr><td colspan=\"3\" class=\"TdIndexMap\"><form id=\"MapSearchFormIm\" name=\"MapSearchFormIm\" enctype=\"application/x-www-form-urlencoded\" action=\"\" method=\"get\"><div id=\"DivMap\" class=\"DivMap\">#maps#</div><div class=\"clear\"></div><input type=\"hidden\" name=\"SearchImCode\" value=\"".time()."\"/><input type=\"hidden\" name=\"action\" value=\"ImFormSearch\"/></form></td></tr>
		  <tr><td colspan=\"3\" class=\"TdIndexMapBtmSearchMap\"><input type=\"hidden\" id=\"IMHLoc\" name=\"IMHLoc\" value=\"{$IMHLoc}\"/><a href=\"javascript:BtmSearchMapImPage();\" alt=\"{$arWords['SearchBottom']}\" title=\"{$arWords['SearchBottom']}\" class=\"DivViewFormAreaA\" id=\"BtmSearchMap\"><span class=\"ui-icon ui-icon-search\"></span>{$arWords['SearchBottom']}</a></td></tr>
		  </tr>
		  </table>";
		  							
$ModuleTemplate['tem_map_city_html'] = 							
		  "<div id=\"c_#dict_id#\">
				  <!-- CITYS BG -->
				  <div class=\"DivMapImgCityBg\">
					  <img src=\"/files/images/dict/#dict_id#.png\" width=\"391\" height=\"400\" border=\"0\" alt=\"dict_name\" title=\"#dict_name#\" />
				  </div>
				  <!-- CITYS AREAS IMG -->
				  <div class=\"DivListAreaActive\" id=\"DivListAreaActive_#dict_id#\">
					  #DivListAreaActive#
				  </div>
				  <!-- AREAS MOUSE AREA -->
				  <div class=\"DivMapAreasMouse\" id=\"DivMapAreasMouse_#dict_id#\">
					  <img src=\"/files/images/dict/m_#dict_id#_{$_COOKIE[lang_code]}.png\" width=\"391\" height=\"400\" border=\"0\" usemap=\"#m_#dict_id#\" />
					  <map name=\"m_#dict_id#\" id=\"m_#dict_id#\">
						#ListArea#
				</div>
			  </div>";
						
$ModuleTemplate['DivListAreaActive_position'] = 
		"<img src=\"/files/images/dict/#dict_id#.png\" id=\"i_aa_#dict_id#\" width=\"391\" height=\"400\" alt=\"dict_name\" title=\"#dict_name#\"/>";
$ModuleTemplate['ListArea_position'] = 
		"<area id=\"#dict_id#\" onMouseOver=\"javascript:onfocusArrayCity('#dict_id#', '#parent_id#');\" title=\"#dict_name#\" shape=\"poly\" coords=\"#coords#\" href=\"javascript:onclickArrayCity('#dict_id#', '#parent_id#');\" />";

$ModuleTemplate['DivViewFormArea_position'] = 
		"<div id=\"DivViewFormArea_#dict_id#\" class=\"DivViewFormArea\" style=\"background:url(../../../files/images/dict/v_#dict_id#.png) top right no-repeat\">
        	<h3><input value=\"1\" id=\"#dict_id#_4\" name=\"#dict_id#_4\" onchange=\"javascript:chechedAllCheckboxAreas('#dict_id#');\"  type=\"checkbox\"/>#dict_name#</h3>
        	<div class=\"DivViewFormAreaListChecked\">#list_input#</div>
            <a class=\"DivViewFormAreaA\" title=\"{$arWords['VubratEwe']}\" alt=\"{$arWords['VubratEwe']}\" href=\"javascript: HideArrayShowCity('#dict_id#', '#parent_id#');\"><span class=\"ui-icon ui-icon-check\"></span>{$arWords['VubratEwe']}</a>
        </div>";
?>