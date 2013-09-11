<?php 
	#стисок недвижимостью 
		$ClImMinPrice = new ImListPrint("i WHERE i.im_is_hot=1 AND i.im_photo != 'imnoimage.png' ORDER BY RAND() DESC LIMIT 15", 
										$ModuleTemplate,
										$TemplateImList,
										$dictionaries,
										$arWords);
		$ClUserData = new mysql_select($tbl_user_site);
		$UserData = $ClUserData -> select_table_id("WHERE user_id={$_COOKIE[user_id]}");
?>
<div class="DivCenterPage">
	<h1 class="TitleStandartPage"><?php echo $pages->active_page['title'];?></h1>
	<div class="DivNavigation"><?php echo $pages->navigation_string_htaccess();?></div>
	<table class="TableStandartCenterPage" cellpadding="0" cellspacing="0">
		<tr>
			<td class="UserCabinetMenu"><?php echo $arWords['user_private_link'];?></td>
			<td class="UserTSCPTdCenter"><?php echo $pages->active_page['summary'];?>
			<div>
				<form action="/application/module/user/template.data.retention.php" id='userForm' class="zpFormWinXP" method="POST">
	                <div id='FormAlertIsOk'><p><?php echo $arWords['form_order_text_ok'];?></p></div>
	                <div id='errOutput' class="errOutput"></div>
	                
	                <fieldset>
		               	<label class='zpFormLabel'><?php echo $arWords['form_name_msq'];?> <?php echo $arWords['form_fio_req'];?></label>
	                    <input class='zpFormRequired zpFormRequiredError="<?php echo $arWords['form_fio_req_err'];?>"' value="<?php echo $UserData['user_fio']?>" size="40" name="user_fio" type="text" >
	                    <br />
	                    <label class='zpFormLabel'><?php echo $arWords['form_email_msq'];?></label>
	                    <input size="40" name="user_email" type="text" class='zpFormRequired zpFormEmail  zpFormRequiredError=<?php echo $arWords['form_email_req_err'];?>' value="<?php echo $UserData['user_email']?>"/>
	                    <br />
	                    <label class='zpFormLabel'><?php echo $arWords['form_tel_msq'];?></label>
	                    <input name="user_tel" class='zpFormRequired zpFormPhone zpFormMask="\(000\)\ 000\-0000" zpFormRequiredError="<?php echo $arWords['form_tel_req_err'];?>"' value="<?php echo $UserData['user_phone_mobile'];?>" size="40" type="text" />
	                    <br/>
	                    <label class='zpFormLabel'><?php echo $arWords['form_order_text'];?></label>
	                    <textarea class='zpFormRequired zpFormRequiredError=<?php echo $arWords['form_order_text_err'];?>' name="order_text"></textarea>
	                </fieldset>
	                <input value="order_add" name="retention" type="hidden" onClick="" type="submit" class="button" />
	                <input value="<?php echo $arWords['form_send_msq'];?>" name="Submit" onClick="" type="submit" class="button" />
	                <input value="<?php echo $arWords['form_clear_msq'];?>" name="Clear" onClick="" type="reset" class="button" />
	            </form>
            </div>
			</td>
			<td class="UserTSCPTdTop"><?php 	echo $ClImMinPrice -> GetContent('div_im_list_ban_block', $arr = array('title' => $arWords['ImDivListHeaderHot'], 's_im_link' => 'hot_im', 'css_class' => 'links_block'), 'DivListMinPrice');?></td>
		</tr>
	</table>
</div>
<script type="text/javascript">
Zapatec.Form.setupAll({
		 showErrors: 'afterField',
		showErrorsOnSubmit: true,
		submitErrorFunc: testErrOutput,
		asyncSubmitFunc: myOnFunctionAdd,
		busyConfig: {
			busyContainer: "userForm"
		}
});

checkIfLoadedFromHDD();

function myOnFunctionAdd()
{
	$('#errOutput').hide();
	$('#FormAlertIsOk').show();
}
</script>	