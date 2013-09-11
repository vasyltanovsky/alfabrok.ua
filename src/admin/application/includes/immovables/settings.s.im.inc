<?php
	$_COOKIE['im_f_show_style'] 	= ($_COOKIE['im_f_show_style'] ? $_COOKIE['im_f_show_style']  : "im_list_table");
	$_COOKIE['im_f_show_pnumber'] 	= ($_COOKIE['im_f_show_pnumber'] ? $_COOKIE['im_f_show_pnumber']  : "10");
	$_COOKIE['im_where_sort'] 		= ($_COOKIE['im_where_sort'] ? $_COOKIE['im_where_sort']  : "im_date_add");
	$_GET['page'] = ($_GET['page'] ? $_GET['page'] : 1);
	$ImCatArr = array('flat'=>'4c3ec3ec5e9b5', 'commercial'=>'4c3ec3ec5e9b7', 'home'=>'4c3ec51d537c0', 'buildings'=>'4c3ec51d537c2', 'land'=>'4c3ec51d537c3');
	$DefaultFormValue['im_space'] = array(1, 10000);
	$DefaultFormValue['im_prace'] = array(1, 1000000);
	$DefaultFormValue['im_prace_sq'] = array(1, 10000);
?>