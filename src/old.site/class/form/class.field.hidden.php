<?php #	www.alex-ts.loc
#	ALEX TSURKIN 
#	19.11.2009
error_reporting ( E_ALL & ~ E_NOTICE );

////////////////////////////////////////////////////////////
// Скрытое поле hidden
////////////////////////////////////////////////////////////


class field_hidden extends field {
	// Конструктор класса
	function __construct($name, $id_required = false, $value = "") {
		// Вызываем конструктор базового класса field для 
		// инициализации его данных
		parent::__construct ( $name, "hidden", "-", $id_required, $value, $parameters, "", "" );
	}
	
	// Метод, для возврата имени названия поля
	// и самого тэга элемента управления
	function get_html() {
		$tag = "<input type=\"" . $this->type . "\" 
                     name=\"" . $this->name . "\" 
                     value=\"" . htmlspecialchars ( $this->value, ENT_QUOTES ) . "\">\n";
		return array ("", $tag );
	}
	// Метод, проверяющий корректность переданных данных
	function check() {
		// Обезопасить текст перед внесением в базу данных
		if (! get_magic_quotes_gpc ()) {
			$this->value = mysql_escape_string ( $this->value );
		}
		if ($this->is_required) {
			if (empty ( $this->value ))
				return "Скрытое поле не заполнено";
		}
		
		return "";
	}
}
?>