<?php #	www.alex-ts.loc
#	ALEX TSURKIN 
#	19.11.2009
error_reporting ( E_ALL & ~ E_NOTICE );

////////////////////////////////////////////////////////////
// Скрытое поле с целочисленными значениями hidden
////////////////////////////////////////////////////////////


class field_hidden_int extends field_hidden {
	// Метод, проверяющий корректность переданных данных
	function check() {
		if ($this->is_required) {
			// Поле обязательно к заполнению
			if (! preg_match ( "|^[\d]+$|", $this->value )) {
				return "Скрытое поле должно быть целым числом";
			}
		}
		// Поле не обязательно к заполнению
		if (! preg_match ( "|^[\d]*$|", $this->value )) {
			return "Скрытое поле должно быть целым числом";
		}
		
		return "";
	}
}
?>