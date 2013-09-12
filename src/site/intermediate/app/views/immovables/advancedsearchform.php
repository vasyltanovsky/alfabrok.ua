<?php global $routingObj; ?>
<?php global $arWords; ?>
<?php 
	global $renderHtmlLinkObj; 
	$renderHtmlLinkObj->addJs("js/ant/libs/im.search");
?>
<?php //devLogs::_printr($Model->dictionaryTreeObj);?>
<div id="tabs">
	<ul>
		<li><a href="#tabs-1"><?php echo getLangString('SearchImmovablesCat');?></a></li>
    </ul>
	<div id="tabs-1">
		<form id="SearchFormIm" name="SearchFormIm" enctype="application/x-www-form-urlencoded" action="/ru/<?php echo $routingObj->getController(); ?>/<?php echo $routingObj->getaction();?>" method="get">
			<table class="TableSearchForm">
				<tr>
					<td><?php echo appHtmlClass::partial("/immovables/search/regionalsearchblock", array("Data"=> $Model->dictionaryTreeObj));?></td>
				<td>
					<div class="TableSearchFormDivwidth" >	
						<label for="im_adress_id" class="SearchFormLabel"><?php echo getLangString('FormSearchNameAdress');?></label>
						<input class="ui-autocomplete-input FormSearchInputText" value="<?php echo $routingObj->getParamItem('im_adress_id');?>" size="40" name="im_adress_id" id="im_adress_id" type="text" />
					</div>			
				</td>
				<td>
					<div class="TableSearchFormDivwidth2">
						<label id="" class="SearchFormLabel exchange_label"><?php echo getLangString('exchange');?></label>
						<select name="exchange_rate" id="exchange_select_id" class="exchange_select">
							<?php echo ImPropAdvaced::DictDropList($arWords['exchange_arr'], $routingObj->getParamItem('exchange_rate'), 'code', 'code');?>
						</select>
						<div class="clear"></div>
						<label id="FormSearchNameSq" class="SearchFormLabel"><?php echo getLangString('FormSearchNameSq_'. $routingObj->getController());?></label>
						<label id="" class="SearchFormLabelBE"><?php echo getLangString('from');?></label>
						<input type="text" id="im_spaceb" name="im_spaceb" class="FormSearchInputTextBE" value="<?php echo $routingObj->getParamItem('im_spaceb');?>" size="20" />
						<label id="" class="SearchFormLabelBE"><?php echo getLangString('to');?></label>
						<input type="text" id="im_spacee" name="im_spacee" class="FormSearchInputTextBE" value="<?php echo $routingObj->getParamItem('im_spacee');?>" size="20" />
						<?php if( $routingObj->getAction() == 'rent'): ?>
							<label id="FormSearchNamePriceManth" class="SearchFormLabel"><?php echo getLangString('FormSearchNamePriceManth');?> $</label>
							<label id="" class="SearchFormLabelBE"><?php echo getLangString('from');?></label>
							<input class="FormSearchInputTextBE" value="<?php echo $routingObj->getParamItem('im_prace_manthb');?>" size="40" id="im_prace_manthb" name="im_prace_manthb" type="text"/>
							<label id="" class="SearchFormLabelBE"><?php echo getLangString('to');?></label>
							<input class="FormSearchInputTextBE" value="<?php echo $routingObj->getParamItem('im_prace_manthe');?>" size="40" id="im_prace_manthe" name="im_prace_manthe" type="text"/>
							<label id="FormSearchNamePriceDay" class="SearchFormLabel"><?php echo getLangString('FormSearchNamePriceDay');?> $</label>
							<label id="" class="SearchFormLabelBE"><?php echo getLangString('from');?></label>
							<input class="FormSearchInputTextBE" value="<?php echo $routingObj->getParamItem('im_prace_dayb');?>" size="40" id="im_prace_dayb" name="im_prace_dayb" type="text"/>
							<label id="" class="SearchFormLabelBE"><?php echo getLangString('to');?></label>
							<input class="FormSearchInputTextBE" value="<?php echo $routingObj->getParamItem('im_prace_daye');?>" size="40" id="im_prace_daye" name="im_prace_daye" type="text"/>
						<?php else: ?>				
							<label id="FormSearchNamePrice" class="SearchFormLabel"><?php echo getLangString('FormSearchNamePrice');?></label>
							<label id="" class="SearchFormLabelBE"><?php echo getLangString('from');?></label>
							<input type="text" id="im_praceb" name="im_praceb" class="FormSearchInputTextBE" value="<?php echo $routingObj->getParamItem('im_praceb');?>" size="20" />
							<label id="" class="SearchFormLabelBE"><?php echo getLangString('to');?></label>
							<input type="text" id="im_pracee" name="im_pracee" class="FormSearchInputTextBE" value="<?php echo $routingObj->getParamItem('im_pracee');?>" size="20" />
							<label id="FormSearchNamePriceM" class="SearchFormLabel"><?php echo getLangString('FormSearchNamePriceM_'. $routingObj->getController());?></label>
							<label id="" class="SearchFormLabelBE"><?php echo getLangString('from');?></label>
							<input type="text" id="im_prace_sqb" name="im_prace_sqb" class="FormSearchInputTextBE" value="<?php echo $routingObj->getParamItem('im_prace_sqb');?>" size="20" />
							<label id="" class="SearchFormLabelBE"><?php echo getLangString('to');?></label>
							<input type="text" id="im_prace_sqe" name="im_prace_sqe" class="FormSearchInputTextBE" value="<?php echo $routingObj->getParamItem('im_prace_sqe');?>" size="20" />
					</div>	
					<?php endif;?>		
				</td>
			</tr>
			<tr>
				<td class="TableSearchFormTdStandartPropCat" colspan="3"><?php echo $Model->PrintPropFormSt->Form;?></td>
			</tr>	
			<tr>
				<td>
					<a href="#" id="SearchPropImAdviceHS" title="<?php echo getLangString('SearchImmovablesAdvased');?>"><?php echo getLangString('SearchImmovablesAdvased');?></a>
				</td>
				<td>
				</td>
				<td>
					<input type="hidden" id="SearchIsAdvasedChecked" name="SearchIsAdvasedChecked" value="<?php echo ($routingObj->getParamItem("SearchIsAdvasedChecked") ? $routingObj->getParamItem("SearchIsAdvasedChecked") : 0);?>"/> 
					<input type="hidden" name="SearchImCode" value="<?php  echo time();?>"/> 
					<input type="submit" id="SearchSbtIm" value="<?php echo getLangString('SearchBottom');?>"/>
					<input type="hidden" name= "action" value="ImFormSearch"/>
				</td>
			</tr>
		</table>	
		<div id="DivImPropForm"><?php echo $Model->PrintPropFormAd->Form;?></div>
	</form>
	</div>
</div>	
<script type="text/javascript">
	var availableTags = <?php echo GetAdressString($Model->dAdressList, $Model->dictionaries); ?>
	<?php //echo BuildJScriptArrays($BuildResult, $_COOKIE['ImFormSearchArray']);?>
</script>
<script type="text/javascript">
$(function() {
	$("#im_adress_id").autocomplete({
		source: availableTags,
		maxHeight: 400,
		minLength: 3
	});
	$("#tabs").tabs();
	<?php echo ($routingObj->getParamItem("SearchIsAdvasedChecked") ? "$('#DivImPropForm').show();" : "");?>
});
</script> 
