<?php
	require_once("../../../config/config.php");
require_once DOC_ROOT . '/config/class.config.php';
	require_once("../../includes/language/set.cookie.php");
	require_once("../../includes/immovables/settings.s.im.inc");
	//print_r($_GET);
	//print_r($_POST);
?>
<?php
	#	����� ������� ��� ������
	require_once '../search/f.search.php';
	
	#��������� ����� �������
		$dictionaries = new dictionaries();
	#��������� ������ ����� ��������
		$dct_list 	=	$dictionaries->buid_dictionaries_list($tbl_list_dictionaries);
	#��������� ������ �������� ��������
		$dct		=	 $dictionaries->buid_dictionaries	($tbl_dictionaries,
									 	 					 "WHERE lang_id = {$_COOKIE['lang_id']} ORDER BY dict_name");
	#�����������	
		#���� �������(��)
		$dictionaries->do_dictionaries(11);
		$im_region_id_add	 = $dictionaries->my_dct;
		#���� 
		$dictionaries->do_dictionaries(15);
		$im_array_id_add	 = $dictionaries->my_dct;
		#����� ������� (����)
		$dictionaries->do_dictionaries(24);
		$im_a_region_add	 = $dictionaries->my_dct;
		#���� �����(��)
		$dictionaries->do_dictionaries(12);
		$im_city_id_add	 	= $dictionaries->my_dct;		
		#���� ����� ������(��)
		$dictionaries->do_dictionaries(13);
		$im_area_id_add	 	= $dictionaries->my_dct;	
		#���� ������(�������) �����
		$dictionaries->do_dictionaries(14);
		$im_adress_id_add 	= $dictionaries->my_dct;
		$dictionaries->do_dictionaries(22);
		$sale_id_add 		= $dictionaries->my_dct;
				
		#���������� ������� ��������	
		$BuildResult = array_merge_recursive($im_region_id_add, $im_array_id_add, $im_a_region_add, $im_city_id_add, $im_area_id_add);
		#������ ������ ��������
		$BuildResult = $dictionaries->BuildArrayParentChild($BuildResult);
		#���������������� ����������� ������ ����������� 
		$PrintFormStandartArr = BuildFieldset($BuildResult, $dictionaries, $CookieData);
		
		#������� ������������� ������������	
			$ImPropList = new mysql_select($tbl_im_pl,
										   "WHERE lang_id = {$_COOKIE['lang_id']} AND catalog_id='{$_GET[im_catalog_id]}' AND type_prop='advanced' AND hide='show'",
										   "ORDER BY im_prop_style_id ASC");
			$ImPropList->select_table("im_prop_id");
			$PrintPropForm = new ImPropAdvaced($ImPropList, $dictionaries, $CookieData, NULL,  false, "SearchFormAdvased", "FormSearchInputText", $arWords['FormSearchFirldNoValue']);
			$PrintPropForm->ImPropListPrintField();
?>
<script type="text/javascript">
	var availableTags = <?php echo GetAdressString($im_adress_id_add, $dictionaries); ?>
	//var availableTags = '';
	//["ActionScript", "AppleScript", "Asp", "BASIC", "C", "C++", "Clojure", "COBOL", "ColdFusion", "Erlang", "Fortran", "Groovy", "Haskell", "Java", "JavaScript", "Lisp", "Perl", "PHP", "Python", "Ruby", "Scala", "Scheme"];
	<?php echo BuildJScriptArrays($BuildResult, $_COOKIE['ImFormSearchArray']);?>
</script>
<script type="text/javascript" src="/js/im.search.js"></script>	

<div style="padding: 0pt 0.7em; margin-bottom:10px;" class="ui-state-highlight ui-corner-all"> 
	<p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-info"></span><?php echo $arWords['user_add_subs_im_st_prop'];?></p>
</div>
<div id="SearchFormIm" class="SubsAdPropFormBg">
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
				<?php 
					if($_GET['type_cat'] == 'rent') {
						echo "<label id=\"FormSearchNamePriceDay\" class=\"SearchFormLabel\">{$arWords['FormSearchNamePriceDay']} $</label>
								<input class=\"FormSearchInputText\" value=\"\" size=\"40\" name=\"im_prace_day\" type=\"text\" /><br/>
							<label id=\"FormSearchNamePriceManth\" class=\"SearchFormLabel\">{$arWords['FormSearchNamePriceManth']} $</label>
								<input class=\"FormSearchInputText\" value=\"\" size=\"40\" name=\"im_prace_manth\" type=\"text\"/>";
					}
				?>	
				</div>			
			</td>
			<td>
				<div class="TableSearchFormDivwidth">
				<label id="FormSearchNameSq" class="SearchFormLabel"><?php echo $arWords['FormSearchNameSq'];?></label>
					<input type="text" id="im_space" name="im_space" class="FormSearchInputText" value="" size="40" />
					<div class="SliderWidth" id="slider-im_space"></div>
				<label id="FormSearchNamePrice" class="SearchFormLabel"><?php echo $arWords['FormSearchNamePrice'];?></label>
					<input class="FormSearchInputText" id="im_prace"   value="" size="40" name="im_prace" type="text" />
					<div class="SliderWidth" id="slider-im_prace"></div>
				<label id="FormSearchNamePriceM" class="SearchFormLabel"><?php echo $arWords['FormSearchNamePriceM'];?></label>
					<input class="FormSearchInputText" id="im_prace_sq"  value="" size="40" name="im_prace_sq" type="text" />
					<div class="SliderWidth" id="slider-im_prace_sq"></div>
				</div>			
			</td>
		</tr>
		<tr>
			<td>
				<a href="#" id="SearchPropImAdviceHS" title="<?php echo $arWords['user_add_subs_im_ad_prop'];?>"><?php echo $arWords['user_add_subs_im_ad_prop'];?></a>
			</td>
			<td>
			</td>
			<td>
				<input type="hidden" name="SearchImCode" value="<?php echo uniqid();?>"/> 
				<input type="hidden" name= "retention" value="ImFormSubs"/>
			</td>
		</tr>
	</table>	
    <div id="DivImPropForm" style="margin-top:10px;">
		<?php echo $PrintPropForm->Form;?>
	</div>
</div>          
<script type="text/javascript">
$(function() {
	$("#slider-im_space").slider({
		range: true,
		<?php echo SlideValue('im_space', $CookieData['im_space'], $DefaultFormValue['im_space']);?>
		slide: function(event, ui) {
			$("#im_space").val(ui.values[0] + ' - ' + ui.values[1]);
		}
	});
	$("#slider-im_prace").slider({
		range: true,
		<?php echo SlideValue('im_prace', $CookieData['im_prace'], $DefaultFormValue['im_prace']);?>
		slide: function(event, ui) {
			$("#im_prace").val(ui.values[0] + ' - ' + ui.values[1]);
		}
	});
	$("#slider-im_prace_sq").slider({
		range: true,
		<?php echo SlideValue('im_prace_sq', $CookieData['im_prace_sq'], $DefaultFormValue['im_prace_sq']);?>
		slide: function(event, ui) {
			$("#im_prace_sq").val(ui.values[0] + ' - ' + ui.values[1]);
		}
	});
	$("#im_space").val($("#slider-im_space").slider("values", 0) + ' - ' + $("#slider-im_space").slider("values", 1));
	$("#im_prace").val($("#slider-im_prace").slider("values", 0) + ' - ' + $("#slider-im_prace").slider("values", 1));
	$("#im_prace_sq").val($("#slider-im_prace_sq").slider("values", 0) + ' - ' + $("#slider-im_prace_sq").slider("values", 1));
	$("#im_adress_id").autocomplete({
		source: availableTags
	});
	$("#im_date_add_e").datepicker();
	$("#im_date_add_s").datepicker();
});
</script>