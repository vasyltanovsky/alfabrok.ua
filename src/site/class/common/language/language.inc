<?php
function initLang($langCodeDefault) {
	$language = new languageClass ( '', $_COOKIE ['lang_code'], $_COOKIE ['lang_id'], $langCodeDefault );
	$language->do_get_this ( substr ( $_SERVER ['REDIRECT_URL'], 1, 2 ) );
	
	if ($language->set_cookie) {
		setcookie ( 'lang_code', $language->lang_code, 0, '/' );
		setcookie ( 'lang_id', $language->lang_id, 0, '/' );
		$_COOKIE ['lang_code'] = $language->lang_code;
		$_COOKIE ['lang_id'] = $language->lang_id;
	}
	
	try {
		//обрабатываем xml таблиц БД
		$xmlObj = new xmlToArrayClass ( null );
		if (($fc = file_get_contents ( DOC_ROOT . '/app/includes/language/' . $_COOKIE ['lang_code'] . '/words.language.xml' )) !== false) {
			$xmlObj->xml = $fc;
			$arrData = $xmlObj->createArray ();
			include DOC_ROOT . '/app/includes/language/' . $_COOKIE ['lang_code'] . '/words.language.php';
			return $arWords = $arrData ['words'];
		} else
			throw new Exception ( 'Error open words.language.xml.' );
	} catch ( Exception $exc ) {
		echo ExceptionFullGet::ExcError ( $exc );
	}
}

/* Функция: возвращает значение необходимого элемента массива языковой версии
* @param  $id - айди элемента языковой версии массива
* @return значение элемента языковой версии массива
*/
function getLangString($id) {
	global $arWords;
	if (! isset ( $arWords [$id] ))
		return "!! no isset {$id} lang string";
	return $arWords [$id];
}

function GetConfigValue($name, $id) {
	global $CONFIG;
	return $CONFIG [$name] [$id];
}