<?php
class immovablesModelClass extends modelClass {
	/* for im. item */
	public $imagesList;
	public $imagesPlanList;
	public $videoList;
	public $summary;
	public $lastData;
	public $realtor;
	public $propertiesList;
	public $propertiesListBuild;
	public $propertiesOnlyList;
	public $propertiesOnlyListBuild;
	public $propertiesData;
	public $mayby;
	public $maybymatrix;
	public $maybyiteration;
	public $maybyList;
	public function __construct($provider) {
		parent::__construct ( $provider );
		$this->mayby = false;
		$this->maybyiteration = 0;
		global $maybymatrix; // app/models/immovables/settings
		$this->maybymatrix = $maybymatrix;
	}
	public function getList($param) {
		$res = $this->provider->getList ( $param );
		$this->list = $res ["resTable"];
		$this->listData = $res ["resTableBuild"];
	}
	public function getListHotPrice($param) {
		$res = $this->provider->getListHotPrice ( $param );
		$this->list = $res ["resTable"];
		$this->listData = $res ["resTableBuild"];
	}
	public function getListPager($param, $page_id, $pagerlink, $limit = null) {
		$this->buildDictionaries ();
		$this->provider->setValue ( "id", "im_id" );
		$this->provider->setValue ( "orderby", $_COOKIE ['im_where_sort'] );
		$this->provider->setValue ( "pagerlink", $pagerlink );
		$this->provider->setValue ( "limit", ($limit ? $limit : $_COOKIE ['im_f_show_pnumber']) );
		$this->provider->setValue ( "pagerparamafter", $this->getRequestStringForPager ( $param ) );
		$this->provider->setValue ( "ordersort", $_COOKIE ['im_where_sort_order'] );
		$propParam = array (
				"hide" => "show",
				"im_catalog_id" => $param ["im_catalog_id"] 
		);
		if (isset ( $param ["is_prop_rent"] ))
			$propParam ["is_prop_rent"] = true;
		if (isset ( $param ["is_prop_sale"] ))
			$propParam ["is_prop_sale"] = true;
		$this->getPropertiesOnlyList ( $propParam );
		
		$query = "";
		if (isset ( $param ["action"] ))
			$query = $this->buildSearchQuery ( $param );
		
		$this->provider->getListPager ( $param, $page_id, $query );
		$this->list = $this->provider->list;
		$this->pager = $this->provider->pager;
		
		if ($this->list) {
			$param ["im_ids"] = $this->buildImmovablesIdForPropertiesQuery ();
			$this->getPropertiesList ( $param );
			unset ( $param ["im_ids"] );
			$this->buildPropertiesData ();
		}
	}
	public function buildSearchQuery($param) {
		// ласс обработчик заполнених полей формы поиска
		$SQForm = new ImSiteForm ( $this->routingObj->getParam (), 'ImFormSearchArray', 'SearchImCode', $this->dictionaries, $this->propertiesOnlyListBuild );
		$query = $this->provider->buildStandartImmovablesQuery ( $param );
		$SQForm->StandartImQuery = $query;
		$query .= $SQForm->PostGetParser ( $param );
		return $query;
	}
	public function getPropertiesList($param) {
		$res = $this->provider->getPropertiesList ( $param );
		$this->propertiesList = $res ["list"];
		$this->propertiesListBuild = $res ["listBuild"];
	}
	public function getPropertiesOnlyList($param) {
		$res = $this->provider->getPropertiesOnlyList ( $param );
		$this->propertiesList = $res ["list"];
		$this->propertiesListBuild = $res ["listBuild"];
	}
	public function buildImmovablesIdForPropertiesQuery() {
		$ret = "";
		if ($this->list) {
			foreach ( $this->list as $key => $value ) {
				if (! empty ( $value ))
					$ret .= sprintf ( "'%s',", $value ["im_id"] );
			}
			$ret = substr ( $ret, 0, strlen ( $ret ) - 1 );
		}
		return $ret;
	}
	public function buildPropertiesData() {
		$this->propertiesData = new PropSort ( $this->propertiesList );
		$this->propertiesData->GetArrToPrint ( 'im_id', array (
				'is_print_list',
				'is_print_ad',
				'is_print_st' 
		) );
	}
	public function getImmovablesListToYmap() {
		if ($this->list) {
			$this->buildDictionaries ();
			require_once DOC_ROOT . '/app/models/immovables/oldymap/moduletemplateymap.php';
			require_once DOC_ROOT . '/app/models/immovables/oldymap/settings.php';
			// $param["im_ids"] = $model->buildImmovablesIdForPropertiesQuery();
			// devLogs::_printr($param);
			// $model->getPropertiesList ( $param );
			// $model->buildPropertiesData();
			foreach ( $this->list as $key => $value ) {
				$this->getItemProperties ( $value ["im_id"] );
				$this->buildPropertiesData ();
				$ModImPropObj = new ModuleSiteIm ( $ModuleTemplate, $arWords, $this->dictionaries, $this->propertiesData->ImPropData, $this->propertiesData->ImPropArrData );
				if ($value ['im_is_sale'])
					$this->list [$key] ["tempSale"] = $ModImPropObj->BuildHTML ( $value, $ModuleTemplate ['ymaps'] [$value ['im_catalog_id']] ['sale'], $TemplateImList [$value ['im_catalog_id']] ['sale'] );
				if ($value ['im_is_rent'])
					$this->list [$key] ["tempRent"] = $ModImPropObj->BuildHTML ( $value, $ModuleTemplate ['ymaps'] [$value ['im_catalog_id']] ['rent'], $TemplateImList [$value ['im_catalog_id']] ['rent'] );
				$this->list [$key] ["im_city_name"] = $this->dictionaries->getDictValue ( $value, "im_city_id" );
				$this->list [$key] ["im_area_name"] = $this->dictionaries->getDictValue ( $value, "im_area_id" );
				$this->list [$key] ["im_adress_name"] = $this->dictionaries->getDictValue ( $value, "im_adress_id" );
				
				if ($value ['im_catalog_id'] == "4c3ec3ec5e9b5") {
					$this->list [$key] ["im_room"] = $this->propertiesData->ImPropArrData [$value ['im_id']] ['4c400ed4e5797'] ['im_prop_value'];
					/* поиск по квартирам */
					$im_roomb = $this->routingObj->getParamItem ( "im_roomb" );
					$im_roome = $this->routingObj->getParamItem ( "im_roome" );
					if (! empty ( $im_roomb ))
						if ($this->list [$key] ["im_room"] < $im_roomb)
							unset ( $this->list [$key] );
					if (! empty ( $im_roome ))
						if ($this->list [$key] ["im_room"] > $im_roome)
							unset ( $this->list [$key] );
				}
			}
		}
	}
	public function buildImmovablesCodeForStingToStringQuery($ids) {
		$ret = "('0')";
		if (! empty ( $ids )) {
			$ret = "";
			$ids = explode ( ",", $ids );
			foreach ( $ids as $key => $value ) {
				if (! empty ( $value ))
					$ret .= sprintf ( "'%s',", translit ( $value ) );
			}
			return sprintf ( "(%s)", substr ( $ret, 0, strlen ( $ret ) - 1 ) );
		}
		return "('0')";
	}
	/* details */
	public function getItem($id) {
		$this->item = $this->provider->getItem ( $id );
	}
	public function getItemByCode($code) {
		$this->item = $this->provider->getItemByCode ( $code );
	}
	public function getItemProperties($id) {
		$serRes = $this->provider->getPropertiesList ( array (
				"im_id" => $id 
		) );
		$this->propertiesList = $serRes ["list"];
		$this->propertiesListBuild = $serRes ["listBuild"];
		$this->buildPropertiesData ();
	}
	public function getItemPlan($id) {
		$this->imagesPlanList = $this->provider->getImagesList ( $id, "4c5a97cea179d" );
	}
	public function getRealtor($id) {
		if (! $id)
			return;
		$SusrIDCl = new mysql_select ( "system_accounts" );
		$this->realtor = $SusrIDCl->select_table_id ( "WHERE id_account	= $id" );
	}
	public function getItemVideo($id) {
		$this->videoList = $this->provider->getVideo ( $id );
	}
	public function getItemSummary($id) {
		$this->summary = $this->provider->getItemSummary ( $id );
	}
	public function getItemImages($id) {
		$this->imagesList = $this->provider->getImagesList ( $id, "4c5a97c04ffa1" );
	}
	private function getRequestStringForPager($param) {
		$res = $this->routingObj->getParamInString ();
		return (! empty ( $res ) ? "?" . $res : "");
	}
	public function getImmovablesTitle() {
		$ret = sprintf ( "%s - %s, %s, %s %s, %s %s, %s y.e", getLangString ( $this->item ["im_catalog_id"] . "_item" ), $this->item ["im_code"], $this->dictionaries->getDictValue ( $this->item, "im_city_id" ), $this->dictionaries->getDictValue ( $this->item, "im_adress_id" ), $this->item ["im_adress_house"], $this->item ["im_space"], $this->dictionaries->getDictValue ( $this->item, "im_space_value_id" ), ($this->routingObj->getAction () == "detailssale") ? $this->item ["im_prace"] : $this->item ["im_prace_manth"] );
		return $ret;
	}
	public function getitemlink($item = "") {
		if (empty ( $item ))
			$item = $this->item;
		global $arWords;
		return sprintf ( "ru/%s/%s/1/%s", $arWords ["TypeCatImNameArrIdPAge"] [$item ["im_catalog_id"]], ($item ["im_is_sale"] ? "sale" : "rent"), $item ["im_id"] );
	}
	public function getMayByList($param, $page_id, $pagerlink) {
		if ($this->maybyiteration == count ( $this->maybymatrix ))
			return;
		$paramformayby = $this->routingObj->getParam ();
		if (isset ( $this->maybymatrix [$this->maybyiteration] )) {
			foreach ( $this->maybymatrix [$this->maybyiteration] as $key => $value ) {
				$paramformayby = $this->$value ( $paramformayby );
			}
		}
		$this->getListPager ( $paramformayby, $page_id, $pagerlink, 20 );
		if (! $this->list) {
			$this->maybyiteration ++;
			$this->getMayByList ( $param, $page_id, $pagerlink );
		}
		return;
	}
	private function maybyDeleteParamFieldsCheckbox($param) {
		$ret = array ();
		foreach ( $param as $key => $value ) {
		}
		return $param;
	}
	private function maybyDeleteParamFieldsMyltiCheckbox($param) {
		$ret = array ();
		foreach ( $param as $key => $value ) {
			$pos = strpos ( $key, "m_" );
			if ($pos !== 0)
				$ret [$key] = $value;
		}
		return $ret;
	}
	private function maybyDeleteParamFieldsIm($param) {
		$ret = array ();
		foreach ( $param as $key => $value ) {
			$pos = strpos ( $key, "im_" );
			if ($pos !== 0)
				$ret [$key] = $value;
		}
		return $ret;
	}
	private function maybyDeleteParamFieldsSlider($param) {
		$ret = array ();
		foreach ( $param as $key => $value ) {
			$pos = strpos ( $key, "b_" );
			if ($pos !== 0)
				$ret [$key] = $value;
		}
		return $ret;
	}
	private function maybyDeleteParamFieldsTerritory($param) {
		return $param;
	}
}