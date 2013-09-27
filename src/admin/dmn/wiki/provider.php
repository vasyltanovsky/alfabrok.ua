<?php
/**
 * @author Alex Tsurkin
 *
 */
class WikiProvider extends Provider {
	public function GetItemList($param = array()) {
		$res = null;
		$query = "";
		if (! empty ( $param['w_menu_name'] ))
			$query .= " and v.w_menu_name like '%{$param ["w_menu_name"]}%'";
		if (! empty ( $param['w_synonyms'] ))
			$query .= " and v.w_synonyms like '%{$param ["w_synonyms"]}%'";
		$catData = new mysql_select ( $this->table );
		$catData->select_table_query ( "select v.*
										from {$this->table} v
										WHERE 1=1 {$query} order by v.id desc", $this->id );
		if (! empty ( $catData->table )) {
			$this->resTable = $catData->table;
			$this->resBuildTable = $catData->buld_table;
			return array(
					"resTable" => $this->resTable,
					"resBuildTable" => $this->resBuildTable);
		} else
			return $res;
	}
	public function GetItem($id) {
		if (! $id)
			return null;
		$data = new mysql_select ( $this->table );
		return $data->select_table_id ( sprintf ( " where id = '%s'", $id ) );
	}
	public function SaveItem($array = array()) {
		$sql = sprintf ( "INSERT INTO `wiki`(`w_menu_name`, `w_w_title`, `w_w_keywords`, `w_w_description`, `w_synonyms`) VALUES ('%s','%s','%s','%s','%s')", $array["w_menu_name"], $array["w_w_title"], $array["w_w_keywords"], $array["w_w_description"], $array["w_synonyms"] );
		if (! mysql_query ( $sql ))
			$ret["error"] = mysql_error ();
		$ret["id"] = mysql_insert_id ();
		return $ret;
	}
	public function UpdateItem($id, $array) {
		$Data = new mysql_select ( $this->table );
		$Data->update_table ( "where id = {$id}", $array );
		return TRUE;
	}
	public function GetArticleList($param = array()) {
		$res = null;
		$query = "";
		if (! empty ( $param['wiki_id'] ))
			$query .= " and v.wiki_id={$param ["wiki_id"]}";
		if (! empty ( $param['wa_title'] ))
			$query .= " and v.wa_title like '%{$param ["wa_title"]}%'";
		
		$catData = new mysql_select ( $this->table );
		$catData->select_table_query ( "select v.*, w.w_menu_name
				from {$this->table} v
				left join wiki w on v.wiki_id = w.id	
				WHERE 1=1 {$query} order by v.id desc", $this->id );
		if (! empty ( $catData->table )) {
			$this->resTable = $catData->table;
			$this->resBuildTable = $catData->buld_table;
			return array(
					"resTable" => $this->resTable,
					"resBuildTable" => $this->resBuildTable);
		} else
			return $res;
	}
	public function GetArticle($id) {
		if (! $id)
			return null;
		$data = new mysql_select ( $this->table );
		return $data->select_table_id ( sprintf ( " where id = '%s'", $id ) );
	}
	public function SaveArticle($array = array()) {
		$sql = sprintf ( "INSERT INTO `wiki_articles`(`wiki_id`, `wa_title`, `wa_summary`) VALUES ('%s','%s','%s')", $array["wiki_id"], $array["wa_title"], $array["wa_summary"] );
		if (! mysql_query ( $sql ))
			$ret["error"] = mysql_error ();
		$ret["id"] = mysql_insert_id ();
		return $ret;
	}
	public function UpdateArticle($id, $array) {
		$Data = new mysql_select ( $this->table );
		$Data->update_table ( "where id = {$id}", $array );
		return TRUE;
	}
}
