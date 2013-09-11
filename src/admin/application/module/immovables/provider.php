<?php
/**
 * @author Alex Tsurkin
 *
 */
class ImmovablesProvider extends Provider {
	/**
	 * @param array() $param
	 * @return multitype:NULL Ambigous <unknown, multitype:> |NULL
	 */
	public function GetList($param = array()) {
		$res = null;
		$query = "";
		if (! empty ( $param ['im_code'] ))
			$query .= " and i.im_code LIKE '%{$param ["im_code"]}%'";
		
		$catData = new mysql_select ( $this->table );
		$catData->select_table_query ( "select i.*
										from {$this->table} i
										WHERE i.im_id IS NOT NULL {$query} order by i.im_date_add desc ", $this->id );
		if (! empty ( $catData->table )) {
			$this->resTable = $catData->table;
			$this->resBuildTable = $catData->buld_table;
			return array ("resTable" => $this->resTable, "resBuildTable" => $this->resBuildTable );
		} else
			return $res;
	}
	
	public function GetJsonList($param = array()) {
		//$cl_sel_position = new mysql_select ( $tbl_dictionaries, "WHERE lang_id = $_COOKIE[lang_id] and dict_name like '%{$_GET['term']}%'", "ORDER BY dict_name ASC" );
		//		$cl_sel_position->select_table_query ( "select dict_id as id, dict_name as value, dict_name as label from {$tbl_dictionaries} where lang_id = $_COOKIE[lang_id] {$query} and dict_name like '%{$_GET['term']}%' ORDER BY dict_name asc", "id" );

		$res = null;
		$query = "";
		if (! empty ( $param ['term'] ))
			$query .= " and r.{$param['field_name']} LIKE '%{$param ['term']}%'";
		$catData = new mysql_select ( $this->table );
		$catData->select_table_query ( "select r.{$param[field_name]} as value
										from {$this->table} r
										left join system_accounts u on r.user_id = u.id_account	
										left join dictionaries d on r.type_id = d.dict_id and d.lang_id = {$_COOKIE[lang_id]}
										WHERE r.rc_id IS NOT NULL {$query} order by r.date_add desc ", $this->id );
		if (! empty ( $catData->table )) {
			$this->resTable = $catData->table;
			$this->resBuildTable = $catData->buld_table;
			return array ("resTable" => $this->resTable, "resBuildTable" => $this->resBuildTable );
		} else
			return $res;
	}
	
	public function GetItem($id) {
		if (! $id)
			return null;
		$data = new mysql_select ( $this->table );
		return $data->select_table_id ( sprintf ( " where rc_id = '%s'", $id ) );
	}
	
	public function UpdateItem($id, $array) {
		$Data = new mysql_select ( $this->table );
		$Data->update_table ( "where rc_id = '{$id}'", $array );
		return TRUE;
	}
	
	public function SaveItem($array = array()) {
		$sql = sprintf ( "insert into reference_customers (rc_fio, rc_tel, type_id, rc_summary, date_add, user_id)
							values('%s', '%s', '%s', '%s', NOW(), %s)", $array ["rc_fio"], $array ["rc_tel"], $array ["type_id"], $array ["rc_summary"], $_COOKIE ["id_account"] );
		if (! mysql_query ( $sql ))
			throw new ExceptionMySQL ( mysql_error (), $sql, "ERROR" );
		return;
	}
}
