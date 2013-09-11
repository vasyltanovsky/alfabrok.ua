<?php

/*
 * PHP 5.0.x
 *
 * Logger v.0.1
 *
 * tIT-GP
 *
 * License LGPL
 *
 */

class devLogs {
	public $obj;
	public function __construct($obj = null) {
		$this->obj = $obj;
	}
	public static function _echo($data, $color = "blue") {
		echo sprintf ( "<pre style='color:%s'>%s</pre>", $color, $data );
	}
	public static function _printr($data, $name = "") {
		if ($name)
			echo sprintf ( "<pre style='color:blue'>%s</pre>", $name );
		echo "<pre style='color:blue'>";
		print_r ( $data );
		echo "</pre>";
	}
	public static function celledClass($color = "blue") {
		echo sprintf ( "<pre style='color:%s'><small>%s</small></pre>", $color, __METHOD__ . '-> ' . get_called_class () . PHP_EOL );
	}
}

