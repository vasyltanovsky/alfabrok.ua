<?php
class vakansiiProviderClass extends providerClass {
	public function getItem($url) {
		$ret = "";
		if ($url) {
			$ret = $this->mysql->select_table_id ( sprintf ( "where url='%s'", $url ) );
		}
		return $ret;
	}
	public function getList($param) {
		$res = null;
		$query = "";
		if (! empty ( $param["type_id"] ))
			$query .= " and p.type_id = '{$param["type_id"]}'";
		$this->mysql->select_table_query ( "select p.* from {$this->table} p
										    WHERE 1= 1 {$query} order by p.pos desc", $this->id );
		$this->list = $this->mysql->table;
		$this->listBuild = $this->mysql->buld_table;
		if (! empty ( $this->mysql->table )) {
			return array(
					"resTable" => $this->list,
					"resBuildTable" => $this->listBuild);
		} else
			return $res;
	}
}