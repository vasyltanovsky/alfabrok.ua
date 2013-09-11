<?php
	if($_POST['lang_bottom'])
	{
		if($_POST['lang_bottom'] == "ru")
			$_POST['lang_bottom'] = "ru";
		if($_POST['lang_bottom'] == "ua")
			$_POST['lang_bottom'] = "ua";
		if($_POST['lang_bottom'] == "en")
			$_POST['lang_bottom'] = "en";	
	}
	
	#обьявление класса языков
	$language =  new language($_POST['lang_bottom'],
							  $_COOKIE['lang_code'],
							  $_COOKIE['lang_id'],
							  "ru");
	
	#обработчик переключение языковой версии
	$language->do_this();
	
	#проверка на задание языковой версии
	if($language->set_cookie)
	{
		setcookie('lang_code', $language->lang_code, 0, '/');							
		setcookie('lang_id',   $language->lang_id, 0, '/');							
		header("Location: ". $_SERVER['HTTP_REFERER']);	
	}
	if($_COOKIE ['lang_id'])
		$_COOKIE['lang_id'] = $_COOKIE ['lang_id'];
?>