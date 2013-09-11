<?php
$ZpFormInc = 'formEdit.js';
require_once '../utils/template.ajax/js.css.php';
?>
<?php

# 	Риэлторы
$rieltorsData = new mysql_select ( "system_accounts", "where type <> '4f4b95785a8c4'", "ORDER BY id_account" );
$rieltorsData->select_table ( "id_account" );

#объявляем класс словаря
$dictionaries = new dictionaries ();
#формируем массив имени словарей
$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries );
#формируем массив значений словарей
$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = {$_COOKIE[lang_id]}", "ORDER BY dict_name ASC" );
# 	айди каталога недвижимости(словарь)
$dictionaries->do_dictionaries ( 17 );
$im_catalog_id_add = $dictionaries->my_dct;
#	айди область(сл)
$dictionaries->do_dictionaries ( 11 );
$im_region_id_add = $dictionaries->my_dct;
#	айди массив города(сл)
$dictionaries->do_dictionaries ( 15 );
$im_array_id_add = $dictionaries->my_dct;
#район области (айди)
$dictionaries->do_dictionaries ( 24 );
$im_a_region_add = $dictionaries->my_dct;
#айди город(сл)
$dictionaries->do_dictionaries ( 12 );
$im_city_id_add = $dictionaries->my_dct;
#айди район города(сл)
$dictionaries->do_dictionaries ( 13 );
$im_area_id_add = $dictionaries->my_dct;
#айди адресс(словарь) улица
$dictionaries->do_dictionaries ( 14 );
$im_adress_id_add = $dictionaries->my_dct;
#айди измирение площади(словарь)
$dictionaries->do_dictionaries ( 54 );
$im_space_value_id_add = $dictionaries->my_dct;
#айди измирение площади(словарь)
$dictionaries->do_dictionaries ( 22 );
$im_sale_id_add = $dictionaries->my_dct;

$ImDataOneClass = new mysql_select ( $tbl_im );

$codes = array();
$codes['4c3ec3ec5e9b5'] = "K";
$codes['4c3ec3ec5e9b7'] = "C";
$codes['4c3ec51d537c0'] = "H";
$codes['4c3ec51d537c2'] = "M";
$codes['4c3ec51d537c3'] = "T";

$lastId = array();

foreach($codes as $key => $code)
{
	$ImDataOne = $ImDataOneClass->select_table_query ( "SELECT CONVERT(SUBSTR(im_code, 2), UNSIGNED) id FROM `immovables` WHERE im_catalog_id = '".$key."' ORDER BY CONVERT(SUBSTR(im_code, 2), UNSIGNED)" );
	for($i = 0; $i < count($ImDataOne); $i++)
	{
		if ($i == count($ImDataOne) - 1 || $ImDataOne[$i][id] + 1 < $ImDataOne[$i + 1][id])
		{
			$lastId[$code] = $ImDataOne[$i]['id'] + 1;
			break;
		} 
	}
}
#	функция формирует списов возможный родителей, справочник меню
function sel_parent_id($arr, $arr_build, $sel = 'NULL', $name_id = 'pc_id', $echo_id = 'menu_words') {
	$str = NULL;
	for($i = 0; $i < count ( $arr ); $i ++) {
		$paddingLeft = $arr [$i] [2] * 10;
		$selecteOption = NULL;
		if ($sel)
			if ($sel == $arr [$i] [$name_id])
				$selecteOption = "selected=\"selected\"";
		$str .= "<option {$selecteOption} value=\"{$arr[$i][$name_id]}\" style=\"padding-left:{$paddingLeft}px!important\">{$arr_build[$arr[$i][$name_id]][$echo_id]}</option>";
	}
	return $str;
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
?>
<?php

$cp_id = uniqid ();
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#tabsDmnImmovable").tabs();
	window.lastId = <?php echo json_encode($lastId); ?>;
});

//	page dialog hide
function hide_ajax_div() {
	location.href = location.search;
}
function myOnFunctionAddImg() {
	var outputDiv = document.getElementById("errOutput");
	if(outputDiv != null){
		outputDiv.innerHTML = '';//clear error message if any
		outputDiv.style.display = "none";
	}
	$.prompt('Добавление товара выполнено успешно.');
	//$('#DivRequestImg').load('template.add/form.add.img.php?cp_id=<?php echo $cp_id;?>&new_position=true');
}
</script>
<!--<script type='text/javascript' src='template.edit/demo.js'></script>-->
<div id="dialog-page-body"></div>
<div id="d-dialog">
  <div id="d-dialog-in">
    <table class="t-dialog">
      <tr>
        <td class="td-dialog-close"><a href="#" class="a-dialog-close" onclick="hide_ajax_div();">
          <h3 class="a-h3-dialog-close">закрыть</h3>
          </a></td>
      </tr>
      <tr>
        <td class="td-dialog-form">
        	<div id="d-overflow">
	            <div id="tabsDmnImmovable">
	            	<ul>
	                	<li><a href="#Dtabs-1">Недвижимость</a></li>
	              	</ul>
	              	<div id="Dtabs-1">
	                	<div id="DivRequestImg"></div>
	                	<?php 
	                		#	подключение формы для редактирования
						  	include_once("template.add/form.page.php");
				    	?>
	              	</div>
	            </div>
	        </div>
          </td>
      </tr>
    </table>
  </div>
</div>
<!-- ДОБАВЛЕНИЕ ПОЗИЦИИ -->
