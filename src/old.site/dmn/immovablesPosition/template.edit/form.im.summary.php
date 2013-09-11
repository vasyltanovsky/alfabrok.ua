<script type="text/javascript">
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
    <br />
    <label class='zpFormLabel'>Описание недвижимости</label>
    <br />
    <textarea name="im_su_text" cols="40" rows="10" class="zpForm" style=" font:12pt Verdana, Geneva, sans-serif;  text-align: justify;"><?php echo $active_text_id['im_su_text'];?></textarea>
    <br />
    <input class='zpForm' value="<?php echo $active_text_id['im_su_id'];?>" size="13" name="im_su_id" type="hidden" >
    <input class='zpForm' value="<?php echo ($active_text_id['lang_id'] ? $active_text_id['lang_id'] : '4c5d58cd3898c');?>" size="13" name="lang_id" type="hidden" >
    <input class='zpForm' value="<?php echo ($active_text_id['im_id'] ? $active_text_id['im_id'] : $_POST['im_id']) ;?>" size="13" name="im_id" type="hidden" >
    <input class='zpForm' value="edit_summary" size="13" name="retention" type="hidden" >
    <br />
    <input type="button" onclick="UpdateComment();return false;" value="Генерировать"></input> 
  </fieldset>
  <input value="Сохранить" name="Submit" onClick="" type="submit" class="button" />
</form>
