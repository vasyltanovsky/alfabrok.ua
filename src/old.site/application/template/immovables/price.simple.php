<?php 
global $arWords;
?>
<span class="ImSpanPrice"><?php echo Discharge::GetDisValue($data[$key]*$_COOKIE['exchange_USD'], 4)?> </span>
<span class="ImSpanPriceUSA" title="<?php echo $arWords['exchange_by_ndu']?>">(<?php echo $arWords['exchange_by_ndu']."</br>".Discharge::GetDisValue($data[$key] , 4, " $") ?>)</span>
