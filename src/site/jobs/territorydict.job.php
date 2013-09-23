<?php
/**
 * джоба скрывает элементы региональных справочников которые не используються
 */
require 'config.php';
$mysql = new mysql_select ( "dictionaries" );
// скрываем все элементы терротериального справочника
$mysql->update_table ( " where ld_id in (11,12,13,14,15,24)", array (
		"hide" => "0" 
) );
// обновляем элементы по которые есть недвижимость
$mysql->query ( "UPDATE dictionaries SET hide = 1 WHERE dict_id in (select im_array_id as dict_id from immovables where hide = 'show');" );
$mysql->query ( "UPDATE dictionaries SET hide = 1 WHERE dict_id in (select im_region_id as dict_id from immovables where hide = 'show');" );
$mysql->query ( "UPDATE dictionaries SET hide = 1 WHERE dict_id in (select im_a_region_id as dict_id from immovables where hide = 'show');" );
$mysql->query ( "UPDATE dictionaries SET hide = 1 WHERE dict_id in (select im_city_id as dict_id from immovables where hide = 'show');" );
$mysql->query ( "UPDATE dictionaries SET hide = 1 WHERE dict_id in (select im_area_id as dict_id from immovables where hide = 'show');" );
$mysql->query ( "UPDATE dictionaries SET hide = 1 WHERE dict_id in (select im_adress_id as dict_id from immovables where hide = 'show');" );