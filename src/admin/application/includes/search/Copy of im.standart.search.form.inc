<form id="SearchFormIm" name="SearchFormIm" enctype="application/x-www-form-urlencoded" action="/immovables/<?php echo $_GET[1].'/'.$_GET['type_cat'];?>.html" method="get">
	<table class="TableSearchForm">
		<tr>
			<td>
				
					<label id="FormSearchNameRegion" class="SearchFormLabelList"><?php echo $arWords['FormSearchNameRegion'];?><span id="0_d_span"  class="ui-icon ui-icon-triangle-1-s"></span></label>
						<?php echo PrintStandartFormDiv('0_d', $PrintFormStandartArr, $CookieData);?>
					<label id="FormSearchNameRRegion" class="SearchFormLabelList"><?php echo $arWords['FormSearchNameRRegion'];?><span id="1_d_span"  class="ui-icon ui-icon-triangle-1-s"></span></label>
						<?php echo PrintStandartFormDiv('1_d', $PrintFormStandartArr);?>
					<label id="FormSearchNameCity" class="SearchFormLabelList"><?php echo $arWords['FormSearchNameCity'];?><span id="2_d_span" class="ui-icon ui-icon-triangle-1-s"></span></label>
						<?php echo PrintStandartFormDiv('2_d', $PrintFormStandartArr);?>
					<label id="FormSearchNameRCIty" class="SearchFormLabelList"><?php echo $arWords['FormSearchNameRCIty'];?><span id="3_d_span" class="ui-icon ui-icon-triangle-1-s"></span></label>
						<?php echo PrintStandartFormDiv('3_d', $PrintFormStandartArr);?>
					<label id="FormSearchNameACity" class="SearchFormLabelList"><?php echo $arWords['FormSearchNameACity'];?><span id="4_d_span" class="ui-icon ui-icon-triangle-1-s"></span></label>
						<?php echo PrintStandartFormDiv('4_d', $PrintFormStandartArr);?>
			</td>
			<td>
				<div class="TableSearchFormDivwidth">	
				<label for="im_adress_id" class="SearchFormLabel"><?php echo $arWords['FormSearchNameAdress'];?></label>
					<input class="ui-autocomplete-input FormSearchInputText" value="<?php echo $CookieData['im_adress_id'];?>" size="40" name="im_adress_id" id="im_adress_id" type="text" />
				<label id="FormSearchNameDate" class="SearchFormLabel"><?php echo $arWords['FormSearchNameDateMin'];?></label>
					<input class="FormSearchInputText" value="<?php echo $CookieData['im_date_add_s'];?>" size="40" name="im_date_add_s" id="im_date_add_s" type="text" /><br/>
				<label id="FormSearchNameDate" class="SearchFormLabel"><?php echo $arWords['FormSearchNameDateMax'];?></label>
					<input class="FormSearchInputText" value="<?php echo $CookieData['im_date_add_e'];?>" size="40" name="im_date_add_e" id="im_date_add_e" type="text" /><br/>	
				</div>			
			</td>
			<td>
				<div class="TableSearchFormDivwidth">
				<label id="FormSearchNameSq" class="SearchFormLabel"><?php echo $arWords['FormSearchNameSq_'.$_GET[1]];?></label>
					<input type="text" id="im_space" name="im_space" class="FormSearchInputText" value="" size="40" />
					<div class="SliderWidth" id="slider-im_space"></div>
				<?php 
					if($_GET['type_cat'] == 'rent') {
						echo "<label id=\"FormSearchNamePriceManth\" class=\"SearchFormLabel\">{$arWords['FormSearchNamePriceManth']} $</label>
								<input class=\"FormSearchInputText\" value=\"\" size=\"40\" id=\"im_prace_manth\" name=\"im_prace_manth\" type=\"text\"/>
								<div class=\"SliderWidth\" id=\"slider-im_prace_manth\"></div>
								<label id=\"FormSearchNamePriceDay\" class=\"SearchFormLabel\">{$arWords['FormSearchNamePriceDay']} $</label>
								<input class=\"FormSearchInputText\" value=\"\" size=\"40\" id=\"im_prace_day\" name=\"im_prace_day\" type=\"text\" />
								<div class=\"SliderWidth\" id=\"slider-im_prace_day\"></div>";
					}
					else {
				?>
				<label id="FormSearchNamePrice" class="SearchFormLabel"><?php echo $arWords['FormSearchNamePrice'];?></label>
					<input class="FormSearchInputText" id="im_prace"   value="" size="40" name="im_prace" type="text" />
					<div class="SliderWidth" id="slider-im_prace"></div>
				<label id="FormSearchNamePriceM" class="SearchFormLabel"><?php echo $arWords['FormSearchNamePriceM_'.$_GET[1]];?></label>
					<input class="FormSearchInputText" id="im_prace_sq"  value="" size="40" name="im_prace_sq" type="text" />
					<div class="SliderWidth" id="slider-im_prace_sq"></div>
				</div>	
				<?php }?>		
			</td>
		</tr>
		<tr>
			<td class="TableSearchFormTdStandartPropCat" colspan="3"><?php echo $SearchListPropCat;?></td>
		</tr>	
		<tr>
			<td>
				<a href="#" id="SearchPropImAdviceHS" title="<?php echo $arWords['SearchImmovablesAdvased'];?>"><?php echo $arWords['SearchImmovablesAdvased'];?></a>
			</td>
			<td>
			</td>
			<td>
				<input type="hidden" name="SearchImCode" value="<?php  echo time();?>"/> 
				<input type="submit" class="ui-state-default ui-corner-all" id="SearchSbtIm" value="<?php echo $arWords['SearchBottom'];?>"/>
				<input type="hidden" name= "action" value="ImFormSearch"/>
			</td>
		</tr>
	</table>	
<script type="text/javascript">
$(function() {
	$("#slider-im_space").slider({
		range: true,
		step: 20,
		<?php echo SlideValue('im_space', $CookieData['im_space'], $DefaultFormValue['im_space']);?>
		slide: function(event, ui) {
			$("#im_space").val(ui.values[0] + ' - ' + ui.values[1]);
		}
	});
	<?php
		if($_GET['type_cat'] == 'sale') {
	?>
			$("#slider-im_prace").slider({
		range: true,
		step: 50000,
		<?php echo SlideValue('im_prace', $CookieData['im_prace'], $DefaultFormValue['im_prace']);?>
		slide: function(event, ui) {
			$("#im_prace").val(ui.values[0] + ' - ' + ui.values[1]);
		}
	});
	$("#slider-im_prace_sq").slider({
		range: true,
		step: 500,
		<?php echo SlideValue('im_prace_sq', $CookieData['im_prace_sq'], $DefaultFormValue['im_prace_sq']);?>
		slide: function(event, ui) {
			$("#im_prace_sq").val(ui.values[0] + ' - ' + ui.values[1]);
		}
	});
	$("#im_prace").val($("#slider-im_prace").slider("values", 0) + ' - ' + $("#slider-im_prace").slider("values", 1));
	$("#im_prace_sq").val($("#slider-im_prace_sq").slider("values", 0) + ' - ' + $("#slider-im_prace_sq").slider("values", 1));
	<?php
		}
	?>
	$("#im_space").val($("#slider-im_space").slider("values", 0) + ' - ' + $("#slider-im_space").slider("values", 1));
	$("#im_adress_id").autocomplete({
		source: availableTags
	});
	$("#im_date_add_e").datepicker();
	$("#im_date_add_s").datepicker();
	<?php
	if($_GET['type_cat'] == 'rent') {
	?>
		$("#slider-im_prace_day").slider({
		range: true,
		step: 20,
		<?php echo SlideValue('im_prace_day', $CookieData['im_prace_day'], $DefaultFormValue['im_prace_day']);?>
		slide: function(event, ui) {
			$("#im_prace_day").val(ui.values[0] + ' - ' + ui.values[1]);
		}
		});
		$("#slider-im_prace_manth").slider({
			range: true,
			step: 50000,
			<?php echo SlideValue('im_prace_manth', $CookieData['im_prace_manth'], $DefaultFormValue['im_prace_manth']);?>
			slide: function(event, ui) {
				$("#im_prace_manth").val(ui.values[0] + ' - ' + ui.values[1]);
			}
		});
		$("#im_prace_day").val($("#slider-im_prace_day").slider("values", 0) + ' - ' + $("#slider-im_prace_day").slider("values", 1));
		$("#im_prace_manth").val($("#slider-im_prace_manth").slider("values", 0) + ' - ' + $("#slider-im_prace_manth").slider("values", 1));
	<?php
	}
	?>
	
});
</script>

					
	
	
	
