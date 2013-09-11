<?php

/*
 * PHP 5.0.x
 *
 * Logger v.0.1
 *
 * tIT-GP
 *
 * License LGPL
 *
 */

class loggerClass {
	
	//Имя лог-файла, куда ведем запись
	public $logfile;
	//Указатель на этот лог-файл
	private $logd;
	//Данные из лог-файла
	public $data;
	//Данные этой сессии
	public $current_data;
	
	function __construct($path) {
		
		//Инициируем массив на случай, если лог-файл пустой
		$this->data = array ();
		
		//Инициируем массив на случай, если ни разу не вызовем writeln();
		$this->current_data = array ();
		
		//Если нет указанного путя, то и работать нет смысла
		if (! is_dir ( $path )) {
			return false;
		}
		
		//Создаем пути, тобы было легче ориентироваться в логах
		if (! is_dir ( $path = $path . '/' . date ( 'Y' ) )) {
			@mkdir ( $path, '0700' );
		}
		//if ( !is_dir($path = $path.SLASH.date('m')) ) {
		//  @mkdir($path, '0700');
		//}
		

		//Создаем пустой файл, если нет
		@fclose ( fopen ( $this->logfile = $path . '/' . date ( 'Y-m-d' ) . '.log', 'a' ) );
		
		//Считываем лог-файл в массив
		$this->data = file ( $this->logfile );
		//Открываем файл для чтения-записи
		$this->logd = fopen ( $this->logfile, 'r+' );
	
	}
	
	//Добавим строку в буфер лога
	public function writeln($str) {
		
		$line = '[' . date ( 'H:i:s' ) . '] ';
		$line .= $str . "\n";
		
		$this->current_data [] = $line;
	
	}
	
	//Готовим массив для записи в файл
	private function prepare() {
		
		//Это чтобы самая новая запись в самом верху была
		//$this->current_data = array_reverse($this->current_data);
		return array_merge ( $this->data, $this->current_data );
	
	}
	
	//Ну нет в четвертом ПХП деструкторов -- будете вызывать явно
	function __destruct() {
		
		flock ( $this->logd, LOCK_EX );
		//Нельзя писать в файл массив -- неправильно поймут
		fwrite ( $this->logd, implode ( $this->prepare (), '' ) );
		fclose ( $this->logd );
	
	}

}

?>