<?php
	$ZpFormInc = 'formEdit.js';
	require_once '../utils/template.ajax/js.css.php';

	$ImSuQClass = new mysql_select($tbl_im_su);
  	$active_id = $ImSuQClass -> select_table_id("WHERE lang_id = '4c5d58cd3898c' AND im_id = {$_GET[im_id]}");
  	require_once 'template.edit/form.im.summary.php';
?>
	


