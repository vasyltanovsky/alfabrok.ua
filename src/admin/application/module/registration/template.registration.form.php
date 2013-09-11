

    <!-- Common JS files -->
	<script type='text/javascript' src='/js/js-zapatec/utils/zapatec.js'></script>
	<script type="text/javascript" src="/js/js-zapatec/lang/ru-utf8.js"></script>
	<!-- Custom includes -->	
	<script type='text/javascript' src='/js/js-zapatec/src/form-<?php echo $_COOKIE['lang_code'];?>.js'></script>
	<script type='text/javascript' src='/js/js-zapatec/demo.js'></script>
	
	<!-- ALL demos need these css -->
	<link href="/css/css.zapatec/zpcal.css" rel="stylesheet" type="text/css">
	<link href="/css/css.zapatec/template.css" rel="stylesheet" type="text/css">
    <link href="/css/css.zapatec/winxp.css" rel="stylesheet" type="text/css">

<div class="DivCenterPage">
<h1 class="TitleStandartPage"><?php echo $pages->active_page['title']?></h1>
<?php if($_GET[1]) {echo "<div class=\"DivNavigation\">"; $pages->navigation_string_htaccess(); echo "</div>";} ?>


<table class="TableStandartCenterPage" >
<tr>
<td  class="TSCPTdCenter">
			<form action="application/module/registration/validate.registration.php" id='userForm' class="zpFormWinXP" method="POST">
                <div id='FormAlertIsOk'><p><?php echo $arWords['RegistrationOk'];?></p></div>
                <div id='errOutput' class="errOutput"></div>
                
                <fieldset>
                    <label class='zpFormLabel'><?php echo $arWords['form_name_req'];?></label>
                    <input class='zpFormRequired zpFormRequiredError=<?php echo $arWords['form_name_req_err'];?>' value="" size="40" name="user_name" type="text" >
                    <br />
                    <label class='zpFormLabel'><?php echo $arWords['form_fio_req'];?></label>
                    <input class='zpFormRequired zpFormRequiredError="<?php echo $arWords['form_fio_req_err'];?>"' value="" size="40" name="user_fio" type="text" >
                    <br />
                    <label class='zpFormLabel'><?php echo $arWords['form_email_req'];?></label>
                    <input value="" size="40" name="user_email" type="text" class='zpFormRequired zpFormEmail  zpFormRequiredError=<?php echo $arWords['form_email_req_err'];?>' />
                    <br />
                    <label class='zpFormLabel'><?php echo $arWords['form_pass_req'];?></label>
                    <input class='zpFormRequired zpFormRequiredError="<?php echo $arWords['form_pass_req_err'];?>"' value="" size="40" name="user_password" type="password" >
                    <br />
        			<label class='zpFormLabel'><?php echo $arWords['form_pass_sec_req'];?></label>
                    <input class='zpFormRequired zpFormRequiredError="<?php echo $arWords['form_pass_sec_req_err'];?>"' value="" size="40" name="user_password_sec" type="password" >
                    <br />
                    <label class='zpFormLabel'><?php echo $arWords['form_tel_msq'];?></label>
                    <input value="" size="40" name="user_tel" type="text" class='zpFormRequired zpFormPhone zpFormMask="\(000\)\ 000\-0000" zpFormRequiredError="<?php echo $arWords['form_tel_req_err'];?>"' />
                    <br/>
                    <!--<label class="zpFormLabel">?php echo $arWords['form_rules_reg'];?></label>
                    <input value="1" name="checkbox" type="checkbox" class="zpFormRequired zpFormRequiredError="?php echo $arWords['form_rules_reg_err'];?>""/>
					<br/>-->
                            
                </fieldset>
                
                <input value="<?php echo $arWords['form_reg_msq'];?>" name="Submit" onClick="" type="submit" class="button" />
            </form>
	</td>
	<td  class="TSCPTdRight"><?php echo $ret_submenu_index; echo $Formation['im_list'] ;?></td>
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