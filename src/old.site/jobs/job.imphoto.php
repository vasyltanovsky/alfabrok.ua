<?php
@set_time_limit ( 0 );
@ini_set ( 'memory_limit', '256M' );
//отображение ошибок
error_reporting ( E_ALL );
ini_set ( "display_errors", "1" );

//define ( "DEBUG", 1 );


//поключение конфига
include '../config/config.php';
//подключение классов
include DOC_ROOT . '/config/class.config.php';

define ( "OLD_FOLDER", "../files/images/immovables/" );
define ( "NEW_FOLDER", "../files/images/n_immovables/" );

function resizeMainPhoto($namePhoto, $typePhoto, $im_id = null) {
	if (is_file ( sprintf ( "%s%s.%s", OLD_FOLDER, $namePhoto, $typePhoto ) )) {
		$PhotoSize = getimagesize ( sprintf ( "%s%s.%s", OLD_FOLDER, $namePhoto, $typePhoto ) );
		//		$wantedPerms = "0755";
		//		echo $actualPerms = fileperms ( sprintf ( "%s%s.%s", OLD_FOLDER, $namePhoto, $typePhoto ) );
		//		echo "<br/>";
		//		if ($actualPerms < $wantedPerms)
		//			chmod ( sprintf ( "%s%s.%s", OLD_FOLDER, $namePhoto, $typePhoto ), $wantedPerms );
		//		return;
		if ($PhotoSize [0] > 800) {
			try {
				$resizeObj = new resize ( sprintf ( "%s%s.%s", OLD_FOLDER, $namePhoto, $typePhoto ) );
				$resizeObj->resizeImage ( 800, 600, 'crop' );
				unlink ( sprintf ( "%s%s.%s", OLD_FOLDER, $namePhoto, $typePhoto ) );
				$resizeObj->saveImage ( sprintf ( "%s%s.%s", OLD_FOLDER, $namePhoto, $typePhoto ), 100 );
			} catch ( Exception $ex ) {
				echo sprintf ( "<p><b>Error resizeMainPhoto: %s,%s - %s</b></p>", $namePhoto, $im_id, $ex->getMessage () );
			}
			echo sprintf ( "<p><small>ResizeMainPhoto: %s - %s, (%s*%s)</small></p></hr>", $namePhoto, $im_id, $PhotoSize [0], $PhotoSize [1] );
		}
	}
}

function copyPhoto($namePhoto, $typePhoto, $im_id = null) {
	try {
		copy ( sprintf ( "%s%s.%s", OLD_FOLDER, $namePhoto, $typePhoto ), sprintf ( "%s%s.%s", NEW_FOLDER, $namePhoto, $typePhoto ) );
		copy ( sprintf ( "%ss_%s.%s", OLD_FOLDER, $namePhoto, $typePhoto ), sprintf ( "%s%s.%s", NEW_FOLDER, $namePhoto, $typePhoto ) );
		copy ( sprintf ( "%ssi_%s.%s", OLD_FOLDER, $namePhoto, $typePhoto ), sprintf ( "%s%s.%s", NEW_FOLDER, $namePhoto, $typePhoto ) );
		copy ( sprintf ( "%sst_%s.%s", OLD_FOLDER, $namePhoto, $typePhoto ), sprintf ( "%s%s.%s", NEW_FOLDER, $namePhoto, $typePhoto ) );
		copy ( sprintf ( "%spr_%s.%s", OLD_FOLDER, $namePhoto, $typePhoto ), sprintf ( "%s%s.%s", NEW_FOLDER, $namePhoto, $typePhoto ) );
		copy ( sprintf ( "%sbig_%s.%s", OLD_FOLDER, $namePhoto, $typePhoto ), sprintf ( "%ss_%s.%s", NEW_FOLDER, $namePhoto, $typePhoto ) );
	} catch ( Exception $ex ) {
		echo sprintf ( "<p><b>Error copyPhoto: %s,%s - %s</b></p>", $namePhoto, $im_id, $ex->getMessage () );
	}
}

function deletePhoto($namePhoto, $typePhoto, $im_id = null) {
	//return;
	try {
		unlink ( sprintf ( "%s%s.%s", OLD_FOLDER, $namePhoto, $typePhoto ) );
		unlink ( sprintf ( "%ss_%s.%s", OLD_FOLDER, $namePhoto, $typePhoto ) );
		unlink ( sprintf ( "%ssi_%s.%s", OLD_FOLDER, $namePhoto, $typePhoto ) );
		unlink ( sprintf ( "%sst_%s.%s", OLD_FOLDER, $namePhoto, $typePhoto ) );
		unlink ( sprintf ( "%spr_%s.%s", OLD_FOLDER, $namePhoto, $typePhoto ) );
		unlink ( sprintf ( "%sbig_%s.%s", OLD_FOLDER, $namePhoto, $typePhoto ) );
		echo sprintf ( "<p><small>Final: %s,%s</small></p>", $namePhoto, $im_id );
	} catch ( Exception $ex ) {
		echo sprintf ( "<p><b>Error deletePhoto: %s,%s - %s</b></p>", $namePhoto, $im_id, $ex->getMessage () );
	}
}

function deletePhotoFromDB($namePhoto) {
	$query = "delete from immovables_photos where im_photo_id = '{$namePhoto}'";
	if (! mysql_query ( $query ))
		throw new ExceptionMySQL ( mysql_error (), $query, $namePhoto );
}

//выборка фотограий недвижимости с проверкой на существование самой недвиж. 
$provider = new mysql_select ( "immovables" );
$provider->select_table_query ( "select p.*, i.im_id as immovable_id from immovables_photos p 
								left join immovables i on p.im_id = i.im_id" );
$immobalesPhotoList = $provider->table;
$i = 1;
if (count ( $immobalesPhotoList ) > 0) {
	foreach ( $immobalesPhotoList as $key => $value ) {
		//копирует фотографии недв. в новую папку и удаляем их со старой папки
		if ($value ["immovable_id"]) {
			resizeMainPhoto ( $value ["im_photo_id"], $value ["im_file_type"], $value ["im_id"] );
			//	copyPhoto ( $value ["im_photo_id"], $value ["im_file_type"] );
			//	deletePhoto ( $value ["im_photo_id"], $value ["im_file_type"] );
		} else {
			//deletePhoto ( $value ["im_photo_id"], $value ["im_file_type"], $value ["im_id"] );
		//deletePhotoFromDB ( $value ["im_photo_id"] );
		}
	}
}

exit ( "Копирование завершено!" );