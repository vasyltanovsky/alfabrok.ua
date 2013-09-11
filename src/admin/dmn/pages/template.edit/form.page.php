
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
                            <label class='zpFormLabel'>Айди страници</label>
                            <input class='zpFormRequired' value="<?php echo $active_id['page_id'];?>" size="13" name="page_id" type="text" >
                            <br />
                    		<label class='zpFormLabel'>Веб заголовок </label>
                            <input class='zpFormRequired' value="<?php echo $active_id['title_web'];?>" size="40" name="title_web" type="text" >
                            <br />
                            <label class='zpFormLabel'>Веб ключевые слова </label>
                            <input class='zpForm' value="<?php echo $active_id['keywords_web'];?>" size="40" name="keywords_web" type="text" >
                            <br />
                            <label class='zpFormLabel'>Веб описание </label>
                            <input class='zpForm' value="<?php echo $active_id['description_web'];?>" size="40" name="description_web" type="text" >
                            <br />
                            <label class='zpFormLabel'>Страница (ЦМС)</label>
                            <input class='zpForm' value="<?php echo $active_id['name_page'];?>" size="40" name="name_page" type="text" >
                            <br />
                            <label class='zpFormLabel'>Название в меню</label>
                            <input class='zpFormRequired' value="<?php echo $active_id['menu_words'];?>" size="40" name="menu_words" type="text" >
                            <br />
                            <label class="zpFormLabel">Отображать меню</label>
                            <input value="1" name="menu_show" <?php echo $menu_show;?>type="checkbox" class="zpForm"/>
                            <br/>
                            <br />
                            <label class='zpFormLabel'>загаловок контента</label>
                            <input class='zpFormRequired' value="<?php echo $active_id['title'];?>" size="40" name="title" type="text" >
                            <br />
                            <label class="zpFormLabel">Отображать загаловок</label>
                            <input value="1" name="title_show" <?php echo $title_show;?> type="checkbox" class="zpForm"/>
                            <br/>
                            <br />
                            <label class='zpFormLabel'>КО контента</label>
                            <br /> 
                            <textarea name="description" cols="40" rows="10" class="zpForm">
                            <?php echo $active_id['description'];?></textarea>
                            <br /> 
                            <label class="zpFormLabel">Отображать КО</label>
                            <input value="1" name="description_show" <?php echo $description_show;?> type="checkbox" class="zpForm"/>
                            <br/>
                            <br />
                            <label class='zpFormLabel'>ПО контента</label>
                            <br /> 
                            <textarea name="summary" cols="40" rows="10" class="zpForm">
                            <?php echo $active_id['summary'];?></textarea>
                            <br /> 
                            <label class="zpFormLabel">Отображать ПО</label>
                            <input value="1" name="summary_show" <?php echo $summary_show;?> type="checkbox" class="zpForm"/>
                            <br/>
                            <br />
                            <label class='zpFormLabel'>Позиция</label>
                            <input class='zpFormRequired' value="<?php echo $active_id['pos'];?>" size="13" name="pos" type="text" >
                            <br />
                            <label class="zpFormLabel">Отображать СТР</label>
                            <input value="1" name="hide" <?php echo $hide;?>type="checkbox" class="zpForm"/>
                            <br/>
                            <br />
                            <label class='zpFormLabel'>Модуль</label>
                            <input class='zpForm' value="<?php echo $active_id['adress_template'];?>" size="70" name="adress_template" type="text" >
                            <br />
                            <label class='zpFormLabel'>Родительский ID</label>
								<select name="parent_id" class="zpForm">
									<option value="">--select--</option>
									<?php echo sel_parent_id($cl_sel_pages->table, $active_id['parent_id']);?>
								</select>
								<br />
								<br />
                              <label class='zpFormLabel'>Справочник меню</label>
								<select name="dict_id" class="zpForm">
									<option value="">--select--</option>
									<?php echo sel_parent_id($menu_dct, $active_id['dict_id'], 'dict_id', 'dict_name');?>
								</select>
								<br />
								<br />   
                               
                            <label class='zpFormLabel'>Уровень вхождения</label>
                            <input class='zpForm' value="<?php echo $active_id['parent_in'];?>" size="40" name="parent_in" type="text" >
                            <input class='zpForm' value="edit_page" size="40" name="retention" type="hidden" >
                            <br />
                        </fieldset>
                        
                        <input value="Сохранить" name="Submit" onClick="" type="submit" class="button" />
                     
                    </form>