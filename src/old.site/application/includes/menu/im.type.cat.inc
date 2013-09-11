<div class="ImFormLinkType"> 
	<form action="" method="post">
		<input type="radio" name="type_cat" onchange="javascript:SetImLinkPage('<?php echo $_GET[1];?>','sale');" id="type_sale" <?php if ($_GET['type_cat'] == 'sale') echo "checked=\"checked\"";?> value="sale"/><label><?php echo $arWords['ImSale'];?></label>
  		<input type="radio" name="type_cat" onchange="javascript:SetImLinkPage('<?php echo $_GET[1];?>', 'rent');" id="type_rent" <?php if ($_GET['type_cat'] == 'rent') echo "checked=\"checked\"";?> value="rent"/><label class="SpanImFromLityType"><?php echo $arWords['ImRent'];?></label>
		<a href="/immovables/flat/<?php echo $_GET['type_cat'];?>.html" class="<?php echo IsActiveLinkMenu('flat');?>" title="<?php echo $arWords['ImLinkFlat'];?>"><?php echo $arWords['ImLinkFlat'];?></a>
    	<a href="/immovables/commercial/<?php echo $_GET['type_cat'];?>.html" class="<?php echo IsActiveLinkMenu('commercial');?>" title="<?php echo $arWords['ImLinkCommercial'];?>"><?php echo $arWords['ImLinkCommercial'];?></a>
    	<a href="/immovables/home/<?php echo $_GET['type_cat'];?>.html" class="<?php echo IsActiveLinkMenu('home');?>" title="<?php echo $arWords['ImLinkHome'];?>"><?php echo $arWords['ImLinkHome'];?></a>
    	<a href="/immovables/buildings/<?php echo $_GET['type_cat'];?>.html" class="<?php echo IsActiveLinkMenu('buildings');?>" title="<?php echo $arWords['ImLinkBuildings'];?>"><?php echo $arWords['ImLinkBuildings'];?></a>
    	<a href="/immovables/land/<?php echo $_GET['type_cat'];?>.html" class="<?php echo IsActiveLinkMenu('land');?>" title="<?php echo $arWords['ImLinkLand'];?>"><?php echo $arWords['ImLinkLand'];?></a>
	</form>	
</div>