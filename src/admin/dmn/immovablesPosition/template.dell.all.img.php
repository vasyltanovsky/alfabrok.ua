<?php 

	require_once("../../config/config.php");
	
	$im_id = $_POST['im_id'];
	
	$serc = mysql_query("SELECT im_photo_id,im_file_type FROM immovables_photos WHERE im_id = $im_id") or die(mysql_error());
	function build_array($src)
	{
		while ($row = mysql_fetch_assoc($src))
		{
			$array[] = $row; 
		}
		return $array;
	}		
	$aray = build_array($serc);
	
	foreach ($aray as $row):
		if(file_exists($images_folder.$row['im_photo_id'].".".$row['im_file_type']))
          @unlink($images_folder.$row['im_photo_id'].".".$row['im_file_type']);
		if(file_exists($images_folder."s_".$row['im_photo_id'].".".$row['im_file_type']))
          @unlink($images_folder."s_".$row['im_photo_id'].".".$row['im_file_type']);				
	endforeach;
	
	$qty = mysql_query("DELETE FROM immovables_photos WHERE im_id = $im_id") or die(mysql_error());	
	$r['q'] = $qty;
	echo json_encode($r);