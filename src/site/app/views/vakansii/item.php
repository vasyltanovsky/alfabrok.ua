<?php global $routingObj; ?>
<?php global $arWords;?>
<?php echo appHtmlClass::partial("vakansii/menu", array("Model"=>$Model))?>
<div class="vakansii-item">
	<h2><?php echo $Model->item["title"]?></h2>
	<div class="summary"><?php echo $Model->item["summary"]?></div>
	<div class="more">
		<span class="date"><?php echo $Model->item["date"]?></span>
		<div class="clear"></div>
	</div>
</div>