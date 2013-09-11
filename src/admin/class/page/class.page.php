<?php
# ========================================================================#
#
#  Author:    Alex Tsurkin
#  Version:	  1.0
#  Date:      01.11.2010
#  Purpose:   движок сайта
#  Requires : Requires PHP5, GD library.
#  Usage Example:
#                     $PageObj = new Page( $CONFIG, $temp, $tbl, $arWords);
#                     $PageObj -> createPage();
#                     $PageObj -> printPage();
#
# ========================================================================#
class Page {
	//данные настройки сайта	
	public $conf;
	//шаблоны .inc	
	public $templates;
	public $arWords;
	public $tbl;
	//массив _GET
	private $GET;
	//	
	private $html_temlate_page;
	//класс справочников	
	private $dict;
	//имя автивной страницы	
	private $PHP_SELF;
	//сформированная страница	
	private $create_page;
	//	данные активной страницы с таблиц (pages_structure, pages_module,  pages_temp_mod)
	private $data_PTM;
	private $cache;
	
	// Конструктор класса
	public function __construct($conf, $tbl, $arWords) {
		$this->conf = $conf;
		$this->tbl = $tbl;
		$this->arWords = $arWords;
		$this->PHP_SELF = PageGet::getPagePhpself ();
		$this->GET = PageGet::getPageGetArr ();
		$this->dict = $this->getDictionary ();
		$this->cache = new CacheSite ( );
	}
	/* Функция: запускает подключенные модули страницы
     * @return данные по этому полю
     */
	private function processPageModule() {
		if ($this->GET ['statistic'])
			echo "<br><b>Page Modules Start! Count:" . count ( $this->data_PTM ['page_modules'] ) . "</b><br>";
		foreach ( $this->data_PTM ['page_modules'] as $value ) {
			$ModulePage = new $value ['parent_s_name'] ( $this->tbl, $this->conf, $this->arWords, $this->templates );
			if ($value ['pm_val'])
				$ModulePage->$value ['m_s_name'] ( $value ['pm_val'] );
			else
				$ModulePage->$value ['m_s_name'] ();
		}
		return;
	}
	/* Функция: производит выборку модулей активной страницы
	 * @param $namePage - имя активной страницы
     * @return $this->data_PTM ['page_modules'] - модули активной страницы
     */
	private function getPageModule($namePage) {
		$selPageModuleData = new mysql_select ( );
		$selPageModuleData->select_table_query ( "select pm.*, m.m_name, m.parent_id, m.m_s_name, m.m_type, mp.m_s_name as parent_s_name from {$this->tbl['pages_module']['name']} pm 
												 left join {$this->tbl['modules']['name']} m on pm.m_id = m.m_id
												 left join {$this->tbl['modules']['name']} mp on m.parent_id = mp.m_id
												 where pm.page_id = '{$namePage}' order by pm.pos" );
		if ($selPageModuleData->table)
			return $this->data_PTM ['page_modules'] = $selPageModuleData->table;
		else
			return false;
	}
	
	/* Функция: формирует страницы
     * @return $this->createPage
     */
	public function createPage() {
		//выбирает все страницы с таблицы pages_temp_mod
		$selPageData = new mysql_select ( );
		$selPageData->select_table_query ( "select ps.*, pr.page_url as page_parent_url  from {$this->tbl['pages_structure']['name']} ps 
											left join {$this->tbl['pages_structure']['name']} pr on pr.page_id = ps.parent_id 
											where ps.lang_id = {$_COOKIE['lang_id']} and ps.hide = 1 group by ps.page_id order by ps.pos ", 'page_id' );
		$this->data_PTM ['pages_data_table'] = $selPageData->table;
		$this->data_PTM ['pages_data_buld_table'] = $selPageData->buld_table;
		
		//находим активную страницу
		//$this->data_PTM ['active_page_data'] 	= $selPageData->buld_table [$this->PHP_SELF];
		$selActivePageData = new mysql_select ( $this->tbl ['pages_structure'] ['name'] );
		$this->data_PTM ['active_page_data'] = $selActivePageData->select_table_id ( "where lang_id = {$_COOKIE['lang_id']} and page_url = '{$this->PHP_SELF}' and hide = 1 
																					   or  lang_id = {$_COOKIE['lang_id']} and page_id = '{$this->PHP_SELF}' and hide = 1" );
		
		$this->data_PTM ['active_page'] = $this->PHP_SELF = $this->data_PTM ['active_page_data'] ['page_id'];
		//кеширование страницы
		$cache = $this->isCachePage ( 'start', $this->data_PTM ['active_page_data'] ['is_cache'] );
		if ($cache) {
			$this->create_page = $cache;
			return;
		}
		//
		if (empty ( $this->data_PTM ['active_page_data'] )) {
			$FC = new FileReader ( );
			$this->create_page = $FC->get_file_content ( DOC_ROOT . '/application/includes/templates/page/', 'page-404.html' );
			return;
		}
		//запускаем подключенные модули
		if ($this->getPageModule ( $this->PHP_SELF ))
			$this->processPageModule ();
			//запускаем обработку подключенных шаблонов 
		$selPageTempModData = new mysql_select ( );
		$selPageTempModData->select_table_query ( "select ptm.*, t.temp_id, t.temp_name, t.temp_type, t.temp_s_name, t.temp_s_code, t.parent_id as t_parent_id, m.m_name, m.parent_id as m_parent_id, m.m_s_name, m.m_type, mp.m_s_name as parent_s_name from {$this->tbl['ptm']['name']} ptm 
													left join {$this->tbl['modules']['name']} m on ptm.mod_id = m.m_id
												 	left join {$this->tbl['modules']['name']} mp on m.parent_id = mp.m_id
												 	left join {$this->tbl['templates']['name']} t on ptm.temp_id = t.temp_id
												 	where ptm.page_id = '{$this->PHP_SELF}' order by ptm.pos_temp_id desc", 'pt_id' );
		if ($this->GET ['statistic'])
			echo "<br><b>Page templates Module Count:" . count ( $selPageTempModData->table ) . "</b><br>";
		
		if (! empty ( $selPageTempModData->table )) {
			//фомируем структуру в древовидной форме
			$ptm_tree = new CatalogHadler ( $selPageTempModData->table, $selPageTempModData->buld_table, 'm_name', 'pt_id', 'parent_id' );
			$ptm_tree->get_arr_formation ();
			//присваиаваем переменные
			$this->data_PTM ['ptm'] = $selPageTempModData->table;
			$this->data_PTM ['ptm_build_table'] = $selPageTempModData->buld_table;
			$this->data_PTM ['ptm_tree'] = $ptm_tree->ArrFormation;
			if ($this->GET ['statistic'])
				echo "<br><b>Start Class Controls:</b><br>";
				//обьеявления класс контроллов
			$ClControls = new ptm ( $this->data_PTM, $this->conf, $this->GET, $this->dict, $this->arWords, $this->templates, $this->tbl );
			$ClControls->processControls ();
			//получаем содержимое страницы
			if ($create_page = $ClControls->getDataControls ())
				return $this->create_page = $create_page;
			else
				return die ( "ERROR. Страница не сформирована!" );
		} else
			return die ( "ERROR. Нет подключенных шаблонов!" );
	}
	
	/* Функция: выводит страницу
     */
	public function printPage() {
		echo $this->create_page;
		//кеширование (сохранение сформированной страницы)
		$this->isCachePage ( 'end', $this->data_PTM ['active_page_data'] ['is_cache'] );
		return;
	}
	/* Функция: возвращает значение указанного поля класса page
     * @param  $field - имя поля
     * @return данные по этому полю
     */
	public function getSomeField($field) {
		return $this->$field;
	}
	// Перегрузка специального метода __toString()
	/* Функция: 
     * @param  
     * @return 
     */
	public function __toString() {
	}
	/* Функция: функция вызывает класс справочника формирования справочников и их значений 
     * @return $dictionaries - класс справочника
     */
	private function getDictionary() {
		$dictionaries = new dictionaries ( );
		$dictionaries->buid_dictionaries_list ( $this->tbl ['list_dict'] ['name'] );
		$dictionaries->buid_dictionaries ( $this->tbl ['dict'] ['name'], "WHERE lang_id = {$_COOKIE['lang_id']} ORDER BY dict_name ASC" );
		return $dictionaries;
	}
	/* Функция: производит проверку и кеширование страницы
	 * @param $action - действие начало, завершение кеширования
	 * @param $pageData - данные страницы по кешированию
     * @return 
     */
	private function isCachePage($action, $is_cache) {
		//		echo $is_cache;
		if (! $is_cache)
			return false;
		if ($action == 'start') {
			$this->cache->checking_inclusion ();
			return $this->cache->checking_existence ();
		}
		if ($action == 'end') {
			$this->cache->creation_page ();
		}
		return;
	}
}
?>