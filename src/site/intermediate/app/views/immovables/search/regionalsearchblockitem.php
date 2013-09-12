<div class="rlist rListItem-<?php echo $margin; ?> parent-element-<?php echo $parent_id;?>" style="margin:0 0 0 <?php echo ($margin ? $margin : 0)*10; ?>px; <?php echo (($parent_id == 0 ? "false" : $is_checked) ? "" : "display:none;"); ?>">
	<?php foreach ($list as $key => $value) :?>
		<div class="item">
			<?php if(is_array($value["child"])):?>
				<span class="plus " id="plus-item-<?php echo $value["0"]?>"><?php echo ($value["checked"] ? '-' : "+")?></span>
			<?php endif;?>
			<div class="val"><input class="checkbox-item-<?php echo $value["0"]?>" <?php echo ($value["checked"] ? 'checked="checked"' : "")?> accesskey="" value="1" name="<?php echo $value["dict_id"]?>_<?php echo $value["2"]?>" id="<?php echo $value["dict_id"]?>_<?php echo $value["2"]?>" rel="" onchange=""  type="checkbox"/><label for="<?php echo $value["dict_id"]?>_<?php echo $value["2"]?>" class="r-name-item-<?php echo $value["0"]?>"><?php echo $value["dict_name"];?></label></div>
			<div class="clear"></div>
			<?php 
				if($value["child"]) {
					echo appHtmlClass::partial("immovables/search/regionalsearchblockitem", array("list"=> $value["child"], "Data" => $Data, "margin" => $value[2] + 1, "parent_id" => $value["0"], "is_checked" => $value["checked"], "isKiev" => $isKiev));
				}
			?>
		</div>
	<?php endforeach;?>
</div>	