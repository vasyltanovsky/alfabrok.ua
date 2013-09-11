<form class="FormImShow" action="" name="im_show" enctype="application/x-www-form-urlencoded">
	<label style="margin-left:20px;"><?php echo $arWords['ImTableListPnumberHeader'];?></label>
	<input type="radio" name="im_f_show_pnumber" onchange="javascript:setStylePnumber('im_f_show_pnumber', 30);" <?php echo IsCookieCheck("im_f_show_pnumber", 30); ?> value="30"/><label>30</label>
	<input type="radio" name="im_f_show_pnumber" onchange="javascript:setStylePnumber('im_f_show_pnumber', 50);" <?php echo IsCookieCheck("im_f_show_pnumber", 50); ?> value="50"/><label>50</label>
	<input type="radio" name="im_f_show_pnumber" onchange="javascript:setStylePnumber('im_f_show_pnumber', 100);" <?php echo IsCookieCheck("im_f_show_pnumber", 100); ?> value="100"/><label>100</label>
	<a href="/contacts/mailAs.html" class="ALinkSendOrder" title="<?php echo $arWords['user_send_order'];?>"><span></span><?php echo $arWords['user_send_order'];?></a>
	<a href="javascript:AddImPosition();" class="ALinkAddImIndex" title="<?php echo $arWords['user_add_im'];?>"><span></span><?php echo $arWords['user_add_im'];?></a>
</form>
