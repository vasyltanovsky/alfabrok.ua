<?php
class routingClass {
	public $localization;
	public $contoller;
	public $action;
	public $get = array ();
	public $post;
	private $routes;
	
	public function __construct() {
		$this->localization = "ru";
		$this->contoller = "index";
		$this->action = "index";
		$this->includeRoute ();
		$this->checkForNotNormalHosting ();
		$this->init ();
		unset ( $this->routes );
	}
	public function getLocalization() {
		return $this->localization;
	}
	public function getController() {
		return $this->contoller;
	}
	public function getControllerFull() {
		return sprintf ( "%sController", $this->contoller );
	}
	public function getAction() {
		return strtolower ( $this->action );
	}
	public function getParam() {
		return $this->get;
	}
	public function getParamToString() {
		$ret = "";
		if (! empty ( $this->get )) 
			foreach ( $this->get as $key => $value ) {
				$ret .= sprintf ( "&%s=%s", $key, $value );
			}
		return $ret;
	}
	public function getParamInString() {
		if (strpos ( $_SERVER ['REQUEST_URI'], "?" ))
			return substr ( $_SERVER ['REQUEST_URI'], strpos ( $_SERVER ['REQUEST_URI'], "?" ) + 1, strlen ( $_SERVER ['REQUEST_URI'] ) );
		return;
	}
	public function setParamItem($key, $value) {
		return $this->get [$key] = $value;
	}
	public function getParamItem($name, $defaultValue = null) {
		if (! isset ( $this->get [$name] ))
			return $defaultValue;
		else
			return $this->get [$name];
	}
	public function init() {
		//преобразование строки REDIRECT_URL в массив
		$get = explode ( '/', $_SERVER ['REDIRECT_URL'] );
		if (! empty ( $get [1] ))
			$this->localization = strtolower ( $get [1] );
		if (! empty ( $get [2] ))
			$this->contoller = strtolower ( $get [2] );
		if (! empty ( $get [3] ))
			$this->action = strtolower ( $get [3] );
		$this->buildGet ( $get );
		//$this->buildPost ( $get );
	}
	private function buildGet($strRedirectArray) {
		if (isset ( $this->routes [$this->contoller] [$this->action] )) {
			//строим параметры соответсвенно роуту	
			foreach ( $strRedirectArray as $key => $value ) {
				if (isset ( $key, $this->routes [$this->contoller] [$this->action] [$key] ))
					$this->get [$this->routes [$this->contoller] [$this->action] [$key]] = $value;
			}
		}
		//
		$this->get = array_merge ( $this->get, $_GET );
	}
	private function buildPost($strRedirectArray) {
		$this->post = $_POST;
	}
	private function includeRoute() {
		//подключание настроек 
		require $_SERVER ['DOCUMENT_ROOT'] . '/config/routes.inc';
		$this->routes = $routes;
	}
	
	private function checkForNotNormalHosting() {
		$_SERVER ['REDIRECT_URL'] = $_SERVER ['REDIRECT_URL'];
		//проверка для ебанутого хостинга
		if ($_SERVER ['SERVER_NAME'] != 'tristroj.loc') {
			if (strpos ( $_SERVER ['REQUEST_URI'], '?' ))
				$_SERVER ['REDIRECT_URL'] = substr ( $_SERVER ['REQUEST_URI'], 0, strpos ( $_SERVER ['REQUEST_URI'], '?' ) );
			else {
				if ($_SERVER ['REDIRECT_URL'] != '/')
					$_SERVER ['REDIRECT_URL'] = $_SERVER ['REQUEST_URI'];
				else
					unset ( $_SERVER ['REDIRECT_URL'] );
			}
		}
		return $_SERVER ['REDIRECT_URL'];
	}
}