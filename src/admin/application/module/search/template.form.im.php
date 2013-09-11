<?php
	#	набор функцый для поиска
	require_once 'f.search.php';
//if(!$dictionaries) {
	#объявляем класс словаря
		$dictionaries_hide = new dictionaries();
	#формируем массив имени словарей
		$dct_list 	=	$dictionaries_hide->buid_dictionaries_list($tbl_list_dictionaries);
	#формируем массив значений словарей
		$dct		=	$dictionaries_hide->buid_dictionaries	($tbl_dictionaries,
									 	 					 	"WHERE lang_id = {$_COOKIE['lang_id']} and hide = 1 ORDER BY dict_name");	
		
/*}
else {
	$dictionaries_hide = $dictionaries;
}*/
	#справочники	
		#айди область(сл)
		$dictionaries_hide->do_dictionaries(11);
		$im_region_id_add	 = $dictionaries_hide->my_dct;
		#айди 
		$dictionaries_hide->do_dictionaries(15);
		$im_array_id_add	 = $dictionaries_hide->my_dct;
		#район области (айди)
		$dictionaries_hide->do_dictionaries(24);
		$im_a_region_add	 = $dictionaries_hide->my_dct;
		#айди город(сл)
		$dictionaries_hide->do_dictionaries(12);
		$im_city_id_add	 = $dictionaries_hide->my_dct;		
		#айди район города(сл)
		$dictionaries_hide->do_dictionaries(13);
		$im_area_id_add	 = $dictionaries_hide->my_dct;	
		#айди адресс(словарь) улица
		$dictionaries_hide->do_dictionaries(14);
		$im_adress_id_add = $dictionaries_hide->my_dct;
		$dictionaries->do_dictionaries(22);
		$sale_id_add = $dictionaries->my_dct;
		
		if (!is_array($im_region_id_add))
			$im_region_id_add = array();
		if (!is_array($im_array_id_add))
			$im_array_id_add = array();
		if (!is_array($im_a_region_add))
			$im_a_region_add = array();
		if (!is_array($im_city_id_add))
			$im_city_id_add = array();
		if (!is_array($im_area_id_add))
			$im_area_id_add = array();

		#производим слияние массивов	
		$BuildResult = array_merge_recursive($im_region_id_add, $im_array_id_add, $im_a_region_add, $im_city_id_add, $im_area_id_add);
		#строим дерево каталога
		$BuildResult = $dictionaries->BuildArrayParentChild($BuildResult);
		#сформировованный древовидный массив справочника 
		//$PrintFormStandartArr = BuildFieldset($BuildResult, $dictionaries, $CookieData);
		
		$DictionaryTree = new DictionaryTree($BuildResult, $dictionaries, $CookieData);
		$DictionaryTree -> buildDictionaryTree();
		
		
		if($_GET['type_cat'] == 'sale') $ImPropListQueryIPType = 'AND is_prop_sale = 1';
		else  $ImPropListQueryIPType = 'AND is_prop_rent = 1';
		
			#выборка характеристик недвижимости	
			$ImPropListSt = new mysql_select($tbl_im_pl,
										   "WHERE lang_id = {$_COOKIE['lang_id']} AND catalog_id='{$ImCatArr[$_GET[1]]}' AND type_prop='standard' AND hide='show' AND is_show_form=1 {$ImPropListQueryIPType}",
										   "ORDER BY im_prop_style_id ASC");
			$ImPropListSt->select_table("im_prop_id");
			$PrintPropFormSt = new ImPropAdvaced($ImPropListSt, $dictionaries, $CookieData, NULL,  false, "SearchFormAdvased", "FormSearchInputText", $arWords['FormSearchFirldNoValue']);
			$PrintPropFormSt->ImPropListPrintField();
			$SearchListPropCat = $PrintPropFormSt->Form;
			
			
		#выборка характеристик недвижимости	
			$ImPropListAd = new mysql_select($tbl_im_pl,
										   "WHERE lang_id = {$_COOKIE['lang_id']} AND catalog_id='{$ImCatArr[$_GET[1]]}' AND type_prop='advanced' AND hide='show' AND is_show_form=1 {$ImPropListQueryIPType}",
										   "ORDER BY im_prop_style_id ASC");
			$ImPropListAd->select_table("im_prop_id");
			$PrintPropFormAd = new ImPropAdvaced($ImPropListAd, $dictionaries, $CookieData, NULL,  false, "SearchFormAdvased", "FormSearchInputText", $arWords['FormSearchFirldNoValue']);
			$PrintPropFormAd->ImPropListPrintField();

			
		#выборка характеристик недвижимости		
			$ImPropList = new mysql_select($tbl_im_pl,
											   "WHERE lang_id = {$_COOKIE['lang_id']} AND catalog_id='{$ImCatArr[$_GET[1]]}' AND hide='show'",
											   "ORDER BY im_prop_style_id ASC");
			$ImPropList->select_table("im_prop_id");
			$PrintPropForm = new ImPropAdvaced($ImPropList, $dictionaries, $CookieData, NULL,  false, "SearchFormAdvased", "FormSearchInputText", $arWords['FormSearchFirldNoValue']);
			$PrintPropForm->ImPropListPrintField();	
?>
<script type="text/javascript">
	var availableTags = <?php echo GetAdressString($im_adress_id_add, $dictionaries); ?>
	<?php echo BuildJScriptArrays($BuildResult, $_COOKIE['ImFormSearchArray']);?>
</script>
<script type="text/javascript" src="/js/im.search.js"></script>	

<div id="tabs">
	<ul>
		<li><a href="#tabs-1"><?php echo $arWords['SearchImmovablesCat'];?></a></li>
    	<!--<li><a href="#tabs-2"><?php echo $arWords['SearchImmovablesMap'];?></a></li>-->
	    <?php if (strpos ( $_SERVER["REQUEST_URI"], "dmn/") ) : ?>
        	<li><a href="#tabs-3"><?php echo $arWords['SearchImmovablesCode'];?></a></li>
		<?php endif; ?>
    </ul>
	<div id="tabs-1">
    	<?php
			#стандартные паля для поиска недвижимости	
			require_once DOC_ROOT . '/application/includes/search/im.standart.search.form.inc';?>
			<div id="DivImPropForm">
				<?php echo $PrintPropFormAd->Form;?>
			</div>
            </form>
	</div>
	<!--<div id="tabs-2">
    	<?php
        	#подгрузка карты городов	
			//$PG_ARRAY['retention'] = 'get_im_ca_map';
			//require_once('application/module/map_city/template.print.map.php');
		?>
	</div>-->
	<?php if (strpos ( $_SERVER["REQUEST_URI"], "dmn/") ) : ?>
        <div id="tabs-3">
            <script type="text/javascript">
			$(function() {
				$('#inputCodes').bind('keypress', function(e) {
					var keycode =  e.keyCode ? e.keyCode : e.which;
					if(keycode < 37 || keycode > 40 ) {
						changePointerCodeToSCField(this);
					}
				});
			});
			</script>
			<form id="SearchFormIm" method="get" action="/dmn/immovablesPosition/" enctype="application/x-www-form-urlencoded" name="SearchFormIm">
                <table class="TableSearchForm">
                    <tr>
                        <td>
                        	<input type="text" name="inputCodes" size="40" id="inputCodes" value="<?php echo $_GET["inputCodes"];?>" class="FormSearchInputText">
                            <input type="hidden" name="action" value="s_code"/>
                        	<input type="submit" value="Найти" id="">
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                    </tr>
                </table>
            </form>
       </div>
    <?php endif; ?>
</div>	

	<script type="text/javascript">
	$(function() {
		$("#im_adress_id").autocomplete({
			source: availableTags,
			maxHeight: 400,
			minLength: 3
		});
		$("#tabs").tabs();
		<?php echo ($CookieData["SearchIsAdvasedChecked"] ? "$(\"#DivImPropForm\").show();" : "");?>
	});
	</script> 
