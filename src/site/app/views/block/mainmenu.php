<?php global $routingObj; ?>
<?php if($Data):?>
	<div class="HeaderMenu" style="border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
		<?php foreach ($Data as $key => $value):?>
			<a class="" id="page-<?php echo $value["controller"]; ?>-<?php echo $value["action"]; ?>" href="<?php echo $value["page_url"];?>"><?php echo $value["p_w_menu"];?></a>
		<?php endforeach;?>
	</div>
<?php endif;?>
<?php //devLogs::_printr($Data);?>