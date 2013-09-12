<?php global $exchangeRateObj; ?>
<?php global $arWords; ?>
<?php $m = new ModuleSiteIm(array(), $arWords, $Model->dictionaries, $Model->propertiesData->ImPropData, $Model->propertiesData->ImPropArrData);?>
<table cellpadding="0" cellspacing="0" border="0" class="ImTablePrice">
<?php if($Data ['im_prace_old'] < $Data ['im_prace']):?>
	<tr>
		<td>
			<span class=ImSpanPriceOne><?php echo Discharge::GetDisValue($Data['im_prace']*$exchangeRateObj->GetItemData('USD'), 4)?> 
			<?php echo appHtmlClass::partial("exchangerate/block", array("value" => $Data['im_prace'])); ?></span>
			<span class=ImSpanPriceOldOne><?php echo Discharge::GetDisValue($Data['im_prace_old']*$exchangeRateObj->GetItemData('USD'), 4); ?> </span>
		</td>
		<td><img src=<?php echo getLangString("imageDomain")?>/files/images/bg/price_up.png class=ImPriceUpImg alt="" title=""/></td></tr>
<?php endif;?>
<?php if($Data ['im_prace_old'] > $Data ['im_prace']):?>
	<tr>
		<td>
			<span class=ImSpanPriceOne><?php echo Discharge::GetDisValue($Data['im_prace']*$exchangeRateObj->GetItemData('USD'), 4)?> 
			<?php echo appHtmlClass::partial("exchangerate/block", array("value" =>$Data['im_prace'])); ?></span>
			<span class=ImSpanPriceOldOne><?php echo Discharge::GetDisValue($Data['im_prace_old']*$exchangeRateObj->GetItemData('USD'), 4)?> 
			<?php echo appHtmlClass::partial("exchangerate/block", array("value" =>$Data['im_prace'])); ?></span>
		</td>
		<td><img src=<?php echo getLangString("imageDomain")?>/files/images/bg/price_down.png class=ImPriceDownImg alt= title=/></td></tr>
<?php else: ?>
	<tr>
		<td>
		<span class=ImSpanPriceOne><?php echo Discharge::GetDisValue($Data['im_prace']*$exchangeRateObj->GetItemData('USD'), 4)?> 
		<?php echo appHtmlClass::partial("exchangerate/block", array("value" =>$Data['im_prace'])); ?></span></td></tr>
<?php endif;?>
</table>
<?php echo $m->GetOtherPrice($Model->item, null);?>
