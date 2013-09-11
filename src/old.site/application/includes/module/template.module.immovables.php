<?php
/*
 * 	карта недвижимости
 */											
	$ModuleTemplate['im_view_map_block'] 	= "<script type=\"text/javascript\">
												// JavaScript Document
												var map, geoResult;
												var im_geopos = '#im_geopos#';
												// Создание обработчика для события window.onLoad
												
													if(im_geopos == '') {
														YMaps.jQuery(function () {
															// Создание экземпляра карты и его привязка к созданному контейнеру
															map = new YMaps.Map(YMaps.jQuery(\"#YMapsID\")[0]);
															map.addControl(new YMaps.TypeControl());
															map.addControl(new YMaps.ToolBar());
															map.addControl(new YMaps.Zoom());
															//map.addControl(new YMaps.MiniMap());
															map.addControl(new YMaps.ScaleLine());
															// Установка для карты ее центра и масштаба
															map.setCenter(new YMaps.GeoPoint(30.454415, 50.420595), 14);
															// Добавление элементов управления
															map.addControl(new YMaps.TypeControl());
															showYMapsAddress(map, '#im_city_id#, #im_adress_id# #im_adress_house#');
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
															placemark.name = '#im_city_id#, #im_adress_id# #im_adress_house#';
															placemark.description = '#im_city_id#, #im_adress_id# #im_adress_house#';
															map.addOverlay(placemark);
															var linkPanorama = \"http://maps.yandex.ru/?text=\" + '#im_city_id#, #im_adress_id# #im_adress_house#' +\" &ol=stv&oll=\" + im_geopos +\"&ll=\" + im_geopos + \"&l=map%2Cstv\";
															$('#aShowPanorama').attr({href: linkPanorama}) 
														});
													}
											</script>";
/*
 * 	 план недвижимости
 */	
	$ModuleTemplate['im_view_plan_block'] 		= "<h3><a href=\"#\">{$arWords[im_accordion_plan]}</a></h3><div>#plans#<div class=\"clear\"></div></div>";
	$ModuleTemplate['im_view_plan_block_pos']   = "<a class=\"highslide\" href=\"/files/images/immovables/#im_photo_id#.#im_file_type#\" onclick=\"return hs.expand(this)\" ><img src=\"/files/images/immovables/si_#im_photo_id#.#im_file_type#\"/></a>";
	
/*
* 	видео недвижимости
*/
	$ModuleTemplate['im_view_video_block']	= "<h3><a href=\"#\">{$arWords[im_accordion_video]}</a></h3><div><object width=\"350\" height=\"275\">
											<param name=\"allowFullScreen\" value=\"true\" />
											<param name=\"allowScriptAccess\" value=\"always\" />
											<param name=\"wmode\" value=\"transparent\" />
											<param name=\"movie\" value=\"/files/flash/uppod.swf\" />
											<param name=\"flashvars\" value=\"st=/files/flash/video54-941.txt&amp;file=/files/video/im/#iv_id#.#iv_file_type#\" />
											<embed src=\"/files/flash/uppod.swf\"\" type=\"application/x-shockwave-flash\" allowscriptaccess=\"always\" allowfullscreen=\"true\" wmode=\"transparent\" flashvars=\"st=/files/flash/video54-941.txt&amp;file=/files/video/im/#iv_id#.#iv_file_type#\" width=\"350\" height=\"275\">
											</embed>
											</object></div>";
	
											
	$ModuleTemplate['im_similar_arr'] 	= "<div id=\"im_similar_arr\">#im_similar_arr#</div>";
	$ModuleTemplate['im_similar_str'] 	= "<div id=\"im_similar_str\">#im_similar_str#</div>";
	$ModuleTemplate['im_similar_spa'] 	= "<div id=\"im_similar_spa\">#im_similar_spa#</div>";
	$ModuleTemplate['im_similar_pri'] 	= "<div id=\"im_similar_pri\">#im_similar_pri#</div>";
	//$ModuleTemplate['im_similar_pri_sq']= "<div id=\"im_similar_pri_sq\">#im_similar_pri_sq#</div>";
	
	$ModuleTemplate['im_similar'] = "<div class=\"DivImSimilar\" id=\"tabs\">
										<ul>
											#im_similar_arr_h#
											#im_similar_str_h#
											#im_similar_spa_h#
											#im_similar_pri_h#
										</ul>
											#im_similar_arr#
											#im_similar_str#
											#im_similar_spa#
											#im_similar_pri#
										</div>";
	#im_similar_pri_sq_h#
	#im_similar_pri_sq#
	$ModuleTemplate['photo_list_block_header'] = "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"list_Flat_table_block\"><tr class=\"list_Flat_table_block_header\"><td class=\"TdLeftBorder\"></td><td>{$arWords['im_add_im_img_label']}</td><td class=\"TdRightBorder\">{$arWords['im_add_im_img_type_label']}</td></tr>";
	$ModuleTemplate['photo_list_block_bottom'] = "</table>";		
	$ModuleTemplate['photo_list_block'] = "<tr><td class=\"TdListLeftBorder\" width=\"15px\"><input type=\"radio\" value=\"#im_photo_id#\" name=\"im_photo_id\"/></td><td class=\"TdListLogoALignCenter\"  width=\"75px\"><img src=\"../../files/images/immovables/s_#im_photo_id#.#im_file_type#\" alt=\"\" title=\"\"></td><td class=\"TdListRightBorder\">#im_photo_type#</td></tr>";
	
	
	
?>