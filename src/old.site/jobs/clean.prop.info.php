<?php
#подключение к БД, и подключение классов
require_once ("../config/config.php");
require_once ("../config/class.config.php");
#обработчик языка
require_once ("../application/includes/language/set.cookie.php");

$data = new mysql_select ( $tbl_dictionaries );
$data->select_table_query( "select p.im_prop_id, p.im_id as p_im_id,  i.im_id
							from im_properties_info p	
							left join immovables i on i.im_id = p.im_id", "im_prop_id" );

foreach ($data->table as $key => $value) {
	if(empty($value['im_id'])) {
		$query = "delete from im_properties_info where im_id = " .$value['p_im_id'];
		if (! mysql_query ( $query )) {
			throw new ExceptionMySQL ( mysql_error (), $query, $query );
		}
		echo sprintf("%s<br/>", $query);
	}
	else 
		echo sprintf("%s<br/>", $value['p_im_id']);
}

//
//			$query = "UPDATE {$this->name_table_select}
//								SET $update
//									$where";
//			if (! mysql_query ( $query )) {
//				throw new ExceptionMySQL ( mysql_error (), $query, "Ошибка добавления новостного" );
//			}
//			return "Insert";
//		} else {
//			return "Error";
//		}