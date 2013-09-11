
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
</script>              


		      <form action="template.data.retention.php" id='userForm' class="zpFormWinXP" method="POST">
                        <div id='errOutput' class="errOutput"></div>
                    
                        <fieldset>
                            <label class='zpFormLabel'>Название</label>
                            <input class='zpFormRequired' value="" size="40" name="menu_words" type="text" >
                            <br />
                            <label class='zpFormLabel'>Заголовок</label>
                            <input class='zpFormRequired' value="" size="40" name="title" type="text" >
                            <br />
                            <label class='zpFormLabel'>Web ключевые слова</label>
                            <input class='zpForm' value="" size="40" name="keywords_web" type="text" >
                            <br />
                            <label class='zpFormLabel'>Web краткое описание</label>
                            <input class='zpForm' value="" size="40" name="description_web" type="text" >
                            <br />
                            <!--<br />
                            <label class="zpFormLabel">Отображать загаловок</label>-->
                            <input type="hidden" value="1" name="title_show" class="zpForm"/>
                            <!--<br>>-->
                            <label class='zpFormLabel'>Краткое описание</label>
                            <br /> 
                            <textarea name="description" cols="40" rows="10" class="zpForm">
                            </textarea>
                            <!--<br /> 
                            <label class="zpFormLabel">Отображать КО</label>-->
                            <input name="description_show" type="hidden" value="1" class="zpForm"/>
                            <!--<br>
                            <br />-->
                            <label class='zpFormLabel'>Полное описание</label>
                            <br /> 
                            <textarea name="summary" cols="40" rows="10" class="zpForm">
                            </textarea>
                            <!--<br /> 
                            <label class="zpFormLabel">Отображать ПО</label>-->
                            <input name="summary_show" type="hidden" value="1" class="zpForm"/>
                            <!--<br>                            <br />
                            <label class='zpFormLabel'>Позиция</label>-->
                            <input class='zpForm zpFormInt' value="" size="13" name="pos" type="hidden" >
                            <!--<br />--> <br />
                             <label class="zpFormLabel">Отображать</label>
                            <input value="1" name="hide" type="checkbox" class="zpForm"/> <br /> <br />
                            <!-- 
                            <label class='zpFormLabel'>Родительский ID</label>
								<select name="parent_id" class="zpForm">
									<option value="">Не выбрано</option>
									?php echo sel_parent_id($cl_sel_pages->table, $active_id['parent_id']);?>
								</select>
							 -->	
			    	<input value="4c7e1b724c295" name="dict_id" type="hidden" class="zpForm"/>
		            <input class='zpForm' value="add_page" size="13" name="retention" type="hidden" >
                            <br />
                        </fieldset>
                        
                        <input value="Сохранить" name="Submit" onClick="" type="submit" class="button" />
                     
                    </form>