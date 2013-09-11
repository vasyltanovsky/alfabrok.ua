<div class="DivCatMenu"> 
	<form action="" id="ImMenu" method="post">
		<span class="SpanCatMenuImSea"><?php echo $arWords['SearchImmovablesCat'];?></span>	   
		<input type="radio" name="type_cat" checked="checked" id="type_sale" <?php if ($_GET['type_cat'] == 'sale') echo "checked=\"checked\"";?> value="sale"/><label><?php echo $arWords['ImSale'];?></label>
  		<input type="radio" name="type_cat" id="type_rent" <?php if ($_GET['type_cat'] == 'rent') echo "checked=\"checked\"";?> value="rent"/><label><?php echo $arWords['ImRent'];?></label>
		<a href="/contacts/mailAs.html" class="ALinkSendOrder" title="<?php echo $arWords['user_send_order'];?>"><span></span><?php echo $arWords['user_send_order'];?></a>
		<a href="javascript:AddImPosition();" class="ALinkAddImIndex" title="<?php echo $arWords['user_add_im'];?>"><span></span><?php echo $arWords['user_add_im'];?></a>
	</form>	
	<div class="clear"></div>
	<div class="DivCatMenuLinkImages">	
    	<a href="javascript:SetImLink('flat');" id="Flat" title="<?php echo $arWords['ImLinkFlat'];?>">
			<img src="/files/images/bg/cat/flat.png" title="<?php echo $arWords['ImLinkFlat'];?>"/>
			<img src="/files/images/bg/cat/flat_1.png" title="<?php echo $arWords['ImLinkFlat'];?>"/>
			<img src="/files/images/bg/cat/flat_2.png" title="<?php echo $arWords['ImLinkFlat'];?>"/>
			</a>
		<a href="javascript:SetImLink('commercial');" id="Commercial"  title="<?php echo $arWords['ImLinkCommercial'];?>">
			<img src="/files/images/bg/cat/commercial.png"  title="<?php echo $arWords['ImLinkCommercial'];?>" />
			<img src="/files/images/bg/cat/commercial_1.png"  title="<?php echo $arWords['ImLinkCommercial'];?>" />
			<img src="/files/images/bg/cat/commercial_2.png"  title="<?php echo $arWords['ImLinkCommercial'];?>" />
			</a>
		<a href="javascript:SetImLink('home');" id="Home"  title="<?php echo $arWords['ImLinkHome'];?>">
			<img src="/files/images/bg/cat/home.png" title="<?php echo $arWords['ImLinkHome'];?>" />
			<img src="/files/images/bg/cat/home_1.png" title="<?php echo $arWords['ImLinkHome'];?>" />
			<img src="/files/images/bg/cat/home_2.png" title="<?php echo $arWords['ImLinkHome'];?>" />
			</a>
		<a href="javascript:SetImLink('buildings');" id="Buildings"  title="<?php echo $arWords['ImLinkBuildings'];?>">
			<img src="/files/images/bg/cat/buildings.png" title="<?php echo $arWords['ImLinkBuildings'];?>"/>
			<img src="/files/images/bg/cat/buildings_1.png" title="<?php echo $arWords['ImLinkBuildings'];?>"/>
			<img src="/files/images/bg/cat/buildings_2.png" title="<?php echo $arWords['ImLinkBuildings'];?>"/>
			</a>
		<a href="javascript:SetImLink('land');" id="Land"  title="<?php echo $arWords['ImLinkLand'];?>">
			<img src="/files/images/bg/cat/land.png" title="<?php echo $arWords['ImLinkLand'];?>" />
			<img src="/files/images/bg/cat/land_1.png" title="<?php echo $arWords['ImLinkLand'];?>" />
			<img src="/files/images/bg/cat/land_2.png" title="<?php echo $arWords['ImLinkLand'];?>" />
			</a>
		<div class="clear"></div>	
	</div>	
	
	<div class="DivCatMenuLink">	
		<a href="javascript:SetImLink('flat');" id="FlatAlink" title="<?php echo $arWords['ImLinkFlat'];?>">
			<?php echo $arWords['ImLinkFlat'];?></a>
    	<a href="javascript:SetImLink('commercial');" id="CommercialAlink"  title="<?php echo $arWords['ImLinkCommercial'];?>">
			<span><?php echo $arWords['ImLinkCommercial'];?></a>
    	<a href="javascript:SetImLink('home');" id="HomeAlink"  title="<?php echo $arWords['ImLinkHome'];?>">
			<span><?php echo $arWords['ImLinkHome'];?></a>
    	<a href="javascript:SetImLink('buildings');" id="BuildingsAlink"  title="<?php echo $arWords['ImLinkBuildings'];?>">
			<?php echo $arWords['ImLinkBuildings'];?></a>
    	<a href="javascript:SetImLink('land');" id="LandAlink"  title="<?php echo $arWords['ImLinkLand'];?>">
			<?php echo $arWords['ImLinkLand'];?></a>
		
	</div>
	
</div>
<!--<div id="SlideIndex">
    <img src="/files/images/bg/cat/flat.jpg"  />
    ?php if(!eregi("opera", $HTTP_USER_AGENT)) {?>
    <img src="/files/images/bg/cat/commercial.jpg"  />
    <img src="/files/images/bg/cat/home.jpg"/>
    <img src="/files/images/bg/cat/buildings.jpg" />
    <img src="/files/images/bg/cat/land.jpg" />
    ?php }?>
</div>-->