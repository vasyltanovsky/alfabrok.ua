<?php global $routingObj; ?>
<?php global $exchangeRateObj; ?>
<?php global $arWords; ?>
<?php $m = new ModuleSiteIm(array(), $arWords, $Model->dictionaries, $Model->propertiesData->ImPropData, $Model->propertiesData->ImPropArrData);?>
<?php if($Model->list):?>
	<table cellpadding="0" cellspacing="0" border="0" class="list_Flat_table_block search_list_table">
		<tr class="list_Flat_table_block_header">
			<td class="TdLeftBorder"><?php echo getLangString('ImFListHeaderCode');?></td>
			<td><?php echo getLangString('ImFListHeaderImg');?></td>															
			<td><?php echo getLangString('ImFListHeaderSummary');?>(<?php echo getLangString('ImFListHeaderArea');?>/ <?php echo getLangString('ImFListHeaderStreet');?>)</td>
			<td><?php echo getLangString('TypeCatImName');?></td>
			<td><?php echo getLangString('ImFListHeaderPrice');?></td>
			<td><?php echo getLangString('ImFListHeaderM2Sotku');?></td>
			<td width="50"><?php echo getLangString('FormSearchNamePriceManth');?> ($)</td>
			<td><?php echo getLangString('ImFListHeaderSq');?> <?php echo getLangString('ImFListHeaderSqPl');?></td>
			<td><?php echo getLangString('ImSale');?>/ <?php echo getLangString('ImRent');?></td>
			<td class="TdRightBorder"><?php echo getLangString('ImFListHeaderMap');?></td>
		</tr>
		<?php foreach ($Model->list as $key => $value):?>
			<tr>
				<td class="TdListLeftBorder"><?php echo $value["im_code"];?></td>
				<td class="ListTableImIndexImg"><a href="/ru/<?php echo $arWords["TypeCatImNameArrIdPAge"][$value["im_catalog_id"]]; ?>/<?php echo ($value["im_is_sale"] ? "sale" : "rent");?>/1/<?php echo $value["im_id"];?>"><img src="<?php echo getLangString('imageDomain');?>/files/images/immovables/st_<?php echo $value["im_photo"];?>" alt="<?php echo $value["im_title"];?>"/></a></td>
				<td class="TdListLeftAlight"><p><?php echo $value["im_title"];?></p><p><b><?php echo $m->GetFullAdress($value, "im_full_adress")?></b></p><div class="ImPropTable"><?php echo $m->GetPropListValue($value, "im_prop_list")?></div><a class="AReadMore" href="/ru/<?php echo $arWords["TypeCatImNameArrIdPAge"][$value["im_catalog_id"]]; ?>/<?php echo ($value["im_is_sale"] ? "sale" : "rent");?>/1/<?php echo $value["im_id"]; ?>"><?php echo getLangString(REadMore);?></a></td>
                <td><?php echo getLangString($value["im_catalog_id"] . '_item');?></td>
				<td class="TdTextCenter"><?php echo appHtmlClass::partial("immovables/price/pricecurrent", array("Data" => $value)); ?></td>
				<td><?php echo Discharge::GetDisValue ( $value ["im_prace_sq"] * $exchangeRateObj->GetItemData('USD'), 4 );?></td>
				<td><?php if($value["im_prace_day"]) echo appHtmlClass::partial("immovables/price/pricesimple", array("Data" => $value, "key" => "im_prace_day")); ?></td>
           		<td><?php echo $value["im_space"];?></td>
				<td>
					<?php if($value["im_is_sale"]):?>
						<a href="/ru/<?php echo $arWords["TypeCatImNameArrIdPAge"][$value["im_catalog_id"]]; ?>/<?php echo ($value["im_is_sale"] ? "sale" : "rent");?>/1/<?php echo $value["im_id"]; ?>"><img title="Продажа" alt="Продажа" class="ImPriceUpImg" src="<?php echo getLangString('imageDomain');?>/files/images/bg/sale_im.png"></a>
					<?php endif;?>
					<?php if($value["im_is_rent"]):?>
						<a href="/ru/<?php echo $arWords["TypeCatImNameArrIdPAge"][$value["im_catalog_id"]]; ?>/<?php echo ($value["im_is_sale"] ? "sale" : "rent");?>/1/<?php echo $value["im_id"]; ?>"><img title="Продажа" alt="Продажа" class="ImPriceUpImg" src="<?php echo getLangString('imageDomain');?>/files/images/bg/rent_im.png"></a>
					<?php endif;?>	
				</td>
			    <td class="TdListRightBorder"><a href="/ru/<?php echo $arWords["TypeCatImNameArrIdPAge"][$value["im_catalog_id"]]; ?>/<?php echo ($value["im_is_sale"] ? "sale" : "rent");?>/1/<?php echo $value["im_id"]; ?>#YMapsID"><?php echo appHtmlClass::partial("immovables/ymap/image", array("Model"=>$Model, "item" => $value, "m" => $m) );?></a></td>	
        	</tr>	
		<?php endforeach;?>
	</table>												
<?php else:?>
	<?php echo appHtmlClass::partial("immovables/immovablesnoposition"); ?>
<?php endif;?>