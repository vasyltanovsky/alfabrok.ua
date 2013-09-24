<?php
define ( 'DOC_ROOT', $_SERVER['DOCUMENT_ROOT'] );
require_once ("../../config/config.php");
// require_once("../utils/security_mod.php");
require_once ("../../config/class.config.php");
// require_once("../utils/template.ajax/JSON.php");
require_once '../utils/functions/f.encodestring.php';

// $log = new Logger ( DOC_ROOT . '/files/logs/site/' );

$json_converter = new Services_JSON ();
$response = array();
$response['success'] = false;
$response['fieldErrors'] = array();

if ($_POST['retention'] == 'edit_ptm') {
	try {
		$query = "DELETE FROM {$tbl_ptm} WHERE page_id = '{$_POST[page_id]}'";
		if (! mysql_query ( $query ))
			throw new ExceptionMySQL ( mysql_error (), $query, "ERROR DELL POS TEMP MOD" );
		
		foreach ( $_POST as $key => $value ) {
			if ($key != 'page_id' and $key != 'retention' and $key != 'pt_id-{new-id}') {
				if (substr ( $key, 0, strpos ( $key, "-" ) ) == "pt_id") {
					$pt_id = $value;
					$query = "INSERT INTO {$tbl_ptm}
								SET
									pt_id 			= {$pt_id},
									page_id  		= '{$_POST["page_id"]}',
									temp_id 		= " . ($_POST["temp_id-" . $pt_id] ? $_POST["temp_id-" . $pt_id] : 'NULL') . ",
									mod_id			= " . ($_POST["mod_id-" . $pt_id] ? $_POST["mod_id-" . $pt_id] : 'NULL') . ",
									pos				= " . ($_POST["pos-" . $pt_id] ? $_POST["pos-" . $pt_id] : 'NULL') . ",
									parent_id		= " . ($_POST["parent_id-" . $pt_id] ? $_POST["parent_id-" . $pt_id] : 'NULL') . ",
									pos_temp_id		= " . ($_POST["pos_temp_id-" . $pt_id] ? $_POST["pos_temp_id-" . $pt_id] : 'NULL') . ",
									pt_is_cache		= " . ($_POST["pt_is_cache-" . $pt_id] ? $_POST["pt_is_cache-" . $pt_id] : 'NULL') . ",
									pt_val			= '{$_POST["pt_val-" . $pt_id]}'";
					
					if (! mysql_query ( $query ))
						throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT or UPDATE TEMPLATE MODULE" );
				}
			}
		}
		
		$response['success'] = "true";
		header ( 'Content-type: text/plain' );
		echo $json_converter->encode ( $response );
	} catch ( ExceptionMySQL $exc ) {
		echo ExceptionFullGet::ExcMysqlN ( $exc );
		// $log->writeln ( ExceptionFullGet::ExcMysqlN ( $exc ) );
	}
}

if ($_POST['retention'] == 'edit_page') {
	//print_r($_POST);
	try {
		$arr_update = array(
				"parent_id" => "'{$_POST[parent_id]}',",
				"hide" => ($_POST['hide'] ? $_POST['hide'] : "NULL") . ",",
				"is_cache" => ($_POST['is_cache'] ? $_POST['is_cache'] : "NULL") . ",",
				"p_type" => "'{$_POST[p_type]}',",
				"p_w_menu" => "'{$_POST[p_w_menu]}',",
				"p_w_title" => "'{$_POST[p_w_title]}',",
				"p_w_keyw" => "'{$_POST[p_w_keyw]}',",
				"p_w_desc" => "'{$_POST[p_w_desc]}',",
				"controller" => "'{$_POST[controller]}',",
				"action" => "'{$_POST[action]}',",
				"page_url" => "'{$_POST[page_url]}',",
				"cache_time" => ($_POST['cache_time'] ? $_POST['cache_time'] : "NULL") . ",",
				"priority" => ($_POST['priority'] ? $_POST['priority'] : "NULL") . ",",
				"p_level" => ($_POST['p_level'] ? $_POST['p_level'] : "NULL") . ",",
				"pos" => "{$_POST[pos]}");
		
		$cl_page_update = new mysql_select ( $tbl_sturture );
		$cl_page_update->update_table ( "WHERE page_id = '{$_POST[page_id]}' AND lang_id = {$_COOKIE[lang_id]}", $arr_update );
		
		if (! empty ( $_POST['pc_text'] ) && empty ( $_POST[pc_id] )) {
			$_POST['pc_id'] = ($_POST['pc_id'] ? $_POST['pc_id'] : uniqid ());
			$query = "INSERT INTO
								{$tbl_content}
							SET
								pc_id 			= '{$_POST['pc_id']}',
								page_id  		= '{$_POST['page_id']}',
								pc_type  		= '{$_POST['pc_type']}',
								lang_id			= #lang_id#,
								pc_text 		= '{$_POST['pc_text']}';";
			if (! mysql_query ( str_replace ( "#lang_id#", 1, $query ) ))
				throw new ExceptionMySQL ( mysql_error (), $query, "ERROR" );
			if (! mysql_query ( str_replace ( "#lang_id#", 2, $query ) ))
				throw new ExceptionMySQL ( mysql_error (), $query, "ERROR" );
			if (! mysql_query ( str_replace ( "#lang_id#", 3, $query ) ))
				throw new ExceptionMySQL ( mysql_error (), $query, "ERROR" );
			$query = "INSERT INTO `pages_temp_mod` (`pt_id`, `page_id`, `temp_id`, `pos`, `pos_temp_id`, `pt_val`)
						VALUES (NULL, '{$_POST['page_id']}', 142, 1, 1, '');";
			if (! mysql_query ( $query ))
				throw new ExceptionMySQL ( mysql_error (), $query, "ERROR" );
			$arr_update = array(
					"pc_text" => "'" . mysql_real_escape_string ( $_POST[pc_text] ) . "'");
			$cl_page_update = new mysql_select ( $tbl_content );
			$cl_page_update->update_table ( "WHERE pc_id = '{$_POST[pc_id]}' AND lang_id = {$_COOKIE[lang_id]}", $arr_update );
		}
		
		$response['success'] = "true";
		header ( 'Content-type: text/plain' );
		echo $json_converter->encode ( $response );
	} catch ( ExceptionMySQL $exc ) {
		echo $exc;
		echo ExceptionFullGet::ExcMysqlN ( $exc );
		// $log->writeln ( ExceptionFullGet::ExcMysqlN ( $exc ) );
	}
}

if ($_POST['retention'] == 'add_page') {
	try {
		$query = "INSERT INTO {$tbl_sturture}
						SET
						page_id 		= '{$_POST[page_id]}',
						parent_id  		= '{$_POST[parent_id]}',
						hide 			= " . ($_POST['hide'] ? $_POST['hide'] : "NULL") . ",
						p_type			= '{$_POST[p_type]}',
						lang_id			= 1,
						p_w_menu		= '{$_POST[p_w_menu]}',
						p_w_title		= '{$_POST[p_w_title]}',
						p_w_keyw		= '{$_POST[p_w_keyw]}',
						p_w_desc		= '{$_POST[p_w_desc]}',
						p_level			= " . ($_POST['p_level'] ? $_POST['p_level'] : "NULL") . ",
						pos				= " . ($_POST['pos'] ? $_POST['pos'] : "NULL") . ",
						page_url		= '" . strtolower ( ($_POST['page_url'] ? $_POST['page_url'] : translitStrlover ( $_POST['page_url_text'] ? $_POST['page_url_text'] : $_POST['p_w_menu'] )) ) . "'";
		if (! mysql_query ( $query ))
			throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT or UPDATE TEMPLATE MODULE" );
		$query = "INSERT INTO {$tbl_sturture}
						SET
						page_id 		= '{$_POST[page_id]}',
						parent_id  		= '{$_POST[parent_id]}',
						hide 			= " . ($_POST['hide'] ? $_POST['hide'] : "NULL") . ",
						p_type			= '{$_POST[p_type]}',
						lang_id			= 2,
						p_w_menu		= '{$_POST[p_w_menu]}',
						p_w_title		= '{$_POST[p_w_title]}',
						p_w_keyw		= '{$_POST[p_w_keyw]}',
						p_w_desc		= '{$_POST[p_w_desc]}',
						p_level			= " . ($_POST['p_level'] ? $_POST['p_level'] : "NULL") . ",
						pos				= " . ($_POST['pos'] ? $_POST['pos'] : "NULL") . ",
						page_url		= '" . strtolower ( ($_POST['page_url'] ? $_POST['page_url'] : translitStrlover ( $_POST['page_url_text'] ? $_POST['page_url_text'] : $_POST['p_w_menu'] )) ) . "'";
		if (! mysql_query ( $query ))
			throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT or UPDATE TEMPLATE MODULE" );
		$query = "INSERT INTO {$tbl_sturture}
						SET
						page_id 		= '{$_POST[page_id]}',
						parent_id  		= '{$_POST[parent_id]}',
						hide 			= " . ($_POST['hide'] ? $_POST['hide'] : "NULL") . ",
						p_type			= '{$_POST[p_type]}',
						lang_id			= 3,
						p_w_menu		= '{$_POST[p_w_menu]}',
						p_w_title		= '{$_POST[p_w_title]}',
						p_w_keyw		= '{$_POST[p_w_keyw]}',
						p_w_desc		= '{$_POST[p_w_desc]}',
						p_level			= " . ($_POST['p_level'] ? $_POST['p_level'] : "NULL") . ",
						pos				= " . ($_POST['pos'] ? $_POST['pos'] : "NULL") . ",
						page_url		= '" . ($_POST['page_url'] ? $_POST['page_url'] : translitStrlover ( $_POST['page_url_text'] ? $_POST['page_url_text'] : $_POST['p_w_menu'] )) . "'";
		if (! mysql_query ( $query ))
			throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT or UPDATE TEMPLATE MODULE" );
		
		if (! empty ( $_POST['pc_text'] )) {
			$_POST['pc_id'] = ($_POST['pc_id'] ? $_POST['pc_id'] : uniqid ());
			$query = "INSERT INTO
			{$tbl_content}
							SET
								pc_id 			= '{$_POST['pc_id']}',
								page_id  		= '{$_POST['page_id']}',
								pc_type  		= '{$_POST['pc_type']}',
								lang_id			= {$_COOKIE['lang_id']},
								pc_text 		= '{$_POST['pc_text']}';";
			if (! mysql_query ( $query ))
				throw new ExceptionMySQL ( mysql_error (), $query, "ERROR" );
			$query = "INSERT INTO `pages_temp_mod` (`pt_id`, `page_id`, `temp_id`, `pos`, `pos_temp_id`, `pt_val`)
						VALUES (NULL, '{$_POST['page_id']}', 142, 1, 1, '');";
			if (! mysql_query ( $query ))
				throw new ExceptionMySQL ( mysql_error (), $query, "ERROR" );
		}
		
		$response['success'] = "true";
		header ( 'Content-type: text/plain' );
		echo $json_converter->encode ( $response );
	} catch ( ExceptionMySQL $exc ) {
		echo ExceptionFullGet::ExcMysqlN ( $exc );
		// $log->writeln ( ExceptionFullGet::ExcMysqlN ( $exc ) );
	}
}

if ($_POST['retention'] == 'add_content') {
	try {
		$_POST['pc_id'] = ($_POST['pc_id'] ? $_POST['pc_id'] : uniqid ());
		$query = "INSERT INTO
		{$tbl_content}
						SET
							pc_id 			= '{$_POST['pc_id']}',
							page_id  		= '{$_POST['page_id']}',
							pc_type  		= '{$_POST['pc_type']}',
							lang_id			= {$_COOKIE['lang_id']},
							pc_text 		= '{$_POST['pc_text']}';";
		if (! mysql_query ( $query ))
			throw new ExceptionMySQL ( mysql_error (), $query, "ERROR" );
		$response['success'] = "true";
		header ( 'Content-type: text/plain' );
		echo $json_converter->encode ( $response );
	} catch ( ExceptionMySQL $exc ) {
		echo ExceptionFullGet::ExcMysqlN ( $exc );
		// $log->writeln ( ExceptionFullGet::ExcMysqlN ( $exc ) );
	}
}

if ($_POST['retention'] == 'edit_content') {
	
	$arr_update = array(
			"pc_text" => "'" . mysql_real_escape_string ( $_POST[pc_text] ) . "'");
	
	$cl_page_update = new mysql_select ( $tbl_content );
	$cl_page_update->update_table ( "WHERE pc_id = '{$_POST[pc_id]}' AND lang_id = {$_COOKIE[lang_id]}", $arr_update );
	
	$response['success'] = true;
	header ( 'Content-type: text/plain' );
	echo $json_converter->encode ( $response );
}

?>
