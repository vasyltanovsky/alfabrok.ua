<?php if($Model->list):?>
	<ul class="sitemap-ul inner-<?php echo $level;?>">
		<?php foreach ($Model->list as $key => $value):?>
			<li>
				<a class="" href="/<?php echo $Model->getitemlink($value);?>" title="<?php echo $value['im_title']?>"><?php echo $value['im_title']?></a>
			</li>
		<?php endforeach;?>
	</ul>
<?php endif;?>