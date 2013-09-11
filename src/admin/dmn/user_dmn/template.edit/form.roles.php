<script>
//	Zapatec
//	функция возврата положительного ответа myOnFunctionEdit
//	<script type='text/javascript' src='../utils/js/js-zapatec/form.js'>
Zapatec.Form.setupAll({
	showErrors: 'afterField',
	showErrorsOnSubmit: true,
	submitErrorFunc: testErrOutput,
	asyncSubmitFunc: myOnFunctionEdit,
	busyConfig: {
		busyContainer: "rolesForm"
	}
	
});
checkIfLoadedFromHDD();
</script>              


		      <form action="template.data.retention.php" id='rolesForm' class="zpFormWinXP" method="POST">
                        <div id='errOutput' class="errOutput"></div>
                    
                        <fieldset>
                        	<label class='zpFormLabel'>Логин (Email)</label>
                            <input class='zpFormRequired zpFormEmail' value="<?php echo $active_id['login'];?>" size="40" name="login" type="text" >
                            <br />
                            <label class='zpFormLabel'>Старый пароль</label>
                            <input class='zpForm' value="" size="40" name="password_old" type="password" >
                            <br />
                            <label class='zpFormLabel'>Новый пароль</label>
                            <input class='zpForm' value="" size="40" name="password" type="password" >
                            <br />
                            <label class='zpFormLabel'>Повтор пароля</label>
                            <input class='zpForm' value="" size="40" name="repassword" type="password" >
                            <br />
                            <label class='zpFormLabel'>ФИО</label>
                            <input class='zpFormRequired' value="<?php echo $active_id['fio'];?>"" size="40" name="fio" type="text" >
                            <br />
                            <label class='zpFormLabel'>Номер телефона</label>
                            <input class='zpFormRequired' value="<?php echo $active_id['tel'];?>" size="40" name="tel" type="text" >
                            <br />
                            <label class='zpFormLabel'>Риэлтор</label>
                            <input class='zpForm' value="1" <?php echo $isRealtor;?> size="40" name="" type="checkbox" >
                            <br />
                            <input class='zpForm' value="edit_page" size="13" name="retention" type="hidden" >
                            <input class='zpFormRequired' value="<?php echo $active_id['id_account'];?>" size="40" name="id_account" type="hidden" >
                            <br />
                        </fieldset>
                        
                        <input value="Сохранить" name="Submit" onClick="" type="submit" class="button" />
                     
                    </form>