<?php
/**
 * Этот класс отвечает за обработку данных контроллера и выдачи результата
 * @author Alex
 *
 */
class appClass {
	/**
	 * объект класса роутинг
	 * @var routingClass
	 */
	private $routingObj;
	private $controllerDataObj = null;
	private $appResult;
	private $activePage;
	private $cacheObj;
	private $isCasheApp;
	private $appDataObj;
	public function __construct() {
	}
	/**
	 * 
	 */
	public function init() {
		global $routingObj;
		global $exchangeRateObj;
		global $controllerDataObj;
		$this->isCasheApp = false;
		new securityClass ();
		$this->routingObj = new routingClass ();
		$routingObj = $this->routingObj;
		$this->cacheObj = new cacheClass ();
		$this->appDataObj = new appDataClass ();
		$exchangeRateObj = new exchangeRateClass ();
	}
	/**
	 * формируем активный контроллер, действие, гет параметры
	 * @throws ExceptionObject
	 */
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
	/**
	 * получение активной страницы
	 */
	public function getActivePage() {
		$structureModelObj = new structureModelClass ( new structureProviderClass ( "pages_structure" ) );
		$structureModelObj->getItem ( $this->routingObj->getController (), $this->routingObj->getAction () );
		if ($structureModelObj->item) {
			$this->activePage = $structureModelObj->item;
			$this->appDataObj = new appDataClass ( $this->activePage );
		}
	}
	/**
	 * проверка на кеш 
	 */
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
	/**
	 * формиет кеш результат, если он необходим
	 * @param string $action
	 */
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
	/**
	 * формирует необходимый контроллер и действие
	 * @param котроллер $controller
	 * @param действие $action
	 * @param масив параметры $param
	 * @throws ExceptionObject
	 */
	public function formatControllerObject($controller, $action, $param) {
		try {
			if (! class_exists ( $controller ))
				throw new ExceptionObject ( $controller, "\"$controller\" не существует контроллера" );
			$this->controllerDataObj = new $controller ();
			if (! method_exists ( $this->controllerDataObj, $action ))
				throw new ExceptionObject ( $action, "\"$action\" не существует метода" );
			$this->controllerDataObj->setResult ( $this->controllerDataObj->$action ( $param ) );
			$this->appDataObj->setTitle ( $this->controllerDataObj->appDataObj->getTitle () );
			$this->appDataObj->setKeyw ( $this->controllerDataObj->appDataObj->getKeyw () );
			$this->appDataObj->setDesc ( $this->controllerDataObj->appDataObj->getDesc () );
			$this->appDataObj->setStringNavigation ( $this->controllerDataObj->appDataObj->getStringNavigation () );
			$this->appDataObj->setPController ( $this->controllerDataObj->appDataObj->getPController () );
			$this->appDataObj->setPAction ( $this->controllerDataObj->appDataObj->getPAction () );
			$this->appDataObj->social = $this->controllerDataObj->appDataObj->social;
		} catch ( Exception $exc ) {
			// header ( "HTTP/1.1 301 Moved Permanently" );
			// header ( "Location: http://" . $_SERVER ['HTTP_HOST'] . "/404.html" );
			// exit ();
			echo ExceptionFullGet::ExcError ( $exc );
		}
	}
	/**
	 *  вывод результата обработки 
	 */
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
				$aControllerObj = new aControllerClass ();
				$this->appResult = $aControllerObj->view ( array (
						"appDataObj" => $this->appDataObj,
						"body" => $this->controllerDataObj->result 
				), "/shared/" . $this->controllerDataObj->loyaut );
			}
		}
	}
	/**
	 * печать результата обработки 
	 */
	public function printResult() {
		echo $this->appResult;
		// кеширование (сохранение сформированной страницы)
		$this->buildCashApp ( 'end' );
		return;
	}
}