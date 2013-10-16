<script type="text/javascript">
//	Zapatec
//	функция возврата положительного ответа myOnFunctionEdit
//	<script type='text/javascript' src='../utils/js/js-zapatec/form.js'>
Zapatec.Form.setupAll({
	showErrors: 'afterField',
	showErrorsOnSubmit: true,
	submitErrorFunc: testErrOutput,
	asyncSubmitFunc: addImComplate,
	busyConfig: {
		busyContainer: "userForm"
	}
	
});
checkIfLoadedFromHDD();
function addImComplate( callbackArgs ) {
	if (callbackArgs) {
		if(callbackArgs.newImId) {
			window.location = location.search + "&im_add_full=true&im_id=" + callbackArgs.newImId;
		}
		alert("Ошибка при добавление объекта!");
	}
	else 
		alert("Ошибка при добавление объекта!");
}
function setCharCode () {
	var im_catalog_id = $('#im_catalog_id').val();
	//alert(im_catalog_id);
	var im_code;
		
	switch (im_catalog_id) {
		case '4c3ec3ec5e9b5' : 
			im_code = "K";
			break;
		case '4c3ec3ec5e9b7' : 
			im_code = "C";
			break;
		case '4c3ec51d537c0' : 
			im_code = "H";
			break;
		case '4c3ec51d537c2' : 
			im_code = "M";
			break;
		case '4c3ec51d537c3' : 
			im_code = "T";
			break;
		default :
			im_code = im_code;
		}	
	im_code = im_code + window.lastId[im_code];
	
	//	
	$('#im_code').val(im_code);

}
</script>

<form action="template.data.retention.php" id='userForm' class="zpFormWinXP" method="POST">
  	<div id='errOutput' class="errOutput"></div>
  	<fieldset>
  		<label class='zpFormLabel'>Каталог недвижимости</label>
        <select name="im_catalog_id" id="im_catalog_id" onchange="javascript: setCharCode();" class="zpFormRequired">
          <option value="">--select--</option>
          <?php echo sel_parent_standart($im_catalog_id_add, '', 'dict_id', 'dict_name');?>
        </select>
        <br />
        <label class='zpFormLabel'>Код недвижимости</label>
        <input class='zpFormRequired' value="" size="40" name="im_code" id="im_code"  type="text" >
        <br />
        <label class='zpFormLabel'>Заголовок</label>
        <input class='zpForm' value="" size="40" name="im_title" type="text" >
        <br />
        <label class='zpFormLabel'>Общая площадь</label>
        <input class='zpFormRequired zpFormFloat' value="" size="40" name="im_space" type="text" >
        <br />
        <label class='zpFormLabel'>Ед. площади</label>
        <select name="im_space_value_id" class="zpFormRequired">
          <option value="">--select--</option>
          <?php echo sel_parent_standart($im_space_value_id_add, '', 'dict_id', 'dict_name');?>
        </select>
    </fieldset>
    <fieldset>
		<?php require_once 'template/form.regional.template.php'; ?>
        <label class='zpFormLabel'>№ дома (улицы)</label>
        <input class='zpForm' value="" size="40" name="im_adress_house" type="text" >
        <br />
        <label class='zpFormLabel'>№ квартиры</label>
        <input class='zpForm' value="" size="40" name="im_adress_flat" type="text" >
        <br />
        <label class='zpFormLabel'>Координаты на карте</label>
        <input class='' value="" size="40" name="im_geopos" type="text" >
    </fieldset>
    <fieldset>
        <label class='zpFormLabel'>Цена за объект</label>
        <input class='zpForm zpFormInt' value="" size="40" name="im_prace" type="text" >
        <br />
        <label class='zpFormLabel'>(Аренда) цена за день </label>
        <input class='zpForm zpFormInt' value="" size="40" name="im_prace_day" type="text" >
        <br />
        <label class='zpFormLabel'>(Аренда) цена за месяц</label>
        <input class='zpForm zpFormInt' value="" size="40" name="im_prace_manth" type="text" >
    </fieldset>
    <fieldset>
        <label class="zpFormLabel">Риэлтор</label>
        <select name="susr_id" class="zpForm">
            <option value="">--select--</option>
            <?php echo sel_parent_standart($rieltorsData->table, '', 'id_account', 'fio');?>
        </select>
        <br />
        <label class='zpFormLabel'>Имя, телефоны хозяина</label>
        <input class='zpForm'  id="" value="" size="40" name="user_tel" type="text" > 
        <br />
        <label class='zpFormLabel'>Заметки о хозяине</label>
        <input class='zpForm'  id="" value="" size="40" name="user_notes" type="text" > 
    </fieldset>  
    <fieldset>  
        <label class='zpFormLabel'>Заголовок</label>
        <input class='zpForm'  id="" value="" size="60" name="web_title" type="text" > 
        <br />
        <label class='zpFormLabel'>Ключевые слова</label>
        <input class='zpForm'  id="" value="" size="175" name="web_keywords" type="text" > 
        <br />
        <label class='zpFormLabel'>Описание</label>
        <input class='zpForm'  id="" value="" size="150" name="web_description" type="text" > 
        <br />
    </fieldset>  
    <fieldset>  
        <label class="zpFormLabel">Отображать</label>
        <input value="1" name="hide" type="checkbox" class="zpForm"/> <br /> <br />
        <label class="zpFormLabel">Горящие предложения</label>
        <input value="1" name="im_is_hot" type="checkbox" class="zpForm"/> <br /> <br />
        <label class="zpFormLabel">Продажа</label>
        <input value="1" name="im_is_sale" type="checkbox" class="zpForm"/> <br /> <br />
        <label class="zpFormLabel">Аренда</label>
        <input value="1" name="im_is_rent" type="checkbox" class="zpForm"/>
    </fieldset>
    <br/>
    <input class='zpForm' value="" size="13" name="im_sale_id" type="hidden" >
    <input class='zpForm' value="add_page" size="13" name="retention" type="hidden" >
 	<input value="Сохранить" name="Submit" onClick="" type="submit" class="button" />
</form>
