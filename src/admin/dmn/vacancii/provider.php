<?php
/**
 * @author Alex Tsurkin
 *
 */
class VacanciiProvider extends Provider {
	/**
	 *
	 * @param array() $param        	
	 * @return multitype:NULL Ambigous <unknown, multitype:> |NULL
	 */
	public function GetVacanciiList($param = array()) {
		$res = null;
		$query = "";
		if (! empty ( $param['type_id'] ))
			$query .= " and v.type_id='{$param ["type_id"]}'";
		if (! empty ( $param['hide'] ))
			$query .= " and v.hide= {$param ["hide"]}";
		if (! empty ( $param['v_id'] ))
			$query .= " and v.v_id='{$param ["v_id"]}'";
		if (! empty ( $param['url'] ))
			$query .= " and v.url='{$param ["url"]}'";
		$catData = new mysql_select ( $this->table );
		$catData->select_table_query ( "select v.*
										from {$this->table} v
										WHERE v.lang_id = {$_COOKIE['lang_id']} {$query} order by v.v_id desc", $this->id );
		if (! empty ( $catData->table )) {
			$this->resTable = $catData->table;
			$this->resBuildTable = $catData->buld_table;
			return array(
					"resTable" => $this->resTable,
					"resBuildTable" => $this->resBuildTable);
		} else
			return $res;
	}
	public function GetVacance($id) {
		if (! $id)
			return null;
		$data = new mysql_select ( $this->table );
		return $data->select_table_id ( sprintf ( " where v_id = '%s'", $id ) );
	}
	public function GetVacanciiListWhisCity($param = array()) {
		$query = "";
		if (! empty ( $param['type_id'] ))
			$query .= " and v.type_id='{$param ["type_id"]}'";
		if (! empty ( $param['hide'] ))
			$query .= " and v.hide= {$param ["hide"]}";
		$catData = new mysql_select ( 'shop_info' );
		$catData->select_table_query ( "select v.*
										from vacancii v
										WHERE v.v_id <> 0 {$query} group by v.city_id", "ct_id" );
		if (empty ( $_GET['city_id'] ))
			$_GET['city_id'] = $catData->table[0]['city_id'];
		if (! empty ( $catData->table )) {
			$this->resTable = $catData->table;
			$this->resBuildTable = $catData->buld_table;
			return array(
					"resTable" => $this->resTable,
					"resBuildTable" => $this->resBuildTable);
		} else
			return $res;
	}
	public function UpdateVacance($id, $array) {
		$Data = new mysql_select ( $this->table );
		$Data->update_table ( "where v_id = {$id} and lang_id = {$_COOKIE['lang_id']}", $array );
		return TRUE;
	}
	public function SaveVacance($array = array()) {
		$array['hide'] = ($array['hide'] ? $array['hide'] : 'NULL');
		$array['url'] = translitStrlover ( $array['title'] );
		if (empty ( $array["pos"] )) {
			$cl_sel_pages = new mysql_select ( 'vacancii' );
			$PosData = $cl_sel_pages->select_table_id ( "WHERE lang_id = {$_COOKIE[lang_id]}" );
			$array["pos"] = $PosData["pos"] + 1;
		}
		$sql = sprintf ( "insert into vacancii (v_id, title, description, text, hide, date, pos, w_title, w_keywords, w_description, type_id, url, lang_id)
							values(null, '%s', '%s', '%s', %s, NOW(), %s, '%s', '%s', '%s', '%s', '%s', #lang_id#)", $array["title"], $array["description"], $array["text"], $array["hide"], $array["pos"], $array["w_title"], $array["w_keywords"], $array["w_description"], $array["type_id"], $array["url"] );
		if (! mysql_query ( str_replace ( "#lang_id#", 1, $sql ) ))
			throw new ExceptionMySQL ( mysql_error (), $sql, "ERROR" );
		$last_id = mysql_insert_id ();
		$this->UpdateVacance ( $last_id, array(
				"url" => sprintf ( "'%s-%s'", $array["url"], $last_id )) );
		
		return;
	}
}
