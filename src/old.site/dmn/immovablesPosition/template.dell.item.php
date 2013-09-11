<?php 
	require_once '../utils/template.ajax/js.css.php';
	$query = "DELETE FROM $tbl_im WHERE im_id = '{$_POST[im_id]}'";
    if(!mysql_query($query)) throw new ExceptionMySQL(mysql_error(),   $query,  "ERROR dell immovables position");
    $query = "DELETE FROM $tbl_im_pi WHERE im_id = '{$_POST[im_id]}'";
    if(!mysql_query($query)) throw new ExceptionMySQL(mysql_error(),   $query,  "ERROR dell im_properties_info positions");
?>
<script type="text/javascript">
	$.prompt("Элемент удален.", {callback: function() {window.location = location.href;}});
</script>
