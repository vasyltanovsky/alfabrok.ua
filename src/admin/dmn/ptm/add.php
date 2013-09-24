<?php
error_reporting ( E_ALL & ~ E_NOTICE );
define ( 'DOC_ROOT', $_SERVER ['DOCUMENT_ROOT'] );

// Устанавливаем соединение с базой данных
require_once ("../../config/config.pg.php");
// Подключаем блок авторизации
require_once ("../utils/security_mod.php");
// Подключаем SoftTime FrameWork
require_once ("../../config/class.config.dmn.php");
define ( 'SLASH', '../../' );
require_once '../../config/class.pg.php';
require_once 'functions/functions.php';
require_once '../utils/template.html/template.module.php';

$ArrPageInfo = array ("certificate" => array ("title" => "Добавление сертификата", "back" => "<a href=\"index.php\">Назад</a>", "pageInfo" => "", "msq" => "Сертификат добавлен! <a href=\"index.php\">К списку.</a><script type=\"text/javascript\">$(function(){window.open('print.php','mywindow','width=700, height=900');});</script>" ) );

// Поколючение обработчика и сохранение, редактирование записи
$SaveInfo = "";
if (isset ( $_POST ['retention'] )) {
	require_once 'template.data.retention.php';
	$ModErr = new ModuleSite ( $ModuleTemplate );
	if (isset ( $response ['fieldErrors'] )) {
		$returnErr ['error_text'] = "";
		foreach ( $response ['fieldErrors'] as $value ) {
			$returnErr ['error_text'] .= $value;
		}
		$SaveInfo = $ModErr->For_HTML ( $ModuleTemplate ['error_page'], $returnErr );
	} else
		$SaveInfo = $ModErr->For_HTML ( $ModuleTemplate ['msq_page'], $ArrPageInfo [$_GET ['temp']] );
}

// Включаем заголовок страницы
require_once ("../utils/top.php");
// Вывод информации об ошибках сохранение и т.д.	
echo $SaveInfo;
// Подключение формы	
require_once 'template.add/add.' . $_GET ['temp'] . '.php';
// Включаем завершение страницы
require_once ("../utils/bottom.php");
?>