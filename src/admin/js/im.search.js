/*	new version regoanal search	*/
var atestSome;
$(document).ready(function(){
	$(".regionalBlock .reginalTree").hover(function() {
	}, function() {
		$(this).hide();
	});

	$(".form-span-exchange").html("(" + $("#exchange_select_id option:selected").val() + ")");
	$("#exchange_select_id").change(function () {
		$(".form-span-exchange").html("(" + $("#exchange_select_id option:selected").val() + ")");
	});
	
	$(".regionalTextInput").click(function () {
		$(".reginalTree").toggle();
	});
	
	$(".rlist").each(function () {
		if(!$(this).hasClass("rListItem-0")) {							   
		}
	});
	
	$(".rlist .plus").click(function () {
		var input_name = $(this).attr("id").substring(10,23);
		if($(".checkbox-item-" + input_name).attr("checked")) {
			$("#plus-item-" + input_name).html("+");
			$(".parent-element-" + input_name).hide();
			removeFromRegionalTextInput(input_name);
			$(".checkbox-item-" + input_name).attr( { "checked": "" });
		}
		else {
			$("#plus-item-" + input_name).html("-");
			$(".parent-element-" + input_name).show();
			appendToRegionalTextInput(input_name);
			$(".checkbox-item-" + input_name).attr( { "checked": "checked" });
		}
	});
	$(".rlist input").click(function () {
		var input_name = $(this).attr("name").substring(0,13);	
		if($(this).attr("checked")) {
			$("#plus-item-" + input_name).html("-");
			$(".parent-element-" + input_name).show();
			appendToRegionalTextInput(input_name);
		}
		else { 
			$("#plus-item-" + input_name).html("+");
			$(".parent-element-" + input_name).hide();
			removeFromRegionalTextInput(input_name);
		}
	});
});

/*
*/
function appendToRegionalTextInput ( input_name ) { 
	if($(".regionalTextInput .rSelected").html() != "")
		$(".regionalTextInput .rSelected").append("<span class=\"coma-" + input_name + "\">, </span>");
	$(".regionalTextInput .rSelected").append($(".r-name-item-" + input_name).clone());
	$(".regionalTextInput .no-items").hide();
}

/*
*/
function removeFromRegionalTextInput ( input_name ) { 
	$(".regionalTextInput .rSelected .r-name-item-" + input_name).remove();
	$(".regionalTextInput .rSelected .coma-" + input_name).remove();
	$(".parent-element-" + input_name + " input").each(function () {
		if($(this).attr("checked"))	 {
			$(this).attr( { checked : "" } );
			var name = $(this).attr("name").substring(0,13);
			$(".regionalTextInput .rSelected .r-name-item-" + name).remove();
			$(".regionalTextInput .rSelected .coma-" + name).remove();
		}
	});
	if($(".regionalTextInput .rSelected").html() == "") 
		$(".regionalTextInput .no-items").show();
}

/*
if($(".regionalTextInput .rSelected").html() == "") {
		$(".regionalTextInput .rSelected").
	}
*/

/*
	вызов функционала при клие на checkbox
*/
function setCheckbox(FieldId)
{
	var Fkey = new String()
	var Fvalue = new String()
	var value = $("#"+FieldId).fieldValue();
	setCheckboxValue(FieldId, value);
	HideShowFields(FieldId, value);
	return;
}
/*

*/
function setCheckboxValue(dict_Id, CheckboxValue) {
	return;
}
/*
	функия распределяет значения для отображения в диве
*/
function HideShowFields(dict_id, CheckboxValue) {
	var div_id = DictDiv[dict_id];
	for(var i = 0; i < DivDictShow[div_id].length; i++){
		if(DivDictShow[div_id][i]['dict_id'] == dict_id) {
			if(CheckboxValue == 1) {
				DivDictShow[div_id][i]['is_show'] = 1;
				TransferCheckedElement(dict_id, CheckboxValue);
			} 
			else {
				DivDictShow[div_id][i]['is_show'] = 0;
				TransferCheckedElement(dict_id, CheckboxValue);
			}
		}
		else {
			if(DivDictShow[div_id][i]['is_show'] != 1) {
				DivDictShow[div_id][i]['is_show'] = 0;
			}
		}
	}
	HideShowCheckbox(div_id);
	return;
}
var el;
function TransferCheckedElement(FieldId, value) {
	var name = $("#"+FieldId).attr("name");
	var divTransferI = name.substr(14,1);
	var cloneCheckedElement = $("#checked_group_item_"+FieldId).clone();
	var rel = $("#"+FieldId).attr("rel");
    if(value == 1) {
		$("#checked_group_item_"+FieldId).remove();
		$("#show_" + divTransferI  + "_checked").append(cloneCheckedElement);
		if($("#" + divTransferI).html() == "")
			$("#" + divTransferI + "_d").hide();
	}
	else {
		$("#checked_group_item_"+FieldId).remove();
		if(rel == "")
			$("#" + divTransferI).append(cloneCheckedElement);
		else 
			$("#" + rel + "_f").append(cloneCheckedElement);
	}
}
	
/*
	функция скрывает и отображет позиции дива
*/
function HideShowCheckbox(div_id) {
	for(var i = 0; i < DivDictShow[div_id].length; i++){
		//alert(DivDictShow[div_id][i]['is_show']+'----'+DivDictShow[div_id][i]['dict_id']);
		if(DivDictShow[div_id][i]['is_show'] == 1) {
			$('#'+DivDictShow[div_id][i]['dict_id']+'_f').show();
		}
		else {
			$('#'+DivDictShow[div_id][i]['dict_id']+'_f').hide();
		}
	
	}
	return;
}

$(document).ready(function(){
/*
	скрывает все ненужные fieldset - ы
*/					   	
	HideShowCheckbox("1_d");
	HideShowCheckbox("2_d");
	HideShowCheckbox("3_d");
	HideShowCheckbox("4_d");
	
	var optionsSearch = { 
			target: "#DivRequest",
			beforeSubmit: valideSearch,
			url:'/application/module/immovables/get.post.hadler.php',
			success: RePage
		  };
	
	$('#4c496bd58da0d_f').hide();
	$('#0_d').hide();
	$('#1_d').hide();
	$('#2_d').hide();
	$('#3_d').hide();
	$('#4_d').hide();
	$('#DivImPropForm').hide();
	
	$('#FormSearchNameRegion').bind("click", function(){
		FieldsetClickHideShow("#0_d");
	});	
	$('#FormSearchNameRRegion').bind("click", function(){
		FieldsetClickHideShow("#1_d");
	});		
	$('#FormSearchNameCity').bind("click", function(){
		FieldsetClickHideShow("#2_d");
	});			
	$('#FormSearchNameRCIty').bind("click", function(){
		FieldsetClickHideShow("#3_d");
	});	
	$('#FormSearchNameACity').bind("click", function(){
		FieldsetClickHideShow("#4_d");
	});	
	//
	$('#SearchPropImAdviceHS').bind("click", function(){
		FieldsetClickHideShow("#DivImPropForm");
	});
});

function hideOtherField(id) {
	var F = ['#0_d', '#1_d', '#2_d', '#3_d', '#4_d'];
	for (i = 0; i < 6; i++)  {
  		if(F[i] != id) {
			var OId = F[i];
			$(OId).hide();
		}
	}
	return;
}

function FieldsetClickHideShow(id) {
	hideOtherField(id);
	if ($(id).is(":hidden")) {
		if(id == "#DivImPropForm")
			$("#SearchIsAdvasedChecked").val(1);
		$(id).show();
		$(id+'_span').removeClass('ui-icon ui-icon-triangle-1-s');
		$(id+'_span').addClass('ui-icon ui-icon-triangle-1-n');
	} else {
		if(id == "#DivImPropForm")
			$("#SearchIsAdvasedChecked").val(0);
		$(id).hide();
		$(id+'_span').removeClass('ui-icon ui-icon-triangle-1-n');
		$(id+'_span').addClass('ui-icon ui-icon-triangle-1-s');
	}
	return;
}

function FieldsetClickHideShowListCheckbox(id) {
	if ($(id).is(":hidden")) {
		$(id).show();
		$(id+'_span').removeClass('ui-icon ui-icon-triangle-1-s');
		$(id+'_span').addClass('ui-icon ui-icon-triangle-1-n');
	} else {
		$(id).hide();
		$(id+'_span').removeClass('ui-icon ui-icon-triangle-1-n');
		$(id+'_span').addClass('ui-icon ui-icon-triangle-1-s');
	}
	return;
}


//	функция проверки выбран ли пункт для удаления
function valideSearch(formData, jqForm, options) {	
	var queryString = $.param(formData); 
	//alert(queryString);
	return true;
}
function RePage(responseText, statusText)  { 
	var href_link = location.href.toLowerCase();
	if(href_link.substr(href_link.length -1, href_link.length) == '#') window.location = href_link.substr(0, href_link.length-1); 
	else window.location = location.href.toLowerCase(); 
	return;
}

// вызов после получения ответа 
function showResponse(responseText, statusText)  { 
    // для обычного html ответа, первый аргумент - свойство responseText
    // объекта XMLHttpRequest
 
    // если применяется метод ajaxSubmit (или ajaxForm) с использованием опции dataType 
    // установленной в 'xml', первый аргумент - свойство responseXML
    // объекта XMLHttpRequest
 
    // если применяется метод ajaxSubmit (или ajaxForm) с использованием опции dataType
    // установленной в 'json', первый аргумент - объек json, возвращенный сервером.
 
    alert('Статус ответа сервера: ' + statusText + '\n\nТекст ответа сервера: \n' + responseText + 
        '\n\nЦелевой элемент div обновиться этим текстом.'); 
}

function set_search_field() {
	var search_field = $("#search_field").val();
	var redirect_url = '/s_immovables.html';
	if (search_field){
		redirect_url = redirect_url + '?action=s_code&id='+search_field;
		location.href = redirect_url;
	}
	else {
		alert("Введите код недвижимости для поиска!");
	} 
}

		