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


function startYSearchProcess() {
	yLoading.start();
	//обнуление значений
	imDataS = Array(); 
	imDataSY = Array();
	//запускаем поиск 
	startYSearch();
	$('#CountSearchIm').show();
	$('#YHelp').hide();
	$('#showHelp').show();
	$('#hideHelp').hide();
}

function setHelpSearch (imType, activeSlide) {
	setActiveTypeIm(imType);
	$("#blck-" + imType + " input:checkbox").attr("checked","checked");
	$( "#accYMapSearchTypeIm" ).accordion("activate", activeSlide);
	startYSearchProcess();
}

/* установка указателя типа недвижимости*/
function setActiveTypeIm(id) {
	/* очистили чекбоксы*/
	var allCheckboxes = $("#accYMapSearchTypeIm input:checkbox:enabled");
	var notChecked = allCheckboxes.not(':checked');
	allCheckboxes.removeAttr('checked');
	/* установили указатель типа недвижимости */ 
	imTypeActive = id;
	/* обнуляем значение полей input[text]*/
	if(imTypeActive != '4c3ec3ec5e9b5') {
		var element = $('#blck-4c3ec3ec5e9b5').children('.fDiv').children('input').val('');
	}
	/* логирование */ 
	logs ('установили указатель типа недвижимости setActiveTypeIm ', id);
	return;
}

/* */
function startYSearch() {
	//	в массив searchParams записываем параметры поиска недвижимости	*/
	setSearchParam();
	//	поиск недвижимости согласно заданным параметров	*/
	searchInImData();
	//	инициализация обьектов недвижимости на карте	*/
	initImImYMap();
	//
	doWhileYCallBack();
	// логирование */ 
	logs ('startYSearch ', logData);
}

/*	инициализация обьектов недвижимости на карте	*/
// Функция для отображения результата геокодирования
function initImImYMap() {
	logData = null;
	geocoderImList.cleanGeocoderImList();
	geocoderImList.imDataSCount =  imDataS.length-1;
	// проверка на существование недвижимости
	if( imDataS.length != 0) {
		//обход элементов недвижимости для отображения на карте
		for(var i = 0; i<imDataS.length; i++) {
			var adress = ( imDataS[i]['im_city_name'] != "" ? imDataS[i]['im_city_name'] + ", " : "") + ( imDataS[i]['im_area_name'] != "" ? imDataS[i]['im_area_name'] + ", " : "") + ( imDataS[i]['im_adress_name'] != "" ? imDataS[i]['im_adress_name'] + ", " : "") + ( imDataS[i]['im_adress_house'] != "" ? imDataS[i]['im_adress_house'] + ", " : "") ;
			//alert(adress);
			// Запуск процесса геокодирования
			geocoder = new YMaps.Geocoder(adress, {results: 1, id: i });
			geocoder.id = i;
			if(imDataS[i]['im_geopos'] != "") {
				//указываем жестко позиционирование на карте
				//alert("im_geopos" + imDataS[i]['im_geopos']);
				//alert(imDataS[i]['im_geopos'].substr(0, imDataS[i]['im_geopos'].indexOf(",")) + "<>" + imDataS[i]['im_geopos'].substr(imDataS[i]['im_geopos'].indexOf(",") + 1, imDataS[i]['im_geopos'].lenght ));
				
				setGeopointerResult(i, imDataS[i]['im_geopos'].substr(0, imDataS[i]['im_geopos'].indexOf(",")), imDataS[i]['im_geopos'].substr(imDataS[i]['im_geopos'].indexOf(",") + 1, imDataS[i]['im_geopos'].lenght ));
				setGeopointerId(i);
			}
			else {	
				YMaps.Events.observe(geocoder, geocoder.Events.Load, function () {
					if (this.length()) {
						setGeopointerResult(this.id, this.get(0).getGeoPoint().__lng, this.get(0).getGeoPoint().__lat);
					}
					setGeopointerId(this.id);
				});
				YMaps.Events.observe(geocoder, geocoder.Events.Fault, function (geocoder, error) {
					alert("Произошла ошибка: " + error);
				})
			}
		}
		//добавление коммекции недвижимости на карту
		//iMap.addOverlay(gCollection);
		// Процесс геокодирования завершен неудачно
	}
	else {
		geocoderImList.isDone = true;
		geocoderImList.imDataSCount = 0;
	}
	/* логирование */ 
	logs ('initImImYMap ', logData);
}
/**
 * setgCollection
 */
 function setgCollection() {
 	//	Удаление предыдущего результата поиска
	gCollection.removeAll();
	gCollection = new YMaps.GeoObjectCollection(iconStyle[imTypeActive]);	
	//	обход всех эл. массива геокодирование
	var isListIcon;
	for (var key in geocoderImList.arrGeocoderImList) {
 	   	var val = geocoderImList.arrGeocoderImList [key];
 	    isListIcon = imTypeActive;
 	   	if(geocoderImList.arrGeocoderImList [key].length > 1)
 	   	isListIcon = imTypeActive + "-l";
 	   	var placemark = new YMaps.Placemark(new YMaps.GeoPoint(val[0]._lng, val[0]._lat), {hasHint: true, style : iconStyleTitle[isListIcon]});
 	   	placemark.name = "";
 	   	placemark.description = geocoderImList.getPlacemarkTemplate(_templateContent, key, imDataS, searchParams);
 	    placemark.metaDataProperty.count = geocoderImList.arrGeocoderImList [key].length;
		gCollection.add(placemark);
	}	
	//	добавление группы на карту
	iMap.addOverlay(gCollection);
	// 	логирование
	logs ('gCollection ',  geocoderImList.countImList);
	return;
 }

/**
 * setGeopointerResult
 * @param {void} id, __lng, __lat 
 */
 function setGeopointerResult(id, __lng, __lat) {
 	//alert( id +'' + __lng +'' + __lat);
 	geocoderImList.setElementGeocoder(id, __lng, __lat);
 	return;
 }

 /**  
 * setGeopointerResult
 * @param {void} id, __lng, __lat 
 */
 function setGeopointerId(id) {
 	geocoderImList.setIsDone(id);
 	return;
 }

/**
 * searchInImData
 * поиск недвижимости согласно заданным параметров
 */
function searchInImData() {	
	logData = null;
	imDataS = Array();
	var d;
	/* обходим массив недвижимости  */ 
	for(var j = 0; j<imData.length; j++) {
		if(imData[j]['im_catalog_id'] == imTypeActive) {
			var is = (imDataS.length == 0 ? 0 :  imDataS.length); 
			/* обходим массив параметров поиска */ 
			//for(var i = 0; i<searchParams.length; i++) {
				var flag = true;
				for (var key in searchParamsSort) {
					var val = searchParamsSort[key];
		   			/* в зависимости от имени поля поиска применяем закон */ 
					switch(key) {
						case 'im_roomb': {
							if(val > parseInt (imData[j]['im_room']) ) flag = false;
							break;
						}
						case 'im_roome': {
							if(val < parseInt (imData[j]['im_room']) ) flag = false;
							break;
						}
						case 'im_priceb': {
							if(searchParamsSort['im_is_sale']) {
								if(val > parseInt (imData[j]['im_prace']) ) flag = false;
							}
							if(searchParamsSort['im_is_rent']) {
								if(val > parseInt (imData[j]['im_prace_manth']) ) flag = false;
							}
							break;
						}
						case 'im_pricee': {
							if((searchParamsSort['im_is_sale']) && (imData[j]['im_is_sale'] == 1)) {	
								if(val < parseInt (imData[j]['im_prace']) ) flag = false;
							}
							if((searchParamsSort['im_is_rent']) && (imData[j]['im_is_rent'] == 1)) {
								if(val < parseInt (imData[j]['im_prace_manth']) ) flag = false;
							}
							break;
						}
						case 'im_spaceb': {
							if(val > parseInt (imData[j]['im_space']) ) flag = false;
							break;
						}
						case 'im_spacee': {
							if(val < parseInt (imData[j]['im_space']) ) flag = false;
							break;
						}
						case 'im_is_sale': {
							if(imData[j]['im_is_sale'] != 1) {
								if(searchParamsSort['im_is_rent']) {
									if(imData[j]['im_is_rent'] != 1) flag = false;
								}
								else flag = false;
							}
							break;
						}
						case 'im_is_rent': {
							if(imData[j]['im_is_rent'] != 1) {
								if(searchParamsSort['im_is_sale']) {
									if(imData[j]['im_is_sale'] != 1) flag = false;
								}
								else flag = false;
							}
							break;
						}
						default : {
//							!!!!!сделать поиск по аренде продаже зависимость
							if(imData[j][key] != val ) flag = false;
							d = imData[j][key];
							break;
						}
					}
				}
			
			if (flag == true) { 
				logData += "!!!!im_id:" + imData[j]['im_id'] + " im_catalog_id:" + imData[j]['im_catalog_id'] + " key:" + key + " val:" + val + " code:" +  imData[j]['im_code'] +";</br>";
				imDataS[is] = imData[j];
			}	
			//}
		}
	}
	/* логирование */ 
	logs ('searchInImData ', logData);
}

/**
 * searchInImData
 * в массив searchParams записываем параметры поиска недвижимости
 */
function setSearchParam() {
	searchParams = Array();
	searchParamsSort = Array();
	logData = null;
	var i = -1;
	/* обходим поля формы */ 
	$('#formYMapSearch input').each(function( n, element ){
		if(($(element).attr('rel') == imTypeActive) || ($(element).attr('rel') == null)) {
			/* логирование */ 
			switch($(element).attr('type')) {
				case 'text': {
					if($(element).val() == '') break;
					i++;
					searchParams[i] = new Array();
					searchParams[i][$(element).attr('name')] = $(element).val();
					searchParamsSort[$(element).attr('name')] = new Array();
					searchParamsSort[$(element).attr('name')] = $(element).val();
					break;
				}
				case 'checkbox': {
					if($(element).attr('checked') == false) break;
					i++;
					searchParams[i] = new Array();
					searchParams[i][$(element).attr('name')] = $(element).val();
					searchParamsSort[$(element).attr('name')] = new Array();
					searchParamsSort[$(element).attr('name')] = $(element).val();
					break;
				}
				default : {
					break;
				}
			}
			logData += $(element).attr('name') + "' '" + $(element).val() + " ->" + $(element).attr('type') +";";
		}
	});
	/* логирование */ 
	logs ('setSearchParam ', logData);
}

/**
 * setYMapIconStyle
 * определение стиля иконок недвижимости
 * @param {void} typeIm
 */
function setYMapIconStyle(typeIm) {
	iconStyle[typeIm] = new YMaps.Style();
	iconStyle[typeIm].iconStyle = new YMaps.IconStyle();
	iconStyle[typeIm].iconStyle.href = "http://alfabrok.ua/files/images/YMap/typeIm/" + typeIm + ".gif";
	iconStyle[typeIm].iconStyle.size = new YMaps.Point(27, 26);
	iconStyle[typeIm].iconStyle.offset = new YMaps.Point(-9, -26);
	iconStyleTitle[typeIm].iconStyle = new YMaps.IconStyle();
	iconStyleTitle[typeIm].iconStyle.href = "http://alfabrok.ua/files/images/YMap/typeIm/" + typeIm + ".gif";
	iconStyleTitle[typeIm].iconStyle.size = new YMaps.Point(27, 26);
	iconStyleTitle[typeIm].iconStyle.offset = new YMaps.Point(-9, -26);
	iconStyleTitle[typeIm].hintContentStyle = new YMaps.HintContentStyle(new YMaps.Template("<div style=\"\">Кол-во объектов: <b>$[metaDataProperty.count]</b></div>"));
	return;
}

/* */
function logs(msq, data) {
	//$('#RRSYM').append("" + msq + "<br>" + data + "<hr/>");
	//$('#RRSYMNow').html("" + msq + "<br>" + data + "<hr/>");
	return;
}

/**
 * 
 * doWhileYCallBack
 * функция запускаеться через 0.5 секунды для запуска след. функций (setgCollection, setImCount)
 * @param {type} param 
 */
 function doWhileYCallBack() {
 	if(geocoderImList.isDone == true) {
 		//	 
		setgCollection();
		//	отображение найденных и отображенных на карте объектов недвижимости 
		setImCount();	
		//
		yLoading.complete();
 		//	логирование  
		logs ('doWhileYCallBack ', 't');
 		return;
 	}
 	else {
 		var timeoutId = setTimeout(doWhileYCallBack, 500);
 		/* логирование */ 
		logs ('doWhileYCallBack ', 'f');
 	}
 }

/**
 * 
 * setImCount
 * отображение количества найденной на карте недви.
 */
function setImCount() {
	//alert(geocoderImList.countImList);
	var countImDataS = geocoderImList.countImList;
	//imDataSY.length;
	$("#CountSearchIm span").text(countImDataS);
	$("#CountSearchIm").show();
	return;
}