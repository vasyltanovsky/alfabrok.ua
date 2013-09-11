<span class=price-arrow-down>&nbsp;</span>
	<div class=exchange-rate-block>
	<h4><?php echo $arWords['exchange_by_ndu'];?></h4>
	<p>USA $ = <span class=val><?php echo Discharge::GetDisValue($value , 4, "") ?></span></p>
	<p>EUR &#8364; ≈ <span class=val><?php echo Discharge::GetDisValue(round($value*($_COOKIE['exchange_USD']/$_COOKIE['exchange_EUR'])), 4, "") ?></span></p>
	<p>RUB руб. ≈ <span class=val><?php echo Discharge::GetDisValue($value*$_COOKIE['exchange_USD']/$_COOKIE['exchange_RUB'], 4, "") ?></span></p>
	<div class=clear></div>
</div>