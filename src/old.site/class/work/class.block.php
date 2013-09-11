<?php

class pages_block {
	
	function RetLeftFM($arr, $dict, $nameFTitle, $nameFLink) {
		if ($dict == '4b2504f444aa3') {
			for($i = 0; $i < count ( $arr ); $i ++) {
				$ret .= "<a title=\"{$arr[$i][$nameFTitle]}\" href=\"{$arr[$i][$nameFLink]}\">";
				$ret .= $arr [$i] [$nameFTitle];
				$ret .= "</a>";
			}
		}
		return $ret;
	}
	
	#	index ban
	public function indexBan($arr, $dict, $nameFTitle, $nameFLink, $nameFDescription) {
		for($i = 0; $i < count ( $arr ); $i ++) {
			if ($dict == $arr [$i] ['dict_id']) {
				$ret .= "<a title =\"{$arr[$i][$nameFTitle]}\" href=\"{$arr[$i][$nameFLink]}\">";
				$ret .= $arr [$i] [$nameFDescription];
				$ret .= "</a>";
			}
		}
		return $ret;
	}
}
?>