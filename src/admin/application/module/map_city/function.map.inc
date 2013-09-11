<?php
/* Функция: 
    * @param 
    * @return 
    */
function BuildMapCityArea($BuildDictArray, $ClDict, $Coordinat) {
	global $arWords;
	global $ModuleTemplate;
	
	$ModuleSite = new ModuleSite ( $ModuleTemplate, $arWords );
	#строим checkbox
	$ReturnMapInput = BuildMapInput ( $BuildDictArray [15], 4 );
	#
	$arr = $BuildDictArray [13];
	for($i = 0; $i < count ( $arr ); $i ++) {
		if ($arr [$i] ['dict_have_image']) {
			#
			$DivListAreaActive [$arr [$i] ['parent_id']] .= $ModuleSite->For_HTML ( $ModuleTemplate ['DivListAreaActive_position'], $arr [$i] );
			#
			if (isset ( $Coordinat ['ac_' . $arr [$i] ['dict_id']] ))
				$arr [$i] ['coords'] = $Coordinat ['ac_' . $arr [$i] ['dict_id']];
			else
				$arr [$i] ['coords'] = '';
			$ListArea [$arr [$i] ['parent_id']] .= $ModuleSite->For_HTML ( $ModuleTemplate ['ListArea_position'], $arr [$i] );
			#
			$arr [$i] ["list_input"] = $ReturnMapInput [$arr [$i] ['dict_id']];
			$DivViewFormArea_position .= $ModuleSite->For_HTML ( $ModuleTemplate ['DivViewFormArea_position'], $arr [$i] );
		}
	}
	#
	$arr = $BuildDictArray [12];
	for($i = 0; $i < count ( $arr ); $i ++) {
		if ($arr [$i] ['dict_have_image']) {
			$arr [$i] ['DivListAreaActive'] = $DivListAreaActive [$arr [$i] ['dict_id']];
			$arr [$i] ['ListArea'] = $ListArea [$arr [$i] ['dict_id']];
			$return .= $ModuleSite->For_HTML ( $ModuleTemplate ['tem_map_city_html'], $arr [$i] );
		}
	}
	return $return . '<div id="DivViewFormAreaListAll">' . $DivViewFormArea_position . "</div>";
}
/* Функция: 
	    * @param 
	    * @return 
	    */
function BuildMapInput($Arr, $name_i) {
	$countReturnI = array ();
	for($i = 0; $i < count ( $Arr ); $i ++) {
		$countReturnI [$Arr [$i] ['parent_id']] ++;
		$return [$Arr [$i] ['parent_id']] .= "<input id=\"{$Arr[$i]['dict_id']}_{$name_i}\" value=\"1\" name=\"{$Arr[$i]['dict_id']}_{$name_i}\" type=\"checkbox\"/>  {$countReturnI[$Arr[$i]['parent_id']]}. {$Arr[$i][dict_name]}<br/>";
	
	}
	return $return;
}
/* Функция: 
    * @param 
    * @return 
    */
function FormSelectCity($arr) {
	if (empty ( $arr ))
		return;
	$return = "<select class=\"MapFormSelect\" id=\"MapFormCityIm\" name=\"MapFormCityIm\">";
	$checked = "checked=\"checked\"";
	for($i = 0; $i < count ( $arr ); $i ++) {
		if ($arr [$i] ['dict_have_image']) {
			$return .= "<option {$checked} value=\"{$arr[$i]['dict_id']}'_2\">{$arr[$i]['dict_name']}</option>";
			$checked = NULL;
		}
	}
	return $return . "</select>";
}

?>