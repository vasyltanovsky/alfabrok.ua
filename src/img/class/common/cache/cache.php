<?php
class cacheClass {
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
	
	public function __construct($cachetime = 3600, $cachepage = null, $tbl_cache = 'cache_site', $on_cache = null) {
		$this->cachedir = $_SERVER ['DOCUMENT_ROOT'] . "/cache/pages/";
		$this->cachetime = $cachetime;
		$this->cachepage = $cachepage;
		$this->tbl_cache = $tbl_cache;
		$this->on_cache = $on_cache;
		
	//$this->checking_inclusion();
	}
	
	#	проверка на включение кеширования
	function checking_inclusion() {
		$this->cachetime = 6000;
		$this->on_cache = true;
		$this->this_pages ();
		return;
	}
	
	#	формирования имени страници для кеширования
	function this_pages() {
		$thispage = 'http://' . $_SERVER ['HTTP_HOST'] . $_SERVER ['REQUEST_URI'] . $this->getCookieList ( $_COOKIE ) . browserDetectionClass::getItem ();
		$this->cachepage = $this->cachedir . 'page-' . md5 ( $thispage );
		return;
	}
	
	function getCookieList() {
		$arr ["lang_id"] = $_COOKIE ["lang_id"];
		$arr ["lang_code"] = $_COOKIE ["lang_code"];
		return implode ( $arr );
	}
	
	#	проверка на существование кешированного файла
	function checking_existence() {
		if ($this->on_cache == 0)
			return;
		
		if (file_exists ( $this->cachepage )) {
			$cachelink_time = filemtime ( $this->cachepage );
			if ((time () - $this->cachetime) < $cachelink_time) {
				return file_get_contents ( $this->cachepage );
			}
		}
		
		ob_start ();
	}
	
	#	создание кешированного файла
	function creation_page() {
		$isCreatePage = true;
		if (file_exists ( $this->cachepage )) {
			$cachelink_time = filemtime ( $this->cachepage );
			if ((time () - $this->cachetime) < $cachelink_time) {
				$isCreatePage = false;
			}
		}
		
		if ($isCreatePage) {
			$fp = fopen ( $this->cachepage, 'w' );
			fwrite ( $fp, ob_get_contents () );
			fclose ( $fp );
			ob_end_flush ();
		}
	}

}
?>