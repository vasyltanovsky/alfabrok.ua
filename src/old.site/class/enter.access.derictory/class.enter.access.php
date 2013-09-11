<?php
class EnterAccess {
	public $tbl_DB; //имя таблицы БД
	public $EA_login; //имя поля логина, названия поля логина формы, ошибка
	public $EA_pass; //имя поля пароля, названия поля пароля формы, ошибка
	public $location; //Улицас для перенаправления при положительном и отрецательном ответах
	public $IsDoCheck; //
	public $EA_check; //имя поля активации аккаунта, названия поля активации аккаунта формы, ошибка
	public $errorRequery; //ответ обработчика, сбор ошыбок
	private $userData; //данные по выборке
	

	public function __construct($tbl_DB = 'system_accounts', $EA_login = array('login_db'=>'login','login_form'=>'admin_login','login_err'=>'Неверное имя пользователя.'), $EA_pass = array('pass_db'=>'password','pass_form'=>'admin_password','pass_err'=>'Неверный пароль.'), $location = array('Location: http://estafeta-contest.loc/index.html', 'Location: ../dmn/pages/'), $EA_check = array('check_db'=>'','check_val'=>'1','check_err'=>'Ваш аккаунт не ативирован.'), $IsDoCheck = false, $errorRequery = array('fieldErrors' => ''), $userData = NULL) {
		$this->tbl_DB = $tbl_DB;
		$this->EA_login = $EA_login;
		$this->EA_pass = $EA_pass;
		$this->location = $location;
		$this->EA_check = $EA_check;
		$this->IsDoCheck = $IsDoCheck;
		$this->errorRequery = $errorRequery;
		$this->userData = $userData;
	}
	
	#выборка с БД
	public function mysql_query($requeryWhere) {
		$query = "SELECT * FROM {$this->tbl_DB} {$requeryWhere}";
		$sql_query = mysql_query ( $query );
		if (! $sql_query)
			die ( mysql_error () . "" . $query . "Ошибка select system_accounts" );
		return mysql_fetch_array ( $sql_query );
	}
	
	#вход в админ панель
	public function Enter($postData) {
		#проверка существования всех данных
		if (empty ( $postData [$this->EA_login ['login_form']] ) and empty ( $postData [$this->EA_pass ['pass_form']] ))
			$this->errorRequery ['fieldErrors'] [$this->EA_login ['login_db']] = "P.L. ERROR";
		else {
			$UserData = $this->mysql_query ( "WHERE {$this->EA_login['login_db']}='{$postData[$this->EA_login['login_form']]}'" );
			
			#выполняем проверку имени пользователя, если не существует пользователя выводим сообщение
			if (! $UserData)
				$this->errorRequery ['fieldErrors'] [$this->EA_login ['login_form']] = $this->EA_login ['login_err'];
			else {
				#выполняем проверку пароля данного пользователя, если имя пользователя не соответствует паролю выводим сообщение
				if ($UserData [$this->EA_pass ['pass_db']] != md5 ( $postData [$this->EA_pass ['pass_form']] ))
					$this->errorRequery ['fieldErrors'] [$this->EA_pass ['pass_form']] = $this->EA_pass ['pass_err'];
				else {
					if ($this->IsDoCheck) {
						if (! $this->CheckAccount ( $UserData ))
							return $this->errorRequery ['fieldErrors'] [$this->EA_pass ['pass_form']] = $this->EA_check ['check_err'];
					}
					#даем положительный ответ обработчику, записываем кукис
					$this->errorRequery ['success'] = true;
					$this->set_admin_cookie ( $UserData );
				}
			}
		}
		return;
	}
	
	#	
	public function CheckAccount($UserData) {
		if ($UserData [$this->EA_check ['check_db']] == $this->EA_check ['check_val'])
			return true;
		else
			return false;
	}
	
	#записываем кукис
	public function set_admin_cookie($userData) {
		//print_r($userData);
		//echo $userData [$this->EA_login ['login_db']];
		//echo $userData [$this->EA_pass ['pass_db']];
		//exit();
		setcookie ( $this->EA_login ['login_form'], $userData [$this->EA_login ['login_db']], 0, '/' );
		setcookie ( $this->EA_pass ['pass_form'], $userData [$this->EA_pass ['pass_db']], 0, '/' );
		//setcookie('lang_code', $language->lang_code, 0, '/');
		setcookie ( 'user_id', $userData ['user_id'], 0, '/' );
	}
	
	#проверка записаних кукис, и перенаправление на дерикторию в панели управления
	public function location_enter($cookieData) {
		if (isset ( $cookieData [$this->EA_login ['login_form']] ) and isset ( $cookieData [$this->EA_pass ['pass_form']] ))
			if ($this->mysql_query ( "WHERE {$this->EA_login['login_db']}='{$cookieData[$this->EA_login['login_form']]}' AND {$this->EA_pass['pass_db']}='{$cookieData[$this->EA_pass['pass_form']]}'" ))
				return header ( $this->location [1] );
		return;
	}
	
	#
	public function ShowForm($cookieData) {
		if (isset ( $cookieData [$this->EA_login ['login_form']] ) and isset ( $cookieData [$this->EA_pass ['pass_form']] ))
			if ($this->mysql_query ( "WHERE {$this->EA_login['login_db']}='{$cookieData[$this->EA_login['login_form']]}' AND {$this->EA_pass['pass_db']}='" . $cookieData [$this->EA_pass ['pass_form']] . "'" ))
				return true;
		return FALSE;
	}
	
	#функция проверки доступности к панели управления
	public function protection_admin_panel($cookieData) {
		if (isset ( $cookieData [$this->EA_login ['login_form']] ) and isset ( $cookieData [$this->EA_pass ['pass_form']] )) {
			if (! $this->mysql_query ( "WHERE {$this->EA_login['login_db']}='{$cookieData[$this->EA_login['login_form']]}' AND {$this->EA_pass['pass_db']}='" . $cookieData [$this->EA_pass ['pass_form']] . "'" ))
				return header ( $this->location [0] );
			;
		} else {
			return header ( $this->location [0] );
		}
		return;
	}

}
?>