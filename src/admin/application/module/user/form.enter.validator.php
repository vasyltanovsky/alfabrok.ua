<?php
require_once ("../../../config/config.php");
require_once DOC_ROOT . '/config/class.config.php';
require_once ("../../includes/mail/template.mail.text.php");
//include_once '../../../application/includes/language/set.cookie.php';


$json_converter = new Services_JSON ();
$response = array ();
$response ['success'] = false;
$response ['fieldErrors'] = array ();

$EA = new EnterAccess ( $tbl_DB = $tbl_user_site, $EA_login = array ('login_db' => 'user_login', 'login_form' => 'user_enter_login', 'login_err' => 'Неверное имя пользователя.' ), $EA_pass = array ('pass_db' => 'user_password', 'pass_form' => 'user_enter_password', 'pass_err' => 'Неверный пароль.' ), $location = array ('Location: http://estafeta-contest.loc/index.html', 'Location: ../dmn/pages/' ), $EA_check = array ('check_db' => 'user_activity', 'check_val' => 'activity', 'check_err' => 'Ваш аккаунт не ативирован.' ), $IsDoCheck = true );
$EA->Enter ( $_POST );
$response = $EA->errorRequery;
//$response['fieldErrors']['admin_login'] = 'asdfsd';


header ( 'Content-type: text/plain' );
echo $json_converter->encode ( $response );
?>