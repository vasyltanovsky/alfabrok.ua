<?php
/*
 * @copy Copyright 2013  
 * @version 2.1
 * @author Alex Prophet <webroom.in.ua>
 */

//отображение ошибок
error_reporting ( E_ALL & ~ E_NOTICE & ~ E_WARNING );
ini_set ( "display_errors", 1 );

//опредение времени
function getmicrotime() {
	list ( $usec, $sec ) = explode ( " ", microtime () );
	return (( float ) $usec + ( float ) $sec);
}
$time_start = getmicrotime ();

//константы
define ( 'SLASH', '/' );
define ( 'DOC_ROOT', $_SERVER ['DOCUMENT_ROOT'] . "/" );

//define ( 'DOC_ROOT', $_SERVER ['DOCUMENT_ROOT'] );
define ( 'DEBUG', 1 );
session_start ();

include DOC_ROOT . '/config/class.inc'; //подключение классов
include DOC_ROOT . '/config/config.php'; //поключение конфига
include DOC_ROOT . '/config/models.inc'; //поключение моделей
include DOC_ROOT . '/config/providers.inc'; //поключение провайдеров
include DOC_ROOT . '/config/controllers.inc'; //поключение контроллеров 


//формируем версию языка
global $arWords;
$arWords = initLang ( "ru" );
//формируем страницу
global $routingObj;
global $renderHtmlLinkObj;
global $exchangeRateObj;
$renderHtmlLinkObj = new renderHtmlLink ( );
$appObj = new appClass ( );
$appObj->init ();
$appObj->buildControllerData ();
$appObj->getResult ();
$appObj->printResult ();
return;
/*
//подключение настроек сайта
//include_once DOC_ROOT . '/application/module/settings.php';
//подключение обработчика версии языка
include_once DOC_ROOT . '/application/module/languages/set.cookie.php';
//подключение контролов
include DOC_ROOT . '/application/controls/controls.php';
//подключение провайдеров
include DOC_ROOT . '/application/module/providers.php';
//подключение модулей
include DOC_ROOT . '/application/module/modules.php';

include DOC_ROOT . '/dmn/utils/functions/f.encodestring.php';

//обьявляем класс обработки страницы
$page = new page ( $CONFIG, $tbl, $arWords );
$GET = $page->getSomeField ( 'GET' );

//вывести данные по обработке
if (isset ( $GET ['statistic'] )) {
	$print_r = $_COOKIE;
	if ($GET ['statistic'] == 'server')
		$print_r = $_SERVER;
	if ($GET ['statistic'] == 'get')
		$print_r = $_GET;
	if ($GET ['statistic'] == 'php')
		echo phpinfo ();
	if ($GET ['statistic'] == 'page')
		$print_r = $page;
	
	echo "<pre>";
	print_r ( $print_r );
	echo "<pre>";
}
//
if (isset ( $GET ['statistic'] ))
	header ( 'Content-Type: text/html; charset=utf-8' );
	
//Обработать конфиг	и запуск класса page
if (isset ( $GET ['statistic'] ))
	echo "<br>Время отработки config.php и запуск класса page - " . (($time_prev = getmicrotime ()) - $time_start) . " секунд";
	
//Обработать и создать страницу
$page->createPage ();
if (isset ( $GET ['statistic'] ))
	echo "<br>Время отработки processPage() - " . (getmicrotime () - $time_prev) . " итого прошло " . (($time_prev = getmicrotime ()) - $time_start) . " секунд";
	
//Вывести страницу
$page->printPage ();
if (isset ( $GET ['statistic'] ))
	echo "<br>Время отработки страницы - " . (getmicrotime () - $time_start) . " секунд";
*/