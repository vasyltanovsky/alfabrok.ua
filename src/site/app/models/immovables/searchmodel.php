<?php
class immovablesSearchModelClass extends immovablesModelClass {
	public $dRegionList;
	public $dArrayList;
	public $dARegionList;
	public $dCityList;
	public $dAreaList;
	public $dAdressList;
	public $dSaleList;
	public $terrotoryParentChildResult;
	
	public $dictionaryTreeObj;
	public $PrintPropFormSt;
	public $ImPropListAd;
	public $PrintPropForm;
	public $routingObj;
	
	public function __construct($provider) {
		parent::__construct ( $provider );
		$this->dRegionList = array ();
		$this->dArrayList = array ();
		$this->dARegionList = array ();
		$this->dCityList = array ();
		$this->dAreaList = array ();
		$this->dAdressList = array ();
		$this->dSaleList = array ();
		global $routingObj;
		$this->routingObj = $routingObj;
	}
	public function buildAdvasedSearchForm($param) {
		$this->buildTerrotoryDict ();
	}
	
	public function buildTerrotoryDict() {
		$this->dictionaries->do_dictionaries ( 11 );
		$this->dRegionList = $this->dictionaries->my_dct;
		$this->dictionaries->do_dictionaries ( 15 );
		$this->dArrayList = $this->dictionaries->my_dct;
		$this->dictionaries->do_dictionaries ( 24 );
		$this->dARegionList = $this->dictionaries->my_dct;
		$this->dictionaries->do_dictionaries ( 12 );
		$this->dCityList = $this->dictionaries->my_dct;
		$this->dictionaries->do_dictionaries ( 13 );
		$this->dAreaList = $this->dictionaries->my_dct;
		$this->dictionaries->do_dictionaries ( 14 );
		$this->dAdressList = $this->dictionaries->my_dct;
		$this->dictionaries->do_dictionaries ( 22 );
		$this->dSaleList = $this->dictionaries->my_dct;
		
		$mergeTerrotoryResult = array_merge_recursive ( $this->dRegionList, $this->dArrayList, $this->dARegionList, $this->dCityList, $this->dAreaList );
		$this->terrotoryParentChildResult = $this->dictionaries->BuildArrayParentChild ( $mergeTerrotoryResult );
		
		$this->dictionaryTreeObj = new dictionaryTreeClass ( $this->terrotoryParentChildResult, $this->dictionaries, $this->routingObj->getParam () );
		$this->dictionaryTreeObj->buildDictionaryTree ();
	}
	
	public function buildImmovablesProperties($categoryType) {
		$query = ($this->routingObj->getAction () == "sale" ? "and is_prop_sale = 1" : "and is_prop_rent = 1");
		
		#выборка характеристик недвижимости	
		$ImPropListSt = new mysql_select ( "im_properties_list", "WHERE lang_id = {$_COOKIE['lang_id']} AND catalog_id='{$categoryType}' AND type_prop='standard' AND hide='show' AND is_show_form=1 $query", "ORDER BY im_prop_style_id ASC" );
		$ImPropListSt->select_table ( "im_prop_id" );
		$PrintPropFormSt = new ImPropAdvaced ( $ImPropListSt, $this->dictionaries, $this->routingObj->getParam (), NULL, false, "SearchFormAdvased", "FormSearchInputText", getLangString ( 'FormSearchFirldNoValue' ) );
		$PrintPropFormSt->ImPropListPrintField ();
		$SearchListPropCat = $PrintPropFormSt->Form;
		$this->PrintPropFormSt = $PrintPropFormSt;
		
		#выборка характеристик недвижимости	
		$ImPropListAd = new mysql_select ( "im_properties_list", "WHERE lang_id = {$_COOKIE['lang_id']} AND catalog_id='{$categoryType}' AND type_prop='advanced' AND hide='show' AND is_show_form=1 {$query}", "ORDER BY im_prop_style_id ASC" );
		$ImPropListAd->select_table ( "im_prop_id" );
		$PrintPropFormAd = new ImPropAdvaced ( $ImPropListAd, $this->dictionaries, $this->routingObj->getParam (), NULL, false, "SearchFormAdvased", "FormSearchInputText", getLangString ( 'FormSearchFirldNoValue' ) );
		$PrintPropFormAd->ImPropListPrintField ();
		$this->PrintPropFormAd = $PrintPropFormAd;
		
		#выборка характеристик недвижимости		
		$ImPropList = new mysql_select ( "im_properties_list", "WHERE lang_id = {$_COOKIE['lang_id']} AND catalog_id='{$categoryType}' AND hide='show'", "ORDER BY im_prop_style_id ASC" );
		$ImPropList->select_table ( "im_prop_id" );
		$PrintPropForm = new ImPropAdvaced ( $ImPropList, $this->dictionaries, $this->routingObj->getParam (), NULL, false, "SearchFormAdvased", "FormSearchInputText", getLangString ( 'FormSearchFirldNoValue' ) );
		$PrintPropForm->ImPropListPrintField ();
		$this->PrintPropForm = $PrintPropForm;
	}
}