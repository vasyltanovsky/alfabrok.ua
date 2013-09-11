<?php
require_once '../config/config.php';
require_once DOC_ROOT . '/config/class.config.php';
$CONFIG ['Lang'] ['default'] = 'rus';
require_once '../application/includes/language/set.cookie.php';
require_once '../application/includes/module/template.module.php';
require_once '../application/module/immovables/f.immobles.php';
require_once '../application/includes/immovables/setting.im.print.inc';
require_once ("../application/includes/mail/template.mail.text.php");

$ImDataClCount = new mysql_select ( $tbl_im );
$ImDataClCount->select_table_query ( "SELECT * FROM {$tbl_im} i" );

foreach ( $ImDataClCount->table as $key => $value ) {
	$let = substr ( $value ['im_code'], 0, 1 );
	$code = substr ( $value ['im_code'], 1, strlen ( $value ['im_code'] ) );
	if ($let == 'z')
		$let = 'm';
	if ($let == 'y')
		$let = 't';
	$arr_update = array ("im_code" => "'" . strtoupper ( $let . $code . "'" ) );
	$cl_page_update = new mysql_select ( $tbl_im );
	$cl_page_update->update_table ( "WHERE im_id = {$value[im_id]}", $arr_update );
}
echo "UPDATE IM CODE DONE!";

?>