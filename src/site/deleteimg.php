<?php
ini_set ( 'max_execution_time', 1200 );
?>
<?php

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
define ( 'DOC_ROOT', $_SERVER ['DOCUMENT_ROOT'] );

//define ( 'DOC_ROOT', $_SERVER ['DOCUMENT_ROOT'] );
define ( 'DEBUG', 1 );
session_start ();

include DOC_ROOT . '/config/class.inc'; //подключение классов
include DOC_ROOT . '/config/config.php'; //поключение конфига


$deleteurl = "http://alfabrok.ua/deleteimg.php";

$srcfile = 'http://www.alfabrok.ua/files/images/immovables/';
$dstfile = '/files/images/immovables/';

$provider = new mysql_select ( "immovables_photos", " where im_id = 10688 order by im_photo_id " );
$provider->select_table_query ( "SELECT p . * , i.hide
FROM  `immovables_photos` p
JOIN immovables i ON p.im_id = i.im_id
WHERE i.hide =  'show'
AND i.im_id < 9563
order by p.im_id", "im_photo_id" );

if ($provider->table) {
	$dir = opendir ( $dstfile );
	foreach ( $provider->table as $key => $value ) {
		unlink ( DOC_ROOT . "/files/images/immovables/" . $value ["im_photo_id"] . "." . $value ["im_file_type"] );
		unlink ( DOC_ROOT . "/files/images/immovables/st_" . $value ["im_photo_id"] . "." . $value ["im_file_type"] );
		unlink ( DOC_ROOT . "/files/images/immovables/s_" . $value ["im_photo_id"] . "." . $value ["im_file_type"] );
		devLogs::_echo ( "delete->" . $value ["im_id"] );
	}
}
?>