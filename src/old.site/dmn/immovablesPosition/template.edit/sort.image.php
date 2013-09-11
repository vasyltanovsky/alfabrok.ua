<?php

require_once("../../../config/config.php");
foreach ($_POST['sort'] as $key => $value) 
{
	mysql_query("UPDATE immovables_photos set im_photo_order = $key WHERE im_photo_id = '$value'") or die(mysql_error());
}

echo json_encode("ok"); 
