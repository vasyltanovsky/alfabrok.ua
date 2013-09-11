<?php

class securityClass {
	public function __construct() {
		if (get_magic_quotes_gpc ()) {
			if (! empty ( $_POST ))
				$this->stripslashes_array ( $_POST );
			if (! empty ( $_GET ))
				$this->stripslashes_array ( $_GET );
			if (! empty ( $_COOKIE ))
				$this->stripslashes_array ( $_COOKIE );
		}
	}
	
	public function stripslashes_array_callback(&$v, $k) {
		if (is_string ( $v ))
			$v = stripslashes ( $v );
		if (is_string ( $v ))
			$v = str_replace ( "script", "", $v );
	}
	
	public function stripslashes_array(array &$array) {
		if ($array)
			array_walk_recursive ( $array, 'stripslashes_array_callback' );
	}
}

function stripslashes_array_callback(&$v, $k) {
		if (is_string ( $v ))
			$v = stripslashes ( $v );
		if (is_string ( $v ))
			$v = str_replace ( "script", "", $v );
	}
 
/*if (get_magic_quotes_gpc()) {
    if (!empty($_POST)) securityClass::stripslashes_array($_POST);
    if (!empty($_GET)) stripslashes_array($_GET);
    if (!empty($_COOKIE)) stripslashes_array($_COOKIE);
}*/