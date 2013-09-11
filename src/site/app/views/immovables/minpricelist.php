<?php global $arWords;?>
<?php if($Data):?>
<div class="DivListImBan <?php echo $cssClass; ?>" id=""><h3><?php echo $title;?></h3>
	<div id="linksListBan">
		<span id="linkBan-flat" class="AlinkNoActive" rel="flat" title="{$arWords['ImLinkFlat']}"><?php echo getLangString('ImLinkFlat');?></span>
		<span id="linkBan-commercial" class="AlinkNoActive" rel="commercial" title="<?php echo getLangString('ImLinkCommercial');?>"><?php echo getLangString('ImLinkCommercial');?></span>
		<span id="linkBan-home" class="AlinkNoActive" rel="home" title="<?php echo getLangString('ImLinkHome');?>"><?php echo getLangString('ImLinkHome');?></span>
		<span id="linkBan-buildings" class="AlinkNoActive" rel="buildings" title="<?php echo getLangString('ImLinkBuildings');?>"><?php echo getLangString('ImLinkBuildings');?></span>
		<span id="linkBan-land" class="AlinkNoActive" rel="land" title="<?php echo getLangString('ImLinkLand');?>"><?php echo getLangString('ImLinkLand');?></span>
	</div>
	<div id="positionListBan">
	<?php //devLogs::_printr($Data);?>
		<?php foreach ($Data as $key => $value):?>
		<div class="DivListImBanIn" id="<?php echo $value["im_id"];?>" rel="<?php echo $arWords["TypeCatImNameArrIdPAge"][$value["im_catalog_id"]]?>/<?php echo ($value["im_is_sale"] ? "sale" : "rent");?>">
			<div class="DivListImBanIm">
				<a href="/ru/<?php echo getImmovablesLink($value);?>/1/<?php echo $value["im_id"];?>"  title="<?php echo $value["im_title"];?>">
					<img src="<?php echo getLangString('imageDomain');?><?php echo getLangString('imageDomain');?>/files/images/immovables/s_<?php echo $value["im_photo"];?>" alt="<?php echo $value["im_title"];?>" title="<?php echo $value["im_title"];?>"/>
				</a>
			</div>
			<div class="DivListImBanText">
				<p><a href="/ru/<?php echo getImmovablesLink($value);?>/1/<?php echo $value["im_id"];?>" title="<?php echo $value["im_title"];?>"><?php echo $value["im_title"];?></a></p><span><?php echo $value["im_prace"];?></span>
			</div>
		</div>
		<?php endforeach;?>									
		<div class="clear"></div>
	</div>
<!--<a  class="DivListImBanAViewAll" href="/s_immovables.html?action=#s_im_link#" title="<?php echo $title;?>"><?php echo getLangString(ViewAll);?></a>  -->
</div>
<?php endif;?>
		