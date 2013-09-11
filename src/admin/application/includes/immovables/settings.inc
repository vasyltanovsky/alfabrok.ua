<?php
	$_COOKIE['im_f_show_style'] 	= ($_COOKIE['im_f_show_style'] ? $_COOKIE['im_f_show_style']  : "im_list_table");
	$_COOKIE['im_f_show_pnumber'] 	= ($_COOKIE['im_f_show_pnumber'] ? $_COOKIE['im_f_show_pnumber']  : "30");
	$_COOKIE['im_where_sort'] 		= ($_COOKIE['im_where_sort'] ? $_COOKIE['im_where_sort']  : "im_prace");
	$_COOKIE['im_where_sort_order'] = ($_COOKIE['im_where_sort_order'] ? $_COOKIE['im_where_sort_order']  : "desc");
	$_GET[1] = ($_GET[1] ? $_GET[1] : "flat");
	$_GET['type_cat'] = ($_GET['type_cat'] ? $_GET['type_cat'] : "sale");
	$_GET['page'] = ($_GET['page'] ? $_GET['page'] : 1);
	$ImCatArr = array('flat'=>'4c3ec3ec5e9b5', 'commercial'=>'4c3ec3ec5e9b7', 'home'=>'4c3ec51d537c0', 'buildings'=>'4c3ec51d537c2', 'land'=>'4c3ec51d537c3');
	
	$DefaultFormValue['im_space'] 		= array(1, 100000);
	$DefaultFormValue['im_prace'] 		= array(1, 100000000);
	$DefaultFormValue['im_prace_sq'] 	= array(1, 100000);
	$DefaultFormValue['im_prace_manth'] = array(1, 100000);
	$DefaultFormValue['im_prace_day'] 	= array(1, 10000);
?>