<?php
#	www.alex-ts.loc
#	ALEX TSURKIN 
#	19.11.2009
error_reporting ( E_ALL & ~ E_NOTICE );

////////////////////////////////////////////////////////////
// Обращение к несуществующему члену
////////////////////////////////////////////////////////////


class ExceptionMember extends Exception {
	// Имя не существующего члена
	protected $key;
	
	public function __construct($key, $message) {
		$this->key = $key;
		
		// Вызываем конструктор базового класса
		parent::__construct ( $message );
	}
	
	public function getKey() {
		return $this->key;
	}
}
?>
