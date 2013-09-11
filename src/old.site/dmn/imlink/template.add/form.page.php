
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


function setLinkDictId() {
	var dict_id;
	var dict_name;
	var type_reg;
	if($("#im_region_id").val()) {
		dict_id = $("#im_region_id").val();
		$("#im_region_id option:selected").each(function () {
       		dict_name = $(this).text();
    	});
		type_reg = 0;
	}

	if($("#im_a_region_id").val()) {
		dict_id = $("#im_a_region_id").val();
		$("#im_a_region_id option:selected").each(function () {
       		dict_name = $(this).text();
    	});
		type_reg = 1;
	}

	if($("#im_city_id").val()) {
		dict_id = $("#im_city_id").val();
		$("#im_city_id option:selected").each(function () {
       		dict_name = $(this).text();
    	});
		type_reg = 2;
	}

	if($("#im_area_id").val()) {
		dict_id = $("#im_area_id").val();
		$("#im_area_id option:selected").each(function () {
       		dict_name = $(this).text();
    	});
		type_reg = 3;
	}

	if($("#im_array_id").val()) {
		dict_id = $("#im_array_id").val();
		$("#im_array_id option:selected").each(function () {
       		dict_name = $(this).text();
    	});
		type_reg = 4;
	}

	if($("#im_adress_id").val()) {
		dict_id = $("#im_adress_id").val();
		$("#im_adress_id option:selected").each(function () {
       		dict_name = $(this).text();
    	});
		type_reg = 5;
	}
	$("#il_name").val(dict_name);
	$("#il_title").val(dict_name);
	$("#dict_id").val(dict_id);
	$("#type_reg").val(type_reg);
	
	return;	
}
</script>              


		      <form action="template.data.retention.php" id='userForm' class="zpFormWinXP" method="POST">
                        <div id='errOutput' class="errOutput"></div>
                      	<fieldset>
                        	<legend>определение положения</legend>
                        	<label class='zpFormLabel'>Область</label>
								<select name="im_region_id" onchange="javascript:showNextLevel('im_a_region_id', this.value);"  id="im_region_id" class="zpFormRequired">
									<option value="">Не выбрано</option>
									<?php echo sel_parent_standart($im_region_id_add, '4c3eb33182810', 'dict_id', 'dict_name');?>
								</select>
							<br />  
							
                         	<label class='zpFormLabel'>Район области</label>
								<select name="im_a_region_id" onchange="javascript:showNextLevel('im_city_id', this.value);" id="im_a_region_id" class="zpForm">
									<option value=""><?php echo $arWords['fai_fv_no_selected'] ;?></option>
									<?php //echo sel_parent_standart($im_a_region_add, '', 'dict_id', 'dict_name', TRUE);?>
								</select>
							<br />  
							
							<label class='zpFormLabel'>Город (поселок): </label>
								<select name="im_city_id" onchange="javascript:showNextLevel('im_area_id', this.value);" id="im_city_id" class="zpForm">
									<option value="">Не выбрано</option>
									<?php echo sel_parent_standart($im_city_id_add, '4c3eb839f144e', 'dict_id', 'dict_name', TRUE);?>
								</select>
							<br />  
							
							<label class='zpFormLabel'>Район города:</label>
								<select id="im_area_id" onchange="javascript:showNextLevel('im_array_id', this.value);" name="im_area_id" class="zpForm">
									<option value="">Не выбрано</option>
									<?php //echo sel_parent_standart($im_area_id_add, '', 'dict_id', 'dict_name', TRUE);?>
								</select>
							<br />  
							
							<label class='zpFormLabel'>Массив города:</label>
								<select name="im_array_id"  id="im_array_id" class="zpForm">
									<option value="">Не выбрано</option>
									<?php //echo sel_parent_standart($im_array_id_add, '', 'dict_id', 'dict_name');?>
								</select>
							<br />  
							
							<label class='zpFormLabel'>Улица:</label>
								<select name="im_adress_id" id="im_adress_id" class="zpForm">
									<option value="">Не выбрано</option>
									<?php echo sel_parent_standart($im_adress_id_add, '', 'dict_id', 'dict_name');?>
								</select>
							<br /> 
							<br />  
								<a href="#" onclick="javascript: setLinkDictId();">Сформировать айди переменную</a>
							<br />  
							</fieldset>
                        	
                        <fieldset>
                        	<legend>Данные ссылки</legend>
                         	<label class='zpFormLabel'>Каталог недвижимости:</label>
								<select name="type_im" id="type_im" class="zpFormRequired">
									<option value="">Не выбрано</option>
									<?php echo sel_parent_standart($im_catalog_id_add, '', 'dict_id', 'dict_name');?>
								</select>
							<br /> 
							<label class='zpFormLabel'>Аренда/Продажа:</label>
								<select name="type_rs" id="type_rs" class="zpFormRequired">
									<option value="rent">Аренда</option>
									<option value="sale">Продажа</option>
								</select>
							<br />
                            <label class='zpFormLabel'>Название сслыки</label>
                            <input class='zpFormRequired' value="" size="40" name="il_name" id="il_name" maxlength="105" type="text" >
                            <br />
                            <label class='zpFormLabel'>Заголовок ссылки</label>
                            <input class='zpFormRequired' value="" size="40" name="il_title" id="il_title" maxlength="255" type="text" >
                            <br />
                            <!-- <label class='zpFormLabel'>Описание</label>
                            <br /> 
                            <textarea name="il_text" cols="40" rows="10" class="zpForm"></textarea>
                            <br />  -->
                            <label class='zpFormLabel'>Айди переменная</label>
                            <input class='zpFormRequired' value="" size="40" name="dict_id" id="dict_id"  type="text" >
                            <br />
                            <input class='zpForm' value="" size="40" name="type_reg" id="type_reg"  type="hidden" >	
			    			<input class='zpForm' value="add_page" size="13" name="retention" type="hidden" >
                            <br />
                        </fieldset>
                        
                        <input value="Сохранить" name="Submit" onClick="" type="submit" class="button" />
                    </form>