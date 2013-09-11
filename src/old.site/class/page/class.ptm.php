<?php
class ptm {
	public $data_ptm;
	public $conf;
	public $get;
	public $dict;
	public $arWords;
	public $temp;
	public $tbl;
	
	// Массив элементов управления
	private $Controls;
	
	public function __construct($data_ptm, $conf, $get, $dict, $arWords, $temp, $tbl) {
		$this->data_ptm = $data_ptm;
		$this->conf = $conf;
		$this->get = $get;
		$this->dict = $dict;
		$this->arWords = $arWords;
		$this->temp = $temp;
		$this->tbl = $tbl;
	}
	
	/* Функция: запускает контроллеры подключенные к странице
    * @return 
    */
	public function processControls() {
		try {
			for($i = count ( $this->data_ptm ['ptm_tree'] ) - 1; $i >= 0; $i --) {
				//получаем имя контроллера
				$Control = $this->data_ptm ['ptm_build_table'] [$this->data_ptm ['ptm_tree'] [$i] [0]];
				
				//проверка на существования класса
				if (! class_exists ( $Control ['parent_s_name'] )) {
					//если не указан модель обработчика устанавлием ControlInsertTemplate::ReturnEmptyBuild (заглушка)
					$this->data_ptm ['ptm_build_table'] [$Control ['pt_id']] ['m_s_name'] = 'ReturnEmptyBuild';
					$this->data_ptm ['ptm_build_table'] [$Control ['pt_id']] ['parent_s_name'] = 'ControlInsertTemplate';
					$this->Controls [$Control ['pt_id']] = new ControlInsertTemplate ( $Control ['pt_id'], $this->data_ptm, $this->conf, $this->get, $this->dict, $this->arWords, $this->temp, $this->tbl );
				} else {
					//обьявляем модули и запускаем
					if ($Control ['m_type'] == 'm_modyl') {
						$this->Controls [$Control ['pt_id']] = new $Control ['s_name'] ( $Control ['pt_id'], $this->data_ptm, $this->conf, $this->get, $this->dict, $this->arWords, $this->temp, $this->tbl );
					} else {
						$this->Controls [$Control ['pt_id']] = new $Control ['parent_s_name'] ( $Control ['pt_id'], $this->data_ptm, $this->conf, $this->get, $this->dict, $this->arWords, $this->temp, $this->tbl );
					}
				}
			}
		} catch ( Exception $exc ) {
			echo ExceptionFullGet::ExcError ( $exc );
		}
		return;
	}
	/* Функция: подучаем сформированные данные от контроллов
    * @return 
    */
	public function getDataControls() {
		$w_title = NULL;
		$w_key = NULL;
		$w_desc = NULL;
		
		if (is_array ( $this->Controls )) {
			foreach ( $this->Controls as $key => $obj ) {
				if (! is_subclass_of ( $obj, "Control" ))
					throw new ExceptionObject ( $key, "\"$key\" не является элементом управления" );
					
				//получаем контрол
				$control = $obj->get_html ();
				
				$w_title = ($control ['meta'] ['title'] ? $control ['meta'] ['title'] : $w_title);
				$w_key = ($control ['meta'] ['keywords'] ? $control ['meta'] ['keywords'] : $w_key);
				$w_desc = ($control ['meta'] ['description'] ? $control ['meta'] ['description'] : $w_desc);
				
				//соответсвенно к типу шаблона выполянем действия
				switch ($control ['temp_type']) {
					case 't_temp_inc' :
						{
							//обработанный шаблон
							$temp [$control ['parent_id']] [$this->data_ptm ['ptm_build_table'] [$control ['parent_id']] ['temp_s_code']] .= $control ['html'];
							break;
						}
					case 't_temp_part' :
						{
							//указатель части шаблона блока
							$temp [$control ['parent_id']] [$control ['temp_s_code']] .= $temp [$control ['pt_id']] [$this->data_ptm ['ptm_build_table'] [$control ['pt_id']] ['temp_s_code']];
							break;
						}
					case 't_block' :
						{
							//шаблон блока
							$temp [$control ['parent_id']] [$this->data_ptm ['ptm_build_table'] [$control ['parent_id']] ['temp_s_code']] .= Controller::Template ( $this->data_ptm ['ptm_build_table'] [$control ['pt_id']] ['temp_s_name'], $temp [$control ['pt_id']] );
							break;
						}
					case 't_temp_hhd' :
						{
							//шаблон страницы
							return $this->processWebTKD ( $this->data_ptm ['ptm_build_table'] [$control ['pt_id']] ['temp_s_name'], $temp [$control ['pt_id']], $w_title, $w_key, $w_desc );
							break;
						}
				}
			}
		}
		return;
	}
	
	/* Функция: подучаем сформированные данные от контроллов
    * @return 
    */
	private function processWebTKD($fileTemplate, $body, $p_w_title = NULL, $p_w_keyw = NULL, $p_w_desc = NULL) {
		return Controller::Template ( $fileTemplate, array_merge ( $body, array ("p_w_title" => $this->buildMetaTitleField ( $p_w_title ), "p_w_keyw" => ($p_w_keyw ? $p_w_keyw : $this->data_ptm ['active_page_data'] ['p_w_keyw']), "p_w_desc" => $this->buildMetaDescriptionField ( $p_w_desc ), "BrowserVersion" => $this->browser_detection (), "cookie_lang_code" => $_COOKIE ['lang_code'], "PreSrc" => $this->conf ['PreSrc'], "php_self" => $this->data_ptm ['active_page_data'] ['page_url'], "arWords" => $this->arWords ) ) );
	}
	
	/* Функция: 
    * @return 
    */
	private function buildMetaTitleField($dataField = null) {
		return ($dataField ? $dataField : ($this->data_ptm ['active_page_data'] ['p_w_title'] ? $this->data_ptm ['active_page_data'] ['p_w_title'] : $this->data_ptm ['active_page_data'] ['p_w_menu'] . $this->arWords ['standartTitle']));
	}
	/* Функция: 
    * @return 
    */
	private function buildMetaDescriptionField($dataField = null) {
		return ($dataField ? $dataField : ($this->data_ptm ['active_page_data'] ['p_w_desc'] ? $this->data_ptm ['active_page_data'] ['p_w_desc'] : $this->data_ptm ['active_page_data'] ['p_w_menu'] . $this->arWords ['standartDescription'] . $this->data_ptm ['active_page_data'] ['p_w_menu']));
	}
	/* Функция: определения версии браузера
    * @return 
    */
	public function browser_detection() {
		$user_agent = $_SERVER ['HTTP_USER_AGENT'];
		if (stristr ( $user_agent, 'MSIE 9.0' ))
			return "IE9";
		if (stristr ( $user_agent, 'MSIE 8.0' ))
			return "IE8";
		if (stristr ( $user_agent, 'MSIE 7.0' ))
			return "IE7";
		if (stristr ( $user_agent, 'MSIE 6.0' ))
			return "IE6";
		if (stristr ( $user_agent, 'Chrome' ))
			return "CH";
		if (stristr ( $user_agent, 'Firefox' ))
			return "FF";
		if (stristr ( $user_agent, 'Opera' ))
			return "OP";
		if (stristr ( $user_agent, 'Safari' ))
			return "SF";
		return $browserIE = "FF";
		;
	}
}
?>