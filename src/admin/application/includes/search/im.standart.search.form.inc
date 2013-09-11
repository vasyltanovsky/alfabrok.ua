<form id="SearchFormIm" name="SearchFormIm" enctype="application/x-www-form-urlencoded" action="<?php echo (!strpos ( $_SERVER["REQUEST_URI"], "dmn/") ? "/immovables/" . $_GET[1] .'/'. $_GET['type_cat']. ".html" : "/dmn/immovablesPosition/"); ?>" method="get">
	<table class="TableSearchForm">
		<tr>
			<td>
				<?php echo Controller::Template("/application/includes/search/regional.search.block.php", array("Data"=> $DictionaryTree));?>
			</td>
			<td>
				<div class="TableSearchFormDivwidth" >	
				<label for="im_adress_id" class="SearchFormLabel"><?php echo $arWords['FormSearchNameAdress'];?></label>
					<input class="ui-autocomplete-input FormSearchInputText" value="<?php echo $CookieData['im_adress_id'];?>" size="40" name="im_adress_id" id="im_adress_id" type="text" />
			<?php if (strpos ( $_SERVER["REQUEST_URI"], "dmn/") ) : ?>
				<label id="FormSearchNameDate" class="SearchFormLabel"><?php echo $arWords['FormSearchNameDateMin'];?></label>
					<input class="FormSearchInputText" value="<?php echo $CookieData['im_date_add_s'];?>" size="40" name="im_date_add_s" id="im_date_add_s" type="text" /><br/>
				<label id="FormSearchNameDate" class="SearchFormLabel"><?php echo $arWords['FormSearchNameDateMax'];?></label>
					<input class="FormSearchInputText" value="<?php echo $CookieData['im_date_add_e'];?>" size="40" name="im_date_add_e" id="im_date_add_e" type="text" /><br/>
			<?php endif; ?>	
				</div>			
			</td>
			<td>
				<div class="TableSearchFormDivwidth2">
					<label id="" class="SearchFormLabel exchange_label"><?php echo $arWords['exchange'];?></label>
					<select name="exchange_rate" id="exchange_select_id" class="exchange_select">
						<?php echo ImPropAdvaced::DictDropList($arWords['exchange_arr'], $CookieData['exchange_rate'], 'code', 'code');?>
					</select>
					<div class="clear"></div>
					<label id="FormSearchNameSq" class="SearchFormLabel"><?php echo $arWords['FormSearchNameSq_'.$_GET[1]];?></label>
					<label id="" class="SearchFormLabelBE"><?php echo $arWords['from'];?></label>
					<input type="text" id="im_spaceb" name="im_spaceb" class="FormSearchInputTextBE" value="<?php echo $CookieData['im_spaceb'];?>" size="20" />
					<label id="" class="SearchFormLabelBE"><?php echo $arWords['to'];?></label>
					<input type="text" id="im_spacee" name="im_spacee" class="FormSearchInputTextBE" value="<?php echo $CookieData['im_spacee'];?>" size="20" />
				<?php 
					if($_GET['type_cat'] == 'rent') {
						echo "<label id=\"FormSearchNamePriceManth\" class=\"SearchFormLabel\">{$arWords['FormSearchNamePriceManth']} $</label>
								<label id=\"\" class=\"SearchFormLabelBE\">{$arWords['from']}</label>
								<input class=\"FormSearchInputTextBE\" value=\"{$CookieData['im_prace_manthb']}\" size=\"40\" id=\"im_prace_manthb\" name=\"im_prace_manthb\" type=\"text\"/>
								<label id=\"\" class=\"SearchFormLabelBE\">{$arWords['to']}</label>
								<input class=\"FormSearchInputTextBE\" value=\"{$CookieData['im_prace_manthe']}\" size=\"40\" id=\"im_prace_manthe\" name=\"im_prace_manthe\" type=\"text\"/>
								<label id=\"FormSearchNamePriceDay\" class=\"SearchFormLabel\">{$arWords['FormSearchNamePriceDay']} $</label>
								<label id=\"\" class=\"SearchFormLabelBE\">{$arWords['from']}</label>
								<input class=\"FormSearchInputTextBE\" value=\"{$CookieData['im_prace_dayb']}\" size=\"40\" id=\"im_prace_dayb\" name=\"im_prace_dayb\" type=\"text\"/>
								<label id=\"\" class=\"SearchFormLabelBE\">{$arWords['to']}</label>
								<input class=\"FormSearchInputTextBE\" value=\"{$CookieData['im_prace_daye']}\" size=\"40\" id=\"im_prace_daye\" name=\"im_prace_daye\" type=\"text\"/>";
								
					}
					else {
				?>
				<label id="FormSearchNamePrice" class="SearchFormLabel"><?php echo $arWords['FormSearchNamePrice'];?></label>
					<label id="" class="SearchFormLabelBE"><?php echo $arWords['from'];?></label>
					<input type="text" id="im_praceb" name="im_praceb" class="FormSearchInputTextBE" value="<?php echo $CookieData['im_praceb'];?>" size="20" />
					<label id="" class="SearchFormLabelBE"><?php echo $arWords['to'];?></label>
					<input type="text" id="im_pracee" name="im_pracee" class="FormSearchInputTextBE" value="<?php echo $CookieData['im_pracee'];?>" size="20" />
				<label id="FormSearchNamePriceM" class="SearchFormLabel"><?php echo $arWords['FormSearchNamePriceM_'.$_GET[1]];?></label>
					<label id="" class="SearchFormLabelBE"><?php echo $arWords['from'];?></label>
					<input type="text" id="im_prace_sqb" name="im_prace_sqb" class="FormSearchInputTextBE" value="<?php echo $CookieData['im_prace_sqb'];?>" size="20" />
					<label id="" class="SearchFormLabelBE"><?php echo $arWords['to'];?></label>
					<input type="text" id="im_prace_sqe" name="im_prace_sqe" class="FormSearchInputTextBE" value="<?php echo $CookieData['im_prace_sqe'];?>" size="20" />
				</div>	
				<?php }?>		
			</td>
		</tr>
		<?php if (strpos ( $_SERVER["REQUEST_URI"], "dmn/") ) : ?>
		<?php 
			$cl_sel_pages = new mysql_select ( "system_accounts", "where type='4f4b956ee91ed'", "ORDER BY id_account" );
			$cl_sel_pages->select_table ( "id_account" );
		?>
		<tr>
			<td colspan="3">
				<select class="FormSearchInputText" name="susr_id" id="susr_id">
				   	<option value="">Риэлтор</option>
          			<?php echo ImPropAdvaced::DictDropList($cl_sel_pages->table, $CookieData['susr_id'], 'id_account', 'fio');?>
       			</select>
			</td>
		</tr>
		<?php endif;?>
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
				<input type="hidden" id="SearchIsAdvasedChecked" name="SearchIsAdvasedChecked" value="<?php echo ($CookieData["SearchIsAdvasedChecked"] ? $CookieData["SearchIsAdvasedChecked"] : 0);?>"/> 
				<input type="hidden" name="SearchImCode" value="<?php  echo time();?>"/> 
				<input type="submit" id="SearchSbtIm" value="<?php echo $arWords['SearchBottom'];?>"/>
				<?php if(strpos ( $_SERVER["REQUEST_URI"], "dmn/") ) : ?>
				<input type="hidden" name="type_cat" value="<?php echo $_GET["type_cat"];?>"/> 
				<input type="hidden" name="1" value="<?php echo $_GET["1"];?>"/> 
				<?php endif;?>
				<input type="hidden" name= "action" value="ImFormSearch"/>
			</td>
		</tr>
	</table>	
<script type="text/javascript">
$(function() {
	$("#im_date_add_e").datepicker();
	$("#im_date_add_s").datepicker();
});
</script>

					
	
	
	
