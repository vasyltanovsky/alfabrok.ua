<?php
class blockController extends aControllerClass {
	public function header($param) {
		return $this->partialView ();
	}
	public function mainmenu($param) {
		$model = new structureModelClass ( new structureProviderClass ( "pages" ) );
		$model->getList ( $param );
		return $this->partialView ( array ("Data" => $model->list ), "/block/mainmenu" );
	}
}