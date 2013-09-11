<?php
class renderHtmlLink {
	public $cssArr;
	public $jsArr;
	public function __construct() {
		$this->cssArr= array();
		$this->jsArr= array();
	}
	
	public function addCss($name) {
		array_push ( $this->cssArr, $name );
	}
	public function addJs($name) {
		array_push ( $this->jsArr, $name );
	}
	public function renderCss() {
		$ret = "";
		if ($this->cssArr != null) 
			foreach ( $this->cssArr as $key => $value ) {
				$ret .= sprintf ( "<link rel=\"stylesheet\" href=\"/%s.css\">", $value );
			}
		return $ret;
	}
	public function renderJs() {
		$ret = "";
		if ($this->jsArr != null) 
			foreach ( $this->jsArr as $key => $value ) {
				$ret .= sprintf ( "<script type=\"text/javascript\" src=\"/%s.js\"></script>", $value );
			}
		return $ret;
	}
}