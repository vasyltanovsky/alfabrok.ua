<?php
class vakansiiModelClass extends modelClass {
	public $typeVakansiiList;
	public function __construct($provider) {
		parent::__construct ( $provider );
		$this->getTypeVakansii ();
	}
	public function getItem($url) {
		$this->item = $this->provider->getItem ( $url );
	}
	public function getList($param) {
		$res = $this->provider->getList ( $param );
		$this->list = $res["resTable"];
		$this->listData = $res["resBuildTable"];
	}
	public function getTypeVakansii() {
		$this->buildDictionaries ();
		$this->dictionaries->do_dictionaries ( 77 );
		$this->typeVakansiiList = $this->dictionaries->my_dct;
	}
}