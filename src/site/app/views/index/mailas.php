<?php global $arWords; ?>
<div class="DivCenterPage">
	<h1 class="TitleStandartPage"><?php echo $Model['title']?></h1>
	<!-- <div class="DivNavigation"><?php //echo $pages->navigation_string_htaccess(); ?></div> -->
	<table class="TableStandartCenterPage" >
		<tr>
			<td  class="TSCPTdCenter">
				<form action="/ru/index/sendmail" id='userForm' class="zpFormWinXP" method="post">
	                <div id='FormAlertIsOk'><p><?php echo $arWords['form_mail_ok'];?></p></div>
	                <div id='errOutput' class="errOutput"></div>
	                <fieldset>
	                    <label class='zpFormLabel'><?php echo $arWords['form_name_msq'];?></label>
	                    <input class='zpFormRequired' value="" size="40" name="name" type="text" />
	                    <br />
	                    <label class='zpFormLabel'><?php echo $arWords['form_organization_msq'];?></label>
	                    <input class='zpForm' value="" size="40" name="organization" type="text" />
	                    <br/>
	                    <label class='zpFormLabel'><?php echo $arWords['form_tel_msq'];?></label>
	                    <input value="" size="40" name="tel" type="text" class='zpFormRequired zpFormPhone zpFormMask="\(000\)\ 000\-0000"' />
	                    <br/>
	                    <label class='zpFormLabel'><?php echo $arWords['form_email_msq'];?></label>
	                    <input value="" size="40" name="email" type="text" class='zpFormRequired zpFormEmail' />
	                    <br />
	                    <label class='zpFormLabel'><?php echo $arWords['form_title_msq'];?></label>
	                    <input class='zpFormRequired' value="" size="40" name="titlemsq" type="text"/>
	                    <br/>
	                    <label class='zpFormLabel'><?php echo $arWords['form_text_msq'];?></label>
	                    <textarea name="textmsq" cols="40" rows="10" class="zpFormRequired"></textarea>
	                    <br />
	                </fieldset>
	                <input value="<?php echo $arWords['form_send_msq'];?>" name="Submit" onClick="" type="submit" class="button" />
	                <input value="<?php echo $arWords['form_clear_msq'];?>" name="Clear" onClick="" type="reset" class="button" />
	            </form>
		</td>
		<td  class="TSCPTdRight"><?php echo $ret_submenu_index;?></td>
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
function myOnFunctionAdd() {
	$('#errOutput').hide();
	$('#FormAlertIsOk').show();
}
</script>