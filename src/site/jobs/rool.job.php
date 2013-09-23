<?php
// одключение к БД, и подключение классов
// require_once("../config/config.php");
// require_once("../config/class.config.php");
// chmod ($_SERVER['DOCUMENT_ROOT']."/files/images/immovables/*", 0777);
$dir = opendir ( $_SERVER ['DOCUMENT_ROOT'] . "/files/images/immovables/" );
while ( ($file = readdir ( $dir )) !== false ) {
	// Обрабатываем только подкаталоги,
	// игнорируя файлы
	// Исключаем текущий ".", родительский ".."
	// каталоги, а также каталог utils
	if ($file != "." && $file != "..") {
		chmod ( $_SERVER ['DOCUMENT_ROOT'] . "/files/images/immovables/" . $file, 0777 );
		echo $_SERVER ['DOCUMENT_ROOT'] . "/files/images/immovables/" . $file . "<br>";
	}
}

$dir = opendir ( $_SERVER ['DOCUMENT_ROOT'] . "/files/images/realtor/" );
while ( ($file = readdir ( $dir )) !== false ) {
	// Обрабатываем только подкаталоги,
	// игнорируя файлы
	// Исключаем текущий ".", родительский ".."
	// каталоги, а также каталог utils
	if ($file != "." && $file != "..") {
		chmod ( $_SERVER ['DOCUMENT_ROOT'] . "/files/images/realtor/" . $file, 0777 );
		echo $_SERVER ['DOCUMENT_ROOT'] . "/files/images/realtor/" . $file . "<br>";
	}
}

$dir = opendir ( $_SERVER ['DOCUMENT_ROOT'] . "/files/images/customer/" );
while ( ($file = readdir ( $dir )) !== false ) {
	// Обрабатываем только подкаталоги,
	// игнорируя файлы
	// Исключаем текущий ".", родительский ".."
	// каталоги, а также каталог utils
	if ($file != "." && $file != "..") {
		chmod ( $_SERVER ['DOCUMENT_ROOT'] . "/files/images/customer/" . $file, 0777 );
		echo $_SERVER ['DOCUMENT_ROOT'] . "/files/images/customer/" . $file . "<br>";
	}
}

$dir = opendir ( $_SERVER ['DOCUMENT_ROOT'] . "/files/partner/" );
while ( ($file = readdir ( $dir )) !== false ) {
	// Обрабатываем только подкаталоги,
	// игнорируя файлы
	// Исключаем текущий ".", родительский ".."
	// каталоги, а также каталог utils
	if ($file != "." && $file != "..") {
		chmod ( $_SERVER ['DOCUMENT_ROOT'] . "/files/partner/" . $file, 0777 );
		echo $_SERVER ['DOCUMENT_ROOT'] . "/files/partner/" . $file . "<br>";
	}
}
?>