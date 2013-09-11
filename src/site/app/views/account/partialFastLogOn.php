<div class="DHeaerUserLib">
	<div id="login">
		<div id="errOutputEnter" class="errOutputEnter"></div>
		<form action="/application/module/user/form.enter.validator.php" id="FormEnter" class=" zpFormWinxp" method="post">
			<table>
				<tr>
					<td colspan="2"><input id="TUserEnterLogin" class="zpFormRequired zpFormRequiredError=&quot;Введите\ логин!&quot;" title="Логин" value="Логин:" size="40" name="user_enter_login" type="text" style="border-top-left-radius: 4px; border-top-right-radius: 4px; border-bottom-left-radius: 4px; border-bottom-right-radius: 4px;"></td>
				</tr>
				<tr>
					<td colspan="2"><input id="TUserEnterPass" class="zpFormRequired zpFormRequiredError=&quot;Введите\ пароль!&quot;" title="Пароль" value="Пароль:" size="40" name="user_enter_password" type="password" style="border-top-left-radius: 4px; border-top-right-radius: 4px; border-bottom-left-radius: 4px; border-bottom-right-radius: 4px;"></td>
				</tr>
				<tr>
					<td><input id="EnterSubmit" name="Submit" type="submit" class="button EntSbt" title="Войти" value="Войти" style="border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;"></td>
					<td><a class="LinkRegUser" title="Регистрация" href="/registration.html">Регистрация</a></td>
				</tr>
			</table>
		</form>
	</div>
	<div id="UserImFavoritesId"></div>
	<script type="text/javascript">
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
			window.location = "/"; 
		}
	</script>
</div>