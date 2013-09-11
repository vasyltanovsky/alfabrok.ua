<?php 
	$arr = array();
	foreach ($Data as $key => $value) {
		$arr[$value["type_im"].$value["type_rs"]] .= sprintf('<a class="index_im_link" alt="%s" title="%s" href="/ru/%s/%s/?%s_%s=%s">%s</a>', $value["il_title"], $value["il_title"], $value["type_im"], $value["type_rs"], $value["dict_id"], $value["type_reg"], $value["il_name"], $value["il_name"]);
	}
?>
<div style="" "margin-top:10px;" class="DivListImBan">
<h3><?php echo getLangString('index_im_link');?></h3>
<table id="tableIndexOneClick" cellpadding="0" cellspacing=\
	"0" border="0" class="tableIndexOneClick">
	<tr class="header">
		<th class="name"></th>
		<th class="sale"><?php echo getLangString('ImSale');?></th>
		<th class="rent"><?php echo getLangString('ImRent');?></th>
	</tr>
	<?php if(isset($arr["flatsale"]) || isset($arr["flatrent"])):?>
		<tr class="flat">
			<td class="name"><?php echo getLangString('4c3ec3ec5e9b5');?></td>
			<td class="sale"><?php echo (isset($arr["flatsale"]) ?  $arr["flatsale"] : "");?></td>
			<td class="rent"><?php echo (isset($arr["flatrent"]) ?  $arr["flatrent"] : "");?></td>
		</tr>
	<?php endif; ?>
	<?php if(isset($arr["commercialsale"]) || isset($arr["commercialrent"])):?>
	<tr class="commercial">
		<td class="name"><?php echo getLangString('4c3ec3ec5e9b7');?></td>
		<td class="sale"><?php echo (isset($arr["commercialsale"]) ?  $arr["commercialsale"] : "");?></td>
		<td class="rent"><?php echo (isset($arr["commercialrent"]) ?  $arr["commercialrent"] : "");?></td>
	</tr>
	<?php endif; ?>
	<?php if(isset($arr["homesale"]) || isset($arr["homerent"])):?>
	<tr class="home">
		<td class="name"><?php echo getLangString('4c3ec51d537c0');?></td>
		<td class="sale"><?php echo (isset($arr["homesale"]) ?  $arr["homesale"] : "");?></td>
		<td class="rent"><?php echo (isset($arr["homerent"]) ?  $arr["homerent"] : "");?></td>
	</tr>
	<?php endif; ?>
	<?php if(isset($arr["buildingssale"]) || isset($arr["buildingsrent"])):?>
	<tr class="buildings">
		<td class="name"><?php echo getLangString('4c3ec51d537c2');?></td>
		<td class="sale"><?php echo (isset($arr["buildingssale"]) ?  $arr["buildingssale"] : "");?></td>
		<td class="rent"><?php echo (isset($arr["buildingsrent"]) ?  $arr["buildingsrent"] : "");?></td>
	</tr>
	<?php endif; ?>
	<?php if(isset($arr["landsale"])):?>
	<tr class="land">
		<td class="name"><?php echo getLangString('4c3ec51d537c3');?></td>
		<td class="sale"><?php echo (isset($arr["landsale"]) ?  $arr["landsale"] : "");?></td>
		<td class="rent"></td>
	</tr>
	<?php endif; ?>
</table>
</div>