<?php if($inner):?>
	<ul class="sitemap-ul inner-<?php echo $level;?>">
		<?php foreach ($inner as $key => $value):?>
			<li>
				<a href="<?php echo $Model->pagesBuildList[$value[0]]["page_url"]?>" title="<?php echo $Model->pagesBuildList[$value[0]]["p_w_title"]?>"><?php echo $Model->pagesBuildList[$value[0]]["p_w_menu"]?></a>
				<?php echo appHtmlClass::partialAction($Model->pagesBuildList[$value[0]]["controller"], "sitemap", array("action" => $Model->pagesBuildList[$value[0]]["action"], "level" => $level+1));?>
				<?php if(isset($value["inner"])):?>
					<?php echo appHtmlClass::partial("sitemap/inner", array("Model" => $Model, "level" => $level+1, "inner" => $value["inner"]))?>
				<?php endif;?>
			</li>
		<?php endforeach;?>
	</ul>
<?php endif;?>