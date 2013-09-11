<?php
/**
 * 
 */
class CacheSite {
	#	дериктория для кешированных вайлов
	public $cachedir;
	#	время жизни файлов	
	public $cachetime;
	#	страница кеширования
	public $cachepage;
	#	таблица с данными настройкам кеша
	public $tbl_cache;
	#	ключения кеша
	public $on_cache;
	
	public function __construct($cachedir = 'cache_files/', $cachetime = 3600, $cachepage = null, $tbl_cache = 'cache_site', $on_cache = null) {
		$this->cachedir = $cachedir;
		$this->cachetime = $cachetime;
		$this->cachepage = $cachepage;
		$this->tbl_cache = $tbl_cache;
		$this->on_cache = $on_cache;
		
	//$this->checking_inclusion();
	}
	
	#	проверка на включение кеширования
	function checking_inclusion() {
		#	выборка данных о кешированние
		$cl_sel_builder = new mysql_select ( $this->tbl_cache );
		$SelSetting = $cl_sel_builder->select_table_id ( "WHERE cs_id = 1" );
		
		//if$_SERVER['REQUEST_URI']	
		

		if ($SelSetting ['is_cache_on']) {
			$this->cachetime = $SelSetting ['time_cache'];
			$this->on_cache = $SelSetting ['is_cache_on'];
			$this->this_pages ();
		}
		
		return;
	}
	
	#	формирования имени страници для кеширования
	function this_pages() {
		$thispage = 'http://' . $_SERVER ['HTTP_HOST'] . $_SERVER ['REQUEST_URI'];
		$this->cachepage = $this->cachedir . md5 ( $thispage ) . ".html";
		return;
	}
	
	#	проверка на существование кешированного файла
	function checking_existence() {
		if ($this->on_cache == 0)
			return;
		
		if (file_exists ( $this->cachepage )) {
			$cachelink_time = filemtime ( $this->cachepage );
			if ((time () - $this->cachetime) < $cachelink_time) {
				readfile ( $this->cachepage );
				die ();
			}
		}
		
		ob_start ();
	}
	
	#	создание кешированного файла
	function creation_page() {
		if ($this->on_cache == 0)
			return;
		
		$fp = fopen ( $this->cachepage, 'w' );
		fwrite ( $fp, ob_get_contents () );
		fclose ( $fp );
		ob_end_flush ();
	}

}
?>