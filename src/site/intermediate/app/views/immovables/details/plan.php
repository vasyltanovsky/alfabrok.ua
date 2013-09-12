<?php if($Model->imagesPlanList):?>
	<div id="accordionVideo">
		<h3><a href="#"><?php echo getLangString('im_accordion_plan');?></a></h3><div>
			<?php foreach ($Model->imagesPlanList as $key => $value):?>
				<a class="highslide" href="<?php echo getLangString("imageDomain");?>/files/images/immovables/<?php echo $value["im_photo_id"];?>.<?php echo $value["im_file_type"];?>" onclick="return hs.expand(this)" ><img src="<?php echo getLangString("imageDomain");?>/files/images/immovables/s_<?php echo $value["im_photo_id"];?>.<?php echo $value["im_file_type"];?>"/></a>
			<?php endforeach;?>
		</div>
		<div class="clear"></div>	
	</div>
<?php endif?>