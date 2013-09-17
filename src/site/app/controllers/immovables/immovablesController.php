<?php
class immovablesController extends aControllerClass {
	public function index($param) {
		header ( "HTTP/1.1 301 Moved Permanently" );
		header ( "Location: http://" . $_SERVER ['HTTP_HOST'] . "/ru/flat/sale" );
		exit ();
	}
	public function partialAdvancedSearchForm($param) {
		$model = new immovablesSearchModelClass ( new immovablesProviderClass ( "immovables" ) );
		$model->buildDictionaries ();
		$model->buildAdvasedSearchForm ( $param );
		global $arWords;
		global $routingObj;
		$model->buildImmovablesProperties ( $arWords ["typeCatImDictOfController"] [$routingObj->getController ()] );
		return $this->partialView ( array ("Model" => $model ), "/immovables/advancedsearchform" );
	}
	public function partialList($param) {
		$param = 1;
		return $this->partialView ( array (), "/immovables/hotlist" );
	}
	public function partialListLink($param) {
		$this->buildDictionaries ();
		$this->provider->mysql = new mysql_select ( "im_links", "WHERE lang_id = {$_COOKIE['lang_id']} ORDER BY RAND(40)" );
		$this->provider->mysql->select_table ( "il_id" );
		return $this->partialView ( array ("Data" => $this->provider->mysql->table, "Dict" => $this->dictionaries ), "/immovables/linklist" );
	}
	public function partialListHot($param) {
		$this->buildDictionaries ();
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables", "im_id" ) );
		$Data = array ();
		$model->getListHotPrice ( array ("is_hot" => true, "hide" => "show", "im_catalog_id" => "4c3ec3ec5e9b5", "limit" => 10 ) );
		if ($model->list)
			$Data = array_merge ( $Data, $model->list );
		$model->getListHotPrice ( array ("is_hot" => true, "hide" => "show", "im_catalog_id" => "4c3ec3ec5e9b7", "limit" => 10 ) );
		if ($model->list)
			$Data = array_merge ( $Data, $model->list );
		$model->getListHotPrice ( array ("is_hot" => true, "hide" => "show", "im_catalog_id" => "4c3ec51d537c0", "limit" => 10 ) );
		if ($model->list)
			$Data = array_merge ( $Data, $model->list );
		$model->getListHotPrice ( array ("is_hot" => true, "hide" => "show", "im_catalog_id" => "4c3ec51d537c2", "limit" => 10 ) );
		if ($model->list)
			$Data = array_merge ( $Data, $model->list );
		$model->getListHotPrice ( array ("is_hot" => true, "hide" => "show", "im_catalog_id" => "4c3ec51d537c3", "limit" => 10 ) );
		if ($model->list)
			$Data = array_merge ( $Data, $model->list );
		return $this->partialView ( array ("Data" => $Data, "Dictionaries" => $this->dictionaries, "title" => getLangString ( "ImDivListHeaderHot" ), "cssClass" => "links_block" ), "/immovables/minpricelist" );
	}
	public function partialListMinPrice($param) {
		$this->buildDictionaries ();
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables", "im_id" ) );
		$Data = array ();
		$model->getListHotPrice ( array ("im_catalog_id" => "4c3ec3ec5e9b5", "limit" => 15, "hide" => "show" ) );
		if ($model->list)
			$Data = array_merge ( $Data, $model->list );
		$model->getListHotPrice ( array ("im_catalog_id" => "4c3ec3ec5e9b7", "limit" => 15, "hide" => "show" ) );
		if ($model->list)
			$Data = array_merge ( $Data, $model->list );
		$model->getListHotPrice ( array ("im_catalog_id" => "4c3ec51d537c0", "limit" => 15, "hide" => "show" ) );
		if ($model->list)
			$Data = array_merge ( $Data, $model->list );
		$model->getListHotPrice ( array ("im_catalog_id" => "4c3ec51d537c2", "limit" => 15, "hide" => "show" ) );
		if ($model->list)
			$Data = array_merge ( $Data, $model->list );
		$model->getListHotPrice ( array ("im_catalog_id" => "4c3ec51d537c3", "limit" => 15, "hide" => "show" ) );
		if ($model->list)
			$Data = array_merge ( $Data, $model->list );
		return $this->partialView ( array ("Data" => $Data, "Dictionaries" => $this->dictionaries, "title" => getLangString ( "ImDivListHeaderPrice" ), "cssClass" => "minprice" ), "/immovables/minpricelist" );
	}
	public function search($param) {
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		if (! strpos ( $param ["id"], "," )) {
			$model->getItemByCode ( strtoupper ( translit ( $param ["id"] ) ) );
			if ($model->item) {
				global $arWords;
				header ( "HTTP/1.1 301 Moved Permanently" );
				header ( sprintf ( "Location: http://%s/ru/%s/%s/1/%s", $_SERVER ['HTTP_HOST'], $arWords ["TypeCatImNameArrIdPAge"] [$model->item ["im_catalog_id"]], ($model->item ["im_is_sale"] ? "sale" : "rent"), $model->item ["im_id"] ) );
				exit ();
			}
		}
		$param ["im_codes"] = $model->buildImmovablesCodeForStingToStringQuery ( strtoupper ( $param ["id"] ) );
		$param ["hide"] = "show";
		$model->getList ( $param );
		$model->buildDictionaries ();
		$paramAll ["im_ids"] = $model->buildImmovablesIdForPropertiesQuery ();
		$model->getPropertiesList ( $paramAll );
		$model->buildPropertiesData ();
		return $this->View ( array ("Model" => $model ) );
	}
	public function similarList($param) {
		$this->buildDictionaries ();
		$param ["hide"] = "show";
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables", "im_id" ) );
		$model->buildDictionaries ();
		return $this->partialView ( array ("Model" => $model ) );
	}
	public function getImmovablesListYmap($param) {
		set_time_limit ( 10000 );
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables", "im_id" ) );
		$param ["hide"] = "show";
		$param ["limit"] = "100";
		$model->getList ( $param );
		$model->getImmovablesListToYmap ();
		return $this->getJson ( $model->list );
	}
	/*	details	*/
	public function detailsbycode($param) {
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		$model->getItemByCode ( strtoupper ( translit ( $param ["im_code"] ) ) );
		if (! $model->item) {
			header ( "HTTP/1.1 301 Moved Permanently" );
			header ( "Location: http://" . $_SERVER ['HTTP_HOST'] . "/ru/immovables/search?im_code=" . $param ["im_code"] );
			exit ();
		}
		$this->routingObj->setParamItem ( "type_cat", ($model->item ["im_is_sale"] ? "sale" : "rent") );
		$this->routingObj->setParamItem ( "im_id", $model->item ["im_id"] );
		$model->buildDictionaries ();
		$model->getItemProperties ( $model->item ["im_id"] );
		$this->buildImmovablesAppData ( $model );
		return $this->View ( array ("Model" => $model ), sprintf ( "immovables/details%s", $this->routingObj->getParamItem ( "type_cat" ) ) );
	}
	public function detailsrent($param) {
		$this->routingObj->setParamItem ( "type_cat", "rent" );
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		$model->getItem ( $param ["im_id"] );
		if (! $model->item)
			$this->redirectToErrorPage ();
		$model->buildDictionaries ();
		$model->getItemProperties ( $param ["im_id"] );
		$this->buildImmovablesAppData ( $model );
		return $this->View ( array ("Model" => $model ) );
	}
	public function detailssale($param) {
		$this->routingObj->setParamItem ( "type_cat", "sale" );
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		$model->getItem ( $param ["im_id"] );
		if (! $model->item)
			$this->redirectToErrorPage ();
		$model->buildDictionaries ();
		$model->getItemProperties ( $param ["im_id"] );
		$this->buildImmovablesAppData ( $model );
		return $this->View ( array ("Model" => $model ) );
	}
	public function partailImages($param) {
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		$model->getItemImages ( $param ["im_id"] );
		return $this->partialView ( array ("Model" => $model ), "/immovables/details/images" );
	}
	public function partailPlan($param) {
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		$model->getItemPlan ( $param ["im_id"] );
		return $this->partialView ( array ("Model" => $model ), "/immovables/details/plan" );
	}
	public function partailVideo($param) {
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		$model->getItemVideo ( $param ["im_id"] );
		return $this->partialView ( array ("Model" => $model ), "/immovables/details/video" );
	}
	public function partailSummary($param) {
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		$model->getItemSummary ( $param ["im_id"] );
		return $this->partialView ( array ("Model" => $model ), "/immovables/details/summary" );
	}
	public function setCookie($param) {
		$response ['success'] = false;
		if (! empty ( $param ["key"] ) && ! empty ( $param ["value"] )) {
			setcookie ( $param ["key"], $param ["value"], 0, '/' );
			$response ['success'] = true;
		}
		return $this->getJson ( $response );
	}
	public function setSortTable($param) {
		$response ['success'] = false;
		if (empty ( $param ["value"] )) {
			setcookie ( 'im_where_sort', $param ["value"], 0, '/' );
			$im_where_sort = ($_COOKIE ['im_where_sort_order'] == "" ? "desc" : ($_COOKIE ['im_where_sort_order'] == "desc" ? "asc" : "desc"));
			setcookie ( 'im_where_sort_order', $im_where_sort, 0, '/' );
			$response ['success'] = true;
		}
		return $this->getJson ( $response );
	}
	private function buildImmovablesAppData($model) {
		$this->appDataObj->setTitle ( $model->getImmovablesTitle () );
		$this->appDataObj->setKeyw ( $this->appDataObj->getTitle () );
		$this->appDataObj->setDesc ( $this->appDataObj->getTitle () . ". " . $model->item ["im_title"] );
		return;
	}
	/*	сравнение обьектов comparing	*/
	public function sravnenie($param) {
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		return $this->View ( array ("Model" => $model ), "immovables/comparing" );
	}
	public function comparingadditem($param) {
		return $this->getJson ( $param );
	}
	public function comparingremoveitem($param) {
		return $this->getJson ( $param );
	}
	/*	сравнение обьектов comparing	*/
	/*	yndex	*/
	public function poisk($param) {
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		return $this->View ( array ("Model" => $model ), "immovables/poisk" );
	}
	public function karta($param) {
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		return $this->View ( array ("Model" => $model ), "immovables/karta" );
	}
	/*	yndex	*/
}