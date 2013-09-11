
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
                            <!-- <label class='zpFormLabel'>Айди позиции</label> -->
                            <input class='zpFormRequired' value="<?php echo $active_id['sc_id'];?>" size="13" name="sc_id" type="hidden" >
                            <br />
                    		<label class='zpFormLabel'>Название</label>
                            <input class='zpFormRequired' value="<?php echo $active_id['menu_words'];?>" size="40" name="menu_words" type="text" >
                            <br />
                            <label class='zpFormLabel'>Web ключевые слова</label>
                            <input class='zpForm' value="<?php echo $active_id['keywords_web'];?>" size="40" name="keywords_web" type="text" >
                            <br />
                            <label class='zpFormLabel'>Web краткое описание</label>
                            <input class='zpForm' value="<?php echo $active_id['description_web'];?>" size="40" name="description_web" type="text" >
                            <br />
                            <label class='zpFormLabel'>Загoловок</label>
                            <input class='zpFormRequired' value="<?php echo $active_id['title'];?>" size="40" name="title" type="text" >
                            <br />
                            <!--<label class="zpFormLabel">Отображать загаловок</label>-->
                            <input value="1" name="title_show" <?php echo $title_show;?> type="hidden" class="zpForm"/>
                           <!-- <br />
                            <br />-->
                            <label class='zpFormLabel'>Краткое описание</label>
                            <br /> 
                            <textarea name="description" cols="40" rows="10" class="zpForm">
                            <?php echo $active_id['description'];?></textarea>
                            <br /> 
                            <!--<label class="zpFormLabel">Отображать КО</label>-->
                            <input value="1" name="description_show" <?php echo $description_show;?> type="hidden"  class="zpForm"/>
                            <!--<br>
                            <br />-->
                            <label class='zpFormLabel'>Полное описание</label>
                            <br /> 
                            <textarea name="summary" cols="40" rows="10" class="zpForm">
                            <?php echo $active_id['summary'];?></textarea>
                            <br /> 
                            <!--<label class="zpFormLabel">Отображать ПО</label>-->
                            <input value="1" name="summary_show" <?php echo $summary_show;?> type="hidden" class="zpForm"/>
                            <!--<br>
                            <br />
                            <label class='zpFormLabel'>Позиция</label>-->
                            <input class='zpForm zpFormInt' value="<?php echo $active_id['pos'];?>" size="13" name="pos" type="hidden" >
                            <!--<br />--> <br />
                             <label class="zpFormLabel">Отображать</label>
                            <input value="1" name="hide" <?php echo $hide;?>type="checkbox" class="zpForm"/> <br /> <br />
                           
                            <!-- <label class='zpFormLabel'>Родительский ID</label>
								<select name="parent_id" class="zpForm">
									<option value="">Не выбрано</option>
									?php echo sel_parent_id($cl_sel_pages->table, $active_id['parent_id'], 'sc_id', 'menu_words');?>
								</select>
								<br />-->
			    			<input value="<?php echo $active_id['dict_id'];?>" name="dict_id" type="hidden" class="zpForm"/>
                            <input class='zpForm' value="edit_page" size="13" name="retention" type="hidden" >
                            <br />
                        </fieldset>
                        
                        <input value="Сохранить" name="Submit" onClick="" type="submit" class="button" />
                     
                    </form>