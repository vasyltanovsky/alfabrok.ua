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
		busyContainer: "userForm"
	}
	
});
checkIfLoadedFromHDD();
</script>

<form action="template.data.retention.php" id='userForm' class="zpFormWinXP" method="POST">
  <div id='errOutput' class="errOutput"></div>
  <fieldset>
    <label class='zpFormLabel'>Логин (Email)</label>
    <input class='zpFormRequired ' value="<?php echo $active_id['login'];?>" size="40" name="login" type="text" >
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
    <label class='zpFormLabel'>Тип администратора</label>
    <select name="type" class="zpFormRequired">
      	<?php echo sel_parent_id($typeAdministrator, $active_id['type'], 'dict_id', 'dict_name');?>
    </select>
    <br />
    <label class='zpFormLabel'>Разрешенные IP</label>
    <input class='zpForm' value="<?php echo $active_id['ip'];?>" size="40" name="ip" type="text" >
    <br />
    <br />
    <input class='zpForm' value="edit_page" size="13" name="retention" type="hidden" >
    <input class='zpFormRequired' value="<?php echo $active_id['id_account'];?>" size="40" name="id_account" type="hidden" >
    <br />
  </fieldset>
  <fieldset>
    <legend>Роли администратора</legend>
    <?php foreach ($rolesAdminDict as $key => $value) { ?>
    <?php if(empty($value["parent_id"])):?>
    <?php $dictRoolParentId = $value["dict_id"];?>
    <label class='zpFormLabel'><?php echo $value["dict_name"]?></label>
    <input class='zpForm' value="<?php echo $value["dict_id"]?>" <?php echo (in_array($value["dict_id"], $rolesAdmin) ? 'checked="checked"' : "")?>  size="40" name="<?php echo $value["dict_id"]?>" type="checkbox" >
    <br />
    <br />
    <?php foreach ($rolesAdminDict as $Ckey => $Cvalue) { ?>
    <?php if($Cvalue["parent_id"] == $dictRoolParentId):?>
    <label class='zpFormLabel'><?php echo $Cvalue["dict_name"]?></label>
    <input class='zpForm' value="<?php echo $Cvalue["dict_id"]?>" <?php echo (in_array($Cvalue["dict_id"], $rolesAdmin) ? 'checked="checked"' : "")?>  size="40" name="<?php echo $Cvalue["dict_id"]?>" type="checkbox" >
    <br />
    <br />
    <?php endif;?>
    <?php } ?>
    <br />
    <hr>
    <?php endif;?>
    <?php } ?>
  </fieldset>
  <input value="Сохранить" name="Submit" onClick="" type="submit" class="button" />
</form>
