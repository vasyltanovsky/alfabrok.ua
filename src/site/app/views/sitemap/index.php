<?php if($Model->pagesList):?>
	<ul class="sitemap-ul">
		<li><a href="/" title="<?php echo $Model->pagesBuildList["1000000000000"]["p_w_title"]?>"><?php echo $Model->pagesBuildList["1000000000000"]["p_w_menu"]?></a></li>
		<?php echo appHtmlClass::partial("sitemap/inner", array("Model" => $Model, "level" => 0, "inner" => $Model->pagesFormationList))?>
	</ul>
<?php endif;?>