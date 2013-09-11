<?php 
	require_once 'function.php';
	
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
		
		$BuildResult = array_merge_recursive($im_region_id_add, $im_array_id_add, $im_a_region_add, $im_city_id_add, $im_area_id_add);
		#строим дерево каталога
		$BuildResult = $dictionaries->BuildArrayParentChild($BuildResult);
		
		$ClUserData = new mysql_select($tbl_user_site);
		$UserData = $ClUserData -> select_table_id("WHERE user_id={$_COOKIE[user_id]}");
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
	 
	//
	$_GET = getPageGetArr();
	//
	$cl_sel_pages = new mysql_select($tbl_im);
	$_REQUEST = $cl_sel_pages -> select_table_id("WHERE im_id='{$_GET[i]}'");
	//
	#	CHECKED
	$hide = "checked=\"checked\"";
	if($_REQUEST['hide'] == 'hide') $hide = '';
	$im_is_rent = "checked=\"checked\"";
	if(!$_REQUEST['im_is_rent']) $im_is_rent = '';
	$im_is_sale = "checked=\"checked\"";
	if(!$_REQUEST['im_is_sale']) $im_is_sale = '';
?>
<script type="application/javascript">
$(document).ready(function() {
	//showNextLevel('im_a_region_id', '4c3eb33182810');
	//showNextLevel('im_area_id', '4c3eb839f144e');
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
	
<div class="DivCenterPage">
	<h1 class="TitleStandartPage"><?php echo $pages->active_page['title'];?></h1>
	<div class="DivNavigation"><?php echo $pages->navigation_string_htaccess();?></div>
	<table class="TableStandartCenterPage" cellpadding="0" cellspacing="0">
		<tr>
			<td class="UserCabinetMenu"><?php echo $arWords['user_private_link'];?></td>
			<td class="UserTSCPTdCenter"><?php echo $pages->active_page['summary'];?>
			
			<div id="Preloader" style="display: none;"></div>
			<div id='FormAlertIsOk'><p><?php echo $arWords['user_edit_im_st_ok'];?></p></div>
			
			<div id="DivRequeryPropIm"></div>
			<div>
				 <form action="/application/module/user/template.data.retention.php" id='userForm' class="zpFormWinXP" method="POST">
                        <div id='errOutput' class="errOutput"></div>
                    
                         <fieldset>
                         	<label class='zpFormLabel'><?php echo $arWords['fai_fv_im_title'];?></label>
                            <input class='zpForm' value="<?php echo $_REQUEST['im_title'];?>" size="40" name="im_title" type="text" >
                            <br />
                         	<label class='zpFormLabel'><?php echo $arWords['fai_fv_im_catalog_id'];?></label>
								<select name="im_catalog_id" id="im_catalog_id" class="zpFormRequired">
									<option value=""><?php echo $arWords['fai_fv_no_selected'] ;?></option>
									<?php echo sel_parent_standart($im_catalog_id_add, $_REQUEST['im_catalog_id'], 'dict_id', 'dict_name');?>
								</select>
							<br />  
							
							<label class='zpFormLabel'><?php echo $arWords['fai_fv_im_region_id'];?></label>
								<select name="im_region_id" onchange="javascript:showNextLevel('im_a_region_id', this.value);"  id="im_region_id" class="zpFormRequired">
									<option value=""><?php echo $arWords['fai_fv_no_selected'] ;?></option>
									<?php echo sel_parent_standart($im_region_id_add, $_REQUEST['im_region_id'], 'dict_id', 'dict_name');?>
								</select>
							<br />  
							
                         	<label class='zpFormLabel'><?php echo $arWords['fai_fv_im_a_region_id'];?></label>
								<select name="im_a_region_id" onchange="javascript:showNextLevel('im_city_id', this.value);" id="im_a_region_id" class="zpForm">
									<option value=""><?php echo $arWords['fai_fv_no_selected'] ;?></option>
									<?php echo sel_parent_standart($im_a_region_add, $_REQUEST['im_a_region_id'], 'dict_id', 'dict_name', TRUE);?>
								</select>
							<br />  
							
							<label class='zpFormLabel'><?php echo $arWords['fai_fv_im_city_id'];?></label>
								<select name="im_city_id" onchange="javascript:showNextLevel('im_area_id', this.value);" id="im_city_id" class="zpFormRequired">
									<option value=""><?php echo $arWords['fai_fv_no_selected'] ;?></option>
									<?php echo sel_parent_standart($im_city_id_add, $_REQUEST['im_city_id'], 'dict_id', 'dict_name', TRUE);?>
								</select>
							<br />  
							
							<label class='zpFormLabel'><?php echo $arWords['fai_fv_im_area_id'];?></label>
								<select id="im_area_id" onchange="javascript:showNextLevel('im_array_id', this.value);" name="im_area_id" class="zpForm">
									<option value=""><?php echo $arWords['fai_fv_no_selected'] ;?></option>
									<?php echo sel_parent_standart($im_area_id_add, $_REQUEST['im_area_id'], 'dict_id', 'dict_name', TRUE);?>
								</select>
							<br />  
							
							<label class='zpFormLabel'><?php echo $arWords['fai_fv_im_array_id'];?></label>
								<select name="im_array_id"  id="im_array_id" class="zpForm">
									<option value=""><?php echo $arWords['fai_fv_no_selected'] ;?></option>
									<?php echo sel_parent_standart($im_array_id_add, $_REQUEST['im_array_id'], 'dict_id', 'dict_name');?>
								</select>
							<br />  
							
							<label class='zpFormLabel'><?php echo $arWords['fai_fv_im_adress_id'];?></label>
								<select name="im_adress_id" id="im_adress_id" class="zpForm">
									<option value=""><?php echo $arWords['fai_fv_no_selected'] ;?></option>
									<?php echo sel_parent_standart($im_adress_id_add, $_REQUEST['im_adress_id'], 'dict_id', 'dict_name');?>
								</select>
							<br />  
							
							<label class='zpFormLabel'><?php echo $arWords['fai_fv_im_adress_house'];?></label>
                            <input class='zpForm' value="<?php echo $_REQUEST['im_adress_house'];?>" size="40" name="im_adress_house" type="text" >
                            <br />
                            <label class='zpFormLabel'><?php echo $arWords['fai_fv_im_adress_flat'];?></label>
                            <input class='zpForm' value="<?php echo $_REQUEST['im_adress_flat'];?>" size="40" name="im_adress_flat" type="text" >
                            <br />
							<label class='zpFormLabel'><?php echo $arWords['fai_fv_im_prace'];?></label>
                            <input class='zpForm zpFormInt' value="<?php echo $_REQUEST['im_prace'];?>" size="40" name="im_prace" type="text" >
                            <br />
                            <label class='zpFormLabel'><?php echo $arWords['fai_fv_im_prace_day'];?></label>
                            <input class='zpForm zpFormInt' value="<?php echo $_REQUEST['im_prace_day'];?>" size="40" name="im_prace_day" type="text" >
                            <br />
                            <label class='zpFormLabel'><?php echo $arWords['fai_fv_im_prace_manth'];?></label>
                            <input class='zpForm zpFormInt' value="<?php echo $_REQUEST['im_prace_manth'];?>" size="40" name="im_prace_manth" type="text" >
                            <br />
                            <label class='zpFormLabel'><?php echo $arWords['fai_fv_im_space'];?></label>
                            <input class='zpFormRequired zpFormFloat' value="<?php echo $_REQUEST['im_space'];?>" size="40" name="im_space" type="text" >
                            <br />
                            <label class='zpFormLabel'><?php echo $arWords['fai_fv_im_space_value_id'];?></label>
								<select name="im_space_value_id" class="zpFormRequired">
									<option value=""><?php echo $arWords['fai_fv_no_selected'] ;?></option>
									<?php echo sel_parent_standart($im_space_value_id_add, $_REQUEST['im_space_value_id'], 'dict_id', 'dict_name');?>
								</select>
							<br />  
							<label class="zpFormLabel"><?php echo $arWords['fai_fv_im_is_sale'];?></label>
                            <input value="1" name="im_is_sale" <?php echo $im_is_sale;?> type="checkbox" class="zpForm"/>
                            <br>
                            <br>
                            <label class="zpFormLabel"><?php echo $arWords['fai_fv_im_is_rent'];?></label>
                            <input value="1" name="im_is_rent" <?php echo $im_is_rent;?> type="checkbox" class="zpForm"/>
                            <br>
                            <br>
                            <input class='zpForm' value="<?php echo $_REQUEST['im_id'];?>" size="13" name="im_id" type="hidden" >
						    <input class='zpForm' value="edit_page" size="13" name="retention" type="hidden" >
							 <input class='zpForm' value="1" size="13" name="im_is_special" type="hidden" >
                        </fieldset>
                        
                        <input value="Сохранить" name="Submit" onClick="" type="submit" class="button" />
                    </form>
           		 </div>
			</td>
		</tr>
	</table>
</div>
<div id="errOutput"></div>
<script type="text/javascript">
Zapatec.Form.setupAll({
		 showErrors: 'afterField',
		showErrorsOnSubmit: true,
		submitErrorFunc: testErrOutput,
		asyncSubmitFunc: ImPropSaveUser,
		busyConfig: {
			busyContainer: "userForm"
		}
});

checkIfLoadedFromHDD();

/*$(document).ready(function() {  
	$('#userForm').hide();
	$("#DivEchoResult").append('add_ok');
	$('#DivRequeryPropIm').show('');
	$("#DivRequeryPropIm").ajaxStart(function(){ShowPreloader();});
	$('#DivRequeryPropIm').load('/application/module/user/template.data.retention.php?retention=get_prop&im_catalog_id=4c3ec3ec5e9b5');
	$("#DivRequeryPropIm").ajaxComplete(function(){hidePreloader();});
});*/

function ImPropSaveUser()
{
	$("#FormAlertIsOk").show();
	$('#errOutput').hide();
}
</script>	