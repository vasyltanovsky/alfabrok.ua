<?php
class landController extends aControllerClass {
	public function rent($param) {
		if ($this->routingObj->getParamItem ( "im_id" ))
			return appHtmlClass::Action ( "immovables", "detailsrent", $this->routingObj->getParam () );
		$param ["im_catalog_id"] = "4c3ec51d537c3";
		$param ["im_is_rent"] = true;
		$param ["is_prop_rent"] = true;
		$param ["hide"] = "show";
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables", "im_id" ) );
		$model->getListPager ( $param, $param ["page_id"], "/ru/land/rent" );
		return $this->View ( array ("Model" => $model ) );
	}
	public function sale($param) {
		if ($this->routingObj->getParamItem ( "im_id" ))
			return appHtmlClass::Action ( "immovables", "detailssale", $this->routingObj->getParam () );
		$param ["im_catalog_id"] = "4c3ec51d537c3";
		$param ["im_is_sale"] = true;
		$param ["is_prop_sale"] = true;
		$param ["hide"] = "show";
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables", "im_id" ) );
		$model->getListPager ( $param, $param ["page_id"], "/ru/land/sale" );
		return $this->View ( array ("Model" => $model ) );
	}
	
	/* sitemap */
	public function sitemap($param) {
		$this->isPartial = true;
		if ($param["action"] == "rent" || $param["action"] == "sale") {
			$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables", "im_id" ) );
			$model->getList ( array(
					"hide" => "show",
					"im_catalog_id" => "4c3ec51d537c3",
					"im_is_sale" => ($param["action"] == "sale" ? true : false),
					"im_is_rent" => ($param["action"] == "rent" ? true : false)) );
			return $this->partialView ( array(
					"Model" => $model,
					"level" => $param["level"]), "immovables/sitemap/index" );
		}
	}
	public function sitemapxml($param) {
		$this->isPartial = true;
		if ($param["action"] == "rent" || $param["action"] == "sale") {
			$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables", "im_id" ) );
			$model->getList ( array(
					"hide" => "show",
					"im_catalog_id" => "4c3ec51d537c3",
					"im_is_sale" => ($param["action"] == "sale" ? true : false),
					"im_is_rent" => ($param["action"] == "rent" ? true : false)) );
			$array = null;
			if ($model->list) {
				foreach ( $model->list as $key => $value ) {
					$array[] = array(
							"loc" => sprintf ( "http://%s/ru/home/%s/1/%s", $_SERVER['HTTP_HOST'], $param["action"], $value["im_id"] ),
							"lastmod" => date ( "Y-m-d H:i:s" ),
							"changefreq" => "weekly",
							"priority" => $param["priority"]);
				}
			}
			return $array;
		}
	}
}