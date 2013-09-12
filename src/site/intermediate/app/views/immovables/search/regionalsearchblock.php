<?php
	$returnStringSelectedItems = "";
	if(is_array($Data->selectedBuild)) {
		foreach ($Data->selectedBuild as $key => $value) {
			if($key != 0)
				$returnStringSelectedItems .= sprintf( "<span class=\"coma-%s\">, </span>", $value[0]);
			$returnStringSelectedItems .= sprintf( "<span class=\"r-name-item-%s\">%s</span>", $value[0], $value["dict_name"]);
		}
	}
?>
<div class="regionalBlock">
	<div class="regionalTextInput"><span class="rSelected"><?php echo $returnStringSelectedItems; ?></span><span class="no-items" style="<?php echo ($returnStringSelectedItems ? "display:none" : "" );?>">Регионы</span></div>
	<div class="reginalTree">
		<?php echo appHtmlClass::partial("immovables/search/regionalsearchblockitem", array("list"=> $Data->return["child"], "Data" => $Data, "margin" => 0, "parent_id" => 0, "is_checked" => false )); ?>
	</div>
	<div class="reginalCheckboxCollection"><?php echo $rCheckboxCollection;?></div>
</div>


