
<script>
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
                            <!-- <label class='zpFormLabel'>Айди позиции</label>-->
                            <!--  <input class='zpFormRequired' value="" size="13" name="news_id" type="hidden" >-->
                            <br />
                    		<label class='zpFormLabel'>Заголовок </label>
                            <input class='zpFormRequired' value="" size="40" name="news_title" type="text" >
                            <br />
                            <label class='zpFormLabel'>Web ключевые слова</label>
                            <input class='zpForm' value="" size="40" name="keywords_web" type="text" >
                            <br />
                            <label class='zpFormLabel'>Web краткое описание</label>
                            <input class='zpForm' value="" size="40" name="description_web" type="text" >
                            <br />
                            <label class='zpFormLabel'>Краткое описание</label><br />
                            <textarea name="news_description" cols="40" rows="10" class="zpForm">
                            </textarea>
                            <br /> 
                            <label class='zpFormLabel'>Текст новости</label><br />
                            <textarea name="news_summary" cols="40" rows="10" class="zpForm"></textarea>
                            <br /> 
                            <br /> 
                            <label class="zpFormLabel">Отображать</label>
                            <input value="1" name="hide" type="checkbox" class="zpForm"/> <br /> <br />
                            <input class='zpForm' value="add_page" size="13" name="retention" type="hidden" >
                            <br />
                        </fieldset>
                        
                        <input value="Сохранить" name="Submit" onClick="" type="submit" class="button" />
                     
                    </form>