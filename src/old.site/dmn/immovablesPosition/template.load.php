<?php
// Устанавливаем соединение с базой данных
require_once ("../../config/config.php");
// Подключаем SoftTime FrameWork
require_once DOC_ROOT . '/config/class.config.php';
require_once ("../utils/cms.images.php");
require_once 'template/template.inc';

#	объявляем класс словаря
$dictionaries = new dictionaries ( );
#формируем массив имени словарей
$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries );
#формируем массив значений словарей
$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = $_COOKIE[lang_id]" );

//	выборка недвижимости по запросу 
if ($_GET ['print'] == 'list_page') {
	#	запрос для выборки по каталогу нежвижимости
	$WhereImmovable = 'WHERE';
	if (! empty ( $_GET ['dict_id'] ))
	{
		
		//echo $_GET['dict_id'];
		
		
		$WhereImmovable .= " im_catalog_id = '{$_GET['dict_id']}'";
	
	}
	if (! empty ( $_GET ['date_add_ot'] )) {
		list ( $month, $day, $year ) = explode ( "/", ($_GET ['date_add_ot']) );
		$value = $year . "-" . $month . "-" . $day;
		if ($WhereImmovable != 'WHERE') {
			$WhereImmovable .= " AND ";
		}
		$WhereImmovable .= " im_date_add >= '$value'";
	}
	if (! empty ( $_GET ['date_add_do'] )) {
		list ( $month, $day, $year ) = explode ( "/", ($_GET ['date_add_do']) );
		$value = $year . "-" . $month . "-" . $day;
		if ($WhereImmovable != 'WHERE') {
			$WhereImmovable .= " AND ";
		}
		$WhereImmovable .= " im_date_add <= '$value'";
	}
	
	if (! empty ( $_GET ['s_im_id'] ))
		$WhereImmovable = "WHERE im_code LIKE '%{$_GET['s_im_id']}%'";
		# сортировка недвижимости 
	$SortImmovable = "ORDER BY im_id DESC";
	
	if ($WhereImmovable == 'WHERE') {
		$WhereImmovable = "";
	}
	
	# выборка с БД
	$ImPQ = new mysql_select ( $tbl_im, $WhereImmovable, $SortImmovable );
	$ImPL = $ImPQ->select_table ( "im_id" );
	
	$ImPQSt = new mysql_select ( 'immovables_stat' );
	$ImPQSt->select_table ( "im_id" );
	
	$ImTaskQ = new mysql_select ( 'realtor_tasks', " where t_date_reminder = '" . date ( "Y-m-d" ) . "' and is_do=0" );
	$ImTaskQ->select_table ( "im_id" );
	
	require_once ("template.print/print.list.pages.php");
}

//	


if ($_GET ['print'] == 'list_img') {
	#выборка логотипов пользователя
	$cl_photo_class = new mysql_select ( $tbl_im_ph, "WHERE im_id = {$_GET['im_id']} order by im_photo_order", "" );
	$cl_photo_class->select_table ( "im_photo_id" );
	if ($cl_photo_class->table) {
		#подстановка позиций в шаблон вывода логотипов 		
		$cl_Module = new ModuleSite ( $ModuleTemplate, array (), $dictionaries );
		$RetPhoto = $cl_Module->Handler_Template_Html ( 'photo_list_block', $cl_photo_class->table, array ('im_photo_type' => array ('im_photo_type', 'PhotoImgType' ) ) );
	} else {
		$RetPhoto = "<div class=\"DivListError\">Нет добавленных изображений!</div>";
	}
	echo $RetPhoto;
}

//
if ($_GET ['print'] == 'list_tasks') {
	#выборка заданий для Риэлторов
	$cl_task_class = new mysql_select ( 'realtor_tasks', "WHERE im_id = {$_GET['im_id']}", "ORDER BY t_date_do" );
	$cl_task_class->select_table ( "t_id" );
	
	$cl_realtor_class = new mysql_select ( 'system_accounts' );
	$cl_realtor_class->select_table ( "id_account" );
	
	if ($cl_task_class->table) {
		#подстановка позиций в шаблон вывода логотипов 		
		$cl_Module = new ModuleSite ( $ModuleTemplate, array (), $dictionaries );
		$cl_Module->SetFieldValue ( 'realtor_data', $cl_realtor_class->buld_table );
		$RetPhoto = $cl_Module->Handler_Template_Html ( 'task_list_block', $cl_task_class->table, array ('realtor_id' => array ('realtor_id', 'GetRealtorData' ) ) );
	} else {
		$RetPhoto = "<div class=\"DivListError\">Нет добавленных заданий!</div>";
	}
	echo $RetPhoto;
}

//
if ($_GET ['print'] == 'get_summary') {
	$ImSuQClass = new mysql_select ( $tbl_im_su );
	$active_id = $ImSuQClass->select_table_id ( "WHERE lang_id = '{$_GET[lang_id]}' AND im_id = {$_GET[im_id]}" );
	require_once 'template.edit/form.im.summary.php';
}

?>
