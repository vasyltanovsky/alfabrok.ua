<?php global $exchangeRateObj; ?>
<?php if($param["type_cat"] == "sale"):?>
	<b style="color:#C9A72B; font-size:16px;"><?php echo Discharge::GetDisValue($Model['im_prace']*$exchangeRateObj->GetItemData('USD'), 4)?> </b>
<?php else:?>
	<b style="color:#C9A72B; font-size:16px;"><?php echo Discharge::GetDisValue($Model['im_prace_manth']*$exchangeRateObj->GetItemData('USD'), 4)?> </b>
<?php endif;?>
