<?php global $routingObj; ?>
<?php global $exchangeRateObj; ?>
<?php global $arWords; ?>
<?php $m = new ModuleSiteIm(array(), $arWords, $Model->dictionaries, $Model->propertiesData->ImPropData, $Model->propertiesData->ImPropArrData);?>
<table cellpadding="0" cellspacing="0" border="0" class="list_Flat_table_block">
    <tr class="list_Flat_table_block_header">
        <td class="TdLeftBorder"><?php echo getLangString('ImFListHeaderCode');?></td>
        <td class="TdLisImImage"><?php echo getLangString('ImFListHeaderImg');?></td>															
        <td><?php echo getLangString('ImFListHeaderSummary');?>(<?php echo getLangString('ImFListHeaderArea');?>/<a rel="nofollow" href="javascript:setSortTable('im_adress_id');" class="<?php echo WhatSort("im_adress_id");?>"><?php echo getLangString('ImFListHeaderStreet');?></a>)</td>
        <td><a rel="nofollow" href="javascript:setSortTable('im_prace');" class="<?php echo WhatSort("im_prace");?>"><?php echo getLangString('ImFListHeaderPrice');?> </a></td>
        <td><a rel="nofollow" href="javascript:setSortTable('im_prace_sq');" class="<?php echo WhatSort("im_prace_sq");?>"><?php echo getLangString('ImFListHeaderM2');?></a></td>
        <td><?php echo getLangString('ImFListHeaderSqPl');?> <a rel="nofollow" href="javascript:setSortTable('im_space');" class="<?php echo WhatSort("im_space");?>"><?php echo getLangString('ImFListHeaderSq');?></a></td>
        <td><?php echo getLangString('ImFListHeaderRoom');?></td>
        <td class="TdRightBorder"><?php echo getLangString('ImFListHeaderMap');?></td>
    </tr>
	<?php foreach ($Model->list as $key => $value):?>
	<tr>
		<td class="TdListLeftBorder"><?php echo $value["im_code"];?><a href="/ru/immovables/sravnenie" title="<?php echo getLangString("sravnenie_link_title"); ?>" class="comparing-objects-link" id="comparing-item-<?php echo $value["im_id"];?>"><?php echo getLangString("sravnenie_link"); ?></a></td>
		<td class="ListTableImIndexImg"><a href="/ru/buildings/sale/<?php echo $routingObj->getParamItem("page_id", 1);?>/<?php echo $value["im_id"]; ?>"><img src="<?php echo getLangString('imageDomain');?>/files/images/immovables/st_<?php echo $value["im_photo"];?>" alt="<?php echo $value["im_title"];?>"/></a></td>
		<td class="TdListLeftAlight"><p><?php echo $value["im_title"];?></p><p><b><?php echo $m->GetFullAdress($value, "im_full_adress")?></b></p><div class="ImPropTable"><?php echo $m->GetPropListValue($value, "im_prop_list")?></div><a class="AReadMore" href="/ru/buildings/sale/<?php echo $routingObj->getParamItem("page_id", 1);?>/<?php echo $value["im_id"]; ?>"><?php echo getLangString(REadMore);?></a></td>
		<td class="TdTextCenter"><?php echo appHtmlClass::partial("immovables/price/pricecurrent", array("Data" => $value)); ?></td>
		<td><?php echo Discharge::GetDisValue ( $value ["im_prace_sq"] * $exchangeRateObj->GetItemData('USD'), 4 );?></td>
		<td><?php echo $value["im_space"];?></td>
		<td><?php echo $m->GetPropValue($value, "4c400ed4e5797")?></td>
		<td class="TdListRightBorder"><a href="/ru/buildings/sale/<?php echo $routingObj->getParamItem("page_id", 1);?>/<?php echo $value["im_id"]; ?>#YMapsID"><?php echo appHtmlClass::partial("immovables/ymap/image", array("Model"=>$Model, "item" => $value, "m" => $m) );?></a></td>	
	</tr>
	<?php endforeach;?>
</table>


