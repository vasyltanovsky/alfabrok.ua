<?php 
global $arWords;
global $exchangeRateObj;
if($Data ['im_prace_old'] < $Data ['im_prace']):?>
	<img src="<?php echo getLangString("imageDomain")?>/files/images/bg/price_up.png" class="ImPriceUpImg" alt="" title=""/>
	<span class="ImSpanPrice"><?php echo Discharge::GetDisValue($Data['im_prace']*$exchangeRateObj->GetItemData('USD'), 4)?> </span>
	<span class="ImSpanPriceUSA" title="><?php echo $arWords['exchange_by_ndu']?>">(<?php echo $arWords['exchange_by_ndu']."</br>".Discharge::GetDisValue($Data['im_prace'], 4, " $")?>)</span>
	<span class="ImSpanPriceOld"><?php echo Discharge::GetDisValue($Data['im_prace_old']*$exchangeRateObj->GetItemData('USD'), 4)?> </span>
<?php endif;?>
<?php if($Data ['im_prace_old'] > $Data ['im_prace']):?>
	<img src="<?php echo getLangString("imageDomain")?>/files/images/bg/price_down.png" class="ImPriceDownImg" alt="" title=""/>
	<span class="ImSpanPrice"><?php echo Discharge::GetDisValue($Data['im_prace']*$exchangeRateObj->GetItemData('USD'), 4)?> </span>
	<span class="ImSpanPriceUSA" title="<?php echo $arWords['exchange_by_ndu']?>">(<?php echo $arWords['exchange_by_ndu']."</br>".Discharge::GetDisValue($Data['im_prace'], 4, " $") ?>)</span>
	<span class="ImSpanPriceOld"><?php echo Discharge::GetDisValue($Data['im_prace_old']*$exchangeRateObj->GetItemData('USD'), 4)?> </span>
<?php else: ?>
	<span class="ImSpanPrice"><?php echo Discharge::GetDisValue($Data['im_prace']*$exchangeRateObj->GetItemData('USD'), 4)?> </span>
	<span class="ImSpanPriceUSA" title="<?php echo $arWords['exchange_by_ndu']?>">(<?php echo $arWords['exchange_by_ndu']."</br>".Discharge::GetDisValue($Data['im_prace_old'] , 4, " $") ?>)</span>
<?php endif;?>