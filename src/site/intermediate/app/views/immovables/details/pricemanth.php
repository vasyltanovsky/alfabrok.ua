<?php global $arWords; ?>
<?php global $exchangeRateObj; ?>
<div class="DivImTablePrice">
	<?php echo Discharge::GetDisValue($Data[$key]*$exchangeRateObj->GetItemData('USD'), 4)?> 
	<?php echo appHtmlClass::partial("exchangerate/block", array("value" => $Data[$key])); ?></span>
</div>