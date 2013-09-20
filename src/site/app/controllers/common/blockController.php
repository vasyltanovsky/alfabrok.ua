<?php
class blockController extends aControllerClass {

	public function header($param) {
		return $this->partialView ();
	}

	public function mainmenu($param) {
		$model = new structureModelClass ( new structureProviderClass ( "pages_structure" ) );
		$model->getList ( $param );
		return $this->partialView ( array(
				"Data" => $model->list), "/block/mainmenu" );
	}

	public function stringnavigation($param) {
		$param["controller"] = (! empty ( $param["parent_controller"] ) ? $param["parent_controller"] : $param["controller"]);
		$param["action"] = (! empty ( $param["parent_action"] ) ? $param["parent_action"] : $param["action"]);
		if ($param["controller"] && $param["action"]) {
			if ($param["controller"] == "index" && $param["action"] == "index") {
				$this->isPartial = true;
				return null;
			}
			$model = new structureModelClass ( new structureProviderClass ( "pages_structure", "page_id" ) );
			$model->getItem ( $param["controller"], $param["action"] );
			$model->getList ( array(
					"hide" => true) );
			return $this->partialView ( array(
					"Model" => $model,
					"param" => $param) );
		}
		$this->isPartial = true;
		return null;
	}
}