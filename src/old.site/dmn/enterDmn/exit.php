<?php
	setcookie('admin_login', NULL, 0, '/');							
	setcookie('admin_password', NULL, 0, '/');
	setcookie('id_account', NULL, 0, '/');
	setcookie('roles', NULL, 0, '/');
	setcookie('type', NULL, 0, '/');
		
    header("Location: ../../dmn");
?>