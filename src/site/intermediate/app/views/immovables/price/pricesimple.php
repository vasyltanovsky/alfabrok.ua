<?php global $arWords; ?>
<?php global $exchangeRateObj; ?>
<span class="ImSpanPrice"><?php echo Discharge::GetDisValue($Data[$key]*$exchangeRateObj->GetItemData('USD'), 4)?> </span>
<span class="ImSpanPriceUSA" title="<?php echo $arWords['exchange_by_ndu']?>">(<?php echo $arWords['exchange_by_ndu']."</br>".Discharge::GetDisValue($Data[$key] , 4, " $") ?>)</span>
