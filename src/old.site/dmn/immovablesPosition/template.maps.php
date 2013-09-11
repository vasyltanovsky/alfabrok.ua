<?php
	require_once '../utils/template.ajax/js.css.php';
	#	селектим таблицу страниц
   		$cl_sel_pages = new mysql_select($tbl_im);
		$active_id = $cl_sel_pages -> select_table_id("WHERE im_id='{$_POST[im_id]}'");
?>
<script src="http://api-maps.yandex.ru/1.1/index.xml?key=AClnakwBAAAACI7GfgIABsUZ_ZGh4cxSuN2lRkclVs3B3PAAAAAAAAAAAAB6Tfj4eS4BXxpBcsMrwOAqQh3hmg==" type="text/javascript"></script>
<script type="text/javascript">
		// JavaScript Document
		// Создание обработчика для события window.onLoad
		function GetYMapsGeoPointer(value) {
		var geocoder = new YMaps.Geocoder(value, {results: 1});
		// Создание обработчика для успешного завершения геокодирования
		YMaps.Events.observe(geocoder, geocoder.Events.Load, function () {
			// Если объект был найден, то добавляем его на карту
			// и центрируем карту по области обзора найденного объекта
			if (this.length()) {
				geoResult = this.get(0);
				alert(this.get(0).getGeoPoint());
				document.write(this.get(0).getGeoPoint());
			} else return false; 
		});
		// Процесс геокодирования завершен неудачно
		YMaps.Events.observe(geocoder, geocoder.Events.Fault, function (geocoder, error) {
			alert("Произошла ошибка: " + error);
		})
}	
</script>
