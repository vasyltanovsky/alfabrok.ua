<?php
	if(!isset($_POST['lang_bottom'])) $_POST['lang_bottom'] = NULL;
	if(!isset($_POST['lang_code']))   $_POST['lang_code'] = NULL;
	if(!isset($_POST['lang_id'])) 	  $_POST['lang_id'] = NULL;
	
	$language =  new language($_POST['lang_bottom'],
							  $_COOKIE['lang_code'],
							  $_COOKIE['lang_id'],
							  "rus");
	$language->do_this();
	
	if($language->set_cookie)
	{
		setcookie('lang_code', $language->lang_code, 0, '/');							
		setcookie('lang_id',   $language->lang_id, 0, '/');	
		$_COOKIE['lang_code'] 	= $language->lang_code;
		$_COOKIE['lang_id']  	= $language->lang_id;
		//header("Location: ". $_SERVER['HTTP_REFERER']);	
	}
	
	global  $lang_id;
	$lang_id= $language->lang_id;
	
	if(empty($_COOKIE['lang_id']))	 
	{
		$_COOKIE['lang_id'] = 1;
		$lang_id = 1;
		$_COOKIE['lang_code'] = 'rus';
	}
	
	require_once("{$_COOKIE['lang_code']}.words.language.php");
	global  $arWords;
	
	if(empty($_COOKIE["exchange"])) {
		$ExchangeProvider = new ExchangeRateProvider("exchange_rate");
		$ExchangeProvider->GetList();
		if($ExchangeProvider->resTable) {
			setcookie('exchange', true, 0, '/');							
			$_COOKIE['exchange'] 	= true;
			foreach ($ExchangeProvider->resTable as $key => $value) {
				$exchangeNameCookie = sprintf("exchange_%s", $value["code"]);
				setcookie("" . $exchangeNameCookie . "", $value["exchange"], 0, '/');							
				$_COOKIE["" . $exchangeNameCookie. ""] = $value["exchange"];
			}
		}
	}
