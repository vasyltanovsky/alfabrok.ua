<?php global $routingObj; ?>
<?php 
	if($param["string_navigation"])
		$param["string_navigation"] = str_replace("~", " ", $param["string_navigation"]); 
	$flag = true; 
	$active = $Model->item;
	$ret = "";
	if($param["string_navigation"])
		$ret = $param["string_navigation"];
	if(!empty($active)) {
		while($flag) {
			if(empty($ret))
				$link = sprintf('%s', $active["p_w_menu"]);
			else
				$link = sprintf('<a href="%s" title="%s">%s</a><span class="next">&nbsp;»&nbsp;</span>', $active["page_url"], $active["p_w_menu"], $active["p_w_menu"]);
			$ret = $link . $ret;
			if($active["page_id"] == "1000000000000") 
				$flag = false;	
			if($active["parent_id"])
				$active = $Model->listData[$active["parent_id"]];	
		}
	}
?>
<div class="string-navigation"><?php echo $ret;?></div>