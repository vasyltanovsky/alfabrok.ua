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

window.templates = {"4c3ec3ec5e9b5"://Kvartira
	[
	 { field: "im_code", value: "(код объекта %value%)" },
	 { field: "im_is_rent", values: {true: "Аренда"} },
	 { field: "im_is_sale", values: {true: "Продажа"} },
	 { field: "t_4c400ed4e5797", value: "%value%комн." },
	 { plain: "квартиры." },
	 { field: "im_adress_id_auto", value: "%value%" },
	 { field: "im_adress_house", value: "%value%," },
	 { field: "im_area_id_auto", value: "%value% р-н." },
	 { field: "t_4c400ea1b5657", value: "Этаж - %value%," },
	 { field: "t_4c400ec87481e", value: "этажность - %value%." },
	 { field: "im_space", value: "Общая площадь - %value% %im_space_value_id%," },
	 { field: "t_4c4012253a36f", value: "жилая площадь - %value% %im_space_value_id%." },
	 { field: "m_4c4016aeca9be[]", value: "Состояние: %value%." },
	 { field: "m_4c4015451837d[]", value: "Перекрытие - %value%." },
	 { field: "s_4c402fcbd874f", value: "Санузел - %value%" },
	 { field: "t_4c40132ca1039", value: ", %value%." },
	 { field: "t_4c4015574ac3e", value: "Высота потолка: %value%м." },
	 { field: "m_4c4013abc1cb9[]", value: "На полу: %value%." },
	 { field: "m_4c4015b8af7d9[]", value: "На стенах: %value%." },
	 { field: "c_4c401b9f9d09c", value: "Квартира:меблирована полностью." },
	 { field: "t_4c401bce016f9", value: "Количество балконов:%value%." },
	 { field: "m_4c4015b8af7d9[]", value: "Материал постройки дома: %value%." },
	 { field: "m_4c400e6ac4be0[]", value: "Рядом метро: %value%" },
	 { field: "im_prace", value: "Продажа %value%грн./мес." },
	 { field: "im_prace_manth", value: "Аренда %value%грн." },
	 { plain: "<br />АН АЛЬФАБРОК (код объекта %im_code%).<br />" +
		 "тел. (044)233-75-25, (093)170-07-27, (050)313-80-10, (067)487-77-65<br />" +
		 "Больше фото и подробнее об объекте по ссылке <a href='http://www.alfabrok.ua/%im_code%'>http://www.alfabrok.ua/%im_code%</a><br />" +
		 "Посмотрите также другие интересные варианты по ссылке <a href='http://www.alfabrok.ua/immovables/flat/sale.html'>http://www.alfabrok.ua/immovables/flat/sale.html</a><br />" +
		 "Приглашаем к сотрудничеству собственников" },
	 {field:"im_space_value_id"}
	],
	"4c3ec51d537c3"://Земельные участки
		[
		 { field: "im_code", value: "(код объекта %value%)" },
		 { field: "im_is_rent", values: {true: "Аренда"} },
		 { field: "im_is_sale", values: {true: "Продажа"} },
		 { plain: "земельного участка." },
		 { field: "im_adress_id_auto", value: "%value%" },
		 { field: "im_adress_house", value: "%value%," },
		 { field: "im_city_id_auto", value: "%value%," },
		 { field: "im_area_id_auto", value: "%value% р-н." },
		 { field: "im_space", value: "Общая площадь - %value% %im_space_value_id%." },
		 { field: "c_4c582170eebed", values: {true: "Есть газ."} },
		 { field: "s_4c58212f3fc16", values: {true: "Есть электричество."} },
		 { field: "m_4c99f87478f2d[]", value: "Рядом метро: %value%." },
		 { field: "s_4c4057205e1d3", value: "Целевое назначение: %value%." },
		 { field: "m_500d648208a75[]", value: "%value%.", separator: "." },
		 { field: "im_prace", value: "Продажа %value%грн./мес." },
		 { field: "im_prace_manth", value: "Аренда %value%грн." },
		 { plain: "<br />АН АЛЬФАБРОК (код объекта %im_code%).<br />" +
			 "тел. (044)233-75-25, (093)170-07-27, (050)313-80-10, (067)487-77-65<br />" +
			 "Больше фото и подробнее об объекте по ссылке <a href='http://www.alfabrok.ua/%im_code%'>http://www.alfabrok.ua/%im_code%</a><br />" +
			 "Посмотрите также другие интересные варианты по ссылке <a href='http://www.alfabrok.ua/immovables/flat/sale.html'>http://www.alfabrok.ua/immovables/flat/sale.html</a><br />" +
			 "Приглашаем к сотрудничеству собственников" },
		 {field:"im_space_value_id"}
			 	
		],
	"4c3ec3ec5e9b7"://Коммерческая недвижимость
			[
			 { field: "im_code", value: "(код объекта %value%)" },
			 { field: "im_is_rent", values: {true: "Аренда"} },
			 { field: "im_is_sale", values: {true: "Продажа"} },
			 { plain: " недвижимости." },
			 { field: "m_4c4050a2cbf80[]", value: "%value%.", separator: "." },
			 { field: "im_adress_id_auto", value: "%value%" },
			 { field: "im_adress_house", value: "%value%," },
			 { field: "im_area_id_auto", value: "%value% р-н." },
			 { field: "t_4c4050fc797b1", value: "Этаж - %value%," },
			 { field: "t_4c404804b576c", value: "этажность - %value%." },
			 { field: "im_space", value: "Общая площадь - %value% %im_space_value_id%," },
			 { field: "t_4c604016208bc", value: "жилая площадь - %value% %im_space_value_id%." },
			 { field: "m_4c40549df02c5[]", value: "Вход: %value%." },
			 { field: "t_4c4052103be6d", value: "Количество лифтов: %value%." },
			 { field: "t_4c4051712a102", value: "Количество санузлов: %value%." },
			 { field: "c_4c4051e3d555b", values: {true:"Мебель."} },
			 { field: "s_4c456655d85c1", value: "Минимальный срок сдачи: %value%." },
//			 { field: "s_4c405430437fa", value: "Площадь территории: %value% соток." },
			 { field: "s_4c400e1068a8f", value: "%value%.", separator: "." },
			 { field: "m_4c4051a584246[]", value: "Стены: %value%." },
			 { field: "m_4c4051d78227a[]", value: "Состояние: %value%." },
			 { field: "m_4c40519a76cde[]", value: "Перекрытие - %value%." },
			 { field: "t_4c4051c79ff64", value: "Высота (м.) : %value%." },
			 { field: "m_4c4044f741d0a[]", value: "Рядом метро: %value%" },
			 { field: "im_prace", value: "Продажа %value%грн./мес." },
			 { field: "im_prace_manth", value: "Аренда %value%грн." },
			 { plain: "<br />АН АЛЬФАБРОК (код объекта %im_code%).<br />" +
				 "тел. (044)233-75-25, (093)170-07-27, (050)313-80-10, (067)487-77-65<br />" +
				 "Больше фото и подробнее об объекте по ссылке <a href='http://www.alfabrok.ua/%im_code%'>http://www.alfabrok.ua/%im_code%</a><br />" +
				 "Посмотрите также другие интересные варианты по ссылке <a href='http://www.alfabrok.ua/immovables/flat/sale.html'>http://www.alfabrok.ua/immovables/flat/sale.html</a><br />" +
				 "Приглашаем к сотрудничеству собственников" },
			 {field:"im_space_value_id"}
				 	
			],
			"4c3ec51d537c0"://Котеджи. Дома. Дачи.
				[
				 { field: "im_code", value: "(код объекта %value%)" },
				 { field: "im_is_rent", values: {true: "Аренда"} },
				 { field: "im_is_sale", values: {true: "Продажа"} },
				 { field: "t_4c402f345c83d", value: "%value%комн." },
				 { plain: "котеджа/дома/дачи." },
				 { field: "im_adress_id_auto", value: "%value%" },
				 { field: "im_adress_house", value: "%value%," },
				 { field: "im_city_id_auto", value: "%value%," },
				 { field: "im_area_id_auto", value: "%value% р-н." },
				 { field: "t_4c6041d795e80", value: "Этажность - %value%." },
				 { field: "im_space", value: "Общая площадь - %value% %im_space_value_id%," },
				 { field: "t_4c402f924bc2a", value: "жилая площадь - %value% %im_space_value_id%." },
				 { field: "t_4c402f9b5fa99", value: "Площадь кухни: %value%." },
				 { field: "t_4c4069e4f04ec", value: "Площадь участка: %value% соток." },
				 { field: "m_4da0a9350d59d[]", value: "Крыша: %value%." },
				 { field: "m_4c402ff4ccd26[]", value: "На полу: %value%." },
				 { field: "c_4c403fc712b42", values: {true:"Есть бассейн."} },
				 { field: "m_4c403084d9d1d[]", value: "Окна выходят %value%." },
				 { field: "m_4c403002d3da7[]", value: "Перекрытие: %value%." },
				 { field: "s_4c402f72608df", value: "Комнаты %value%." },
				 { field: "m_4c403fefdb399[]", value: "%value%.", separator: "." },
				 { field: "m_4c403061af179[]", value: "Состояние: %value%." },
				 { field: "s_4c402fc6ae647", value: "Санузел - %value%" },
				 { field: "t_4c402fdfa576b", value: ", %value%." },
				 { field: "t_4c40304871b44", value: "Высота потолка: %value%м." },
				 { field: "c_4c40306b561d8", value: "Меблирован полностью." },
				 { field: "c_4c403074ad678", values: {true:"Есть бытовая техника."} },
				 { field: "m_4c455b949da66[]", value: "Рядом метро: %value%." },
				 { field: "s_4c456632abec5", value: "Минимальный срок сдачи: %value%." },
				 { field: "im_prace", value: "Продажа %value%грн./мес." },
				 { field: "im_prace_manth", value: "Аренда %value%грн." },
				 { plain: "<br />АН АЛЬФАБРОК (код объекта %im_code%).<br />" +
					 "тел. (044)233-75-25, (093)170-07-27, (050)313-80-10, (067)487-77-65<br />" +
					 "Больше фото и подробнее об объекте по ссылке <a href='http://www.alfabrok.ua/%im_code%'>http://www.alfabrok.ua/%im_code%</a><br />" +
					 "Посмотрите также другие интересные варианты по ссылке <a href='http://www.alfabrok.ua/immovables/flat/sale.html'>http://www.alfabrok.ua/immovables/flat/sale.html</a><br />" +
					 "Приглашаем к сотрудничеству собственников" },
				 {field:"im_space_value_id"}
				],
				"4c3ec51d537c2"://ОСЗ. Здания.
					[
					 { field: "im_code", value: "(код объекта %value%)" },
					 { field: "im_is_rent", values: {true: "Аренда"} },
					 { field: "im_is_sale", values: {true: "Продажа"} },
					 { plain: "здания." },
					 { field: "im_adress_id_auto", value: "%value%" },
					 { field: "im_area_id_auto", value: "%value% р-н." },
					 { field: "im_space", value: "Общая площадь - %value% %im_space_value_id%," },
					 { field: "t_4c45637599199", value: "площадь территории: %value%." },
					 { field: "m_4c40594d8718f[]", value: "Состояние: %value%." },
					 { field: "t_4c40593208011", value: "Высота: %value%м." },
					 { field: "m_4c4564bb1c7ea[]", value: "Вход: %value%." },
					 { field: "c_4c40598fc879f", values: {true:"Есть интернет."} },
					 { field: "c_4c405976240e2", values: {true:"Лифт: %t_4c405983b11d3%."} },
					 { field: "m_4c40582fac5db[]", value: "Рядом метро: %value%." },
					 { field: "m_4c4058b101cee[]", value: "На полу: %value%." },
					 { field: "c_4c4059da83f08", values: {true:"Есть кондиционер(ы)."} },
					 { field: "m_4c4059ac3a4b8[]", value: "Окна выходят: %value%." },
					 { field: "m_4c40583e7ac49[]", value: "Профиль: %value%." },
					 { field: "m_4c4058ca8062a[]", value: "Стены: %value%." },
					 { field: "s_4c40599ee5fbf", value: "Телефонных линий: %value%." },
					 					 
					 { field: "m_4c40582fac5db[]", value: "Метро: %value%" },
					 { field: "im_prace", value: "Продажа %value%грн./мес." },
					 { field: "im_prace_manth", value: "Аренда %value%грн." },
					 { plain: "<br />АН АЛЬФАБРОК (код объекта %im_code%).<br />" +
						 "тел. (044)233-75-25, (093)170-07-27, (050)313-80-10, (067)487-77-65<br />" +
						 "Больше фото и подробнее об объекте по ссылке <a href='http://www.alfabrok.ua/%im_code%'>http://www.alfabrok.ua/%im_code%</a><br />" +
						 "Посмотрите также другие интересные варианты по ссылке <a href='http://www.alfabrok.ua/immovables/flat/sale.html'>http://www.alfabrok.ua/immovables/flat/sale.html</a><br />" +
						 "Приглашаем к сотрудничеству собственников" },
					 {field:"im_space_value_id"}
					]
};
function UpdateComment()
{
	var fields = window.templates[$("[name=im_catalog_id_]").val()];
	var result = "";
	var values = {};
	for(var i = 0; i < fields.length; i++)
	{
		if (fields[i].field !== undefined)
		{
			var control = $("[name=" + fields[i].field + "]");
			if (control[0].type == "checkbox")
			{
				values[fields[i].field] = control.is(":checked");
			}
			else if (control[0].tagName == "SELECT")
			{
				if (control.attr("multiple"))
				{
					var vals = [];
					for(var j = 1; j < control[0].options.length; j++)
					{
						if (control[0].options[j].selected)
						{
							vals.push(control[0].options[j].text);
						}
					}
					if (vals.length > 0)
					{
						var separator = ",";
						if (fields[i].separator !== undefined)
						{
							separator = fields[i].separator;
						}
						values[fields[i].field] = vals.join(separator + " ");
					}
				}
				else
				{
					if (control[control.length - 1].options[control[control.length - 1].selectedIndex].text.indexOf("select") < 0)
					{
						values[fields[i].field] = control[control.length - 1].options[control[control.length - 1].selectedIndex].text;
					}
					if (fields[i].field == "im_space_value_id")
					{
						values[fields[i].field] = values[fields[i].field].replace("сотка", "соток");
					}
				}
			}
			else
			{
				values[fields[i].field] = control.val();
				if(fields[i].field.indexOf("prace") > 0)
				{
					values[fields[i].field] = (values[fields[i].field] * <?php echo $_COOKIE['exchange_USD'];?>).toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
				}
			}
		}
	}
	for(var i = 0; i < fields.length; i++)
	{
		var val = values[fields[i].field];
		if (fields[i].value !== undefined)
		{
			if (val !== null && val !== undefined && val !== "")
			{
				result += fields[i].value.replace("%value%", val);
			}
		}
		else if (fields[i].plain !== undefined)
		{
			result += fields[i].plain;
		}	
		else if (fields[i].values !== undefined)
		{
			if (fields[i].values[val] !== undefined)
			{
				result += fields[i].values[val];
			}
		}	
		result += " ";
	}	
	for(var k in values)
	{
		result = result.replace(new RegExp("%" + k + "%", "gm"), values[k]);
	}
	tinyMCE.editors.im_su_text.setContent(result);
}

/*$(function()
		{
			var fields = window.templates[$("[name=im_catalog_id_]").val()];
			for(var i = 0; i < fields.length; i++)
			{
				if (fields[i].field !== undefined)
				{
					$("[name=" + fields[i].field + "]").change(function()
						{
							UpdateComment();
						});
				}
			}
		});*/
</script>

<div id="fuckGeo"></div>
<form action="template.data.retention.php" id='userForm' class="zpFormWinXP" method="POST">
  	<div id='errOutput' class="errOutput"></div>
  	<fieldset>
        <label class='zpFormLabel'>Каталог недвижимости</label>
        <select name="im_catalog_id_" disabled="disabled" class="zpFormRequired">
          <option value="">--select--</option>
          <?php echo sel_parent_standart($im_catalog_id_add, $active_id['im_catalog_id'], 'dict_id', 'dict_name');?>
        </select>
        <br />
    	<label class='zpFormLabel'>Код недвижимости</label>
        <input class='zpFormRequired' value="<?php echo  $active_id['im_code'];?>" size="40" name="im_code" type="text" >
        <br />
        <label class='zpFormLabel'>Заголовок</label>
        <input class='zpForm' value="<?php echo  $active_id['im_title'];?>" size="40" name="im_title" type="text" >
        <br />
        <label class='zpFormLabel'>Общая площадь</label>
        <input class='zpFormRequired zpFormFloat' value="<?php echo $active_id['im_space'];?>" size="40" name="im_space" type="text" >
        <br />
        <label class='zpFormLabel'>Ед. площади</label>
        <select name="im_space_value_id" class="zpFormRequired">
            <option value="">--select--</option>
            <?php echo sel_parent_standart($im_space_value_id_add, $active_id['im_space_value_id'], 'dict_id', 'dict_name');?>
        </select>
        <br />
        <label class="zpFormLabel">Дата внесения</label>
        <input name="im_date_add" value="<?php echo class_date::GetPeapleDateView($active_id["im_date_add"]); ?>" type="text" class='zpFormRequired zpFormMask="00.00.0000"'/>
    </fieldset>
    <fieldset>
		<?php require_once 'template/form.regional.template.php'; ?>
        <label class='zpFormLabel'>№ дома (улицы)</label>
        <input class='zpForm'  id="im_adress_house" value="<?php echo $active_id['im_adress_house'];?>" size="40" name="im_adress_house" type="text" >
        <br />
        <label class='zpFormLabel'>№ квартиры</label>
        <input class='zpForm' value="<?php echo $active_id['im_adress_flat'];?>" size="40" name="im_adress_flat" type="text" >
        <br />
        <label class='zpFormLabel'>Координаты на карте</label>
        <input class='' value="<?php echo $active_id['im_geopos'];?>" size="40" name="im_geopos" type="text" >
    </fieldset>
    <fieldset>
        <label class='zpFormLabel'>Цена за объект (новая)</label>
        <input class='zpForm zpFormInt' value="<?php echo $active_id['im_prace'];?>" size="40" name="im_prace" type="text" >
        <br />
        <label class='zpFormLabel'>Цена за объект</label>
        <input class='zpForm zpFormInt' value="<?php echo $active_id['im_prace_old'];?>" size="40" name="im_prace_old" type="text" >
        <br />
        <label class='zpFormLabel'>Цена за кв.м./сотку</label>
        <input class='zpForm zpFormInt' value="<?php echo $active_id['im_prace_sq'];?>" size="40" name="im_prace_sq" type="text" >
        <br />
        <label class='zpFormLabel'>(Аренда) цена за день</label>
        <input class='zpForm zpFormInt' value="<?php echo $active_id['im_prace_day'];?>" size="40" name="im_prace_day" type="text" >
        <br />
        <label class='zpFormLabel'>(Аренда) цена за месяц</label>
        <input class='zpForm zpFormInt' value="<?php echo $active_id['im_prace_manth'];?>" size="40" name="im_prace_manth" type="text" >
    </fieldset>
    <fieldset>
        <label class="zpFormLabel">Риэлтор</label>
        <select name="susr_id" class="zpFormRequired">
            <option value="">--select--</option>
            <?php echo sel_parent_standart($rieltorsData->table, $active_id['susr_id'], 'id_account', 'fio');?>
        </select>
        <br />
        <label class="zpFormLabel">Оператор</label>
        <input class='zpForm' disabled="disabled" value="<?php echo $operatorsData->buld_table[$active_id['im_operator']]["fio"];?>" size="40" type="text" >
        <br />
         <label class='zpFormLabel'>Имя, телефоны хозяина</label>
         <?php if ($_COOKIE["type"] == "4f4b9531d0696"):?>
	        <input class='zpForm' id="" value="<?php echo $active_id['user_tel'];?>" size="40" name="user_tel" type="text" >
        <?php else:?>
	        <input class='zpForm' readonly="readonly" id="" value="<?php echo $active_id['user_tel'];?>" size="40" name="user_tel" type="text" >
        <?php endif;?>
        <br />
        <label class='zpFormLabel'>Заметки о хозяине</label>
        <input class='zpForm'  id="" value="<?php echo $active_id['user_notes'];?>" size="40" name="user_notes" type="text" > 
    </fieldset>
    <fieldset>
        <label class="zpFormLabel">Отображать</label>
        <input value="1" name="hide" type="checkbox" <?php echo $hide;?>  class="zpForm"/> <br /> <br />
        <label class="zpFormLabel">Горящие предложения</label>
        <input value="1" name="im_is_hot" <?php echo $im_is_hot;?>  type="checkbox" class="zpForm"/> <br /> <br />
        <label class="zpFormLabel">Продажа</label>
        <input value="1" name="im_is_sale" <?php echo $im_is_sale;?> type="checkbox" class="zpForm"/> <br /> <br />
        <label class="zpFormLabel">Аренда</label>
        <input value="1" name="im_is_rent" <?php echo $im_is_rent;?>  type="checkbox" class="zpForm"/> <br /> <br />
        <label class="zpFormLabel">Пользовательский обьект</label>
        <input value="1" name="im_is_special" <?php if ($active_id["im_is_special"] != 0){ echo "checked=\"\"";} ;?> type="checkbox" class="zpForm"/>
    </fieldset>
   
    <input class='zpForm' value="" size="40" name="im_geoposition" id="im_geoposition" type="hidden" >
    <input class='zpForm' value="<?php echo $active_id['im_catalog_id'];?>" size="13" name="im_catalog_id" type="hidden" >
    <input class='zpForm' value="<?php echo $active_id['im_id'];?>" size="13" name="im_id" type="hidden" >
    <input class='zpForm' value="<?php echo $active_id['pos'];?>" size="13" name="pos" type="hidden" >
    <input class='zpForm' value="edit_page" size="13" name="retention" type="hidden" >
    <br />
  	<input value="Сохранить" name="Submit" onClick="" type="submit" id="SubmitIm" class="button" />

</form>
