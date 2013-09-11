<?php
require_once ("../../config/config.php");
$im_id = $_POST ['im_id'];
$qty = mysql_query ( "UPDATE immovables_stat SET wiev_count = 0 WHERE im_id = $im_id" );
$r ['q'] = 0;
echo json_encode ( $r );