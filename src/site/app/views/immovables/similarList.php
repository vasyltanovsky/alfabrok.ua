<?php global $routingObj;?>
<?php global $arWords;?>
<?php 
$paramAll = $routingObj->getParam();
$paramForGet = $paramAll;
unset($paramForGet["im_adress_id"]);
unset($paramForGet["im_space_like"]);
unset($paramForGet["im_prace_like"]);
$Model->getList($paramForGet);
if($Model->list) {
	$paramAll["im_ids"] = $Model->buildImmovablesIdForPropertiesQuery ();
	$Model->getPropertiesList ( $paramAll );
	unset($paramAll["im_ids"]);
	$im_similar_arr_h = appHtmlClass::partial(sprintf("%s/%slist", $arWords['TypeCatImNameArrIdPAge'][$paramAll["im_catalog_id"]], ($paramAll["im_is_sale"] ? "sale" : "rent")), array("Model"=> $Model));
}
$paramForGet = $paramAll;
unset($paramForGet["im_area_id"]);
unset($paramForGet["im_space_like"]);
unset($paramForGet["im_prace_like"]);
$Model->getList($paramForGet);
if($Model->list) {
	$paramAll["im_ids"] = $Model->buildImmovablesIdForPropertiesQuery ();
	$Model->getPropertiesList ( $paramAll );
	unset($paramAll["im_ids"]);
	$im_similar_str_h = appHtmlClass::partial(sprintf("%s/%slist", $arWords['TypeCatImNameArrIdPAge'][$paramAll["im_catalog_id"]], ($paramAll["im_is_sale"] ? "sale" : "rent")), array("Model"=> $Model));
}
$paramForGet = $paramAll;
unset($paramForGet["im_area_id"]);
unset($paramForGet["im_adress_id"]);
unset($paramForGet["im_prace_like"]);
$Model->getList($paramForGet);
if($Model->list) {
	$paramAll["im_ids"] = $Model->buildImmovablesIdForPropertiesQuery ();
	$Model->getPropertiesList ( $paramAll );
	unset($paramAll["im_ids"]);
	$im_similar_spa_h = appHtmlClass::partial(sprintf("%s/%slist", $arWords['TypeCatImNameArrIdPAge'][$paramAll["im_catalog_id"]], ($paramAll["im_is_sale"] ? "sale" : "rent")), array("Model"=> $Model));
}
$paramForGet = $paramAll;
unset($paramForGet["im_area_id"]);
unset($paramForGet["im_adress_id"]);
unset($paramForGet["im_space_like"]);
$Model->getList($paramForGet);
if($Model->list) {
	$paramAll["im_ids"] = $Model->buildImmovablesIdForPropertiesQuery ();
	$Model->getPropertiesList ( $paramAll );
	unset($paramAll["im_ids"]);
	$im_similar_pri_h = appHtmlClass::partial(sprintf("%s/%slist", $arWords['TypeCatImNameArrIdPAge'][$paramAll["im_catalog_id"]], ($paramAll["im_is_sale"] ? "sale" : "rent")), array("Model"=> $Model));
}
?>
<div class="DivImSimilar" id="tabs">
	<ul>
		<?php if(!empty($im_similar_arr_h)) echo getLangString("im_similar_arr_h");?>
		<?php if(!empty($im_similar_str_h)) echo getLangString("im_similar_str_h");?>
		<?php if(!empty($im_similar_spa_h)) echo getLangString("im_similar_spa_h");?>
		<?php if(!empty($im_similar_pri_h)) echo getLangString("im_similar_pri_h");?>
	</ul>
		<?php if(!empty($im_similar_arr_h)):?>
			<div id="im_similar_arr"><?php echo $im_similar_arr_h;?></div>
		<?php endif;?>
		<?php if(!empty($im_similar_str_h)):?>
			<div id="im_similar_str"><?php echo $im_similar_str_h;?></div>
		<?php endif;?>
		<?php if(!empty($im_similar_spa_h)):?>
			<div id="im_similar_spa"><?php echo $im_similar_spa_h;?></div>
		<?php endif;?>
		<?php if(!empty($im_similar_pri_h)):?>
			<div id="im_similar_pri"><?php echo $im_similar_pri_h;?></div>
		<?php endif;?>
</div>