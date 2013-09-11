<?php
class dateClass {
	# ���������� ��������������� ���� � �������  ������� 11204510062009
	public function c_d_in_mk_standart($date) {
		$return = mktime ( substr ( $date, 0, 2 ), substr ( $date, 2, 2 ), substr ( $date, 4, 2 ), substr ( $date, 6, 2 ), substr ( $date, 8, 2 ), substr ( $date, 10, 4 ) );
		return $return;
	}
	/*$name_class->c_d_in_mk_standart(date("GismdY"));*/
	
	# ��������������� ���� � ������� � �������� ����������
	public function c_d_in_mk($date, $sub_arr = NULL) {
		if (! $sub_arr) {
			$sub_arr = array (array ("11", "2" ), array ("14", "2" ), array ("17", "2" ), array ("5", "2" ), array ("8", "2" ), array ("0", "4" ) );
		}
		
		$hour = substr ( $date, $sub_arr [0] [0], $sub_arr [0] [1] );
		$minute = substr ( $date, $sub_arr [1] [0], $sub_arr [1] [1] );
		$second = substr ( $date, $sub_arr [2] [0], $sub_arr [2] [1] );
		$month = substr ( $date, $sub_arr [3] [0], $sub_arr [3] [1] );
		$day = substr ( $date, $sub_arr [4] [0], $sub_arr [4] [1] );
		$year = substr ( $date, $sub_arr [5] [0], $sub_arr [5] [1] );
		
		$return = mktime ( $hour, $minute, $second, $month, $day, $year );
		return $return;
	}
	/*$name_class->c_d_in_mk($date, array(
												   array("11","2"),
												   array("14","2"),
												   array("17","2"),
												   array("5","2"),
												   array("8","2"),
												   array("0","4")
												  )
										);
			*/
	
	# ��������������� ���� � ������� ������ �� sql ������� 2009-10-05 14:02:57
	public function c_d_in_mk_sql($date) {
		$return = mktime ( substr ( $date, 11, 2 ), substr ( $date, 14, 2 ), substr ( $date, 17, 2 ), substr ( $date, 5, 2 ), substr ( $date, 8, 2 ), substr ( $date, 0, 4 ) );
		return $return;
	}
	/*$name_class->c_d_in_mk_sql(date("Y-m-d G:i:s"));*/
	
	public function now_minus_start($date_start) {
		return $this->c_d_in_mk_sql ( $date_start ) - $this->c_d_in_mk_standart ( date ( "GismdY" ) );
	}
	/*$name_class->c_d_in_mk_sql(date("Y-m-d G:i:s"));*/
	
	public function finish_minus_now($date_finish) {
		return $this->c_d_in_mk ( $date_finish ) - $this->c_d_in_mk_standart ( date ( "GismdY" ) );
	}
	
	public function GetPeapleDateView($Fdate) {
		list ( $date, $time ) = explode ( " ", $Fdate );
		list ( $year, $month, $day ) = explode ( "-", $date );
		return $date = "$day.$month.$year " . substr ( $time, 0, 5 );
	}
	public function GetMysqlDateView($Fdate) {
		list ( $date, $time ) = explode ( " ", $Fdate );
		list ( $day, $month, $year ) = explode ( ".", $date );
		return $date = "$year-$month-$day";
	}
	/*$name_class->c_d_in_mk_sql(date("Y-m-d G:i:s"));*/
}

// ��������� ���� � ��������� ��� ������������ �������
//list($date, $time) = explode(" ", $guest[$i]['gb_date']);
//list($year, $month, $day) = explode("-", $date);
//$date = "$day.$month.$year ".substr($time, 0, 5);
?>
