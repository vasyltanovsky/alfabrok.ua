<?php
class immovablesProviderClass extends providerClass {
	public function getList($param) {
		$res = null;
		$query = "";
		$limit = (! empty ( $param['limit'] ) ? " limit " . $param['limit'] : "");
		$query = $this->buildStandartImmovablesQuery ( $param );
		$this->mysql->select_table_query ( "select i.* from {$this->table} i 
										    {$query} order by im_id desc" . $limit, $this->id );
		$this->list = $this->mysql->table;
		$this->listBuild = $this->mysql->buld_table;
		if (! empty ( $this->mysql->table )) {
			return array(
					"resTable" => $this->list,
					"resBuildTable" => $this->listBuild);
		} else
			return $res;
	}
	public function getListHotPrice($param) {
		$res = null;
		$query = "";
		$limit = (! empty ( $param['limit'] ) ? " limit " . $param['limit'] : "");
		if (! empty ( $param['im_catalog_id'] ))
			$query .= " and i.im_catalog_id='{$param ["im_catalog_id"]}'";
		if (! empty ( $param['hide'] ))
			$query .= " and i.hide = '{$param ['hide']}'";
		$query .= (empty ( $param["is_hot"] ) ? " and i.im_prace < i.im_prace_old" : " and i.im_is_hot = 1");
		
		$this->mysql->select_table_query ( "select i.* from {$this->table} i 
										    WHERE 1=1 {$query} order by rand() " . $limit, $this->id );
		$this->list = $this->mysql->table;
		$this->listBuild = $this->mysql->buld_table;
		if (! empty ( $this->mysql->table )) {
			return array(
					"resTable" => $this->list,
					"resBuildTable" => $this->listBuild);
		} else
			return $res;
	}
	public function buildStandartImmovablesQuery($param) {
		$query = "where 1=1";
		if (! empty ( $param['im_ids'] ))
			$query .= " and i.im_id IN {$param ["im_ids"]}";
		if (! empty ( $param['im_codes'] ))
			$query .= " and i.im_code IN {$param ["im_codes"]}";
		if (! empty ( $param['im_catalog_id'] ))
			$query .= " and i.im_catalog_id='{$param ["im_catalog_id"]}'";
		if (! empty ( $param['hide'] ))
			$query .= " and i.hide='{$param ["hide"]}'";
		if (! empty ( $param['im_is_sale'] ))
			$query .= " and i.im_is_sale={$param ["im_is_sale"]}";
		if (! empty ( $param['im_is_rent'] ))
			$query .= " and i.im_is_rent={$param ["im_is_rent"]}";
		if (! empty ( $param['im_area_id'] ))
			$query .= " and i.im_area_id='{$param ["im_area_id"]}'";
		if (! empty ( $param['im_space'] ))
			$query .= " and i.im_space='{$param ["im_space"]}'";
		if (! empty ( $param['im_space_like'] ))
			$query .= sprintf ( " and i.im_space < %s AND i.im_space > %s", $param['im_space_like'] * 1.25, $param['im_space_like'] * 0.75 );
		if (! empty ( $param['im_prace_like'] ))
			$query .= sprintf ( " and i.im_prace < %s AND i.im_prace > %s", $param['im_prace_like'] * 1.25, $param['im_prace_like'] * 0.75 );
		if (! empty ( $param['im_prace_manth_like'] ))
			$query .= sprintf ( " and i.im_prace_manth < %s AND i.im_prace_manth > %s", $param['im_prace_manth_like'] * 1.25, $param['im_prace_manth_like'] * 0.75 );
		if (! empty ( $param['im_priceb'] ))
			$query .= " and i.im_prace >= {$param ["im_priceb"]}";
		if (! empty ( $param['im_pricee'] ))
			$query .= " and i.im_prace <= {$param ["im_pricee"]}";
		if (! empty ( $param['im_priceb'] ))
			$query .= " and i.im_space >= {$param ["im_spaceb"]}";
		if (! empty ( $param['im_pricee'] ))
			$query .= " and i.im_space <= {$param ["im_spacee"]}";
		if (! empty ( $param['im_date_add'] ))
			$query .= " and i.im_date_add <= '{$param ["im_date_add"]}'";
		if (! empty ( $param['im_date_add_b'] ))
			$query .= " and i.im_date_add >= '{$param ["im_date_add_b"]}'";
		if (! empty ( $param['im_date_add_e'] ))
			$query .= " and i.im_date_add <= '{$param ["im_date_add_e"]}'";
		return $query;
	}
	public function getListPager($param, $page_id = 1, $query = "") {
		if (empty ( $query ))
			$query = $this->buildStandartImmovablesQuery ( $param );
		$obj = new pager_mysql_right ( $this->table . " i", $query, sprintf ( "order by %s %s", $this->orderby, $this->ordersort ), $this->limit, 5, $this->pagerlink, $this->pagerparamafter );
		$this->list = $obj->get_page ();
		$this->pager = $obj;
	}
	public function getItem($id) {
		$ret = "";
		if ($id) {
			$ret = $this->mysql->select_table_id ( sprintf ( "where im_id=%s", $id ) );
		}
		return $ret;
	}
	public function getItemByCode($code) {
		$ret = "";
		if ($code) {
			$ret = $this->mysql->select_table_id ( sprintf ( "where im_code='%s'", $code ) );
		}
		return $ret;
	}
	public function getImagesList($id, $dict_id) {
		$this->mysql->select_table_query ( "SELECT p.*, CONCAT(p.im_photo_id, '.', p.im_file_type) as im_photo_name, i.im_photo as im_main_photo FROM `immovables_photos` p
											left join immovables i on p.im_id = i.im_id
											WHERE p.im_id = {$id} AND p.im_photo_type = '{$dict_id}' 
											ORDER BY p.im_photo_order", "im_photo_id" );
		return $this->mysql->table;
	}
	public function getItemSummary($id) {
		$this->mysql->name_table_select = "immovables_summary";
		return $this->mysql->select_table_id ( "v WHERE v.im_id = {$id} and lang_id='4c5d58cd3898c'" );
	}
	public function getVideo($id) {
		$this->mysql->name_table_select = "immovables_videos";
		return $this->mysql->select_table_id ( "v WHERE v.im_id = {$id}" );
	}
	public function getPropertiesList($param) {
		$res = null;
		$query = "";
		if (! empty ( $param['im_catalog_id'] ))
			$query .= " and l.catalog_id='{$param ["im_catalog_id"]}'";
		if (! empty ( $param['im_id'] ))
			$query .= " and i.im_id='{$param["im_id"]}'";
		if (! empty ( $param['is_prop_rent'] ))
			$query .= " and l.is_prop_rent=true";
		if (! empty ( $param['is_prop_sale'] ))
			$query .= " and l.is_prop_sale=true";
		if (! empty ( $param['im_ids'] ))
			$query .= " and i.im_id in ({$param ['im_ids']})";
		$this->mysql->name_table_select = "im_properties_list";
		$this->mysql->where_table_select = "l left join im_properties_info i ON l.im_prop_id = i.im_prop_id WHERE l.lang_id = {$_COOKIE['lang_id']} AND i.lang_id = {$_COOKIE['lang_id']} AND hide='show' " . $query;
		$this->mysql->order_table_select = "ORDER BY im_prop_name ASC";
		$this->mysql->select_table ( "im_prop_id" );
		
		if (! empty ( $this->mysql->table )) {
			return array(
					"list" => $this->mysql->table,
					"listBuild" => $this->mysql->buld_table);
		} else
			return $res;
	}
	public function getPropertiesOnlyList($param) {
		$res = null;
		$query = "";
		if (! empty ( $param['im_catalog_id'] ))
			$query .= " and l.catalog_id='{$param ["im_catalog_id"]}'";
		if (! empty ( $param['is_prop_rent'] ))
			$query .= " and l.is_prop_rent=true";
		if (! empty ( $param['is_prop_sale'] ))
			$query .= " and l.is_prop_sale=true";
		
		$this->mysql->name_table_select = "im_properties_list";
		$this->mysql->where_table_select = "l WHERE l.lang_id = {$_COOKIE['lang_id']} AND hide='show' " . $query;
		$this->mysql->order_table_select = "ORDER BY im_prop_name ASC";
		$this->mysql->select_table ( "im_prop_id" );
		
		if (! empty ( $this->mysql->table )) {
			return array(
					"list" => $this->mysql->table,
					"listBuild" => $this->mysql->buld_table);
		} else
			return $res;
	}
}