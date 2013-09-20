<?php
class flatController extends aControllerClass {
	public function rent($param) {
		if ($this->routingObj->getParamItem ( "im_id" ))
			return appHtmlClass::Action ( "immovables", "detailsrent", $this->routingObj->getParam () );
		$param["im_catalog_id"] = "4c3ec3ec5e9b5";
		$param["im_is_rent"] = true;
		$param["is_prop_rent"] = true;
		$param["hide"] = "show";
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables", "im_id" ) );
		$model->getListPager ( $param, $param["page_id"], "/ru/flat/rent" );
		return $this->View ( array(
				"Model" => $model) );
	}
	public function sale($param) {
		if ($this->routingObj->getParamItem ( "im_id" ))
			return appHtmlClass::Action ( "immovables", "detailssale", $this->routingObj->getParam () );
		$param["im_catalog_id"] = "4c3ec3ec5e9b5";
		$param["im_is_sale"] = true;
		$param["is_prop_sale"] = true;
		$param["hide"] = "show";
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables", "im_id" ) );
		$model->getListPager ( $param, $param["page_id"], "/ru/flat/sale" );
		return $this->View ( array(
				"Model" => $model) );
	}
}