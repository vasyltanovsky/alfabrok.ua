<div class="DivCatMenu"> 
	<form action="" id="ImMenu" method="post">
		<span class="SpanCatMenuImSea"><?php echo getLangString('SearchImmovablesCat');?></span>	   
		<input type="radio" name="type_cat" checked="checked" id="type_sale" <?php if ($_GET['type_cat'] == 'sale') echo "checked=\"checked\"";?> value="sale"/><label><?php echo getLangString('ImSale');?></label>
  		<input type="radio" name="type_cat" id="type_rent" <?php if ($_GET['type_cat'] == 'rent') echo "checked=\"checked\"";?> value="rent"/><label><?php echo getLangString('ImRent');?></label>
		<a href="/ru/index/mailas" class="ALinkSendOrder" title="<?php echo getLangString('user_send_order');?>"><span></span><?php echo getLangString('user_send_order');?></a>
		<a href="javascript:AddImPosition();" class="ALinkAddImIndex" title="<?php echo getLangString('user_add_im');?>"><span></span><?php echo getLangString('user_add_im');?></a>
	</form>	
	<div class="clear"></div>
	<div class="DivCatMenuLinkImages">	
    	<a rel='nofollow' href="javascript:SetImLink('flat');" id="Flat" title="<?php echo getLangString('ImLinkFlat');?>">
			<img src="<?php echo getLangString("imageDomain")?>/files/images/bg/cat/flat.png" alt="<?php echo getLangString('ImLinkFlat');?>"/>
			<img src="<?php echo getLangString("imageDomain")?>/files/images/bg/cat/flat_1.png" alt="<?php echo getLangString('ImLinkFlat');?>"/>
			<img src="<?php echo getLangString("imageDomain")?>/files/images/bg/cat/flat_2.png" alt="<?php echo getLangString('ImLinkFlat');?>"/>
			</a>
		<a rel='nofollow' href="javascript:SetImLink('commercial');" id="Commercial"  title="<?php echo getLangString('ImLinkCommercial');?>">
			<img src="<?php echo getLangString("imageDomain")?>/files/images/bg/cat/commercial.png"  alt="<?php echo getLangString('ImLinkCommercial');?>" />
			<img src="<?php echo getLangString("imageDomain")?>/files/images/bg/cat/commercial_1.png"  alt="<?php echo getLangString('ImLinkCommercial');?>" />
			<img src="<?php echo getLangString("imageDomain")?>/files/images/bg/cat/commercial_2.png"  alt="<?php echo getLangString('ImLinkCommercial');?>" />
			</a>
		<a rel='nofollow' href="javascript:SetImLink('home');" id="Home"  title="<?php echo getLangString('ImLinkHome');?>">
			<img src="<?php echo getLangString("imageDomain")?>/files/images/bg/cat/home.png" alt="<?php echo getLangString('ImLinkHome');?>" />
			<img src="<?php echo getLangString("imageDomain")?>/files/images/bg/cat/home_1.png" alt="<?php echo getLangString('ImLinkHome');?>" />
			<img src="<?php echo getLangString("imageDomain")?>/files/images/bg/cat/home_2.png" alt="<?php echo getLangString('ImLinkHome');?>" />
			</a>
		<a rel='nofollow' href="javascript:SetImLink('buildings');" id="Buildings"  title="<?php echo getLangString('ImLinkBuildings');?>">
			<img src="<?php echo getLangString("imageDomain")?>/files/images/bg/cat/buildings.png" alt="<?php echo getLangString('ImLinkBuildings');?>"/>
			<img src="<?php echo getLangString("imageDomain")?>/files/images/bg/cat/buildings_1.png" alt="<?php echo getLangString('ImLinkBuildings');?>"/>
			<img src="<?php echo getLangString("imageDomain")?>/files/images/bg/cat/buildings_2.png" alt="<?php echo getLangString('ImLinkBuildings');?>"/>
			</a>
		<a rel='nofollow' href="javascript:SetImLink('land');" id="Land"  title="<?php echo getLangString('ImLinkLand');?>">
			<img src="<?php echo getLangString("imageDomain")?>/files/images/bg/cat/land.png" alt="<?php echo getLangString('ImLinkLand');?>" />
			<img src="<?php echo getLangString("imageDomain")?>/files/images/bg/cat/land_1.png" alt="<?php echo getLangString('ImLinkLand');?>" />
			<img src="<?php echo getLangString("imageDomain")?>/files/images/bg/cat/land_2.png" alt="<?php echo getLangString('ImLinkLand');?>" />
			</a>
		<div class="clear"></div>	
	</div>		
	<div class="DivCatMenuLink">	
		<a href="javascript:SetImLink('flat');" id="FlatAlink" title="<?php echo getLangString('ImLinkFlat');?>">
			<?php echo getLangString('ImLinkFlat');?></a>
    	<a href="javascript:SetImLink('commercial');" id="CommercialAlink"  title="<?php echo getLangString('ImLinkCommercial');?>">
			<span><?php echo getLangString('ImLinkCommercial');?></a>
    	<a href="javascript:SetImLink('home');" id="HomeAlink"  title="<?php echo getLangString('ImLinkHome');?>">
			<span><?php echo getLangString('ImLinkHome');?></a>
    	<a href="javascript:SetImLink('buildings');" id="BuildingsAlink"  title="<?php echo getLangString('ImLinkBuildings');?>">
			<?php echo getLangString('ImLinkBuildings');?></a>
    	<a href="javascript:SetImLink('land');" id="LandAlink"  title="<?php echo getLangString('ImLinkLand');?>">
			<?php echo getLangString('ImLinkLand');?></a>
		
	</div>
	
</div>