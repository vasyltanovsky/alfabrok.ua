<div id="login">
	<div id='errOutputEnter' class="errOutputEnter"></div>
	<form action="/application/module/user/form.enter.validator.php" id='FormEnter' class="zpFormWinXP" method="post">
    <table>
        <tr>
            <td colspan="2">
                <input id="TUserEnterLogin" class='zpFormRequired zpFormRequiredError="<?php echo $arWords['user_form_enter_login_err']; ?>"' title="<?php echo $arWords['user_form_enter_login']; ?>" value="<?php echo $arWords['user_form_enter_login']; ?>:" size="40" name="user_enter_login" type="text" />
            </td>
         </tr>
     	<tr>   
            <td colspan="2">
                <input id="TUserEnterPass" class='zpFormRequired zpFormRequiredError="<?php echo $arWords['user_form_enter_pass_err']; ?>"' title="<?php echo $arWords['user_form_enter_pass']; ?>" value="<?php echo $arWords['user_form_enter_pass']; ?>:" size="40" name="user_enter_password" type="password" />
            </td>
         </tr>
         <tr>   
            <td>
            	<input id="EnterSubmit"  name="Submit" type="submit" class="button EntSbt" title="<?php echo $arWords['user_form_enter_sub']; ?>" value="<?php echo $arWords['user_form_enter_sub']; ?>"/>
            </td>
            <td>
                <a class="LinkRegUser" title="<?php echo $arWords['user_form_enter_reg']; ?>" href="/registration.html"><?php echo $arWords['user_form_enter_reg']; ?></a>
            </td>
        </tr>
    </table>
</form>
</div>  
<div id="UserImFavoritesId"></div>	
<script type="text/javascript">
//	ZAPATEC
	Zapatec.Form.setupAll({
		showErrors: null,
		showErrorsOnSubmit: true,
		statusImgPos: null,
		submitErrorFunc: testErrOutputEnter,
		asyncSubmitFunc: myOnFunctionAdd,
		busyConfig: {
			busyContainer: "FormEnter"
		}
		
	});
	checkIfLoadedFromHDD();
	function myOnFunctionAdd()
	{
		window.location = "<?php echo $_SERVER['REQUEST_URI'];?>"; 
	}
</script> 
