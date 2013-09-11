<?php

  // Устанавливаем соединение с базой данных
  require_once("../../config/config.php");
  // Подключаем SoftTime FrameWork
require_once DOC_ROOT . '/config/class.config.php';
  require_once("../utils/cms.images.php"); 
  
  		  	$WhereImmovable = 'WHERE';
		  	if(!empty($_GET['realtor_id'])) $WhereImmovable .= " r.realtor_id = '{$_GET['realtor_id']}'";
		  	if(!empty($_GET['t_date_do_b'])) {
			 	list($month, $day, $year) = explode("/", ($_GET['t_date_do_b']));
				$value = $year."-".$month."-".$day;
				if ($WhereImmovable != 'WHERE') {
						$WhereImmovable .= " AND ";
				}
				$WhereImmovable .= " r.t_date_do >= '$value'";
			}
			if(!empty($_GET['t_date_do_e'])) {
			  	list($month, $day, $year) = explode("/", ($_GET['t_date_do_e']));
				$value = $year."-".$month."-".$day;
				if ($WhereImmovable != 'WHERE') {
					$WhereImmovable .= " AND ";
				}
				$WhereImmovable .= " r.t_date_do <= '$value'";
			}
		
		  if ($WhereImmovable == 'WHERE') {
					$WhereImmovable = "where r.t_date_do >= '". date("Y-m-d")."'";
		  }
	# 	Получаем содержимое текущей страницы
   		$cl_sel_pages = new mysql_select('realtor_tasks');
		$cl_sel_pages -> select_table_query("SELECT r.*, a.id_account, a.fio from realtor_tasks r 
											 left join {$tbl_accounts} a on r.realtor_id = a.id_account	{$WhereImmovable}");
	# 	Получаем содержимое текущей страницы
   		$page = $cl_sel_pages -> table;	
 
	if($_GET['print'] == 'list_page')	require_once("template.print/print.list.pages.php");
	

?>
    	
        