<?php
class immovablesController extends aControllerClass {
	public function index($param) {
		$this->redirect ( "ru/flat/sale" );
		exit ();
	}
	public function partialAdvancedSearchForm($param) {
		$model = new immovablesSearchModelClass ( new immovablesProviderClass ( "immovables" ) );
		$model->buildDictionaries ();
		$model->buildAdvasedSearchForm ( $param );
		global $arWords;
		global $routingObj;
		$model->buildImmovablesProperties ( $arWords["typeCatImDictOfController"][$routingObj->getController ()] );
		return $this->partialView ( array(
				"Model" => $model), "/immovables/advancedsearchform" );
	}
	public function partialList($param) {
		$param = 1;
		return $this->partialView ( array(), "/immovables/hotlist" );
	}
	public function partialListLink($param) {
		$this->buildDictionaries ();
		$this->provider->mysql = new mysql_select ( "im_links", "WHERE lang_id = {$_COOKIE['lang_id']} ORDER BY RAND(40)" );
		$this->provider->mysql->select_table ( "il_id" );
		return $this->partialView ( array(
				"Data" => $this->provider->mysql->table,
				"Dict" => $this->dictionaries), "/immovables/linklist" );
	}
	public function partialListHot($param) {
		$this->buildDictionaries ();
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables", "im_id" ) );
		$Data = array();
		$categotyImmovables = array(
				"4c3ec3ec5e9b5",
				"4c3ec3ec5e9b7",
				"4c3ec51d537c0",
				"4c3ec51d537c2",
				"4c3ec51d537c3");
		foreach ( $categotyImmovables as $key => $value ) {
			$model->getListHotPrice ( array(
					"is_hot" => true,
					"hide" => "show",
					"im_catalog_id" => $value,
					"limit" => 10) );
			if ($model->list)
				$Data = array_merge ( $Data, $model->list );
		}
		return $this->partialView ( array(
				"Data" => $Data,
				"Dictionaries" => $this->dictionaries,
				"title" => getLangString ( "ImDivListHeaderHot" ),
				"cssClass" => "links_block"), "/immovables/minpricelist" );
	}
	public function partialListMinPrice($param) {
		$this->buildDictionaries ();
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables", "im_id" ) );
		$Data = array();
		$categotyImmovables = array(
				"4c3ec3ec5e9b5",
				"4c3ec3ec5e9b7",
				"4c3ec51d537c0",
				"4c3ec51d537c2",
				"4c3ec51d537c3");
		foreach ( $categotyImmovables as $key => $value ) {
			$model->getListHotPrice ( array(
					"is_hot" => true,
					"hide" => "show",
					"im_catalog_id" => $value,
					"limit" => 15) );
			if ($model->list)
				$Data = array_merge ( $Data, $model->list );
		}
		return $this->partialView ( array(
				"Data" => $Data,
				"Dictionaries" => $this->dictionaries,
				"title" => getLangString ( "ImDivListHeaderPrice" ),
				"cssClass" => "minprice"), "/immovables/minpricelist" );
	}
	public function search($param) {
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		if (! strpos ( $param["id"], "," )) {
			$model->getItemByCode ( strtoupper ( translit ( $param["id"] ) ) );
			if ($model->item) {
				$this->redirect ( $model->getitemlink () );
				exit ();
			}
		}
		$param["im_codes"] = $model->buildImmovablesCodeForStingToStringQuery ( strtoupper ( $param["id"] ) );
		$param["hide"] = "show";
		$model->getList ( $param );
		$model->buildDictionaries ();
		$paramAll["im_ids"] = $model->buildImmovablesIdForPropertiesQuery ();
		$model->getPropertiesList ( $paramAll );
		$model->buildPropertiesData ();
		return $this->View ( array(
				"Model" => $model) );
	}
	public function similarList($param) {
		$this->buildDictionaries ();
		$param["hide"] = "show";
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables", "im_id" ) );
		$model->buildDictionaries ();
		return $this->partialView ( array(
				"Model" => $model) );
	}
	public function getImmovablesListYmap($param) {
		set_time_limit ( 10000 );
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables", "im_id" ) );
		$param["hide"] = "show";
		$param["limit"] = "100";
		$model->getList ( $param );
		$model->getImmovablesListToYmap ();
		return $this->getJson ( $model->list );
	}
	/* details */
	public function detailsbycode($param) {
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		$model->getItemByCode ( strtoupper ( translit ( $param["im_code"] ) ) );
		if (! $model->item) {
			$this->redirect ( "ru/immovables/search?im_code=" . $param["im_code"] );
			exit ();
		}
		$this->routingObj->setParamItem ( "type_cat", ($model->item["im_is_sale"] ? "sale" : "rent") );
		$this->routingObj->setParamItem ( "im_id", $model->item["im_id"] );
		$model->buildDictionaries ();
		$model->getItemProperties ( $model->item["im_id"] );
		$this->buildImmovablesAppData ( $model );
		return $this->View ( array(
				"Model" => $model), sprintf ( "immovables/details%s", $this->routingObj->getParamItem ( "type_cat" ) ) );
	}
	public function detailsrent($param) {
		$this->routingObj->setParamItem ( "type_cat", "rent" );
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		$model->getItem ( $param["im_id"] );
		if (! $model->item)
			$this->redirectToErrorPage ();
		$this->buildmetahmlforsocial ( $model->item );
		$model->buildDictionaries ();
		$model->getItemProperties ( $param["im_id"] );
		$this->buildImmovablesAppData ( $model );
		return $this->View ( array(
				"Model" => $model) );
	}
	public function detailssale($param) {
		$this->routingObj->setParamItem ( "type_cat", "sale" );
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		$model->getItem ( $param["im_id"] );
		if (! $model->item)
			$this->redirectToErrorPage ();
		$this->buildmetahmlforsocial ( $model->item );
		$model->buildDictionaries ();
		$model->getItemProperties ( $param["im_id"] );
		$this->buildImmovablesAppData ( $model );
		return $this->View ( array(
				"Model" => $model) );
	}
	private function buildmetahmlforsocial($model) {
		if (! empty ( $value )) {
			global $arWords;
			$this->appDataObj->social["fb"]->url = $model->getitemlink ();
			$this->appDataObj->social["fb"]->image = sprintf ( "%s/files/images/immovables/si_%s", getLangString ( "imageDomain" ), $model->item["im_photo"] );
		}
	}
	public function partailImages($param) {
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		$model->getItemImages ( $param["im_id"] );
		return $this->partialView ( array(
				"Model" => $model), "/immovables/details/images" );
	}
	public function partailPlan($param) {
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		$model->getItemPlan ( $param["im_id"] );
		return $this->partialView ( array(
				"Model" => $model), "/immovables/details/plan" );
	}
	public function partailVideo($param) {
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		$model->getItemVideo ( $param["im_id"] );
		return $this->partialView ( array(
				"Model" => $model), "/immovables/details/video" );
	}
	public function partailSummary($param) {
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		$model->getItemSummary ( $param["im_id"] );
		return $this->partialView ( array(
				"Model" => $model), "/immovables/details/summary" );
	}
	private function buildImmovablesAppData($model) {
		$this->appDataObj->setTitle ( $model->getImmovablesTitle () );
		$this->appDataObj->setKeyw ( $this->appDataObj->getTitle () );
		$this->appDataObj->setDesc ( $this->appDataObj->getTitle () . ". " . $model->item["im_title"] );
		return;
	}
	public function setCookie($param) {
		$response['success'] = false;
		if (! empty ( $param["key"] ) && ! empty ( $param["value"] )) {
			setcookie ( $param["key"], $param["value"], 0, '/' );
			$response['success'] = true;
		}
		return $this->getJson ( $response );
	}
	public function setSortTable($param) {
		$response['success'] = false;
		if (empty ( $param["value"] )) {
			setcookie ( 'im_where_sort', $param["value"], 0, '/' );
			$im_where_sort = ($_COOKIE['im_where_sort_order'] == "" ? "desc" : ($_COOKIE['im_where_sort_order'] == "desc" ? "asc" : "desc"));
			setcookie ( 'im_where_sort_order', $im_where_sort, 0, '/' );
			$response['success'] = true;
		}
		return $this->getJson ( $response );
	}
	
	/* сравнение обьектов comparing */
	public function sravnenie($param) {
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		if (! empty ( $_COOKIE["comparing"] )) {
			$imidsarray = json_decode ( $_COOKIE["comparing"], true );
			$im_ids = "(";
			foreach ( $imidsarray as $key => $value )
				$im_ids .= sprintf ( "'%s',", $key );
			$im_ids = sprintf ( "%s)", substr ( $im_ids, 0, strlen ( $im_ids ) - 1 ) );
			$model->getList ( array(
					"hide" => "show",
					"im_ids" => $im_ids) );
			$model->getPropertiesList ( array(
					"im_ids" => substr ( $im_ids, 1, strlen ( $im_ids ) - 2 )) );
			$model->buildPropertiesData ();
			$model->getPropertiesOnlyGroupList ( null );
		}
		return $this->View ( array(
				"Model" => $model), "immovables/comparing/index" );
	}
	public function comparinglist($param) {
		$ret = array(
				"success" => true,
				"comparing" => null,
				"count" => 0);
		if (! empty ( $_COOKIE["comparing"] )) {
			$ret["comparing"] = $_COOKIE["comparing"];
			$ret["count"] = count ( json_decode ( $_COOKIE["comparing"], true ) );
		}
		return $this->getJson ( $ret );
	}
	public function comparingadditem($param) {
		$ret = array(
				"success" => true);
		if (empty ( $param["im_id"] )) {
			$ret["error"] = "noissetimid";
			$ret["success"] = false;
			return $this->getJson ( $ret );
		}
		$jsonComparing = $_COOKIE["comparing"];
		if (! empty ( $jsonComparing )) {
			$jsonObj = json_decode ( $jsonComparing, true );
			if (! isset ( $jsonObj[$param["im_id"]] )) {
				$jsonObj[$param["im_id"]] = $param["im_id"];
			}
		} else {
			$jsonObj[$param["im_id"]] = $param["im_id"];
		}
		$ret["comparing"] = $jsonObj;
		$jsonComparing = ($jsonObj ? json_encode ( $jsonObj ) : null);
		setcookie ( 'comparing', $jsonComparing, 0, '/' );
		$_COOKIE["comparing"] = $jsonComparing;
		return $this->getJson ( $ret );
	}
	public function comparingremoveitem($param) {
		$ret = array(
				"success" => true);
		if (empty ( $param["im_id"] )) {
			$ret["error"] = "noissetimid";
			$ret["success"] = false;
			return $this->getJson ( $ret );
		}
		$jsonComparing = $_COOKIE["comparing"];
		$jsonObj = "";
		if (! empty ( $jsonComparing )) {
			$jsonObj = json_decode ( $jsonComparing, true );
			if (isset ( $jsonObj[$param["im_id"]] )) {
				unset ( $jsonObj[$param["im_id"]] );
			} else
				$ret["error"] = "noissetitem";
		}
		$ret["comparing"] = $jsonObj;
		$jsonComparing = ($jsonObj ? json_encode ( $jsonObj ) : null);
		setcookie ( 'comparing', $jsonComparing, 0, '/' );
		$_COOKIE["comparing"] = $jsonComparing;
		return $this->getJson ( $ret );
	}
	public function comparingsetsorted($param) {
		if (! empty ( $param["list"] )) {
			$l = explode ( ",", $param["list"] );
			unset ( $l[count ( $l ) - 1] );
			foreach ( $l as $key => $value )
				$ret["comparing"][$value] = $value;
			$jsonComparing = ($ret["comparing"] ? json_encode ( $ret["comparing"] ) : null);
			setcookie ( 'comparing', $jsonComparing, 0, '/' );
			$_COOKIE["comparing"] = $jsonComparing;
		}
		return $this->getJson ( $ret );
	}
	/* сравнение обьектов comparing */
	
	/**
	 * новые обьекты
	 *
	 * @param unknown $param        	
	 * @return string
	 */
	public function novue($param) {
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		$param["hide"] = "show";
		$param["limit"] = ($param["limit"] ? $param["limit"] : "10");
		$model->getList ( $param );
		if ($model->list) {
			$model->buildDictionaries ();
			$param["im_ids"] = $model->buildImmovablesIdForPropertiesQuery ();
			$model->getPropertiesList ( $param );
			unset ( $param["im_ids"] );
			$model->buildPropertiesData ();
		}
		return $this->View ( array(
				"Model" => $model), "immovables/new/list" );
	}
	public function partialNovue($param) {
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		return $this->partialView ( array(
				"Model" => $model), "/immovables/new/minlist" );
	}
	/**
	 * предварительное найденное количество объектов недвижимости
	 *
	 * @param unknown $param        	
	 */
	public function precountfound($param) {
		$param["hide"] = "show";
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables", "im_id" ) );
		$model->getListPager ( $param, 1, "" );
		return $this->getJson ( array(
				"count" => $model->provider->pager->total) );
	}
}