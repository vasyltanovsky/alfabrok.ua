<?php 
ini_set('max_execution_time', 1200);
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
$provider->select_table_query ( "SELECT * FROM immovables
ORDER BY im_id", "im_id" );

if ($provider->table) {
	$dir = opendir ( $dstfile );
	foreach ( $provider->table as $key => $value ) {
		$s_filename = sprintf ( "si_%s", $value ["im_photo"] );
		copy ( $srcfile . $s_filename, DOC_ROOT . $dstfile . $s_filename );
		devLogs::_echo ( $srcfile . $s_filename . "-copy->s_" . $value ["im_photo_id"] );

		//$del = file_get_contents ( sprintf ( "%s?im_photo=%s.%s", $deleteurl, $value ["im_photo_id"], $value ["im_file_type"] ) );
		devLogs::_echo ( $value ["im_id"] );
		//devLogs::_echo ( "====================" );
	}
}
//mkdir(dirname($dstfile), 0777, true);
//
?>