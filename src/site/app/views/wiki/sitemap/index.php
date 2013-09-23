<?php if($Model->list):?>
	<ul class="sitemap-ul inner-<?php echo $level;?>">
		<?php foreach ($Model->list as $key => $value):?>
			<li>
				<a class="" href="/ru/wiki/item/<?php echo $value['w_menu_name']?>" title="<?php echo $value['w_w_title']?>"><?php echo $value['w_menu_name']?></a>
			</li>
		<?php endforeach;?>
	</ul>
<?php endif;?>