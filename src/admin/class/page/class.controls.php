<?php
abstract class Control extends Controller {
	public $ptm_pos;
	public $data_ptm;
	public $conf;
	public $get;
	public $dict;
	public $arWords;
	public $temp;
	public $tbl;
	public $error;
	public $navigationString;
	public $meta;
	private $ControlData;
	
	public function __construct($ptm_pos, $data_ptm, $conf, $get, $dict, $arWords, $temp, $tbl) {
		$this->ptm_pos = $ptm_pos;
		$this->data_ptm = $data_ptm;
		$this->conf = $conf;
		$this->dict = $dict;
		$this->get = $get;
		$this->arWords = $arWords;
		$this->temp = $temp;
		$this->tbl = $tbl;
		$this->error = $error;
		$this->navigationString = $navigationString;
		$this->meta = $meta;
		$this->startControl ();
	}
	
	abstract function get_html();
	
	/* Функция: запускает контроллер
    * @return 
    */
	public function startControl() {
		try {
			//производим проверку передан ли айди записи позиция ШаблонМодуль
			if (empty ( $this->data_ptm ['ptm_build_table'] [$this->ptm_pos] ))
				("<br>Не переданы данные Шаблон Модуль ptm_pos<br>");
				//имя метода модуля
			$method = $this->data_ptm ['ptm_build_table'] [$this->ptm_pos] ['m_s_name'];
			//производим проверку на существования метода в данному классе
			if (method_exists ( $this->data_ptm ['ptm_build_table'] [$this->ptm_pos] ['parent_s_name'], $method ))
				return $this->$method ();
			else
				throw new ExceptionMember ( $method, "Член " . $this->data_ptm ['ptm_build_table'] [$this->ptm_pos] ['parent_s_name'] . "::$method не существует" );
		} catch ( Exception $exc ) {
			echo ExceptionFullGet::ExcMember ( $exc );
		}
	}
	/* Функция:
    * @return 
    */
	public function setContData($pt_id, $parent_id, $pos_temp_id, $html = NULL, $title = NULL, $w_title = NULL, $w_key = NULL, $w_desc = NULL, $error = NULL, $navigationString = NULL, $meta = NULL) {
		if ($error)
			$this->exeption ( $error );
		$temp_type = $this->data_ptm ['ptm_build_table'] [$pt_id] ['temp_type'];
		$temp_s_code = $this->data_ptm ['ptm_build_table'] [$pt_id] ['temp_s_code'];
		return $this->ControlData = array ('pt_id' => $pt_id, 'parent_id' => $parent_id, 'pos_temp_id' => $pos_temp_id, 'html' => $html, 'title' => $title, 'w_title' => $w_title, 'w_key' => $w_key, 'w_desc' => $w_desc, 'temp_type' => $temp_type, 'temp_s_code' => $temp_s_code, 'error' => $error, 'navigationString' => $navigationString, 'meta' => $meta );
	}
	
	//
	// Виртуальный обработчик запроса.
	//
	protected function OnOutput($vars, $fileName) {
		//$vars = array('title' => $this->title, 'content' => $this->content);	
		$page = $this->Template ( $fileName, $vars );
		echo $page;
	}
	
	public function getContData() {
		return $this->ControlData;
	}
	
	/* Функция:
    * @return 
    */
	public function __set($key, $value) {
		if (isset ( $this->$key ))
			return $this->$key = $value;
		else
			throw new ExceptionMember ( $key, "Член " . __CLASS__ . "::$key не существует" );
	}
	/* Функция:
    * @return 
    */
	public function __get($key) {
		if (isset ( $this->$key ))
			return $this->$key;
		else
			throw new ExceptionMember ( $key, "Член " . __CLASS__ . "::$key не существует" );
	}
	/* Функция: если активен вывод статистики, то выводим
	 * @param $msq - сообщение
     * @return сообщение
     */
	protected function IsShowStatistic($msq, $ModMethod, $arr = NULL) {
		if ($this->get ['statistic']) {
			echo "<br> Msq: {$msq} <br> Control: " . $ModMethod;
			if ($arr) {
				//echo "<pre>";
			//print_r($arr);
			//echo "</pre>";
			}
		}
		return;
	}
	
	public function __destruct() {
	
	}
	public function __toString() {
		$this->getContData ();
		$this->__destruct ();
	}
	public function exeption($error) {
		switch ($error) {
			case '404' :
				header ( 'Location: /404.html' );
				break;
			
			default :
				;
				break;
		}
	}

}
?>