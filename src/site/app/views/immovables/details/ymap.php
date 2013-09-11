<script type="text/javascript">
// JavaScript Document
var map, geoResult;
var im_geopos = '<?php echo $Model->item["im_geopos"];?>';
// Создание обработчика для события window.onLoad
if(im_geopos == '') {
	YMaps.jQuery(function () {
		// Создание экземпляра карты и его привязка к созданному контейнеру
		map = new YMaps.Map(YMaps.jQuery("#YMapsID")[0]);
		map.addControl(new YMaps.TypeControl());
		map.addControl(new YMaps.ToolBar());
		map.addControl(new YMaps.Zoom());
		//map.addControl(new YMaps.MiniMap());
		map.addControl(new YMaps.ScaleLine());
		// Установка для карты ее центра и масштаба
		map.setCenter(new YMaps.GeoPoint(30.454415, 50.420595), 14);
		// Добавление элементов управления
		map.addControl(new YMaps.TypeControl());
		showYMapsAddress(map, '<?php echo $Model->dictionaries->getDictValue($Model->item, "im_city_id");?>, <?php echo $Model->dictionaries->getDictValue($Model->item, "im_adress_id");?> <?php echo $Model->item["im_adress_house"];?>');
	});
}
else {
	YMaps.jQuery(function () {
		// Создание экземпляра карты и его привязка к созданному контейнеру
		var map = new YMaps.Map(YMaps.jQuery('#YMapsID')[0]);
		map.addControl(new YMaps.TypeControl());
		map.addControl(new YMaps.ToolBar());
		map.addControl(new YMaps.Zoom());
		//map.addControl(new YMaps.MiniMap());
		map.addControl(new YMaps.ScaleLine());
		// Установка для карты ее центра и масштаба
		map.setCenter(new YMaps.GeoPoint(im_geopos.substr(0, im_geopos.indexOf(',')), im_geopos.substr(im_geopos.indexOf(',') + 1, im_geopos.lenght)), 14);
		var placemark = new YMaps.Placemark(new YMaps.GeoPoint(im_geopos.substr(0, im_geopos.indexOf(',')), im_geopos.substr(im_geopos.indexOf(',') + 1, im_geopos.lenght)));													
		map.addControl(new YMaps.TypeControl());
		placemark.name = '<?php echo $Model->dictionaries->getDictValue($Model->item, "im_city_id");?>, <?php echo $Model->dictionaries->getDictValue($Model->item, "im_adress_id");?> <?php echo $Model->item["im_adress_house"];?>';
		placemark.description = '<?php echo $Model->dictionaries->getDictValue($Model->item, "im_city_id");?>, <?php echo $Model->dictionaries->getDictValue($Model->item, "im_adress_id");?> <?php echo $Model->item["im_adress_house"];?>';
		map.addOverlay(placemark);
		var linkPanorama = "http://maps.yandex.ru/?text=" + '<?php echo $Model->dictionaries->getDictValue($Model->item, "im_city_id");?>, <?php echo $Model->dictionaries->getDictValue($Model->item, "im_adress_id");?> <?php echo $Model->item["im_adress_house"];?>' +" &ol=stv&oll=" + im_geopos +"&ll=" + im_geopos + "&l=map%2Cstv";
		$('#aShowPanorama').attr({href: linkPanorama}) 
	});
}
</script>
<div id="divYScreen">
	<span id="hideFullOneMap"><?php echo getLangString("formYMapSearchStrtScreenTitle");?></span>
	<div><a id="aShowPanorama" target="_blank" href="" class="AYPanorama"><span>&nbsp;</span><?php echo getLangString("viewImYPanorama");?></a></div>
	<div  name="YMapsID"  id="YMapsID" style="width:500px;height:400px"></div>
</div>