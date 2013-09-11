<?php
/**
 * @author Alex Tsurkin
 *
 */
class ReferenceCustomersProvider extends Provider {
	/**
	 * @param array() $param
	 * @return multitype:NULL Ambigous <unknown, multitype:> |NULL
	 */
	public function GetList($param = array()) {
		if ((empty($param ['rc_fio']) || mb_strlen($param ['rc_fio'], 'UTF-8') < 5) &&
			(empty($param ['rc_tel']) || mb_strlen($param ['rc_tel'], 'UTF-8') < 5) &&
			(empty($param ['rc_summary']) || mb_strlen($param ['rc_summary'], 'UTF-8') < 5) &&
			(empty($param ['type_id']) || mb_strlen($param ['type_id'], 'UTF-8') < 5) &&
			(empty($param ['date_add']) || mb_strlen($param ['date_add'], 'UTF-8') < 5) &&
			(empty($param ['user_id']) || mb_strlen($param ['user_id'], 'UTF-8') < 5))
		{
			return;
		}
		$res = null;
		$query = "";
		if (!empty($param ["rc_tel"]))
		{
			preg_match_all('!\d+!', $param ["rc_tel"], $tel_matches);
			$tel = implode("", $tel_matches[0]);
		}
		if (! empty ( $param ['rc_fio'] ))
			$query .= " and r.rc_fio LIKE '%{$param ["rc_fio"]}%'";
		if (! empty ( $param ['rc_tel'] ))
			$query .= " and r.rc_tel LIKE '%{$tel}%'";
		if (! empty ( $param ['rc_summary'] ))
			$query .= " and r.rc_summary LIKE '%{$param ["rc_summary"]}%'";
		if (! empty ( $param ['type_id'] ))
			$query .= " and r.type_id='{$param ["type_id"]}'";
		if (! empty ( $param ['date_add'] ))
			$query .= " and r.date_add='{$param ["date_add"]}'";
		if (! empty ( $param ['user_id'] ))
			$query .= " and r.user_id='{$param ["user_id"]}'";
		$catData = new mysql_select ( $this->table );
		$catData->select_table_query ( "select r.*, u.*
										from {$this->table} r
										left join system_accounts u on r.user_id = u.id_account	
										WHERE r.rc_id IS NOT NULL {$query} order by r.date_add desc ", $this->id );
		$typeData = new mysql_select ( $this->table );
		$typeData->select_table_query ( "select d.dict_name, d.dict_id from dictionaries d 
										where d.lang_id = 1 
										and d.dict_id in (select distinct type_id from reference_customers)" );
		$types = array();
		for($i = 0; $i < count($typeData->table); $i++)
		{
			$types[$typeData->table[$i]["dict_id"]] = $typeData->table[$i]["dict_name"];
		}
		for($i = 0; $i < count($catData->table); $i++)
		{
			$catData->table[$i][dict_name] = $types[$catData->table[$i][type_id]];
		}
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

		if ((empty($param ['term']) || mb_strlen($param ['term'], 'UTF-8') < 5))
		{
			return null;
		}
		$res = null;
		$query = "";
		if (! empty ( $param ['term'] ))
		{
			if ($param ["field_name"] == "rc_tel")
			{
				preg_match_all('!\d+!', $param ['term'], $tel_matches);
				$param ['term'] = implode("", $tel_matches[0]);
			}
			$query .= " and r.{$param['field_name']} LIKE '%{$param ['term']}%'";
		}
		$catData = new mysql_select ( $this->table );
		$catData->select_table_query ( "select r.{$param[field_name]} as value
										from {$this->table} r
										left join system_accounts u on r.user_id = u.id_account	
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
