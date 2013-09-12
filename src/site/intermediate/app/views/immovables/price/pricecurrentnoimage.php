<?php global $exchangeRateObj; ?>
<?php if($Data ['im_prace_old'] < $Data ['im_prace']):?>
	<span class="ImSpanPrice"><?php echo Discharge::GetDisValue($Data['im_prace']*$exchangeRateObj->GetItemData('USD'), 4)?> </span>
	<span class="ImSpanPriceUSA" title="><?php echo $arWords['exchange_by_ndu']?>">(<?php echo Discharge::GetDisValue($Data['im_prace'], 4, " $")?>)</span>
	<span class="ImSpanPriceOld"><?php echo Discharge::GetDisValue($Data['im_prace_old']*$_COOKIE['exchange_USD'], 4)?> </span>
<?php endif;?>
<?php if($Data ['im_prace_old'] > $Data ['im_prace']):?>
	<span class="ImSpanPrice"><?php echo Discharge::GetDisValue($Data['im_prace']*$_COOKIE['exchange_USD'], 4)?> </span>
	<span class="ImSpanPriceUSA" title="<?php echo $arWords['exchange_by_ndu']?>">(<?php echo Discharge::GetDisValue($Data['im_prace'], 4, " $") ?>)</span>
	<span class="ImSpanPriceOld"><?php echo Discharge::GetDisValue($Data['im_prace_old']*$exchangeRateObj->GetItemData('USD'), 4)?> </span>
	<?php else: ?><span class="ImSpanPrice"><?php echo Discharge::GetDisValue($Data['im_prace']*$exchangeRateObj->GetItemData('USD'), 4)?> </span>
	<span class="ImSpanPriceUSA" title="<?php echo $arWords['exchange_by_ndu']?>">(<?php echo Discharge::GetDisValue($Data['im_prace'], 4, " $") ?>)</span>
<?php endif;?>