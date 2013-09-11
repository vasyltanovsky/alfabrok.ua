<?php if($Model->item):?>
<?php else:?>
	<?php echo appHtmlClass::partial("immovables/immovablesnoposition"); ?>
<?php endif;?>