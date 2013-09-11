// JavaScript Document
function onfocusArrayCity(ArrayId, CityId) {
	//$("#RequeryArea").text(CityId);
	$("#DivListAreaActive_"+CityId+" img").hide();
	$("#i_aa_"+ArrayId).show();
}
function onclickArrayCity(ArrayId, CityId) {
	//alert(ArrayId);
	//alert("#i_aa_"+ArrayId);
	//$("#DivViewFormAreaListAll div").hide();
	$("#c_"+CityId).hide();
	$("#DivViewFormArea_"+ArrayId).show();
}
function HideArrayShowCity(ArrayId, CityId) {
	$("#c_"+CityId).show();
		$("#DivViewFormArea_"+ArrayId).hide();
}
function chechedAllCheckboxAreas(DictAreaId) {
	var DictAreaValue = $("#"+DictAreaId+'_4').fieldValue();
	//alert(DictAreaValue);
	if(DictAreaValue == 1) {
		$("#DivViewFormArea_"+DictAreaId+" :input").attr('checked', 'checked');
	}
	else {
		$("#DivViewFormArea_"+DictAreaId+" :input").attr('checked', false);
	}
	return;
}
function BtmSearchMap(){
	var optionsMapSearch = { 
		target: "#DivRequestQuery",
		beforeSubmit: valideSearchMap,
		url:'/application/module/immovables/get.post.hadler.php'
		};
	$('#MapSearchFormIm').ajaxSubmit(optionsMapSearch); 
}
function RePageMap(responseText, statusText)  { 
	var MapFormCityIm = $("#MapFormCityIm").fieldValue();
	var MapFormSelect = $("#MapFormTypeIm").fieldValue();
	var type_rs = $("#DivCARequery :radio").fieldValue();
	if(type_rs == '') type_rs = 'sale';
	window.location = '/immovables/'+MapFormSelect+'/'+type_rs+'.html'; 
	return;
}
function valideSearchMap(formData, jqForm, options)
{	var queryString = $.param(formData); 
	var MapFormCityIm = $("#MapFormCityIm").fieldValue();
	var MapFormSelect = $("#MapFormTypeIm").fieldValue();
	var type_rs = $("#DivCARequery :radio").fieldValue();
	if(type_rs == '') type_rs = 'sale';
	//alert('/immovables/'+MapFormSelect+'/'+type_rs+'.html'+queryString);
	window.location = '/immovables/'+MapFormSelect+'/'+type_rs+'.html?'+queryString;
	return false;
}
function BtmSearchMapImPage(){
	
	var optionsMapSearch = { 
		target: "#DivRequestQuery",
		beforeSubmit: valideSearchMI,
		url:'/application/module/immovables/get.post.hadler.php'
		};
		
	$('#MapSearchFormIm').ajaxSubmit(optionsMapSearch); 
}

function valideSearchMI(formData, jqForm, options) {
	var IMHLoc = $("#IMHLoc").fieldValue();
	var queryString = $.param(formData);
	window.location = IMHLoc + queryString;
}
/*$(document).ready(function() {  
	$('#m_4c3eb839f144e area').click(function() {
		alert($(this).attr('id'));
	}); 

*/
