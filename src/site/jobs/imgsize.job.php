<?php
// константы
define ( 'SLASH', '/' );
define ( 'DOC_ROOT', $_SERVER ['DOCUMENT_ROOT'] );
define ( 'DEBUG', 1 );
// подключение классов
include DOC_ROOT . '/config/class.config.php';

$fDir = DOC_ROOT . "/files/images/ct_photos/";
$ImgPropLogo ['ImgW'] = 800;
$ImgPropLogo ['ImgH'] = 600;

$dir = opendir ( $fDir );
while ( ($file = readdir ( $dir )) !== false ) {
	$fileName = $file;
	if (substr ( $fileName, 0, 2 ) == "4d") {
		// *** 1) Initialise / load image
		$resizeObj = new resize ( $fDir . "" . $fileName );
		// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
		$resizeObj->resizeImage ( $ImgPropLogo ['ImgW'], $ImgPropLogo ['ImgH'], 'crop' );
		// *** 3) Save image
		$resizeObj->saveImage ( $fDir . $fileName, 100 );
		echo $fDir . $fileName . "<br>";
	}
}
?>