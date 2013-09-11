<?php
require_once 'application/includes/immovables/setting.im.print.inc';

function GetExceptionLink($list, $exception)
{
	if (count($list) == 1 && $list[0] == $exception)
	{
		$link = "";	
	}
	else
	{
		$except_func = create_function('$var', 'return $var != "'.$exception.'";');
		$link = "s_immovables.html?id=".implode(",", array_filter($list, $except_func))."&action=s_code";
	}
		return "<a href=\"$link\">X</a>";
}

switch ($_GET ['action']) {
	case 's_code' :
		{
			$title_page = $arWords ['SearchImmovablesCode'];
			$arr = preg_replace("'[^0-9KCHMT]'i", "", strtoupper($_GET ['id']));
			$arr = preg_replace("'[KCHMT]'i", ",$0", $arr);
			if ($arr[0] == ',')
			{
				$arr = substr($arr, 1);
			}
			$str = implode ( "','", explode ( ',', $arr ) );
			global $SearchImmovablesCode;
			global $SearchImmovablesCodes;
			$SearchImmovablesCodes = explode ( ',', $arr );
			$SearchImmovablesCode = implode ( ",", explode ( ',', $arr ) );
			$WhereQuery = " i WHERE i.hide = 'show' AND i.im_code IN ('{$str}')";
			// echo $WhereQuery;
			//echo utf8_encode($WhereQuery);
			if (count($SearchImmovablesCodes) > 0)
			{
				$CodesList = "<div class=\"SearchImmovablesCodes\">";
				for($i = 0 ; $i < count($SearchImmovablesCodes); $i++)
				{ 
					$CodesList = $CodesList."<span>$SearchImmovablesCodes[$i]".GetExceptionLink($SearchImmovablesCodes, $SearchImmovablesCodes[$i])."</span> ";    	
				} 
    			$CodesList = $CodesList."</div>";
			}
			break;
		}
	case 'hot_im' :
		{
			$title_page = $arWords ['ImDivListHeaderHot'];
			$WhereQuery = " i WHERE i.hide = 'show' AND i.im_is_hot = 1";
			break;
		}
	default :
		{
			$title_page = $arWords ['ImDivListHeaderPrice'];
			$WhereQuery = " i WHERE i.hide = 'show' AND i.im_prace < i.im_prace_old";
			break;
		}
}

#выборка характеристик недвижимости	
//$ImPropListInfo = new mysql_select ( $tbl_im_pl, "l left join {$tbl_im_pi} i ON l.im_prop_id = i.im_prop_id WHERE l.lang_id = {$_COOKIE['lang_id']} AND i.lang_id = {$_COOKIE['lang_id']} AND type_prop='advanced' AND hide='show'", "ORDER BY im_prop_name ASC" );
//$ImPropListInfo->select_table ( "im_prop_id" );

$paging_str = '&action=' . $_GET [action] . "&id=" . $_GET ["id"];
#выборка недвижимоти
$obj = new pager_mysql ( $tbl_im, $WhereQuery, "ORDER BY i.{$_COOKIE[im_where_sort]}", "10", // Число позиций на странице
"5", // Число ссылок в постраничной навигации
$paging_str );// Объявляем объект постраничной навигации

$ImData = $obj->get_page ();
$ids = "";
if($ImData != 0) {
		foreach($ImData as $key=>$value) {
			$ids .= sprintf("%s,", $value['im_id']);
		}
		$ids = sprintf("(%s)", substr($ids, 0, -1 ));
		#РІС‹Р±РѕСЂРєР° С…Р°СЂР°РєС‚РµСЂРёСЃС‚РёРє РЅРµРґРІРёР¶РёРјРѕСЃС‚Рё	
		$ImPropListInfo = new mysql_select ( $tbl_im_pl );
		$ImPropListInfo-> select_table_query("select i.*, l.* from im_properties_info i 
												left join immovables p on p.im_id = i.im_id 
												left join im_properties_list l on l.im_prop_id = i.im_prop_id
												where l.lang_id = 1 AND i.lang_id = 1 and p.im_catalog_id='4c3ec3ec5e9b5' AND p.hide='show' and p.im_id in {$ids}", "im_prop_id");
}

//   echo '<pre>';
// print_r($ImData);
//  echo '</pre>';
if (empty ( $ImData )) {
	if ($_GET ['action'] == 's_code') {
		$ImPageContentArr ['error_text'] = $arWords ['cp_no_position_code'];
		$ImPageContentClass = new ModuleSite ( $ModuleTemplate );
		$ImPagesContent .= $ImPageContentClass->For_HTML ( $ModuleTemplate ['error_page'], $ImPageContentArr );
		return;
	}
	$ImPageContentArr ['error_text'] = $arWords ['cp_no_position_code'];
	$ImPageContentClass = new ModuleSite ( $ModuleTemplate );
	$ImPagesContent .= $ImPageContentClass->For_HTML ( $ModuleTemplate ['error_page'], $ImPageContentArr );
	return;
}

#преобразование данных характеристик и значений
$ImPropData = new PropSort ( $ImPropListInfo->table );
$ImPropData->GetArrToPrint ( 'im_id', array ('is_print_list', 'is_print_ad', 'is_print_st' ) );

#формирование списка недвижимости
$ModImPropP = new ModuleSiteIm ( $ModuleTemplate, $arWords, $dictionaries, $ImPropData->ImPropData, $ImPropData->ImPropArrData );
$ImPagesContent = $ModImPropP->Handler_Template_Html ( 'search_list_table_block', $ImData, $TemplateImList ['search'] );
$ImPagesContent .= "<div class=\"DivPaging\">" . $obj . "</div>";

?>