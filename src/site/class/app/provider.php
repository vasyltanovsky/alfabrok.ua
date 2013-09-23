<?php
class providerClass {
	public $table;
	public $orderby;
	public $ordersort;
	public $limit;
	public $id;
	
	public $mysql;
	
	public $list;
	public $listBuild;
	
	public $pagerparamafter;
	public $pagerlink;
	public $pager;
	
	public function __construct($table, $id = "id", $orderby = "id", $ordersort = "asc", $limit = "10") {
		$this->table = $table;
		$this->orderby = $orderby;
		$this->ordersort = $ordersort;
		$this->limit = $limit;
		$this->id = $id;
		
		$this->mysql = new mysql_select ( $this->table );
	}
	public function SetValue($field, $value) {
		if (! empty ( $value ))
			$this->$field = $value;
	}
	
	public function getItem($id) {
	}
	public function getList($param) {
	}
	/*
	public function getListPager($param, $page_id = 1, $orderby = "id", $ordersort = "asc", $limit = "10") {
		$this->SetValue ( "orderby", $orderby );
		$this->SetValue ( "ordersort", $ordersort );
		$this->SetValue ( "limit", $limit );
		
		$obj = new pager_mysql_right ( $tbl_im, $WhereImmovableQuery, $WhereImmovableOrder, $_COOKIE ['im_f_show_pnumber'], /* Число позиций на странице
5,  Число ссылок в постраничной навигации
"/$_GET[1]/$_GET[type_cat]", /* Объявляем объект постраничной навигации 
$ImFormSearchArray );
		$ImData = $obj->get_page ();
	
	}*/
	public function saveItem($param) {
	}
	public function deleteItem($id) {
	}

}