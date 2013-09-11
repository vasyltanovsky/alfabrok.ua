<div class="DivTopHeaderMenuSearch">
	<form action="/s_immovables.html" id="im_code_top_form" method="get" name="im_code_top_form" enctype="application/x-www-form-urlencoded">
       	<input id="search_top_field" alt="" type="text" value="<?php if ($SearchImmovablesCode == null) echo $arWords['SearchImmovablesCode']; else echo $SearchImmovablesCode; ?>" name="id" />
      	<input type="hidden" name="action" value="s_code"/>
		<input id="search_top_submit"  type="submit" name="search" value="<?php echo $arWords['SearchBottom'];?>"/>
	</form>
	<div id="divPointerCode">
		<span id="codeK" onclick="javascript:setPointerCodeToSCField('K');" title="<?php echo $arWords['ImLinkFlat'];?>">K</span>
		<span id="codeC" onclick="javascript:setPointerCodeToSCField('C');" title="<?php echo $arWords['ImLinkCommercial'];?>">C</span>
		<span id="codeH" onclick="javascript:setPointerCodeToSCField('H');" title="<?php echo $arWords['ImLinkHome'];?>">H</span>
		<span id="codeM" onclick="javascript:setPointerCodeToSCField('M');" title="<?php echo $arWords['ImLinkBuildings'];?>">M</span>
		<span id="codeT" onclick="javascript:setPointerCodeToSCField('T');" title="<?php echo $arWords['ImLinkLand'];?>">T</span>
	</div>
</div>
<script type="text/javascript">
$(function() {
	$('#search_top_field').bind('keypress', function(e) {
		var keycode =  e.keyCode ? e.keyCode : e.which;
		if(keycode < 37 || keycode > 40 ) {
			changePointerCodeToSCField(this);
		}
	});
});
</script>
