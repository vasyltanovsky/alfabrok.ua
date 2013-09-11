<?php
require_once ("../../config/config.php");
require_once DOC_ROOT . '/config/class.config.php';
require_once '../utils/admin.panel.access/admin.panel.access.php';

$json_converter = new Services_JSON ( );
$response = array ();
$response ['success'] = false;
$response ['fieldErrors'] = array ();

$AdminAccess = new admin_panel_acess ( );
$AdminAccess->enter_admin_panel ( $_POST );
$response = $AdminAccess->errorRequery;

header ( 'Content-type: text/plain' );
echo $json_converter->encode ( $response );
?>