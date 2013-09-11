<?php
class contentController extends aControllerClass {
	public function index($param) {
		return null;
	}
	public function details($param) {
		$model = new structureModelClass ( new structureProviderClass ( "pages" ) );
		$model->getItemId ( $param ["page_id"] );
		return $this->View ( array ("Data" => $model->item ) );
	}
	public function partialDetails($param) {
		$model = new structureModelClass ( new structureProviderClass ( "pages" ) );
		$model->getItemId ( $param ["page_id"] );
		return $this->partialView ( array ("Data" => $model->item ), "content/details" );
	}
}