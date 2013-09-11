<?php if($data ['im_prace_old'] < $data ['im_prace']):?>
	<tr>
		<td>
			<span class=ImSpanPriceOne><?php echo Discharge::GetDisValue($data['im_prace']*$_COOKIE['exchange_USD'], 4)?> <?php echo Controller::Template("application/template/exchangeRate/exchange.rate.block.php", array("value" => $data['im_prace'])); ?></span>
			<span class=ImSpanPriceOldOne><?php echo Discharge::GetDisValue($data['im_prace_old']*$_COOKIE['exchange_USD'], 4); ?> </span>
		</td>
		<td><img src=/files/images/bg/price_up.png class=ImPriceUpImg alt="" title=""/></td></tr>
<?php endif;?>
<?php if($data ['im_prace_old'] > $data ['im_prace']):?>
	<tr>
		<td>
			<span class=ImSpanPriceOne><?php echo Discharge::GetDisValue($data['im_prace']*$_COOKIE['exchange_USD'], 4)?> <?php echo Controller::Template("application/template/exchangeRate/exchange.rate.block.php", array("value" =>$data['im_prace'])); ?></span>
			<span class=ImSpanPriceOldOne><?php echo Discharge::GetDisValue($data['im_prace_old']*$_COOKIE['exchange_USD'], 4)?> <?php echo Controller::Template("application/template/exchangeRate/exchange.rate.block.php", array("value" =>$data['im_prace'])); ?></span>
		</td>
		<td><img src=/files/images/bg/price_down.png class=ImPriceDownImg alt= title=/></td></tr>
<?php else: ?>
	<tr>
		<td>
		<span class=ImSpanPriceOne><?php echo Discharge::GetDisValue($data['im_prace']*$_COOKIE['exchange_USD'], 4)?> <?php echo Controller::Template("application/template/exchangeRate/exchange.rate.block.php", array("value" =>$data['im_prace'])); ?></span></td></tr>
<?php endif;?>
