<?php
function getPageGetArr() {
	$return = $_GET;
	if (! strpos ( $_SERVER ['REQUEST_URI'], '?' )) {
		return $return;
	} else {
		$str = substr ( $_SERVER ['REQUEST_URI'], strpos ( $_SERVER ['REQUEST_URI'], '?' ) + 1, strlen ( $_SERVER ['REQUEST_URI'] ) );
		$Arr = explode ( '&', $str );
		if (is_array ( $Arr )) {
			for($i = 0; $i < count ( $Arr ); $i ++) {
				$j = explode ( "=", $Arr [$i] );
				$j [1] = htmlspecialchars ( urldecode ( $j [1] ) );
				
				if (! empty ( $j [1] )) {
					if (strpos ( $j [0], '-sale' ) or strpos ( $j [0], '-rent' ))
						$j [0] = substr ( $j [0], 0, strlen ( $j [0] ) - 5 );
					if (substr ( $j [0], 0, 2 ) == "m_") {
						$pos_ = strpos ( substr ( $j [0], 2, strlen ( $j [0] ) ), '%23', true );
						$key = substr ( $j [0], 0, $pos_ + 2 );
						$key_in = substr ( $j [0], $pos_ + 5, strlen ( $j [0] ) );
						$key_in = substr ( $key_in, 0, strlen ( $key_in ) - 3 );
						$return [$key] [$key_in] = $j [1];
					} else
						$return [$j [0]] = $j [1];
				}
			}
			return $return;
		}
	}
}
?>