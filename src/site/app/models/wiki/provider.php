<?php
class wikiProviderClass extends providerClass {
	public function getItem($id) {
		$ret = "";
		if ($id) {
			$ret = $this->mysql->select_table_id ( sprintf ( "where w_menu_name='%s'", $id ) );
		}
		return $ret;
	}
	public function getList($param) {
		$res = null;
		$query = "";
		$this->mysql->select_table_query ( "select p.* from {$this->table} p
										    WHERE 1= 1 {$query} order by p.w_menu_name", $this->id );
		$this->list = $this->mysql->table;
		$this->listBuild = $this->mysql->buld_table;
		if (! empty ( $this->mysql->table )) {
			return array (
					"resTable" => $this->list,
					"resBuildTable" => $this->listBuild 
			);
		} else
			return $res;
	}
	function getArticleList($param) {
		$res = "";
		$query = "";
		if (! empty ( $param ["wiki_id"] ))
			$query .= "and w.wiki_id = {$param[wiki_id]}";
		$this->mysql->select_table_query ( "select w.* from wiki_articles w
											WHERE 1= 1 {$query} order by w.id desc", $this->id );
		
		if (! empty ( $this->mysql->table )) {
			return $this->mysql->table;
		}
		return $res;
	}
	function getImmovablesList($param) {
		$res = "";
		$query = "";
		if (! empty ( $param ["wiki_id"] ))
			$query .= "and w.wiki_id = {$param[wiki_id]}";
		$this->mysql->select_table_query ( "select w.*, i.* from wiki_immovables w
											left join immovables i on w.im_id = i.im_id and i.hide = 'show'
										    WHERE 1= 1 {$query} order by i.im_id desc", $this->id );
		
		if (! empty ( $this->mysql->table )) {
			return $this->mysql->table;
		}
		return $res;
	}
}