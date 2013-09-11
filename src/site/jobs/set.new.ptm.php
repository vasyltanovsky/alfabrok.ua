<?php
//константы
define ( 'SLASH', '/' );
define ( 'DOC_ROOT', $_SERVER ['DOCUMENT_ROOT'] );
define ( 'DEBUG', 1 );
//поключение конфига
include DOC_ROOT . '/config/config.php';
include DOC_ROOT . '/config/class.config.php';


$pageIdWhere = '4d7cb8f92de71';
$pageIdSet = '4dccdf1713b78';

$PTMData = new mysql_select ( );
$PTMData->select_table_query ( "select p.* from {$tbl['ptm']['name']} p 
								where p.page_id = '{$pageIdWhere}'
								order by p.pt_id", "pt_id" );

$PTMMaxData = new mysql_select ( );
$PTMMaxData->select_table_query ( "select MAX(pt_id) from {$tbl['ptm']['name']}");	
$maxPtId = $PTMMaxData->table[0][0];
								
//echo "<prE>";
//print_r($PTMData->table);
//echo "</prE>";

for ($i=0; $i<count($PTMData->table); $i++) {
	$maxPtId++;
	$temp_id = ($PTMData->table[$i]['temp_id'] ? $PTMData->table[$i]['temp_id'] : "NULL"); 
	$mod_id = ($PTMData->table[$i]['mod_id'] ? $PTMData->table[$i]['mod_id'] : "NULL"); 
	$pos = ($PTMData->table[$i]['pos'] ? $PTMData->table[$i]['pos'] : "NULL"); 
	$parent_id = ($PTMData->table[$i]['parent_id'] ? $PTMData->table[$i]['parent_id'] : "NULL"); 
	$pos_temp_id = ($PTMData->table[$i]['pos_temp_id'] ? $PTMData->table[$i]['pos_temp_id'] : "NULL"); 
	$pt_is_cache = ($PTMData->table[$i]['pt_is_cache'] ? $PTMData->table[$i]['pt_is_cache'] : "NULL"); 
	$pt_val = ($PTMData->table[$i]['pt_val'] ? "'".$PTMData->table[$i]['pt_val']."'" : "NULL"); 
	
	for ($j=0; $j<count($PTMData->table); $j++) {
		if($PTMData->table[$j]['parent_id'] == $PTMData->table[$i]['pt_id']) {
			$PTMData->table[$j]['parent_id'] = $maxPtId;
		}
	}
	echo $query = "INSERT INTO `pages_temp_mod` (`pt_id`, `page_id`, `temp_id`, `mod_id`, `pos`, `parent_id`, `pos_temp_id`, `pt_is_cache`, `pt_val`) 
				VALUES ({$maxPtId}, '{$pageIdSet}', {$temp_id}, {$mod_id}, {$pos}, {$parent_id}, {$pos_temp_id}, {$pt_is_cache}, {$pt_val})";
	echo "<br>";
	if (! mysql_query ( $query ))
		throw new ExceptionMySQL ( mysql_error (), $query, "ERROR" );
	echo $i . "<br>";
}
echo 'done';
?>