<?php
/*
	 * функцыя формирует код сертификата исходя из следущего АЙДИ таблицы certificate 
	 */
function FormarionCertifCode($NextVal, $lenght_code) {
	if ($sl = strlen ( $NextVal )) {
		$ret = NULL;
		for($i = 0; $i < ($lenght_code - $sl); $i ++) {
			$ret .= "0";
		}
		return $ret . $NextVal;
	}
	return;
}

#	функция формирует списов возможный родителей, справочник меню
function sel_parent_standart($arr, $sel = 'NULL', $name_id = 'sc_id', $echo_id = 'menu_words') {
	$str = NULL;
	for($i = 0; $i < count ( $arr ); $i ++) {
		$selecteOption = NULL;
		if ($sel) {
			if ($sel == $arr [$i] [$name_id])
				$selecteOption = "selected=\"selected\"";
		}
		
		$str .= "<option {$selecteOption} value=\"{$arr[$i][$name_id]}\">{$arr[$i][$echo_id]}</option>";
	
	}
	return $str;
}

function BuildJSNextLevelArray($ArrF, $ArrN) {
	$ArrJS = "";
	for($i = 0; $i < count ( $ArrF ); $i ++) {
		$ArrJS .= "JSArray['{$ArrF[$i]['id']}'] = new Array();";
		$ArrJS .= "JSArray['{$ArrF[$i]['id']}'][0] = new Array();";
		$ArrJS .= "JSArray['{$ArrF[$i]['id']}'][0]['name'] = \"-\";";
		$ArrJS .= "JSArray['{$ArrF[$i]['id']}'][0]['id'] = \"0\";";
		$ArrJS .= JSINArray ( $ArrF, $ArrN, $i );
	}
	return $ArrJS;
}

/*
	 * 
	 */
function JSINArray($ArrF, $ArrN, $id) {
	$j = 1;
	$return = "";
	for($i = 0; $i < count ( $ArrN ); $i ++) {
		if ($ArrN [$i] ['brand_id'] == $ArrF [$id] ['id']) {
			$return .= "JSArray['{$ArrF[$id]['id']}'][{$j}] = new Array();";
			$return .= "JSArray['{$ArrF[$id]['id']}'][{$j}]['name'] = \"{$ArrN[$i]['name']}\";";
			$return .= "JSArray['{$ArrF[$id]['id']}'][{$j}]['id'] = \"{$ArrN[$i]['id']}\";";
			$j ++;
		}
	}
	return $return;
}
?>