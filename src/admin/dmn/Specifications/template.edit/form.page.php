
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
                          	<label class='zpFormLabel'>Имя характеристики</label>
                            <input class='zpFormRequired' value="<?php echo  $active_id['im_prop_name'];?>" size="40" name="im_prop_name" type="text" >
                            <br />
                            <label class='zpFormLabel'>Каталог</label>
								<select name="catalog_id" class="zpFormRequired">
									<option value="">Не выбрано</option>
									<?php echo sel_parent_id($IPcat_dct, $active_id['catalog_id'], 'dict_id', 'dict_name');?>	
								</select>
							<br />
							<label class='zpFormLabel'>Справочник</label>
								<select name="ld_id" class="zpForm">
									<option value="">Не выбрано</option>
									<?php echo sel_parent_id($IPLD_dct, $active_id['ld_id'], 'ld_id', 'ld_name');?>
								</select>
							<br />
							<label class='zpFormLabel'>Тип характеристики</label>
								<select name="type_prop" class="zpForm">
									<option value="standard" <?php echo  $TypePropCheck['standard'];?>>Стандартная</option>
									<option value="advanced" <?php echo  $TypePropCheck['advanced'];?>>Расширенная</option>
								</select>
							<br />
							<label class="zpFormLabel">Отображать</label>
                            <input value="1" <?php echo $hide;?> name="hide" type="checkbox" class="zpForm"/>
                            <br />
                            <br />
                            <label class='zpFormLabel'>Вид отображения в форме</label>
								<select name="im_prop_style_id" class="zpForm">
									<option value="">Не выбрано</option>
									<?php echo sel_parent_id($IPstyle_dct, $active_id['im_prop_style_id'], 'dict_id', 'dict_name');?>	
								</select>
							<br />
							<label class="zpFormLabel">Отображать в форме</label>
                            <input value="1" <?php echo $IsFieldForm;?> name="is_show_form" type="checkbox" class="zpForm"/>
                            <br />
                            <br />
                            <label class="zpFormLabel">Характеристика продажа</label>
                            <input value="1" name="is_prop_sale" <?php echo $IsPropSale;?> type="checkbox" class="zpForm"/>
                            <br />
                            <br />
                            <label class="zpFormLabel">Характеристика аренда</label>
                            <input value="1" name="is_prop_rent" <?php echo $IsPropRent;?> type="checkbox" class="zpForm"/>
                            <br />
                            <br />
                            <label class="zpFormLabel">Отображать в таблице</label>
                            <input value="1" name="is_print_list" <?php echo $IsFieldList;?> type="checkbox" class="zpForm"/>
                            <br />
                            <br />
                            <label class="zpFormLabel">Отображать на странице</label>
                            	<select name="is_print" class="zpFormRequired">
									<option value="">Не выбрано</option>
									<option value="is_print_st" <?php echo $IsPropSt;?>>Стандартная характеристика</option>
									<option value="is_print_ad" <?php echo $IsPropAd;?>>Расширенная характеристика</option>
								</select>
                            <br />
                            <br />
                            <input class='zpForm' value="<?php echo  $active_id['im_prop_id'];?>" size="13" name="im_prop_id" type="hidden" >
                            <input class='zpForm' value="edit_page" size="13" name="retention" type="hidden" >
                            <br />
                        </fieldset>
                        
                        <input value="Сохранить" name="Submit" onClick="" type="submit" class="button" />
                     
                    </form>