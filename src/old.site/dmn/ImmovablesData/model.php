<?php
class DMN_ImmovablesData extends Controller {
	public $dictionaries;
	
	public function getPage($array) {
		$this->getDictionaris ();
		$provider = new ImmovablesProvider( 'immovables' );
		if($array["im_code"])
			$provider->GetList ( $array );
		$tAction = $this->Template ( "/dmn/ImmovablesData/template/action.phtml", array ('Data' => $array, "TypeDict" => $TypeDict ) );
		$tListData = $this->Template ( "/dmn/ImmovablesData/template/list.phtml", array ('Data' => $provider->resTable, "dictionaries" => $this->dictionaries ) );
		return $this->Template ( "/dmn/utils/templates/admin/page.phtml", array ('tListData' => $tListData, "tAction" => $tAction ) );
	}
	
	public function getPageJson($array) {
		$query = "";
		if (! empty ( $array ['term'] ))
			$query .= " and i.{$array['field_name']} LIKE '%{$array ['term']}%'";
		$Data = new mysql_select ( "immovables" );
		$Data->select_table_query ( "select i.{$array[field_name]} as value
									 from immovables i
									 WHERE i.im_id IS NOT NULL {$query} order by i.im_id desc ", "im_id" );
		
		$response = $Data->table;
		return $response;
	}
	
	public function getDictionaris() {
		#объявляем класс словаря
		$this->dictionaries = new dictionaries ( );
		#формируем массив имени словарей
		$this->dictionaries->buid_dictionaries_list ( "list_dictionaries" );
		#формируем массив значений словарей
		$this->dictionaries->buid_dictionaries ( "dictionaries", "WHERE lang_id = {$_COOKIE[lang_id]}" );
	}

}