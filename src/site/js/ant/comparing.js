// JavaScript Document
$(document).ready(function() { 
	/*	добавление в стравнени*/
	$(".comparing-objects-link").click(function () {
		comparisonAddItem($(this).attr("id").replace(/comparing-item-/g, ""));
		return false;
	});
	$(".comparing-objects-link-remove").click(function () {
		comparisonRemoveItem($(this).attr("id").replace(/comparing-item-/g, ""));
		return false;
	});
});
function comparisonAddItem(im_id) {
	$.ajax({
    	type: "GET",
        success: function (data) {
			return false;
        },
        url: "/ru/immovables/comparingadditem?im_id=" + im_id
	});
}
function comparisonRemoveItem(im_id) {
	$.ajax({
    	type: "GET",
        success: function (data) {
			return false;
        },
        url: "/ru/immovables/comparingremoveitem?im_id=" + im_id
	});
}
/**
 * отпрявляет на сервер сортировку позиций
 * @param array
 */
function comparisonSetSorted(array) {
	if(array.length == 0)
		return;
	var list = "";
	for(var i = 0; i < array.length; i++)  {
		list += array[i][1].replace(/comparing-item-/g, "") + ",";
	}
	$.ajax({
    	type: "GET",
        success: function (data) {
			return false;
        },
        url: "/ru/immovables/comparingsetsorted?list=" + list
	});
}
/**
 * стрывает параметры по которым нет значений и меняет a на span где текстовые значения
 */
function comparisonHideEmptyAndLargeParam() {
	$(".param-list .params a").each(function () {
		var param = $(this).attr("class");
		var isset = false;
		var sort = true;
		$("#comparing-sort .params span").each(function () {
			if($(this).attr("class") == param) {
				var html = $(this).text();
				if(html) {
					isset = true;
					if(html.length > 25) {
						$("." + param).css("height" , html.length * 1.9);
					}
					sort = isNaN(html);
				}
			}
		});
		if(!isset)
			$("." + param).remove();
		if(sort)
			$(".param-list ." + param).addClass("span");
	});
}
var comparisonSortObj = new Array();
/**
 * сортировка по параметру от большего
 * @string param_name имя праметра
 */
function comparisonSortParamFrom(param_name) {
	comparisonSortObj = buildSortArray(param_name);
	for(var i=0; i<comparisonSortObj.length; i++){
		for(var j=0;j< comparisonSortObj.length-1;j++) {
			if(comparisonSortObj[j][0]>comparisonSortObj[j+1][0]) {
				var p = comparisonSortObj[j];
				comparisonSortObj[j]=comparisonSortObj[j+1];
				comparisonSortObj[j+1]=p;
			}
		}
	}
	buildSortList();
}
/**
 * сортировка по параметру от меньшего
 * @string param_name имя праметра
 */
function comparisonSortParamTo(param_name) {
	comparisonSortObj = buildSortArray(param_name);
	for(var i=0; i<comparisonSortObj.length; i++){
		for(var j=0;j< comparisonSortObj.length-1;j++) {
			if(comparisonSortObj[j][0] < comparisonSortObj[j+1][0]) {
				var p = comparisonSortObj[j];
				comparisonSortObj[j]=comparisonSortObj[j+1];
				comparisonSortObj[j+1]=p;
			}
		}
	}
	buildSortList();
}
/**
 * формирует список элементов
 * @string param_name имя праметра
 * @returns {Array}
 */
function buildSortArray(param_name) {
	$(".param-list span").removeClass("sort");
	comparisonSortObj = new Array();
	$("#comparing-sort .item ." + param_name).each(function () {
		var val = Number($(this).text());
		var id = ($(this).parent(".params").parent(".item").attr("id") ? $(this).parent(".params").parent(".item").attr("id") : $(this).parent(".properties").parent(".params").parent(".item").attr("id"));
		comparisonSortObj.push([(val ? val : 0), id]);
	});
	return comparisonSortObj;
}
/**
 * перемещает эленты на странице
 */
function buildSortList() {
	if(comparisonSortObj.length == 0) 
		return;
	for(var i=0; i<comparisonSortObj.length; i++) {
		var clone = $("#" + comparisonSortObj[i][1]).clone();
		$("#" + comparisonSortObj[i][1]).remove();
		$("#comparing-sort").append(clone);
	}
	comparisonSetSorted(comparisonSortObj);
}


