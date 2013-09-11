<?php
	require_once("../../../config/config.php");
require_once DOC_ROOT . '/config/class.config.php';
	require_once("../../includes/mail/template.mail.text.php");
	require_once '../../includes/module/template.module.php';
#обработчик языка
	require_once("../../includes/language/set.cookie.php");
	
	//$_COOKIE['user_id'] = 1;
	if(empty($_COOKIE['user_id'])) return;
	#выборка логотипов пользователя
	$cl_lu = new mysql_select($tbl_logo_user,
							  "WHERE user_id = {$_COOKIE['user_id']}",
							  "ORDER BY date DESC");
	$cl_lu -> select_table("lu_id");
	
	if($cl_lu -> table) {
		#подстановка позиций в шаблон вывода логотипов 		
		$cl_Module = new ModuleSite($ModuleTemplate);	
		$RetLu = "<table class=\"TableListLogo\"><tr><td><b>{$arWords[user_logo_img]}</b></td><td><b>{$arWords[user_logo_date]}</b></td><td><b>{$arWords[user_logo_text]}</b></td><td class=\"TdListLogoNoRight\"><b>{$arWords[user_logo_comm]}</b></td></tr>";
		$RetLu .= $cl_Module->Handler_Template_Html('logo_list_block', $cl_lu -> table);
		$RetLu .= "</table>";
	}
	else {
		$RetLu = $arWords['user_logo_err'];
	}
	
	echo $RetLu;
?>