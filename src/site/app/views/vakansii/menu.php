<?php global $routingObj; ?>
<?php if($Model->typeVakansiiList):?>
	<div class="vakansii-type-menu">
		<?php foreach ($Model->typeVakansiiList as $key => $value):?>
			<a class="<?php echo ($value["dict_id"] == $routingObj->getParamItem("type_id") ? "active" : "")?>" href="/ru/vakansii/index/<?php echo $value["dict_id"]?>" title="<?php echo $value["dict_name"]?>"><?php echo $value["dict_name"]?></a>
		<?php endforeach;?>
	</div>
<?php endif;?>