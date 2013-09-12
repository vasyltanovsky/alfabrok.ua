<?php global $arWords; ?>
<?php if (! empty ( $item ['im_geopos'] )) :?>
	<img src="http://static-maps.yandex.ru/1.x/?key=<?php echo $arWords["YMapSiteKey"];?>&amp;l=map&amp;pt=<?php echo $item ['im_geopos'];?>,pmywl&amp;size=140,140" alt="">
<?php  else : ?>
	<script type="text/javascript">
		$(function() {
			GetYMapsGeoPointer('<?php echo $item ['im_id'];?>','<?php echo $m->GetDictValue($item, 'im_city_id');?>, <?php echo $m->GetDictValue($item, 'im_adress_id');?>, <?php echo $item ['im_adress_house'];?>');
		});
	</script> 
	<div id="im_map_<?php echo $item ['im_id'];?>" class="im_map_<?php echo $item ['im_id'];?>"></div>
<?php endif;?>