<?php
/* Функция:	формирует строку улиц
 *
 * @param $arr - имя поля
 * @return ret;
 */
function GetAdressString($arr, $dict) {
	if (empty ( $arr ))
		return;
	for($i = 0; $i < count ( $arr ); $i ++) {
		$ret .= '"' . $dict->buld_table [$arr [$i] [0]] ['dict_name'] . '", ';
	}
	return '[' . substr ( $ret, 0, (strlen ( $ret ) - 2) ) . '];';
}

/* Функция:	формирует минимальное и максималное значение для слайдера
 *
 * @param $NameField - имя поля
 * @param $CookieDataValue - выбранное значение
 * @param $DefaultValue - стандартное значение
 * @return ret;
 */
function SlideValue($NameField, $CookieDataValue, $DefaultValue) {
	$Min = $MinV = $DefaultValue [0];
	$Max = $MaxV = $DefaultValue [1];
	if (! empty ( $CookieDataValue )) {
		$MinV = substr ( $CookieDataValue, 0, (strpos ( $CookieDataValue, '-' ) - 1) );
		$MaxV = substr ( $CookieDataValue, (strpos ( $CookieDataValue, '-' ) + 1), strlen ( $CookieDataValue ) );
	}
	return "min: {$Min}, max: {$Max}, values: [{$MinV}, {$MaxV}],";
}

/* Функция: сортирует и формирует Div и Fieldset в зависимости от дерева справочника
 *
 * @param $BuildResult - сформировованный древовидный массив справочника
 * @param $dict - класс стравичника
 * @return $return - отсортированый массив
 */
function BuildFieldset($BuildResult, $dict, $CookieData = NULL) {
	$ArrDiv = array ();
	for($i = 0; $i < count ( $BuildResult ); $i ++) {
		if ($BuildResult [$i] [2] == 0)
			$ArrDiv [$BuildResult [$i] [2] . "_d"] .= BuildCheck ( $BuildResult [$i], $dict, $CookieData . $BuildResult [$i] [1] );
		else
			$ArrDiv [$BuildResult [$i] [2] . "_d"] [$BuildResult [$i] [1] . "_f"] .= BuildCheck ( $BuildResult [$i], $dict, $CookieData, $BuildResult [$i] [1] );
	}
	return $ArrDiv;
}
global $ListCheckedDictForSearch;
/* Функция: строит эл. checkbox для формы
 *
 * @param $id - айди сформировованого древовидный массива
 * @param $dict - класс стравичника
 * @return $return - эл. checkbox для формы
 */
function BuildCheck($id, $dict, $Cookie = NULL, $fieldset = "") {
	$checked = '';
	global $ListCheckedDictForSearch;
	
	if ($Cookie) {
		if (isset ( $Cookie [$id [0] . '_' . $id [2]] )) {
			$checked = "checked=\"checked\"";
			$ListCheckedDictForSearch [$id [2]] .= "<div id=\"checked_group_item_{$id[0]}\"><input value=\"1\" {$checked} name=\"{$id[0]}_{$id[2]}\" id=\"{$id[0]}\" rel=\"{$fieldset}\" onchange=\"javascript:setCheckbox('{$id[0]}');\"  type=\"checkbox\"/>{$dict->buld_table[$id[0]][dict_name]}</div>";
			return NULL;
		}
	}
	#проерка чтобы не выводить пункт, подкаталога "области области"
	if ($id [0] != '4c496bd58da0d')
		return "<div id=\"checked_group_item_{$id[0]}\"><input value=\"1\" name=\"{$id[0]}_{$id[2]}\" id=\"{$id[0]}\" onchange=\"javascript:setCheckbox('{$id[0]}');\" rel=\"{$fieldset}\"  type=\"checkbox\"/>{$dict->buld_table[$id[0]][dict_name]}</div>";
	else
		return NULL;
}
/* Функция: строит эл. checkbox для формы
 *
 * @param $DivId - айди отсортированого массива
 * @param $arr - отсортированый массив
 * @return $return - html код
 */
function PrintStandartFormDiv($DivId, $arr) {
	$return = "<div id=\"{$DivId}\" class=\"DivSearchPosition\">";
	if (substr ( $DivId, 0, 1 ) == 0)
		$return .= "<fieldset id=\"0\">{$arr[$DivId]}</fieldset>";
	else {
		if (is_array ( $arr [$DivId] )) {
			foreach ( $arr [$DivId] as $key => $value ) {
				$return .= "<fieldset id=\"{$key}\">{$value}</fieldset>";
			}
		}
	}
	return $return .= "</div>";

}

/* Функция:
 *
 * @param $BuildResult -
 * @return $return - html код
 */
function BuildJScriptArrays($BuildResult, $Cookie) {
	$DictDiv = "var DictDiv = Array();"; // массив айди div
	$DivDictShow = "var DivDictShow = Array();"; // массив айди fieldset отображения
	$GetArray = "var GetArray = Array();"; //массив айди передаваеммые значений
	$NowDictId = $BuildResult [0] [1];
	$Arrdds [1] = - 1;
	$dds [2] = - 1;
	$dds [3] = - 1;
	$dds [4] = - 1;
	$dds [5] = - 1;
	$ArrddsIsset = array ();
	for($i = 0; $i < count ( $BuildResult ); $i ++) {
		$dds = $BuildResult [$i] [2] + 1; //айди div
		if (! in_array ( $dds, $ArrddsIsset )) {
			$ArrddsIsset [$dds] = $dds; //новый под массив массива
			$Arrdds [$dds] = - 1;
			$DivDictShow .= "DivDictShow['{$dds}_d'] = new Array();";
		}
		$Arrdds [$dds] ++; //счетчик $j
		

		//по дефолту в multiple отображаеться области, обласные центры, и позиции обласных центров
		$is_show = 0;
		if (($dds == 0) or ($BuildResult [$i] [0] == '4c496bd58da0d') or ($BuildResult [$i] [1] == '4c496bd58da0d'))
			$is_show = 1;
		
		if ($Cookie) {
			if (strpos ( $Cookie, $BuildResult [$i] [0] )) {
				$is_show = 1;
			}
		}
		
		$DivDictShow .= "DivDictShow['{$dds}_d'][{$Arrdds[$dds]}] = new Array();";
		$DictDiv .= "DictDiv['{$BuildResult[$i][0]}'] = '{$dds}_d';";
		$DivDictShow .= "DivDictShow['{$dds}_d'][{$Arrdds[$dds]}]['dict_id'] = '{$BuildResult[$i][0]}';";
		$DivDictShow .= "DivDictShow['{$dds}_d'][{$Arrdds[$dds]}]['is_show'] = 1;";
		//{$is_show};
		$GetArray .= "GetArray['{$BuildResult[$i][0]}'] = '';";
	}
	return $DictDiv . "" . $DivDictShow . "" . $GetArray;
}
global $globalRegionalSearchBlock;