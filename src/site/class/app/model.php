<?php
class modelClass {
	public $item;
	public $list;
	public $listBuild;
	public $dictionaries;
	public $pager;
	public $routingObj;
	public $provider;
	public function __construct($provider) {
		$this->provider = $provider;
		global $routingObj;
		$this->routingObj = $routingObj;
	}
	public function getItemId($id) {
	}
	public function getList($param) {
	}
	public function saveItem($param) {
	}
	public function deleteItem($id) {
	}
	public function buildDictionaries() {
		$this->dictionaries = new dictionariesClass ();
		$this->dictionaries->buid_dictionaries_list ( "list_dictionaries" );
		$this->dictionaries->buid_dictionaries ( "dictionaries", "WHERE lang_id = {$_COOKIE['lang_id']} and hide = true ORDER BY dict_id" );
	}
}