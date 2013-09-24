<?php if($Model->typeVakansiiList):?>
	<ul class="sitemap-ul inner-<?php echo $level;?>">
	<?php foreach ($Model->typeVakansiiList as $key => $value):?>
		<li>
			<a class="" href="/ru/vakansii/index/<?php echo $value['dict_id']?>" title="<?php echo $value['dict_name']?>"><?php echo $value['dict_name']?></a>
			<?php $Model->getList ( array("hide" => true, "type_id" => $value['dict_id']));?>
			<?php if($Model->list):?>
				<ul class="sitemap-ul inner-<?php echo $level + 1;?>">
					<?php foreach ($Model->list as $ikey => $ivalue):?>
						<li>
							<a class="" href="/ru/vakansii/item/<?php echo $ivalue['url']?>" title="<?php echo $ivalue['w_title']?>"><?php echo $ivalue['title']?></a>
						</li>
					<?php endforeach;?>
				</ul>
			<?php endif;?>
		</li>
		<?php endforeach;?>
	</ul>	
<?php endif;?>