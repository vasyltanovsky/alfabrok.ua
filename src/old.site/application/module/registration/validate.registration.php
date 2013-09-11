<?php
require_once ("../../../config/config.php");
require_once DOC_ROOT . '/config/class.config.php';
require_once ("../../includes/mail/template.mail.text.php");
include_once '../../../application/includes/language/set.cookie.php';

#
$_POST ['user_name'] = mysql_real_escape_string ( $_POST ['user_name'] );
$_POST ['user_fio'] = mysql_real_escape_string ( $_POST ['user_fio'] );
$_POST ['user_email'] = mysql_real_escape_string ( $_POST ['user_email'] );
$_POST ['user_password'] = mysql_real_escape_string ( $_POST ['user_password'] );
$_POST ['user_password_sec'] = mysql_real_escape_string ( $_POST ['user_password_sec'] );
#
$json_converter = new Services_JSON ();
$response = array ();
$response ['success'] = false;
$response ['fieldErrors'] = array ();

#проверка на существования пользователя с таким логином
$UI = new mysql_select ( $tbl_user_site );
$CheckUI = $UI->select_table_id ( "WHERE user_login = '{$_POST[user_email]}'" );
if (! empty ( $CheckUI ))
	$response ['fieldErrors'] ['user_email'] = $arWords ['form_email_req_err_isset'];
	#проверка на пароли
if ($_POST ['user_password'] != $_POST ['user_password_sec'])
	$response ['fieldErrors'] ['user_password_sec'] = $arWords ['form_pass_req_err_two'];
	
#	
if (empty ( $response ['fieldErrors'] )) {
	$query = "INSERT INTO $tbl_user_site
							  VALUES (NULL,
									  '{$_POST[user_email]}',
									  '" . md5 ( $_POST [user_password] ) . "',
									  '{$_POST[user_email]}',
									  '{$_POST[user_name]} {$_POST[user_fio]}',
									  '',
									  '{$_POST['user_tel']}',
									  '',
									  '',
									  '',
									  '" . md5 ( $_POST [user_email] ) . "',
									  'process', 
									  'process', 
									  'process',
									  '1' , 
									  '1' , 
									  0,
									  0,
									  0,
									  0,
									  NULL,
									  NOW(),
									  NULL,
									  NOW(),
									  NULL,
									  NULL,
									  '')";
	
	if (! mysql_query ( $query ))
		throw new ExceptionMySQL ( mysql_error (), $query, "Ошибка добавления пользователя" );
	
	$_POST ['validate_link'] = "" . $_SERVER ['HTTP_HOST'] . "/registration/evidence156/" . md5 ( $_POST ['user_email'] ) . ".html";
	$cl_Module = new ModuleSite ( $mail_template );
	$UserMassage = $cl_Module->For_HTML ( $mail_template ['user_reqistration'], $_POST );
	
	$mail = new PHPMailer ();
	$mail->From = "{$EmailAdmin}"; // от кого
	$mail->CharSet = 'utf-8';
	$mail->FromName = $EmailAdminMame; // от кого
	$mail->AddAddress ( $_POST ['user_email'] ); // кому - адрес, Имя
	$mail->IsHTML ( true ); // выставляем формат письма HTML
	$mail->Subject = $EmailTitle ['reqistation_user']; // тема письма 
	$mail->Body = $UserMassage;
	// отправляем наше письмо
	if (! $mail->Send ())
		die ( 'Mailer Error: ' . $mail->ErrorInfo );
	$response ['success'] = true;
}

header ( 'Content-type: text/plain' );
echo $json_converter->encode ( $response );

?>
