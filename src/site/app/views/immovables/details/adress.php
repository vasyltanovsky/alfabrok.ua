<?php $AdrArr = array ('im_region_id' => 'FormSearchNameRegion', 'im_a_region_id' => 'FormSearchNameRRegionN', 'im_city_id' => 'FormSearchNameCity', 'im_area_id' => 'FormSearchNameACityN', 'im_array_id' => 'FormSearchNameACity', 'im_adress_id' => 'FormSearchNameAdress' );?>
<?php if($Model):?>
	<div class="DivImTableAdressName">
		<table cellpadding="0" cellspacing="0" border="0" class="ImTableAdressName">
			<?php foreach ($AdrArr as $key => $value):?>
				<?php if(!empty($Model->item[$key])):?>
					<?php if($key == "im_adress_id"):?>
						<tr class="<?php echo $key;?>"><td class="ImTableAdressTdlang"><?php echo getLangString($value);?></td><td class="some-width"><?php echo $Model->dictionaries->getDictValue($Model->item, $key);?>, <?php echo $Model->item["im_adress_house"];?></td></tr>
					<?php else:?>
						<tr class="<?php echo $key;?>"><td class="ImTableAdressTdlang"><?php echo getLangString($value);?></td><td class="some-width"><?php echo $Model->dictionaries->getDictValue($Model->item, $key);?></td></tr>
					<?php endif;?>
				<?php endif;?>
			<?php endforeach;?>
		</table>
	</div>
<?php endif;?>