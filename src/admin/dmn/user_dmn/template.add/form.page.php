<script>
//	Zapatec
//	функция возврата положительного ответа myOnFunctionEdit
//	<script type='text/javascript' src='../utils/js/js-zapatec/form.js'>
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
</script>

<form action="template.data.retention.php" id='userForm' class="zpFormWinXP" method="POST">
  <div id='errOutput' class="errOutput"></div>
  <fieldset>
    <br />
    <label class='zpFormLabel'>Логин (Email)</label>
    <input class='zpFormRequired zpFormEmail' value="" size="40" name="login" type="text" >
    <br />
    <label class='zpFormLabel'>Пароль</label>
    <input class='zpFormRequired' value="" size="40" name="password" type="password" >
    <br />
    <label class='zpFormLabel'>Повтор пароля</label>
    <input class='zpFormRequired' value="" size="40" name="repassword" type="password" >
    <br />
    <label class='zpFormLabel'>ФИО</label>
    <input class='zpFormRequired' value="" size="40" name="fio" type="text" >
    <br />
    <label class='zpFormLabel'>Номер телефона</label>
    <input class='zpFormRequired' value="" size="40" name="tel" type="text" >
    <br />
    <label class='zpFormLabel'>Тип администратора</label>
    <select name="type" class="zpFormRequired">
      	<?php echo sel_parent_id($typeAdministrator, '', 'dict_id', 'dict_name');?>
    </select>
    <br />
    <label class='zpFormLabel'>Разрешенные IP</label>
    <input class='zpForm' value="" size="40" name="ip" type="text" >
    <br />
    <br />
    <input class='zpForm' value="add_page" size="13" name="retention" type="hidden" >
    <br />
  </fieldset>
  <input value="Сохранить" name="Submit" onClick="" type="submit" class="button" />
</form>
