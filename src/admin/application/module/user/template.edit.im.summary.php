<?php
	require_once 'function.php';
	//
	$_GET = getPageGetArr();
	//
	$cl_sel_pages = new mysql_select($tbl_im);
	$active_id 		= $cl_sel_pages -> select_table_id("WHERE im_id='{$_GET[i]}'");
	
	$land_sum_id = $_GET['l'];
	
#объявляем класс словаря
		$dictionaries = new dictionaries();
		#формируем массив имени словарей
		$dct_list 	=	$dictionaries->buid_dictionaries_list($tbl_list_dictionaries, "ORDER BY ld_name ASC");
		#формируем массив значений словарей
		$dct		=	 $dictionaries->buid_dictionaries($tbl_dictionaries,
									 	 				 "WHERE lang_id = {$_COOKIE[lang_id]}",
														 "ORDER BY dict_name");

		$dictionaries->do_dictionaries(67);
		$im_lang	 = $dictionaries->my_dct;
		
		$ImSuQClass = new mysql_select($tbl_im_su);
  		$ImSuData = $ImSuQClass -> select_table_id("WHERE lang_id = '{$land_sum_id}' AND im_id = {$active_id[im_id]}");
  		
		$ClUserData = new mysql_select($tbl_user_site);	
		
		function PrintLangSummary ($arr_lang , $land_sum_id) {
			for($i=0; $i<count($arr_lang); $i++) {
				$class = "UAddSome";
				if($arr_lang[$i][dict_id] == $land_sum_id) {
					$class= "UAddSomeImportant";
				}
				
				 $ret .= "<a id=\"{$arr_lang[$i][dict_id]}\" href=\"/user/{$_GET['1']}/{$_GET['2']}.html?i={$_GET[i]}&l={$arr_lang[$i][dict_id]}\" class=\"{$class}\" alt=\"{$arr_lang[$i]['dict_name']}\" title=\"{$arr_lang[$i]['dict_name']}\"><span class=\"ui-icon ui-icon-flag\"></span>{$arr_lang[$i]['dict_name']}</a>";
			}
			return $ret;
		}
			
?>

<div class="DivCenterPage">
	<h1 class="TitleStandartPage"><?php echo $pages->active_page['title'];?></h1>
	<div class="DivNavigation"><?php echo $pages->navigation_string_htaccess();?></div>
	<table class="TableStandartCenterPage" cellpadding="0" cellspacing="0">
		<tr>
			<td class="UserCabinetMenu"><?php echo $arWords['user_private_link'];?></td>
			<td class="UserTSCPTdCenter"><?php echo $pages->active_page['summary'];?>
		
			<div id="Preloader" style="display: none;"></div>
			<div id='FormAlertIsOk'><p><?php echo $arWords['user_add_im_end'];?></p></div>
			
			<div id="eventFormLang" class="eventFormLang"><?php echo PrintLangSummary($im_lang, $land_sum_id);?></div>
			
			<div>
			  <form action="/application/module/user/template.data.retention.php" id='FormImAddSum' class="zpFormWinXP" method="POST">
                        <div id='errOutput' class="errOutput"></div>
                   <!-- zpFormRequiredError="?php echo $arWords['im_add_summary_im_su_text_err']; ?>" -->
                        <fieldset>
                        	<br />
                            <label class='zpFormLabel'><?php echo $arWords['im_add_summary_title'];?></label>
                            <textarea name="im_su_text" cols="40" rows="10" class="zpFormRequired  zpFormRequiredError=<?php echo $arWords['im_add_summary_im_su_text_err'];?>"><?php echo $ImSuData['im_su_text'];?></textarea>
                            <br />
                        	<input class='zpForm' value="<?php echo $ImSuData['im_su_id'];?>" size="13" name="im_su_id" type="hidden" >
							<input class='zpForm' value="<?php echo $land_sum_id ;?>" size="13" name="lang_id" type="hidden" >
							<input class='zpForm' value="<?php echo $active_id['im_id'];?>" size="13" name="im_id" type="hidden" >
                            <input class='zpForm' value="edit_summary" size="13" name="retention" type="hidden" >
                            <br />
                        </fieldset>
                        
                        <input value="<?php echo $arWords['im_add_summary_save_btm'];?>" name="Submit" onClick="" type="submit" class="button" />
                        
                </form>	
			</div>
			</td>
		</tr>
	</table>
</div>
<div id="errOutput"></div>
<script type="text/javascript">
//	Zapatec
//	функция возврата положительного ответа myOnFunctionEdit
//	<script type='text/javascript' src='../utils/js/js-zapatec/form.js'>
	Zapatec.Form.setupAll({
	showErrors: 'afterField',
	showErrorsOnSubmit: true,
	submitErrorFunc: testErrOutput,
	asyncSubmitFunc: saveSumIsDone,
	busyConfig: {
		busyContainer: "FormImAddSum"
	}
	
});
checkIfLoadedFromHDD();
function saveSumIsDone(){
	$.prompt('<?php echo $arWords['im_edit_sum_is_ok']; ?>');
}

$('#ImAddIsDone').bind("click", function(){
	$('#FormImAddSum').hide();
	$('#ImAddIsDone').hide();
	$('#eventFormLang').hide();
	$('#FormAlertIsOk').show();
});
</script> 	