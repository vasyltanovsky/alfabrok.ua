<?php

class cl_foto {
	# 
	public $tbl_foto;
	# 
	public $adress_foto;
	#
	public $pre_arr;
	#
	public $class_a;
	#
	public $wh_arr;
	#
	public $file_type;
	// Конструктор класса
	public function __construct($tbl_foto, $adress_foto, $pre_arr, $class_a, $wh_arr, $file_type) {
		$this->tbl_foto = $tbl_foto;
		$this->adress_foto = $adress_foto;
		$this->pre_arr = $pre_arr;
		$this->class_a = $class_a;
		$this->wh_arr = $wh_arr;
		$this->file_type = $file_type;
	}
	
	public function return_list_foto() {
		$return = NULL;
		for($i = 0; $i < count ( $this->tbl_foto ); $i ++) {
			$return .= $this->pre_arr [0];
			$return .= "<a href=\"" . $this->adress_foto [0];
			$return .= $this->tbl_foto [$i] [car_photo_id];
			$return .= $this->file_type;
			$return .= "\">";
			$return .= "<img src=\"";
			$return .= $this->adress_foto [1];
			$return .= $this->tbl_foto [$i] [car_photo_id];
			$return .= $this->file_type;
			$return .= "\"";
			$return .= " width=\"" . $this->wh_arr [0] . "\"";
			$height .= " height=\"" . $this->wh_arr [1] . "\">";
			$return .= ">";
			
			$return .= "</a>";
			$return .= $this->pre_arr [1];
		}
		return $return;
	}
	
	public function return_list_foto_li_index() {
		$return = NULL;
		for($i = 0; $i < count ( $this->tbl_foto ); $i ++) {
			$return .= $this->pre_arr [0];
			$k = $i + 1;
			$return .= "<li jcarouselindex=\"" . $k . "\" class=\"jcarousel-item jcarousel-item-horizontal jcarousel-item-" . $k . " jcarousel-item-" . $k . "-horizontal\" >";
			$return .= "<a href=\"" . $this->adress_foto [0];
			$return .= $this->tbl_foto [$i] [car_photo_id];
			$return .= $this->file_type;
			$return .= "\">";
			$return .= "<img src=\"";
			$return .= $this->adress_foto [1];
			$return .= $this->tbl_foto [$i] [car_photo_id];
			$return .= $this->file_type;
			$return .= "\"";
			$return .= " width=\"" . $this->wh_arr [0] . "\"";
			$height .= " height=\"" . $this->wh_arr [1] . "\">";
			$return .= ">";
			
			$return .= "</a>";
			$return .= $this->pre_arr [1];
		}
		return $return;
	}
	
	public function return_list_foto_li_index_vertical() {
		$return = NULL;
		for($i = 0; $i < count ( $this->tbl_foto ); $i ++) {
			$return .= $this->pre_arr [0];
			$k = $i + 1;
			$return .= "<li jcarouselindex=\"" . $k . "\" class=\"jcarousel-item jcarousel-item-vertical jcarousel-item-" . $k . " jcarousel-item-" . $k . "-vertical\" >";
			$return .= "<a href=\"" . $this->adress_foto [0];
			$return .= $this->tbl_foto [$i] [car_photo_id];
			$return .= $this->file_type;
			$return .= "\">";
			$return .= "<img src=\"";
			$return .= $this->adress_foto [1];
			$return .= $this->tbl_foto [$i] [car_photo_id];
			$return .= $this->file_type;
			$return .= "\"";
			$return .= " width=\"" . $this->wh_arr [0] . "\"";
			$return .= " height=\"" . $this->wh_arr [1] . "\">";
			$return .= ">";
			
			$return .= "</a>";
			$return .= $this->pre_arr [1];
		}
		return $return;
	}
}
?>
