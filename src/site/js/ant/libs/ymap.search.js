// JavaScript Document
var imData = Array(); //Данные по недвижимости
var imDataS = Array(); //Данные по недвижимости (найденной)
var imDataSY = Array(); //Данные по недвижимости (найденной и отображенной на карте) 
var searchParams = Array(); //Данные по параметрам поиска 
var searchParamsSort = Array(); //Данные по параметрам поиска 
var imTypeActive = null; //Активый раздел недвижимости
var logData = null; //
var yLoading = new oLoading('#yLoading');
var geocoderImList = new GeocoderImList(); //объект геокодирования адрессов недвижимости
var tIndexProp = Array();
var dYProp = Array();
var yMapFunc = new yFunctional();
/*	Yandex map переменные	*/
var gCollection, geoResult, iMap; //Yandex map переменные
var geocoder; //Yandex map переменные
var iconStyleTitle = iconStyle = Array(); // Создание стиля для значка метки


var _templateContent = Array();
	_templateContent['group'] = "<div class=\"yGroupIm\">#data#</div>";

var icoStyleAlfabrok  = new YMaps.Style();
	icoStyleAlfabrok.iconStyle = new YMaps.IconStyle();
	icoStyleAlfabrok.iconStyle.href = "http://alfabrok.ua/files/images/YMap/alfabrok.logo.ymap.png";
	icoStyleAlfabrok.iconStyle.size = new YMaps.Point(50, 52);
	icoStyleAlfabrok.iconStyle.offset = new YMaps.Point(-16, -50);
	
// Создание экземпляра карты и его привязка к созданному контейнеру
YMaps.jQuery(function () {
	iMap = new YMaps.Map(YMaps.jQuery("#indexYMap")[0]);
	iMap.addControl(new YMaps.TypeControl());
	iMap.addControl(new YMaps.ToolBar());
	iMap.addControl(new YMaps.Zoom());
	//map.addControl(new YMaps.MiniMap());
	iMap.addControl(new YMaps.ScaleLine()); 
	//определение стиля иконок недвижимости
	setYMapIconStyle('4c3ec3ec5e9b5');
	setYMapIconStyle('4c3ec3ec5e9b7');
	setYMapIconStyle('4c3ec51d537c0');
	setYMapIconStyle('4c3ec51d537c2');
	setYMapIconStyle('4c3ec51d537c3');
	setYMapIconStyle('4c3ec3ec5e9b5-l');
	setYMapIconStyle('4c3ec3ec5e9b7-l');
	setYMapIconStyle('4c3ec51d537c0-l');
	setYMapIconStyle('4c3ec51d537c2-l');
	setYMapIconStyle('4c3ec51d537c3-l');
	// Установка для карты ее центра и масштаба
    iMap.setCenter(new YMaps.GeoPoint(30.357407,50.438196), 13);
 	// Создание группы со стилем
    gCollection = new YMaps.GeoObjectCollection(icoStyleAlfabrok);
	var placemark = new YMaps.Placemark(new YMaps.GeoPoint(30.357407,50.438196));
 	gCollection.add(placemark);
 	// Добавление группы на карту
    iMap.addOverlay(gCollection);
});


/*	jQuery 	*/
$(function() {
	//$( "#indexYMap" ).resizable();
	
  	//нажатие на кнопку поиска
	$('#btmYMapSearch').click(function() {
		startYSearchProcess();
		return false;
	});
	//зброс поиска
	$('span.clean').click(function() {
		imTypeActive = null;
		imDataS = Array(); 
		imDataSY = Array();
		searchParams = Array();
		gCollection.removeAll();
		$('#RRSYM').html("");
		$('#RRSYMNow').html("");
		$('#CountSearchIm').hide();
		//
		$("#formYMapSearch input:text").val('');
		var allCheckboxes = $("#accYMapSearchTypeIm input:checkbox:enabled");
		allCheckboxes.removeAttr('checked');
		$( "#accYMapSearchTypeIm" ).accordion("activate", -1);
		return false;
	});
	$('a.showFullScreen').click(function() {
		yMapFunc.showFullScreen();
		iMap.redraw();
	});
	$('a.hideFullScreen').click(function() {
		yMapFunc.hideFullScreen();
		iMap.redraw();
	});
	$('#showHelp').click(function() {
		yMapFunc.showHelp();
	});
	$('#hideHelp').click(function() {
		yMapFunc.hideHelp();
	});
	$('#showInfra').click(function() {
		$('#showInfra').hide();	
		$('#hideInfra').show();	
		iMap.setCenter(new YMaps.GeoPoint(30.522152,50.451366), 12, YMaps.MapType.PMAP);
	});
	$('#hideInfra').click(function() {
		$('#showInfra').show();	
		$('#hideInfra').hide();	
		iMap.setCenter(new YMaps.GeoPoint(30.522152,50.451366), 12, YMaps.MapType.MAP);
	});
})