<?php
	require_once 'function.php';
	//
	$_GET = getPageGetArr();
	//
	$cl_sel_pages = new mysql_select($tbl_im);
	$active_id = $cl_sel_pages -> select_table_id("WHERE im_id='{$_GET[i]}'");
		
#объявляем класс словаря
		$dictionaries = new dictionaries();
		#формируем массив имени словарей
		$dct_list 	=	$dictionaries->buid_dictionaries_list($tbl_list_dictionaries, "ORDER BY ld_name ASC");
		#формируем массив значений словарей
		$dct		=	 $dictionaries->buid_dictionaries($tbl_dictionaries,
									 	 				 "WHERE lang_id = {$_COOKIE[lang_id]}",
														 "ORDER BY dict_name");

	#выборка характеристик недвижимости	
		$ImPropList = new mysql_select($tbl_im_pl,
									   "WHERE lang_id = {$_COOKIE['lang_id']} AND catalog_id='{$active_id['im_catalog_id']}' AND hide='show'",
									   "ORDER BY im_prop_name ASC");
		$ImPropList->select_table("im_prop_id");
	#выборка характеристик данной недвижимости
		$ImPropInfo = new mysql_select($tbl_im_pi,
									   "WHERE lang_id = {$_COOKIE['lang_id']} AND im_id='{$active_id['im_id']}'");
		$ImPropInfo->select_table("im_prop_id");
	#объеление клаасс построениея формы справочников, и поздтановка значений в поля формы	
		$PrintPropForm = new ImPropAdvaced($ImPropList, $dictionaries, $ImPropInfo);
		$PrintPropForm->NoSelectedValue	= $arWords['fai_fv_no_selected'];
		$PrintPropForm->ImPropListPrintField();
		
		$ClUserData = new mysql_select($tbl_user_site);	
?>
	
<div class="DivCenterPage">
	<h1 class="TitleStandartPage"><?php echo $pages->active_page['title'];?></h1>
	<div class="DivNavigation"><?php echo $pages->navigation_string_htaccess();?></div>
	<table class="TableStandartCenterPage" cellpadding="0" cellspacing="0">
		<tr>
			<td class="UserCabinetMenu"><?php echo $arWords['user_private_link'];?></td>
			<td class="UserTSCPTdCenter"><?php echo $pages->active_page['summary'];?>
			
			<div id="Preloader" style="display: none;"></div>
			<div id='FormAlertIsOk'><p><?php echo $arWords['user_edit_im_ad_ok'];?></p></div>
		
				
			<div id="DivRequeryPropIm"></div>
			<div>
				 <form action="/application/module/user/template.data.retention.php" id='PropForm' class="zpFormWinXP" method="POST">
                        <div id='errOutput' class="errOutput"></div>
                        <fieldset>
                        	<?php echo $PrintPropForm->Form;?>
                        	<input class='zpForm' value="<?php echo $active_id['im_id'];?>" size="13" name="im_id" id="im_id" type="hidden" >
                            <input class='zpForm' value="add_im_prop_info" size="13" name="retention" type="hidden" >
                            <br />
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
		asyncSubmitFunc: ImSaveUser,
		busyConfig: {
			busyContainer: "PropForm"
		}
});

checkIfLoadedFromHDD();

function ImSaveUser()
{
	$('#errOutput').hide();
	$('#FormAlertIsOk').show();
}
</script>	