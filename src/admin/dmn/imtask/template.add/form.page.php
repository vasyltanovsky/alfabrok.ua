<script type="text/javascript">
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
    <input class='zpForm' value="" maxlength="255" size="40" name="t_title" type="text" >
    <br />
    <label class='zpFormLabel'>Дата выполнения</label>
    <input class='zpForm' value="<?php echo date("d.m.Y");?>" size="40" name="t_date_do" type="text" >
    <br />
    <label class='zpFormLabel'>Дата напоминания</label>
    <input class='zpForm' value="<?php echo date("d.m.Y");?>" size="40" name="t_date_reminder" type="text" >
    <br />
    <label class='zpFormLabel'>Испонитель</label>
    <select name="readltor_do" class="zpFormRequired">
      <option value="">--select--</option>
      <?php echo sel_parent_standart($ClProvQuery->table, '', 'id_account', 'fio');?>
    </select>
    <br />
    <br />
    <label class='zpFormLabel'>Описание</label>
    <br />
    <textarea name="t_text" cols="40" rows="10" class="zpForm"></textarea>
    <br />
    <label class='zpFormLabel'>Код недвижимости</label>
    <input type="text" name="im_id" id="im_id" value="<?php echo $_POST['im_id'];?>" />
    <input class='zpForm' value="add_task" size="13" name="retention" type="hidden" >
  </fieldset>
  <input value="Сохранить" name="Submit" onClick="" type="submit" class="button" />
</form>       
