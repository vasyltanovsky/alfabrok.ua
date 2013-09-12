<?php if($Model->imagesList):?>
	<div class="highslide-gallery">
		<?php foreach ($Model->imagesList as $key => $value):?>
			<a class="highslide" href="<?php echo getLangString("imageDomain");?>/files/images/immovables/<?php echo $value["im_photo_id"];?>.<?php echo $value["im_file_type"];?>" onclick="return hs.expand(this)" ><img src="<?php echo getLangString("imageDomain");?>/files/images/immovables/s_<?php echo $value["im_photo_id"];?>.<?php echo $value["im_file_type"];?>"/></a>
		<?php endforeach;?>
	</div>
<?php endif?>