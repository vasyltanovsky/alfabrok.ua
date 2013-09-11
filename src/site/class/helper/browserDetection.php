<?php
class browserDetectionClass {
	static function getItem() {
		$user_agent = $_SERVER ['HTTP_USER_AGENT'];
		if (stristr ( $user_agent, 'MSIE 8.0' ))
			return "IE8";
		if (stristr ( $user_agent, 'MSIE 7.0' ))
			return "IE7";
		if (stristr ( $user_agent, 'MSIE 6.0' ))
			return "IE6";
		if (stristr ( $user_agent, 'Chrome' ))
			return "CH";
		if (stristr ( $user_agent, 'Firefox' ))
			return "FF";
		if (stristr ( $user_agent, 'Opera' ))
			return "OP";
		if (stristr ( $user_agent, 'Safari' ))
			return "SF";
		return $browserIE = "FF";
		;
	}
}