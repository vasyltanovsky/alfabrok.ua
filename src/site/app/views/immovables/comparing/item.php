<?php global $exchangeRateObj; ?>
<?php global $arWords; ?>
<li class="slide item ui-state-default" id="comparing-item-<?php echo $item["im_id"]?>">
	<div class="header">
		<a href="" id="comparing-remove-item-<?php echo $item["im_id"]?>" class="colp" title="<?php echo getLangString("comparingRemoveItemtitle");?>"><?php echo getLangString("comparingRemoveItem");?></a>
	</div>
	<div class="params">
		<span class="izobrazhenie"><img src="<?php echo getLangString('imageDomain');?>/files/images/immovables/st_<?php echo $item["im_photo"];?>" alt="<?php echo $item["im_title"];?>"/></span>
		<span class="kod"><a target="_blank" href="/<?php echo $Model->getitemlink($item)?>"><?php echo $item["im_code"];?></a></span>
		<span class="oblast"><?php echo $Model->dictionaries->buld_table[$item["im_region_id"]]["dict_name"];?></span>
		<span class="r-n-oblasti"><?php echo $Model->dictionaries->buld_table[$item["im_a_region_id"]]["dict_name"];?></span>
		<span class="gorod-poselok"><?php echo $Model->dictionaries->buld_table[$item["im_city_id"]]["dict_name"];?></span>
		<span class="r-n-goroda"><?php echo $Model->dictionaries->buld_table[$item["im_area_id"]]["dict_name"];?></span>
		<span class="ulitsa"><?php echo $Model->dictionaries->buld_table[$item["im_adress_id"]]["dict_name"];?></span>
		<span class="tsena-prodazha"><?php echo $item['im_prace']?></span>
		<span class="tsena-arenda"><?php echo $item['im_prace_manth']?></span>
		<span class="tsena-za-m2"><?php echo $item['im_prace_sq']?></span>
		<span class="obschaja-ploschad"><?php echo $item["im_space"]?></span>
		<div class="properties">
			<?php if($Model->propertiesListGroup):?>
				<?php foreach ($Model->propertiesListGroup as $key => $value):?>
					<?php 
						$im_prop_id = $value[sprintf("%s_im_prop_id", $arWords["TypeCatImNameArrIdPAge"][$item["im_catalog_id"]])];
						$im_prop_style_id = $value["im_prop_style_id"];
						$propvalue = $m->GetPropValueMini($item, $im_prop_id, $im_prop_style_id);
						$propvaluei = $m->GetPropValue($item, $im_prop_id);
					?>
					<span class="<?php echo strtolower(translit($value["im_prop_name"]))?>"><?php echo $propvalue;?></span>
				<?php endforeach;?>
			<?php endif;?>
		</div>
	</div>
</li>