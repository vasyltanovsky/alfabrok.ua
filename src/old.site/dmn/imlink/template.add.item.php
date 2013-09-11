<?php require_once '../utils/template.ajax/js.css.php';?>
<?php 
		#объявляем класс словаря
		$dictionaries = new dictionaries();
		#формируем массив имени словарей
		$dct_list 	=	$dictionaries->buid_dictionaries_list($tbl_list_dictionaries);
		#формируем массив значений словарей
		$dct		=	 $dictionaries->buid_dictionaries($tbl_dictionaries,
									 	 				 "WHERE lang_id = $_COOKIE[lang_id]");
		
		# 	айди каталога недвижимости(словарь)
		$dictionaries->do_dictionaries(17);
		$im_catalog_id_add	 = $dictionaries->my_dct;
		#	айди область(сл)
		$dictionaries->do_dictionaries(11);
		$im_region_id_add	 = $dictionaries->my_dct;
		#	айди массив города(сл)
		$dictionaries->do_dictionaries(15);
		$im_array_id_add	 = $dictionaries->my_dct;
		#район области (айди)
		$dictionaries->do_dictionaries(24);
		$im_a_region_add	 = $dictionaries->my_dct;
		#айди город(сл)
		$dictionaries->do_dictionaries(12);
		$im_city_id_add	 = $dictionaries->my_dct;		
		#айди район города(сл)
		$dictionaries->do_dictionaries(13);
		$im_area_id_add	 = $dictionaries->my_dct;	
		#айди адресс(словарь) улица
		$dictionaries->do_dictionaries(14);
		$im_adress_id_add = $dictionaries->my_dct;
  		#айди измирение площади(словарь)
		$dictionaries->do_dictionaries(54);
		$im_space_value_id_add	 = $dictionaries->my_dct;
		#айди измирение площади(словарь)
		$dictionaries->do_dictionaries(22);
		$im_sale_id_add	 = $dictionaries->my_dct;
		
		$im_catalog_id_add[0]['dict_id']	= "flat";
		$im_catalog_id_add[0]['dict_name'] 	= "Квартиры";
		$im_catalog_id_add[1]['dict_id'] 	= "commercial";
		$im_catalog_id_add[1]['dict_name'] 	= "Коммерческая недвижимость";
		$im_catalog_id_add[2]['dict_id'] 	= "home";
		$im_catalog_id_add[2]['dict_name'] 	= "Коттеджи. Дома. Дачи.";
		$im_catalog_id_add[3]['dict_id'] 	= "buildings";
		$im_catalog_id_add[3]['dict_name'] 	= "ОСЗ. Здания.";
		$im_catalog_id_add[4]['dict_id'] 	= "land";
		$im_catalog_id_add[4]['dict_name'] 	= "Земельные участки"; 
		
		$BuildResult = array_merge_recursive($im_region_id_add, $im_array_id_add, $im_a_region_add, $im_city_id_add, $im_area_id_add);
		#строим дерево каталога
		$BuildResult = $dictionaries->BuildArrayParentChild($BuildResult);
		
	#	функция формирует списов возможный родителей, справочник меню
		
		function sel_parent_standart($arr, $sel = 'NULL', $name_id = 'sc_id', $echo_id = 'menu_words', $is_function = NULL)
		{
			$ArrStr = array();
			$option_func = NULL;
			for($i=0; $i<count($arr); $i++) {
				if ($is_function) {	$option_func = "onchange=\"javascript:showNextLevel('{$arr[$i][$name_id]}');\"";}
				$selecteOption = '';
				if($sel) if($sel == $arr[$i][$name_id]) $selecteOption = "selected=\"selected\"";
				$return .= "<option class=\"d_{$arr[$i]['parent_id']}\" {$selecteOption} value=\"{$arr[$i][$name_id]}\">{$arr[$i][$echo_id]}</option>";
			}
			return $return;
		}
		
			//echo "<pre>";
			//print_r($BuildResult);
			//echo "</pre>";
			
			
		function BuildJSNextLevelArray($Arr, $Dict) {
			for($i=0; $i<count($Arr); $i++) {
				$ArrJS .= "JSArray['{$Arr[$i][0]}'] = new Array();";
				$ArrJS .= "JSArray['{$Arr[$i][0]}'][0] = new Array();";
				$ArrJS .= "JSArray['{$Arr[$i][0]}'][0]['name'] = \"-\";";	
				$ArrJS .= "JSArray['{$Arr[$i][0]}'][0]['id'] = \"0\";";
				$ArrJS .= JSINArray($Arr, $Dict, $Arr[$i][0]);
			}
			return $ArrJS;
		}
		//echo BuildJSNextLevelArray($BuildResult, $dictionaries);
	 function JSINArray($Arr, $dict, $id) {
	 	$j=1;
	 	$return = "";
	 	for($i=0; $i<count($Arr); $i++) {
	 		if($Arr[$i][1]== $id) {
	 			$return .= "JSArray['{$Arr[$i][1]}'][{$j}] = new Array();";
	 			$return .= "JSArray['{$Arr[$i][1]}'][{$j}]['name'] = \"{$dict->buld_table[$Arr[$i][0]][dict_name]}\";";
	 			$return .= "JSArray['{$Arr[$i][1]}'][{$j}]['id'] = \"{$Arr[$i][0]}\";";
	 			$j++;
	 		}
	 	}
		return $return;
	 }
	 
		
?>
<script type="application/javascript">
$(document).ready(function() {
	showNextLevel('im_a_region_id', '4c3eb33182810');
	showNextLevel('im_area_id', '4c3eb839f144e');
	//showNextLevel();
	
});
function showNextLevel (id, value) {
	var JSArray = new Array();
	<?php echo BuildJSNextLevelArray($BuildResult, $dictionaries);?>
	var selectBox = document.getElementById(id);
   // while (selectBox.options.length) {
              //  selectBox.remove(0);
   // }
	for(var i = 0; i < JSArray[value].length; i++){
		if(i != 0){
			selectBox[i] = new Option(JSArray[value][i]['name'], JSArray[value][i]['id']);
		}	
	}
	return;
}

</script>
<script type="text/javascript">
//	page dialog hide
function hide_ajax_div()
{
	 $('#DivRequest').load('template.load.php?print=list_page');
	 $('#dialog-page-body').hide();
	 $('#d-dialog').hide();
}
$(function() {
	$("#tabs").tabs();
});
</script>
<!--<script type='text/javascript' src='template.edit/demo.js'></script>-->
<div id="dialog-page-body">
</div>

    <div id="d-dialog">
 		<div id="d-dialog-in">
    		<table class="t-dialog">
            	<tr>
                	<td class="td-dialog-close">
                    	<a href="#" class="a-dialog-close" onclick="hide_ajax_div();"><h3 class="a-h3-dialog-close">закрыть</h3></a>
                    </td>
                </tr>
                <tr>
                	<td class="td-dialog-form">
	                    <div id="d-overflow">
							<div id="tabs">
								<ul>
									<li><a href="#tabs-1">Текст</a></li>
								</ul>
								<div id="tabs-1">
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