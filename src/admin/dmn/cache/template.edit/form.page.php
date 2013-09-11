
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
        <label class="zpFormLabel">Кэширование</label>
        <input value="1" name="is_cache_on" <?php echo $is_cache_on ;?> type="checkbox" class="zpForm"/> <br /> <br />
        <label class='zpFormLabel'>Время кэширования</label>
        <input class='zpFormRequired' value="<?php echo $active_id['time_cache'];?>" size="13" name="time_cache" type="text" >
        <br />
    </fieldset>
    
    <input class='zpForm' value="edit_page" size="40" name="retention" type="hidden" >
    <input value="<?php echo $active_id['cs_id'];?>" type="hidden" size="13" name="cs_id">
    <input value="Сохранить" name="Submit" onClick="" type="submit" class="button" />
</form>