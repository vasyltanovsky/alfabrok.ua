<?php

class functionalClass {
	public function prepare_array_to_select($array) {
		$connection = "(";
		$count = count ( $array ) - 1;
		for($i = 0; $i < (count ( $array ) - 1); $i ++) {
			if ($i == $count - 1) {
				$connection .= "'" . $array [$i] . "'";
			} else {
				$connection .= "'" . $array [$i] . "',";
			}
		}
		return $connection .= ")";
	}
	
	public function prepare_array_to_select_mor($array, $name_field) {
		if (empty ( $array ))
			return;
		$connection = "(";
		$count = count ( $array );
		for($i = 0; $i < (count ( $array )); $i ++) {
			if ($i == $count - 1) {
				$connection .= "'" . $array [$i] [$name_field] . "'";
			} else {
				$connection .= "'" . $array [$i] [$name_field] . "',";
			}
		}
		return $connection .= ")";
	}
	
	public function prepare_array_to_neadArray($array, $name_field) {
		$connection = array ();
		$count = count ( $array );
		for($i = 0; $i < (count ( $array )); $i ++) {
			$connection [count ( $connection )] .= "" . $array [$i] [$name_field] . "";
		}
		return $connection;
	}
	
	public function prepare_array_to_select_full($array) {
		$connection = "(";
		$count = count ( $array );
		for($i = 0; $i < (count ( $array )); $i ++) {
			if ($i == $count - 1) {
				$connection .= "'" . $array [$i] . "'";
			} else {
				$connection .= "'" . $array [$i] . "',";
			}
		}
		return $connection .= ")";
	}
	
	# ��������� IP �������
	public function GetIP() {
		if (getenv ( "HTTP_CLIENT_IP" ) && strcasecmp ( getenv ( "HTTP_CLIENT_IP" ), "unknown" ))
			$ip = getenv ( "HTTP_CLIENT_IP" );
		else if (getenv ( "HTTP_X_FORWARDED_FOR" ) && strcasecmp ( getenv ( "HTTP_X_FORWARDED_FOR" ), "unknown" ))
			$ip = getenv ( "HTTP_X_FORWARDED_FOR" );
		else if (getenv ( "REMOTE_ADDR" ) && strcasecmp ( getenv ( "REMOTE_ADDR" ), "unknown" ))
			$ip = getenv ( "REMOTE_ADDR" );
		else if (isset ( $_SERVER ['REMOTE_ADDR'] ) && $_SERVER ['REMOTE_ADDR'] && strcasecmp ( $_SERVER ['REMOTE_ADDR'], "unknown" ))
			$ip = $_SERVER ['REMOTE_ADDR'];
		else
			$ip = "unknown";
		return $ip;
	}
	
	# ����� ���� ������� �� ��������� ��� 
	public function array_id_plus($array, # ������
$step) #��� ������
{
		for($i = 0; $i <= count ( $step ); $i ++) {
			$return [$i] = NULL;
		}
		
		for($i = 0; $i < count ( $array ); $i ++) {
			$return [$i + $step] = $array [$i];
		}
		return $return;
	}
	
	public function Str_Replace($template, $data) {
		foreach ( $data as $key => $value ) {
			$template = str_replace ( "#" . $key . "#", $value, $template );
		}
		return $template;
	}
	
	public function CleanText($data) {
		foreach ( $data as $key => $value ) {
			$ret [$key] = mysql_real_escape_string ( $value );
		}
		return $ret;
	}

}
?>