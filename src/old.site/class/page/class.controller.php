<?php
//
// Базовый класс контроллера.
//
abstract class Controller {
	//
	// Конструктор.
	//
	public function __construct() {
	}
	
	//
	// Генерация HTML шаблона в строку.
	//
	public function Template($fileName, $vars = array()) {
		
		if (is_array ( $vars )) {
			// Установка переменных для шаблона.
			foreach ( $vars as $k => $v ) {
				$$k = $v;
			}
		}
		
		if (! file_exists ( DOC_ROOT . SLASH . $fileName )) {
			echo "fuck";
		}
		// Генерация HTML в строку.
		ob_start ();
		include DOC_ROOT . SLASH . $fileName;
		return ob_get_clean ();
	}
}
