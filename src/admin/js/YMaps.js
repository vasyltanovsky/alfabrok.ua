// JavaScript Document
var YMapSiteKey = 'AClnakwBAAAACI7GfgIABsUZ_ZGh4cxSuN2lRkclVs3B3PAAAAAAAAAAAAB6Tfj4eS4BXxpBcsMrwOAqQh3hmg==~AHNmakwBAAAAIo_9YQIAa0OikH9hvUf6M0w0_cIYi_wFsngAAAAAAAAAAABWdqXLzkUIwYYx_0-o4BC5LRvwMA==';

	YMaps.jQuery(function () {
				// Создание экземпляра карты и его привязка к созданному контейнеру
				map = new YMaps.Map(YMaps.jQuery("#YMapsID")[0]);});
	
// Функция для отображения результата геокодирования
// Параметр value - адрес объекта для поиска
function showYMapsAddress (MapsName, value) {
	// Удаление предыдущего результата поиска
	MapsName.removeOverlay(geoResult);

	// Запуск процесса геокодирования
	var geocoder = new YMaps.Geocoder(value, {results: 1, boundedBy: map.getBounds()});


		// Создание обработчика для успешного завершения геокодирования
		YMaps.Events.observe(geocoder, geocoder.Events.Load, function () {
			// Если объект был найден, то добавляем его на карту
			// и центрируем карту по области обзора найденного объекта
			if (this.length()) {
				geoResult = this.get(0);
				MapsName.addOverlay(geoResult);
				MapsName.setBounds(geoResult.getBounds());
				var linkPanorama = "http://maps.yandex.ru/?text=" + value +" &ol=stv&oll=" + this.get(0).getGeoPoint() +"&ll=" + this.get(0).getGeoPoint() + "&l=map%2Cstv";
				$('#aShowPanorama').attr({href: linkPanorama}) 
			}
			else {
				$('#aShowPanorama').hide() 
			}
		});
															
		// Процесс геокодирования завершен неудачно
		YMaps.Events.observe(geocoder, geocoder.Events.Fault, function (geocoder, error) {
			alert("Произошла ошибка: " + error);
		})
}

function GetYMapsGeoPointer(id, value) {
	var geocoder = new YMaps.Geocoder(value, {results: 1});
	// Создание обработчика для успешного завершения геокодирования
	YMaps.Events.observe(geocoder, geocoder.Events.Load, function () {
		// Если объект был найден, то добавляем его на карту
		// и центрируем карту по области обзора найденного объекта
		if (this.length()) {
			geoResult = this.get(0);
			//alert(this.get(0).getGeoPoint());
			//
			var img =  '<img alt="" src="http://static-maps.yandex.ru/1.x/?key='+YMapSiteKey+'&amp;l=map&amp;pt='+this.get(0).getGeoPoint()+',pmywl&size=140,140"/>';
			//alert(img);
			$(".im_map_"+id).html(img);
			//alert(this.get(0).getGeoPoint());
		} else return false; 
	});
	// Процесс геокодирования завершен неудачно
	YMaps.Events.observe(geocoder, geocoder.Events.Fault, function (geocoder, error) {
		//alert("Произошла ошибка: " + error);
	})
}