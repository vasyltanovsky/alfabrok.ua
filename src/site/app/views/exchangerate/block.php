<?php global $exchangeRateObj; ?>
<span class=price-arrow-down>&nbsp;</span>
	<div class=exchange-rate-block>
	<h4><?php echo getLangString('exchange_by_ndu');?></h4>
	<p>USA $ = <span class=val><?php echo Discharge::GetDisValue($value , 4, "") ?></span></p>
	<p>EUR &#8364; ≈ <span class=val><?php echo Discharge::GetDisValue(round($value*($exchangeRateObj->GetItemData('USD')/$exchangeRateObj->GetItemData('EUR'))), 4, "") ?></span></p>
	<p>RUB руб. ≈ <span class=val><?php echo Discharge::GetDisValue($value*$exchangeRateObj->GetItemData('USD')/$exchangeRateObj->GetItemData('RUB'), 4, "") ?></span></p>
	<div class=clear></div>
</div>