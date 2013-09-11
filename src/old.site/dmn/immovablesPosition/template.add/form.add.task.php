<script type="text/javascript">
//	Zapatec
//	функция возврата положительного ответа myOnFunctionEdit
//	<script type='text/javascript' src='../utils/js/js-zapatec/form.js'>
Zapatec.Form.setupAll({
	showErrors: 'afterField',
	showErrorsOnSubmit: true,
	submitErrorFunc: testErrOutput,
	asyncSubmitFunc: addTaskComplate,
	busyConfig: {
		busyContainer: "userForm"
	}
	
});
checkIfLoadedFromHDD();

function addTaskComplate() {
	$.prompt('Задача добавлена.');
	$('#DivTaskForm').hide();
	$('#DivRequestTasksList').load('template.load.php?print=list_tasks&im_id=<?php echo $_POST['im_id']?>'); 
}
</script>

<div id="DivRequestTask"></div>

<form action="template.data.retention.php" id='userForm' class="zpFormWinXP" method="POST">
  <div id='errOutput' class="errOutput"></div>
  <fieldset>
    <label class='zpFormLabel'>Заголовок</label>
    <input class='zpForm' value="" maxlength="255" size="40" name="t_title" type="text" >
    <br />
    <label class='zpFormLabel'>Дата выполнения</label>
    <input class='zpForm' value="<?php echo date("d.m.Y");?>" size="40" name="t_date_do" type="text" >
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
    <input type="hidden" name="im_id" value="<?php echo $_POST['im_id'];?>" />
    <input class='zpForm' value="add_task" size="13" name="retention" type="hidden" >
  </fieldset>
  <input value="Сохранить" name="Submit" onClick="" type="submit" class="button" />
</form>       
