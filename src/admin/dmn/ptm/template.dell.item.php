<?php
require_once '../utils/template.ajax/js.css.php';

$query = "DELETE FROM pages_structure WHERE page_id = '{$_POST[page_id]}'";
if (! mysql_query ( $query ))
	throw new ExceptionMySQL ( mysql_error (), $query, "Ошибка при удалении каталога" );
$query = "DELETE FROM pages_temp_mod  WHERE page_id = '{$_POST[page_id]}'";
if (! mysql_query ( $query ))
	throw new ExceptionMySQL ( mysql_error (), $query, "Ошибка при удалении каталога" );
?>
<script type="text/javascript">
	$.prompt('Элемент удален.');
</script>
