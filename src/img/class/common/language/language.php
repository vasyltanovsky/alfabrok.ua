<?php
#����������� ������
class languageClass {
	public $lang_post;
	public $cookie_lang_code;
	public $cookie_lang_id;
	public $lang_code;
	public $lang_id;
	public $set_cookie;
	public $table_lang;
	// ����������� ������
	public function __construct($lang_post = NULL, $cookie_lang_code = NULL, $cookie_lang_id = NULL, $lang_code = ru, $lang_id = NULL, $set_cookie = NULL, $table_lang = NULL) {
		$this->lang_post = $lang_post;
		$this->cookie_lang_code = $cookie_lang_code;
		$this->cookie_lang_id = $cookie_lang_id;
		#��������� ��������� �����
		$this->lang_code = $lang_code;
		$this->lang_id = $lang_id;
		#���������� ������� ��� true ��������� ��������� cookie 
		$this->set_cookie = $set_cookie;
		#������� ������
		$this->table_lang = $table_lang;
	}
	
	#### ������ �������
	public function select_table($code) {
		$result = mysql_query ( "SELECT * FROM language WHERE lang_code = '" . $code . "' " ) or die ( "Invalid query: " . mysql_error () );
		
		$this->table_lang = mysql_fetch_array ( $result );
		return $this->table_lang;
	}
	
	public function do_this() {
		if (empty ( $this->cookie_lang_code )) {
			#�� ������� ������ ���������� �������� �����
			$this->select_table ( $this->lang_code );
			$this->lang_code = $this->table_lang [lang_code];
			$this->lang_id = $this->table_lang [lang_id];
			return $this->set_cookie = true;
		} else {
			$this->lang_code = $this->cookie_lang_code;
			$this->lang_id = $this->cookie_lang_id;
			
			if ($this->lang_post) {
				if ($this->lang_post != $this->lang_code) {
					$this->select_table ( $this->lang_post );
					
					$this->lang_code = $this->table_lang [lang_code];
					$this->lang_id = $this->table_lang [lang_id];
					return $this->set_cookie = true;
				}
			
			}
		}
	}
	
	public function do_get_this($GetLangId) {
		if (empty ( $GetLangId )) {
			$this->select_table ( $this->lang_code );
			$this->lang_code = $this->table_lang [lang_code];
			$this->lang_id = $this->table_lang [lang_id];
			return $this->set_cookie = true;
		} else {
			$this->lang_code = $this->cookie_lang_code;
			$this->lang_id = $this->cookie_lang_id;
			
			if ($GetLangId) {
				if ($GetLangId != $this->cookie_lang_code) {
					$this->select_table ( $GetLangId );
					if (empty ( $this->table_lang )) {
						$this->select_table ( $this->lang_code );
					}
					$this->lang_code = $this->table_lang [lang_code];
					$this->lang_id = $this->table_lang [lang_id];
					return $this->set_cookie = true;
				}
			
			}
		}
	}
}