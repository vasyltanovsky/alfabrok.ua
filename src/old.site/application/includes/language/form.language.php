<?php
	$class_input_u = "input-ukr";
	$class_input_r = "input-rus";
	$class_input_e = "input-eng";
	if($lang_id == 1) 
	{  
		$disabled_rus = "disabled=\"disabled\"";
		$class_input_r = "input-rus-d";
	}
	if($lang_id == 2) 
	{
		$disabled_eng = "disabled=\"disabled\"";
		$class_input_e = "input-eng-d";
	}
?>	
<!--<div class="d-lang">
	<form action="?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="application/x-www-form-urlencoded">
    	<input id="buttonRus" name="lang_bottom" ?php echo $disabled_rus;?> type="submit" class="?php echo $class_input_r;?>" value="rus"/>
        <input id="buttonEng" name="lang_bottom" ?php echo $disabled_eng;?> type="submit" class="?php echo $class_input_e;?>" value="eng"/>
    </form>  
</div>-->
