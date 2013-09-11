<?php
	// Устанавливаем соединение с базой данных
	require_once("../../config/config.php");
require_once DOC_ROOT . '/config/class.config.php';

	
	$login 		= $_POST['login'];
	$password 	= md5($_POST['password']);
	
	if($_POST['login'] and $_POST['password'])
	{
		$cl_accounts = new  mysql_select ('system_accounts');
		$user = $cl_accounts->select_table_id("WHERE login='{$login}' AND password='{$password}'");
	}
	
	if ( $user )
	{
		if ( ($user['login'] == $login) && ($user['password'] == $password) )
		{
			setcookie('a_login', $user['login'], 0, '/');							
			setcookie('a_password', $user['password'], 0, '/');
			?>
	            <script language="JavaScript" type="text/javascript">
				window.location = "../dmn/pages/index.php"; 
				</script> 
            <?
		}
	}
	else
		if ( ($user['login'] != $login) || ($user['password'] != $password) )
			echo "Неправильные логин или пароль!";
	exit();
?>
