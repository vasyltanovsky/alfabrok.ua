
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
$(function() {
	$('#im_id').bind('keypress', function(e) {
		var keycode =  e.keyCode ? e.keyCode : e.which;
		if(keycode < 37 || keycode > 40 ) {
			changePointerCodeToSCField(this);
		}
	});
});
</script>              


<form action="template.data.retention.php" id='userForm' class="zpFormWinXP" method="POST">
  <div id='errOutput' class="errOutput"></div>
  <fieldset>
    <label class='zpFormLabel'>Заголовок</label>
    <input class='zpForm' value="<?php echo $active_id['t_title'];?>" maxlength="255" size="40" name="t_title" type="text" >
    <br />
    <label class='zpFormLabel'>Дата напоминания</label>
    <input class='zpForm' value="<?php echo $active_id['t_date_reminder'];?>" size="40" name="t_date_reminder" type="text" >
    <br />
    <br />
    <label class='zpFormLabel'>Описание</label>
    <br />
    <textarea name="t_text" cols="40" rows="10" class="zpForm"><?php echo $active_id['t_text'];?></textarea>
    <br />
    <label class="zpFormLabel">Выполнено</label>
    <input value="1" name="hide" type="checkbox" <?php echo $is_do;?>  class="zpForm"/> <br /> <br />
    <label class='zpFormLabel'>Код недвижимости</label>
    <input type="text" name="im_id" id="im_id" value="<?php echo $active_id['im_id'];?>" />
    <input class='zpForm' value="<?php echo $active_id['t_id'];?>" size="13" name="t_id" type="hidden" >
    <input class='zpForm' value="edit_task" size="13" name="retention" type="hidden" >
  </fieldset>
  <input value="Сохранить" name="Submit" onClick="" type="submit" class="button" />
</form>   