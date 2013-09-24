<?php global $routingObj; ?>
<?php echo appHtmlClass::partial("vakansii/menu", array("Model"=>$Model))?>
<?php if($Model->list):?>
	<div class="vakansii-list">
		<?php foreach ($Model->list as $key => $value):?>
			<div class="vakansii-item">
				<h2><a href="/ru/vakansii/item/<?php echo $value["url"]?>" title="<?php echo $value["title"]?>"><?php echo $value["title"]?></a></h2>
				<div class="description"><?php echo $value["description"]?></div>
				<div class="more">
					<span class="date"><?php echo $value["date"]?></span>
					<a class="read-more" href="/ru/vakansii/item/<?php echo $value["url"]?>" title="<?php echo $value["title"]?>"><?php echo getLangString("ReadMore");?></a>
					<div class="clear"></div>
				</div>
			</div>
		<?php endforeach;?>
	</div>
<?php endif;?>
