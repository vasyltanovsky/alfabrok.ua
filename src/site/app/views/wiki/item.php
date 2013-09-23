<?php global $routingObj; ?>
<?php global $arWords;?>
<?php echo appHtmlClass::partialAction("wiki", "menu", array("active" => $Model->item["id"]))?>
<div class="wiki-item">
	<?php echo appHtmlClass::partial("wiki/articleslist", array("Model" => $Model)); ?>
	<?php if($Model->immovablesList):?>
		<?php $immovablesModel = new immovablesModelClass(new immovablesProviderClass("immovables")); ?>
		<div class="immovables-list">
			<?php foreach ($Model->immovablesList as $key => $value):?>
				<div class="item">
			<h2>
				<a title="" href="/<?php echo $immovablesModel->getitemlink($value)?>"><?php echo $value["im_id"]?></a>
			</h2>
		</div>
			<?php endforeach;?>
		</div>
<?php endif;?>
</div>