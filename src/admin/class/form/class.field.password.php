<?php #	www.alex-ts.loc
#	ALEX TSURKIN 
#	19.11.2009
error_reporting ( E_ALL & ~ E_NOTICE );

////////////////////////////////////////////////////////////
// Текстовое поле для пароля password
////////////////////////////////////////////////////////////


class field_password extends field_text {
	// Конструктор класса
	function __construct($name, $caption, $is_required = false, $value = "", $maxlength = 255, $size = 41, $parameters = "", $help = "", $help_url = "") {
		// Вызываем конструктор базового класса field_text для 
		// инициализации его данных
		parent::__construct ( $name, $caption, $is_required, $value, $maxlength, $size, $parameters, $help, $help_url );
		// Класс field_text присваивает члену type
		// значение text, для пароля этом члену
		// следует присвоить значение password
		$this->type = "password";
	}
}
?>