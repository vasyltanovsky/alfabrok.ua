<?php
class appDataClass {
	public $p_w_title;
	public $p_w_keyw;
	public $p_w_desc;
	
	public function __construct($page = null) {
		if ($page) {
			$this->p_w_title = $page ["title_web"];
			$this->p_w_keyw = $page ["keywords_web"];
			$this->p_w_desc = $page ["description_web"];
		}
	}
	public function appentTitle($data) {
		$this->p_w_title = ($data ? $data . " - " . $this->p_w_title : $this->p_w_title);
	}
	public function appentKeyw($data) {
		$this->p_w_keyw = ($data ? $data . " - " . $this->p_w_keyw : $this->p_w_keyw);
	}
	public function appentDesc($data) {
		$this->p_w_desc = ($data ? $data . " - " . $this->p_w_desc : $this->p_w_desc);
	}
	public function setTitle($data) {
		$this->p_w_title = ($data ? $data : $this->p_w_title);
	}
	public function setKeyw($data) {
		$this->p_w_keyw = ($data ? $data : $this->p_w_keyw);
	}
	public function setDesc($data) {
		$this->p_w_desc = ($data ? $data : $this->p_w_desc);
	}
	public function getTitle() {
		return $this->p_w_title;
	}
	public function getKeyw() {
		return $this->p_w_keyw;
	}
	public function getDesc() {
		return $this->p_w_desc;
	}
}