<?php
/*
 * Класс обработчик 
 *  
 *
 * @version class.discharge.php,v 1.0 2010/11/14
 * @author <AlexTsurkin/>
 * @license GNU GPLv3
 */

class Discharge {
	public function GetDisValue($val, $prop_dis, $currency_sign = " грн.") {
		$val = number_format(round ( $val ), 0, ".", "");
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
?>