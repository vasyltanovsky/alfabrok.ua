<?php
require_once ("../../../config/config.php");
require_once DOC_ROOT . '/config/class.config.php';
require_once ("../../includes/mail/template.mail.text.php");

$_POST ['name'] = mysql_real_escape_string ( $_POST ['name'] );
$_POST ['organization'] = mysql_real_escape_string ( $_POST ['organization'] );
$_POST ['email'] = mysql_real_escape_string ( $_POST ['email'] );
$_POST ['titlemsq'] = mysql_real_escape_string ( $_POST ['titlemsq'] );
$_POST ['textmsq'] = mysql_real_escape_string ( $_POST ['textmsq'] );

$json_converter = new Services_JSON ();
$response = array ();
$response ['success'] = false;
$response ['fieldErrors'] = array ();

#	  отправка письма администратору 
$message = GetMailText ( 'contact_as_company', $_POST );

$mail = new PHPMailer ();
$mail->From = "{$_POST[email]}"; // от кого
$mail->CharSet = 'utf-8';
$mail->FromName = "{$_POST[name]}"; // от кого
$mail->AddAddress ( $EmailAdmin ); // кому - адрес, Имя
$mail->IsHTML ( true ); // выставляем формат письма HTML
$mail->Subject = $EmailTitle ['contactAs'] . " " . $_POST ['titlemsq']; // тема письма 
$mail->Body = $message;

// отправляем наше письмо
if (! $mail->Send ())
	die ( 'Mailer Error: ' . $mail->ErrorInfo );

$response ['success'] = true;
header ( 'Content-type: text/plain' );
echo $json_converter->encode ( $response );
?>
