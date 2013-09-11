<script type="text/javascript">
function SetImLinkPage(page, type_cat) {
	var redirect_url = '/dmn/immovablesPosition/?1='+page+'&type_cat='+type_cat;
	location.href = redirect_url;
}
</script>
<div class="ImFormLinkType"> 
	<form action="" method="post">
		<input type="radio" name="type_cat" onchange="javascript:SetImLinkPage('<?php echo $_GET[1];?>','sale');" id="type_sale" <?php if ($_GET['type_cat'] == 'sale') echo "checked=\"checked\"";?> value="sale"/><label><?php echo $arWords['ImSale'];?></label>
  		<input type="radio" name="type_cat" onchange="javascript:SetImLinkPage('<?php echo $_GET[1];?>', 'rent');" id="type_rent" <?php if ($_GET['type_cat'] == 'rent') echo "checked=\"checked\"";?> value="rent"/><label class="SpanImFromLityType"><?php echo $arWords['ImRent'];?></label>
		<?php if(strpos ( $_COOKIE ["roles"], '5125c267d62af')): ?>
		<a href="?1=flat&type_cat=<?php echo $_GET['type_cat'];?>" class="<?php echo IsActiveLinkMenu('flat');?>" title="<?php echo $arWords['ImLinkFlat'];?>"><?php echo $arWords['ImLinkFlat'];?></a>
		<?php endif; ?>
    	<?php if(strpos ( $_COOKIE ["roles"], '5125c27087b01')): ?>
		<a href="?1=commercial&type_cat=<?php echo $_GET['type_cat'];?>" class="<?php echo IsActiveLinkMenu('commercial');?>" title="<?php echo $arWords['ImLinkCommercial'];?>"><?php echo $arWords['ImLinkCommercial'];?></a>
    	<?php endif; ?>
    	<?php if(strpos ( $_COOKIE ["roles"], '5125c27ba3d11')): ?>
		<a href="?1=home&type_cat=<?php echo $_GET['type_cat'];?>" class="<?php echo IsActiveLinkMenu('home');?>" title="<?php echo $arWords['ImLinkHome'];?>"><?php echo $arWords['ImLinkHome'];?></a>
		<?php endif; ?>
    	<?php if(strpos ( $_COOKIE ["roles"], '5125c284aaabe')): ?>
	   	<a href="?1=buildings&type_cat=<?php echo $_GET['type_cat'];?>" class="<?php echo IsActiveLinkMenu('buildings');?>" title="<?php echo $arWords['ImLinkBuildings'];?>"><?php echo $arWords['ImLinkBuildings'];?></a>
    	<?php endif; ?>
    	<?php if(strpos ( $_COOKIE ["roles"], '5125c290b7791')): ?>
		<a href="?1=land&type_cat=<?php echo $_GET['type_cat'];?>" class="<?php echo IsActiveLinkMenu('land');?>" title="<?php echo $arWords['ImLinkLand'];?>"><?php echo $arWords['ImLinkLand'];?></a>
		<?php endif; ?>	
	</form>	
</div>