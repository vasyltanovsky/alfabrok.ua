<?php
class reportController extends aControllerClass {
	public function word($param) {
		$this->isPartial = true;
		$this->routingObj->setParamItem ( "type_cat", ($param ["type_cat"] ? $param ["type_cat"] : "sale") );
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		$model->getItem ( $param ["im_id"] );
		if (! $model->item)
			$this->redirectToErrorPage ();
		$model->buildDictionaries ();
		$model->getItemProperties ( $param ["im_id"] );
		$model->getRealtor ( $model->item ["susr_id"] );
		$model->getItemSummary ( $param ["im_id"] );
		$model->getItemImages ( $param ["im_id"] );
		
		require_once DOC_ROOT . 'class/document/rtf/Rtf.php';
		require_once DOC_ROOT . 'class/document/rtflite/PHPRtfLite.php';
		require_once DOC_ROOT . 'class/document/rtflite/PHPRtfLite/Font.php';
		require_once DOC_ROOT . 'class/document/rtflite/PHPRtfLite/Border.php';
		
		$this->View ( array ("Model" => $model ) );
		return;
	}
	public function pdf($param) {
		$this->isPartial = true;
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		$ret = $this->View ( array ("Model" => $model ) );
		return;
	}
	public function printpage($param) {
		if (empty ( $param ["im_id"] ))
			return $this->redirectToErrorPage ();
		$this->setLoyaut ( "_loyautprint" );
		$this->routingObj->setParamItem ( "type_cat", ($param ["type_cat"] ? $param ["type_cat"] : "sale") );
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		$model->getItem ( $param ["im_id"] );
		if (! $model->item)
			$this->redirectToErrorPage ();
		$model->buildDictionaries ();
		$model->getItemProperties ( $param ["im_id"] );
		$model->getRealtor ( $model->item ["susr_id"] );
		$model->getItemSummary ( $param ["im_id"] );
		$model->getItemImages ( $param ["im_id"] );
		return $this->View ( array ("Model" => $model ) );
	}
	public function sendtofriend($param) {
		$this->isPartial = true;
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		$ret = $this->View ( array ("Model" => $model ) );
		return;
	}
	
	public function getDocumentName($model) {
	}
}