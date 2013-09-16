<?php
class appClass {
	private $routingObj;
	private $controllerDataObj = null;
	private $appResult;
	
	private $activePage;
	private $cacheObj;
	private $isCasheApp;
	private $appDataObj;
	
	public function __construct() {
	}
	
	public function init() {
		global $routingObj;
		global $exchangeRateObj;
		global $controllerDataObj;
		$this->isCasheApp = false;
		new securityClass ( );
		$this->routingObj = new routingClass ( );
		$routingObj = $this->routingObj;
		$this->cacheObj = new cacheClass ( );
		$this->appDataObj = new appDataClass ( );
		$exchangeRateObj = new exchangeRateClass ( );
	}
	
	public function buildControllerData() {
		try {
			$controller = $this->routingObj->getControllerFull ();
			$action = $this->routingObj->getAction ();
			$param = $this->routingObj->getParam ();
			$this->getActivePage ();
			$this->checkIsCasheApp ();
			$this->buildCashApp ( "start" );
			if (empty ( $this->appResult ))
				$this->formatControllerObject ( $controller, $action, $param );
		} catch ( Exception $ex ) {
			throw new ExceptionObject ( $ex, "Ошибка обращения к контроллеру" );
		}
	}
	
	public function getActivePage() {
		$structureModelObj = new structureModelClass ( new structureProviderClass ( "pages" ) );
		$structureModelObj->getItem ( $this->routingObj->getController (), $this->routingObj->getAction () );
		if ($structureModelObj->item) {
			$this->activePage = $structureModelObj->item;
			$this->appDataObj = new appDataClass ( $this->activePage );
		}
	}
	
	private function checkIsCasheApp() {
		if (empty ( $this->activePage )) {
			$getParam = $this->routingObj->getParam ();
			if (isset ( $getParam ["cashe"] )) {
				$this->isCasheApp = true;
			}
		} else {
			$this->isCasheApp = $this->activePage ["is_cashe"];
		}
		$this->isCasheApp = false;
	}
	
	private function buildCashApp($action = "start") {
		if (! $this->isCasheApp)
			return;
		if ($action == 'start') {
			$this->cacheObj->checking_inclusion ();
			$this->appResult = $this->cacheObj->checking_existence ();
		}
		if ($action == 'end') {
			$this->cacheObj->creation_page ();
		}
		return;
	}
	
	public function formatControllerObject($controller, $action, $param) {
		try {
			$this->controllerDataObj = new $controller ( );
			$this->controllerDataObj->setResult ( $this->controllerDataObj->$action ( $param ) );
			$this->appDataObj->setTitle ( $this->controllerDataObj->appDataObj->getTitle () );
			$this->appDataObj->setKeyw ( $this->controllerDataObj->appDataObj->getKeyw () );
			$this->appDataObj->setDesc ( $this->controllerDataObj->appDataObj->getDesc () );
			//devLogs::_printr($this->controllerDataObj);
		} catch ( Exception $ex ) {
			throw new ExceptionObject ( $ex, "Ошибка обращения к контроллеру" );
		}
		//header("HTTP/1.1 301 Moved Permanently"); 
	//header("Location: http://" . $_SERVER['HTTP_HOST'] . "/404.html"); 
	//exit();
	}
	
	public function getResult() {
		global $cancellationLoyaut;
		if (empty ( $this->appResult )) {
			if ($cancellationLoyaut) {
				$this->appResult = $this->controllerDataObj->result;
				return;
			}
			if ($this->controllerDataObj->isPartial) {
				$this->appResult = $this->controllerDataObj->result;
			} else {
				$aControllerObj = new aControllerClass ( );
				$this->appResult = $aControllerObj->view ( array ("body" => $this->controllerDataObj->result, "p_w_title" => $this->appDataObj->getTitle (), "p_w_desc" => $this->appDataObj->getKeyw (), "p_w_keyw" => $this->appDataObj->getDesc () ), "/shared/" . $this->controllerDataObj->loyaut );
			}
		}
	}
	
	public function printResult() {
		echo $this->appResult;
		//кеширование (сохранение сформированной страницы)
		$this->buildCashApp ( 'end' );
		return;
	}
}