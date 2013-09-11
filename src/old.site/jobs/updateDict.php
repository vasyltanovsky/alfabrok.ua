<?php
	#подключение к БД, и подключение классов
		require_once("config/config.php");
		require_once("config/class.config.php");
	#обработчик языка
		require_once("application/includes/language/set.cookie.php");	

/*
 * 
 */
function updateRegionDict($dict_id) {
	if (empty($dict_id))
		return ;
	global $tbl_dictionaries;
	$arr_update 		 = array("hide" => "1");
	$cl_page_update  = new mysql_select($tbl_dictionaries);
	$cl_page_update	->update_table("WHERE dict_id = '{$dict_id}' AND lang_id = {$_COOKIE[lang_id]}",
									$arr_update);
	return;								
}

$im = new mysql_select($tbl_im);
$im->select_table();

for ($i=0; $i<count($im->table); $i++) {
	$arr = $im->table[$i];
	
	updateRegionDict($arr[im_array_id]);
	updateRegionDict($arr[im_region_id]);
	updateRegionDict($arr[im_a_region_id]);
	updateRegionDict($arr[im_city_id]);
	updateRegionDict($arr[im_area_id]);
	updateRegionDict($arr[im_adress_id]);

	echo $arr['im_id'];
	echo "<br>";
}

?>