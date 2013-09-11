<?php global $arWords; ?>
<?php global $exchangeRateObj; ?>
<?php
	if(empty($Data[$key]))
	return;
?>
<h4 class="im-other-price">
	<?php echo Discharge::GetDisValue($Data[$key]*$exchangeRateObj->GetItemData('USD'), 4)?>
	<span class="price-arrow-down">&nbsp;</span>
	<?php echo appHtmlClass::partial("exchangerate/block", array("value" => $Data[$key])); ?>
	<span>(<?php echo getLangString(($key == "im_prace" ? "ImSale" : "ImRent"))?>)</span>
</h4>