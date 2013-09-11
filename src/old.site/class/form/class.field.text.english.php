<?php #	www.alex-ts.loc
#	ALEX TSURKIN 
#	19.11.2009
error_reporting ( E_ALL & ~ E_NOTICE );

////////////////////////////////////////////////////////////
// Текстовое поле для английского текста
////////////////////////////////////////////////////////////


class field_text_english extends field_text {
	// Метод, проверяющий корректность переданных данных
	function check() {
		// Обезопасить текст перед внесением в базу данных
		if (! get_magic_quotes_gpc ()) {
			$this->value = mysql_escape_string ( $this->value );
		}
		if ($this->is_required)
			$pattern = "|^[a-z]+$|i";
		else
			$pattern = "|^[a-z]*$|i";
			
		// Проверяем поле value на английский символ
		if (! preg_match ( $pattern, $this->value )) {
			return "Поле \"{$this->caption}\" должно содержать только символы латинского алфавита";
		}
		
		return "";
	}
}
?>