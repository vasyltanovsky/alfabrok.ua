<?php global $routingObj; ?>
<?php if($Model->list):?>
	<div class="wiki-menu">
		<?php foreach ($Model->list as $key => $value):?>
			<a class="<?php echo ($value["id"] == $this->routingObj->getParamItem(active) ? "active" : "")?>" href="/ru/wiki/item/<?php echo $value["w_menu_name"]?>" title="<?php echo $value["w_synonyms"]?>"><?php echo $value["w_menu_name"]?></a>
		<?php endforeach;?>
	</div>
<?php endif;?>
