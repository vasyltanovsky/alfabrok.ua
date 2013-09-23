<?php if($Model->list):?>
	<ul class="sitemap-ul inner-<?php echo $level;?>">
		<?php foreach ($Model->list as $key => $value):?>
			<li>
				<a class="" href="/ru/service/details/<?php echo $value['sc_id']?>" title="<?php echo $value['title']?>"><?php echo $value['title']?></a>
			</li>
		<?php endforeach;?>
	</ul>
<?php endif;?>