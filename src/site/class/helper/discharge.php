<?php
class Discharge {
	static function GetDisValue($val, $prop_dis, $currency_sign = " грн.") {
		if(empty($val))
			return;
		$val = number_format ( round ( $val ), 0, ".", "" );
		if (($sl = strlen ( $val )) < $prop_dis)
			return $val . " $";
		$CountDoDisWhile = number_format ( $sl / $prop_dis );
		$FromVal = $val;
		$ToVal = "";
		while ( $CountDoDisWhile ) {
			$ToVal = " " . substr ( $FromVal, strlen ( $FromVal ) - $prop_dis + 1, $prop_dis ) . $ToVal;
			$FromVal = substr ( $FromVal, 0, strlen ( $FromVal ) - $prop_dis + 1 );
			$CountDoDisWhile --;
		}
		return $FromVal . $ToVal . " " . $currency_sign;
	}
}