<?php 
	require_once '../utils/template.ajax/js.css.php';
	
	
	$dir='../../cache_files/';
	$op_dir=opendir($dir);
	while($file = readdir($op_dir ))
	{
    	if($file != "." && $file != "..") 
        {
			unlink ($dir.$file);
        }
	}
?>
<script type="text/javascript">
	$.prompt('Прокешированные страницы удалены.');
</script>
