<?php

class cl_document {
	#
	public $tbl_dictionaries;
	# 
	public $tbl_document;
	# 
	public $adress_document;
	
	public $pre_arr;
	// Конструктор класса
	public function __construct($tbl_dictionaries, $tbl_document, $adress_document, $pre_arr) {
		$this->tbl_dictionaries = $tbl_dictionaries;
		$this->tbl_document = $tbl_document;
		$this->adress_document = $adress_document;
		$this->pre_arr = $pre_arr;
	}
	
	public function return_list_document() {
		$return = NULL;
		for($i = 0; $i < count ( $this->tbl_document ); $i ++) {
			$return .= $this->pre_arr [0];
			$return .= "<a href=\"" . $this->adress_document;
			$return .= $this->tbl_document [$i] [car_doc_id];
			$return .= $this->tbl_document [$i] [car_doc_name] . "\">";
			$return .= $this->tbl_dictionaries [$this->tbl_document [$i] [car_doc_type_id]] ['dict_name'];
			$return .= "</a>";
			$return .= $this->pre_arr [1];
		}
		return $return;
	}
}
?>