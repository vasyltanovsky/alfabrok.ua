<?php global $routingObj; ?>
<div class="ImFormLinkType"> 
	<form action="" method="post">
		<input type="radio" name="type_cat" onchange="javascript:SetImLinkPage('<?php echo $routingObj->getController();?>','sale');" id="type_sale" <?php if ($routingObj->getAction() == 'sale') echo "checked=\"checked\"";?> value="sale"/><label><?php echo getLangString('ImSale');?></label>
  		<input type="radio" name="type_cat" onchange="javascript:SetImLinkPage('<?php echo $routingObj->getController();?>', 'rent');" id="type_rent" <?php if ($routingObj->getAction() == 'rent') echo "checked=\"checked\"";?> value="rent"/><label class="SpanImFromLityType"><?php echo getLangString('ImRent');?></label>
		<a href="/ru/flat/<?php echo $routingObj->getAction();?>" class="<?php echo IsActiveLinkMenu('flat');?>" title="<?php echo getLangString('ImLinkFlat');?>"><?php echo getLangString('ImLinkFlat');?></a>
    	<a href="/ru/commercial/<?php echo $routingObj->getAction();?>" class="<?php echo IsActiveLinkMenu('commercial');?>" title="<?php echo getLangString('ImLinkCommercial');?>"><?php echo getLangString('ImLinkCommercial');?></a>
    	<a href="/ru/home/<?php echo $routingObj->getAction();?>" class="<?php echo IsActiveLinkMenu('home');?>" title="<?php echo getLangString('ImLinkHome');?>"><?php echo getLangString('ImLinkHome');?></a>
    	<a href="/ru/buildings/<?php echo $routingObj->getAction();?>" class="<?php echo IsActiveLinkMenu('buildings');?>" title="<?php echo getLangString('ImLinkBuildings');?>"><?php echo getLangString('ImLinkBuildings');?></a>
    	<a href="/ru/land/<?php echo $routingObj->getAction();?>" class="<?php echo IsActiveLinkMenu('land');?>" title="<?php echo getLangString('ImLinkLand');?>"><?php echo getLangString('ImLinkLand');?></a>
	</form>	
</div>