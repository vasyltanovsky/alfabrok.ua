<?php
class exchangeRateClass extends providerClass {
	public function __construct() {
		$this->id = "code";
		$this->table = "exchange_rate";
		$this->GetList ();
	}
	
	/**
	 * @param array() $param
	 * @return multitype:NULL Ambigous <unknown, multitype:> |NULL
	 */
	public function GetList($param = array()) {
		$res = null;
		$query = "";
		if (! empty ( $param ['code'] ))
			$query .= " and e.code LIKE '%{$param ["code"]}%'";
		if (! empty ( $param ['date_update'] ))
			$query .= " and e.date_update='{$param ["date_update"]}'";
		$Data = new mysql_select ( $this->table );
		$Data->select_table_query ( "select e.*
										from {$this->table} e
										WHERE e.id IS NOT NULL {$query} order by e.date_update desc ", $this->id );
		if (! empty ( $Data->table )) {
			$this->list = $Data->table;
			$this->listBuild = $Data->buld_table;
			return array ("resTable" => $this->list, "resBuildTable" => $this->listBuild );
		} else
			return $res;
	}
	
	public function GetItemData($code) {
		if (is_array ( $this->listBuild )) {
			if (isset ( $this->listBuild [$code] ))
				return $this->listBuild [$code] ["exchange"];
		} else {
			$item = $this->GetItem ( "", $code );
			return $item ["exchange"];
		}
	}
	
	public function GetItem($id = "", $code = "") {
		$where = "";
		if (! empty ( $id ))
			$where = sprintf ( " where id = '%s'", $id );
		if (! empty ( $code ))
			$where = sprintf ( " where code = '%s'", $code );
		$data = new mysql_select ( $this->table );
		return $data->select_table_id ( $where );
	}
	
	public function UpdateItem($id = "", $code = "", $array) {
		$Data = new mysql_select ( $this->table );
		$where = "";
		if (! empty ( $id ))
			$where = "where id = '{$id}'";
		if (! empty ( $code ))
			$where = "where code = '{$code}'";
		$Data->update_table ( $where, $array );
		return TRUE;
	}
	
	public function SaveItem($array = array()) {
		$sql = sprintf ( "insert into exchange_rate (code, exchange, date_update)
							values('%s', '%s', NOW())", $array ["code"], $array ["exchange"] );
		if (! mysql_query ( $sql ))
			throw new ExceptionMySQL ( mysql_error (), $sql, "ExchangeRateProvider::SaveItem ERROR" );
		return;
	}
}