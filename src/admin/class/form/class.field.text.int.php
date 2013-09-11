<?php #	www.alex-ts.loc
#	ALEX TSURKIN 
#	19.11.2009
error_reporting ( E_ALL & ~ E_NOTICE );

////////////////////////////////////////////////////////////
// Текстовое поле с целочисленными значениями
////////////////////////////////////////////////////////////


class field_text_int extends field_text {
	// Минимальное значение поля
	protected $min_value;
	// Максимальное значене поля
	protected $max_value;
	// Конструктор класса
	function __construct($name, $caption, $is_required = false, $value = "", $min_value = 0, $max_value = 0, $maxlength = 255, $size = 41, $parameters = "", $help = "", $help_url = "") {
		// Вызываем конструктор базового класса field_text для 
		// инициализации его данных
		parent::__construct ( $name, $caption, $is_required, $value, $maxlength, $size, $parameters, $help, $help_url );
		$this->min_value = intval ( $min_value );
		$this->max_value = intval ( $max_value );
		
		// Минимальное значение должно быть больше максимального
		if ($this->min_value > $this->max_value) {
			throw Exception ( "Минимальное значение должно 
                         быть больше максимльного 
                         значения. Поле \"" . $this->caption . "\"." );
		}
	}
	
	// Метод, проверяющий корректность переданных данных
	function check() {
		$pattern = "|^[-\d]*$|i";
		if ($this->is_required) {
			// Проверяем поле value на максимальное и минимальное значение
			if ($this->min_value != $this->max_value) {
				if ($this->value < $this->min_value || $this->value > $this->max_value) {
					return "Поле \"" . $this->caption . "\" 
                    должно быть больше " . $this->min_value . " 
                    и меньше " . $this->max_value . "";
				}
			}
			$pattern = "|^[-\d]+$|i";
		}
		// Проверяем, является ли введённое значение
		// целым числом
		if (! preg_match ( $pattern, $this->value )) {
			return "Поле \"" . $this->caption . "\" 
                должно содержать лишь цифры";
		}
		
		return "";
	}
}
?>