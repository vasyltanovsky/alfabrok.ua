<?php global $routingObj; ?>
<?php if($Data):?>
	<div class="HeaderMenu" style="border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
		<?php foreach ($Data as $key => $value):?>
			<a class="" id="<?php echo $value["page_id"]; ?>" href="<?php echo sprintf("%s", ($value["controller"] == "index" && $value["action"] == "index") ? "/" : sprintf("/ru/%s/%s", $value["controller"], $value["action"]))?>" title="<?php echo $value["title"];?>"><?php echo $value["menu_words"];?></a>
		<?php endforeach;?>
	</div>
<?php endif;?>