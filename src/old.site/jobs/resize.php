<?php
@set_time_limit(0);
@ini_set('memory_limit', '128M');

$ImgProp['ImgW'] = 285;
include 'class/resize-image/resize-class.php';

if ($handle = opendir('files/images/immovables/')) 
{ 
    while (false !== ($file = readdir($handle))) {         
		$ar_str = explode('_',$file);	 
		if($ar_str[0] != "st" and $ar_str[0] != "s" and $ar_str[0] != "si" and $ar_str[0] != "." and $ar_str[0] != "..")
		{			
			if(file_exists('files/images/immovables/'.'pr_'.$ar_str[0]))
			{
				true;
			}
			else
			{
				@$resizeObj = new resize('files/images/immovables/'.$ar_str[0]);
				@$resizeObj -> resizeImage($ImgProp['ImgW'], true, 'auto');
				@$resizeObj -> saveImage('files/images/immovables/'.'pr_'.$ar_str[0], 100);	
				echo "1<br>";
			}
		}
		
    }
    closedir($handle); 
}





