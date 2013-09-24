<script type="text/javascript">
//	Zapatec
//	функция возврата положительного ответа myOnFunctionEdit
//	<script type='text/javascript' src='../utils/js/js-zapatec/form.js'>
Zapatec.Form.setupAll({
showErrors: 'afterField',
showErrorsOnSubmit: true,
submitErrorFunc: testErrOutput,
asyncSubmitFunc: EditPageIsOk,
busyConfig: {
busyContainer: "userForm"
}

});
checkIfLoadedFromHDD();
function EditPageIsOk () {
	var outputDiv = document.getElementById("errOutput");
		
	if(outputDiv != null){
		outputDiv.innerHTML = '';//clear error message if any
		outputDiv.style.display = "none";
	}
	$('#errOutput').text('');
	$('#errOutput').show();
	$("#errOutput").append('Добавление страницы выполнено успешно.');
	$('#DivRequest').load('template.load.php?print=print_ptm');
	return;
}
</script>              


<form action="template.data.retention.php" id='userForm' class="zpFormWinXP" method="POST">
      <div id='errOutput' class="errOutput"></div>
  
      <fieldset>
     	  <label class='zpFormLabel'>Веб заголовок </label>
          <input class='zpFormRequired' value="" size="40" name="p_w_title" type="text" >
          <br />
          <label class='zpFormLabel'>Веб ключевые слова </label>
          <input class='zpForm' value="" size="40" name="p_w_keyw" type="text" >
          <br />
          <label class='zpFormLabel'>Веб описание </label>
          <input class='zpForm' value="" size="40" name="p_w_desc" type="text" >
          <br />
          <label class='zpFormLabel'>Название в меню</label>
          <input class='zpFormRequired' value="" size="40" name="p_w_menu" type="text" >
          <br />
          <br />
          <label class='zpFormLabel'>Айди страницы</label>
          <input class='zpFormRequired' value="<?php echo uniqid();?>" size="40" maxlength="15" name="page_id" type="text" >
          <br />
          <label class='zpFormLabel'>Url страницы</label>
          <input class='zpFormRequired' value="" size="40" maxlength="105" name="page_url" type="text" >
          <br />
          <label class='zpFormLabel'>Controller</label>
          <input class='zpFormRequired' value="" size="40" maxlength="105" name="controller" type="text" >
          <br />
          <label class='zpFormLabel'>Action</label>
          <input class='zpFormRequired' value="" size="40" maxlength="105" name="action" type="text" >
          <br />
          <label class='zpFormLabel'>Родительский ID</label>
              <select name="parent_id" class="zpForm">
                  <option value="">--select--</option>
                  <?php echo sel_parent_id($cl_sel_pages->table, $active_id['parent_id'], 'page_id', 'p_w_menu');?>
              </select>
              <br />
           
            <label class='zpFormLabel'>Справочник меню</label>
              <select name="p_type" class="zpForm">
                  <option value="">--select--</option>
                  <?php echo sel_parent_id($menu_dct, '', 'dict_id', 'dict_name');?>
              </select>
              <br />
        
          <label class='zpFormLabel'>Позиция</label>
          <input class='zpFormRequired' value="" size="13" name="pos" type="text" >
          <br />
          <label class='zpFormLabel'>Уровень вхождения</label>
          <input class='zpForm' value="" size="40" name="p_level" type="text" >
          <br />
          <label class="zpFormLabel">Отображать СТР</label>
          <input value="1" name="hide" type="checkbox" class="zpForm"/>
          <br />
          <br />
          <label class="zpFormLabel">Кешировать СТР</label>
          <input value="1" name="is_cache"  type="checkbox" class="zpForm"/>
          <br />
          <br />
          <label class='zpFormLabel'>Время кеширования (дней)</label>
          <input class='zpForm' value="" size="40" maxlength="105" name="cache_time" type="text" >
          <br />
          <label class='zpFormLabel'>Приоритет (sitemap)</label>
          <input class='zpForm' value="" size="40" maxlength="105" name="priority" type="text" >
          <br />
          <br />
          <input class='zpForm' value="add_page" size="40" name="retention" type="hidden" >
          <br />
 	  </fieldset>
	  <input value="Add" name="Submit" onClick="" type="submit" class="button" />
  </form>