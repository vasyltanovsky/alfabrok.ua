<?php if($data ['im_prace_old'] < $data ['im_prace']):?><span class="ImSpanPrice"><?php echo Discharge::GetDisValue($data['im_prace']*$_COOKIE['exchange_USD'], 4)?> </span><span class="ImSpanPriceUSA" title="><?php echo $arWords['exchange_by_ndu']?>">(<?php echo Discharge::GetDisValue($data['im_prace'], 4, " $")?>)</span><span class="ImSpanPriceOld"><?php echo Discharge::GetDisValue($data['im_prace_old']*$_COOKIE['exchange_USD'], 4)?> </span><?php endif;?><?php if($data ['im_prace_old'] > $data ['im_prace']):?><span class="ImSpanPrice"><?php echo Discharge::GetDisValue($data['im_prace']*$_COOKIE['exchange_USD'], 4)?> </span><span class="ImSpanPriceUSA" title="<?php echo $arWords['exchange_by_ndu']?>">(<?php echo Discharge::GetDisValue($data['im_prace'], 4, " $") ?>)</span><span class="ImSpanPriceOld"><?php echo Discharge::GetDisValue($data['im_prace_old']*$_COOKIE['exchange_USD'], 4)?> </span><?php else: ?><span class="ImSpanPrice"><?php echo Discharge::GetDisValue($data['im_prace']*$_COOKIE['exchange_USD'], 4)?> </span><span class="ImSpanPriceUSA" title="<?php echo $arWords['exchange_by_ndu']?>">(<?php echo Discharge::GetDisValue($data['im_prace'], 4, " $") ?>)</span><?php endif;?>
<?php /*
<?php if($data ['im_prace_old'] < $data ['im_prace']):?>
	<span class="ImSpanPrice"><?php echo Discharge::GetDisValue($data['im_prace']*$_COOKIE['exchange_USD'], 4)?> </span>
	<span class="ImSpanPriceUSA" title="><?php echo $arWords['exchange_by_ndu']?>">(<?php echo Discharge::GetDisValue($data['im_prace'], 4, " $")?>)</span>
	<span class="ImSpanPriceOld"><?php echo Discharge::GetDisValue($data['im_prace_old']*$_COOKIE['exchange_USD'], 4)?> </span>
<?php endif;?>
<?php if($data ['im_prace_old'] > $data ['im_prace']):?>
	<span class="ImSpanPrice"><?php echo Discharge::GetDisValue($data['im_prace']*$_COOKIE['exchange_USD'], 4)?> </span>
	<span class="ImSpanPriceUSA" title="<?php echo $arWords['exchange_by_ndu']?>">(<?php echo Discharge::GetDisValue($data['im_prace'], 4, " $") ?>)</span>
	<span class="ImSpanPriceOld"><?php echo Discharge::GetDisValue($data['im_prace_old']*$_COOKIE['exchange_USD'], 4)?> </span>
<?php else: ?>
	<span class="ImSpanPrice"><?php echo Discharge::GetDisValue($data['im_prace']*$_COOKIE['exchange_USD'], 4)?> </span>
	<span class="ImSpanPriceUSA" title="<?php echo $arWords['exchange_by_ndu']?>">(<?php echo Discharge::GetDisValue($data['im_prace'], 4, " $") ?>)</span>
<?php endif;?>
*/
?>
