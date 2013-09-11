<?php
	$class_input_r = "input-rus";
	$class_input_e = "input-eng";
	$class_input_u = "input-ukr";
	if($_COOKIE['lang_id'] == 1) 
	{  
		$disabled_rus = "disabled";
		$class_input_r = "input-rus-d";
	}
	if($_COOKIE['lang_id'] == 2) 
	{
		$disabled_eng = "disabled"; 
		$class_input_e = "input-eng-d";
	}
	if($_COOKIE['lang_id'] == 3) 
	{
		$disabled_ukr = "disabled"; 
		$class_input_u = "input-ukr-d";
	}
?>
<div id="divFormLang" style="display: none">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="application/x-www-form-urlencoded">
        <input id="button" name="lang_bottom" <?php echo $disabled_rus;?> type="submit" class="<?php echo $class_input_r;?>" value="ru">
        <input id="button" name="lang_bottom" <?php echo $disabled_eng;?> type="submit" class="<?php echo $class_input_e;?>" value="en">
        <input id="button" name="lang_bottom" <?php echo $disabled_ukr;?> type="submit" class="<?php echo $class_input_u;?>" value="ua">
</form>  
</div>