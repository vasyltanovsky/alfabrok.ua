<?php if($Model->articlesList):?>
	<div class="articles-list">
		<?php foreach ($Model->articlesList as $key => $value):?>
			<div class="item">
				<h2><?php echo $value["wa_title"]?></h2>
				<div class="summary"><?php echo $value["wa_summary"]?></div>
			</div>
		<?php endforeach;?>
	</div>
<?php endif;?>