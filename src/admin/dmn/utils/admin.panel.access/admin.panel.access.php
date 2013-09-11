<?php
class admin_panel_acess
{
	public $userData;
	public $errorWords;
	public $location;
	public $errorRequery;
	
	public function __construct($userData 	= NULL,
 								$errorWords	= array('error_user_login'		=> 'Неверное имя пользователя.',
 													'error_user_pass'		=> 'Неверный пароль.',
 													'error_user_lp'			=> 'Не все поля заполнены.',
 													'error_user_ip'			=> 'Ваш IP-адрес не в списке разрешенных. Сообщите администратору этот адрес: '
 								),
 								$location 	= array('address_input' => 'Location: http://#server#/dmn', 
 													'transition_direction'	=> 'Location: http://#server#/dmn/firstPage/'),
 								$errorRequery = array('fieldErrors' => ''))
	{
		$this->userData		= $userData;
		$this->errorWords	= $errorWords;
		$this->location		= $location;	
		$this->errorRequery	= $errorRequery;		
	}		
	
	#выборка с БД
	public function mysql_query($requeryWhere)
	{
		$query 		= "SELECT * FROM system_accounts {$requeryWhere}";
		$sql_query 	= mysql_query($query);
		if(!$sql_query) die(mysql_error()."".$query."Ошибка select system_accounts");
		return mysql_fetch_array($sql_query);
	}
	
	public function getUserIP()
	{
  		if (!empty($_SERVER['HTTP_CLIENT_IP']))
		  //check ip from share internet
	  	{
	    	$ip=$_SERVER['HTTP_CLIENT_IP'];
  		}
  		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		  //to check ip is pass from proxy
	  	{
	    	$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
  		}
  		else
  		{
		    $ip=$_SERVER['REMOTE_ADDR'];
	  	}
	  	return $ip;
	}
	
	#вход в админ панель
		public function enter_admin_panel($postData)
		{
			#проверка существования всех данных
				if(empty($postData['admin_login']) and empty($postData['admin_password'])) $this->errorRequery['fieldErrors']['admin_login'] = $this->errorWords['error_user_lp'];
				else 
				{
					$UserData = $this->mysql_query("WHERE login='{$postData['admin_login']}'");
				
					#выполняем проверку имени пользователя, если не существует пользователя выводим сообщение
					if(!$UserData)	$this->errorRequery['fieldErrors']['admin_login'] = $this->errorWords['error_user_login'].$UserData['login'];
					else 
					{
						#выполняем проверку пароля данного пользователя, если имя пользователя не соответствует паролю выводим сообщение
						if($UserData['password'] != md5($postData['admin_password'])) $this->errorRequery['fieldErrors']['admin_password'] = $this->errorWords['error_user_pass'];
						else 
						{
								#даем положительный ответ обработчику, записываем кукис
									$this->errorRequery['success'] = true;
									$postData['id_account'] = $UserData['id_account'];
									$postData['roles'] = $UserData['rool'];
									$postData['type'] = $UserData['type'];
									$postData['good_ip'] = $UserData['type'] == "4f4b9531d0696" || strpos(",".$UserData['ip'].",", ",".$this->getUserIP().",") !== false ? "1" : "0";
									$this->set_admin_cookie($postData);
						}
					}
				}
				return;
		}
	
	#записываем кукис
	public function set_admin_cookie($userData)
	{
		setcookie('admin_login', $userData['admin_login'], 0, '/');							
		setcookie('admin_password', $userData['admin_password'], 0, '/');
		setcookie('id_account', $userData['id_account'], 0, '/');
		setcookie('roles', $userData['roles'], 0, '/');
		setcookie('type', $userData['type'], 0, '/');
		setcookie('good_ip', $userData['good_ip'], 0, '/');
	}
	
	#проверка записаних кукис, и перенаправление на дерикторию в панели управления
	public function location_enter($cookieData)
	{
		
		if(isset($cookieData['admin_password']) and isset($cookieData['admin_password'])) 
		{
			$cookieData['admin_password'] = md5($cookieData['admin_password']);
			if($this->mysql_query("WHERE login='{$cookieData['admin_login']}' AND password='{$cookieData['admin_password']}'")) {
				//print_r($_COOKIE);
				//echo str_replace("#server#", $_SERVER["HTTP_HOST"], $this->location['transition_direction']);
				return header(str_replace("#server#", $_SERVER["HTTP_HOST"], $this->location['transition_direction']));
			}
		}
		return;
	}
	
	#функция проверки доступности к панели управления
	public function protection_admin_panel($cookieData)
	{
		if(isset($cookieData['admin_password']) and isset($cookieData['admin_password'])) 
		{
			$cookieData['admin_password'] = md5($cookieData['admin_password']);
			if(!$this->mysql_query("WHERE login='{$cookieData['admin_login']}' AND password='{$cookieData['admin_password']}'")) {
				//print_r($_COOKIE);
				//echo str_replace("#server#", $_SERVER["HTTP_HOST"], $this->location['address_input']);
				//echo $this->location['address_input'];
				return header(str_replace("#server#", $_SERVER["HTTP_HOST"], $this->location['address_input']));
			}
		}
		return;
	}
	
}
?>