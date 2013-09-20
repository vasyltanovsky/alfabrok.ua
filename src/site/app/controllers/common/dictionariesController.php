<?php
class dictionariesController extends aControllerClass {
	public function getdictvaluelist($param) {
		$data["success"] = true;
		$query = "where 1 = 1 and hide = 1";
		if (! empty ( $param["term"] ))
			$query .= " and dict_name LIKE '%" . $param["term"] . "%'";
		if (! empty ( $param["ld_id"] ))
			$query .= " and ld_id = {$param["ld_id"]}";
		$provider = new mysql_select ();
		$sql = sprintf ( "select * from dictionaries %s order by  dict_name asc %s", $query, (! empty ( $param["limit"] ) ? sprintf ( " limit %s", $param["limit"] ) : "") );
		$provider->select_table_query ( $sql );
		$ret = array();
		if ($provider->table) {
			foreach ( $provider->table as $key => $value ) {
				$ret[] = array(
						"id" => $value["dict_id"],
						"label" => $value["dict_name"]);
			}
		}
		return $this->getJson ( $ret );
	}
}