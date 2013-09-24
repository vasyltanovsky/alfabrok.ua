<?php
error_reporting ( E_ALL & ~ E_NOTICE );
define ( 'DOC_ROOT', $_SERVER['DOCUMENT_ROOT'] );

// Устанавливаем соединение с базой данных
require_once (DOC_ROOT . "/config/config.php");
// Подключаем блок авторизации
// require_once("../utils/security_mod.php");
// Подключаем SoftTime FrameWork
require_once (DOC_ROOT . "/config/class.config.php");
require_once (DOC_ROOT . "/dmn/utils/cms.images.php");

define ( 'SLASH', '../../' );
function PrintTemplateModule($data) {
	$ret = '';
	for($i = 0; $i < count ( $data ); $i ++) {
		$ret[$data[$i]['temp_id']] .= $data[$i]['m_name'] . "<br>";
	}
	return $ret;
}

// бъявляем класс словаря
$dictionaries = new dictionaries ();
// ормируем массив имени словарей
$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries );
// ормируем массив значений словарей
$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = {$_COOKIE[lang_id]}" );
if ($_GET['print'] == 'print_temp') {
	$ClTempCel = new mysql_select ();
	$ClTempCel->select_table_query ( "SELECT m.*  FROM {$tbl_temp} m order by temp_id", 'temp_id' );
	
	if (empty ( $ClTempCel->table ))
		die ( "<br><b>По Вашему запросу ничего не найдено!</b>" );
	
	for($i = 0; $i < count ( $ClTempCel->table ); $i ++) {
		$tRclass = "";
		if ($i % 2 != 0)
			$tRclass = "class=random";
		
		$pagesReturn .= "<tr {$tRclass}>";
		$pagesReturn .= "<td><input type=\"radio\" value=\"{$ClTempCel->table[$i]['page_id']}\" name=\"page_id\"/></td>";
		$pagesReturn .= "<td>{$ClTempCel->table[$i]['page_id']}</td>";
		$pagesReturn .= "<td>{$ClTempCel->table[$i]['page_name']}</td>";
		
		$pagesReturn .= "</tr>";
	}
	
	$pagesReturnHeader = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"table-list\">
								<tr class=\"headings\">
								    <td width=\"10\"></td>
									<td width=\"10\">Id</td>
									<td width=\"250\">Название страницы</td>
								</tr>";
	$pagesReturnBottom = "</table>";
	
	echo $pagesReturnHeader . $pagesReturn . $pagesReturnBottom;
	/*
	 * echo "<pre>"; print_r($ClCertifPQ); echo "</pre>"; $ModCerPropP = new ModuleSite($ModuleTemplate); $ModCerPropP -> SetValueToPrivateField('model_data', $ModelDataBT); $ImPagesContent = $ModCerPropP -> Handler_Template_Html('list_certificate', $ClCertifPQ->table, $SettingTemplate['list_print']);
	 */
}

if ($_GET['print'] == 'print_ptm') {
	$ClPTMCel = new mysql_select ();
	$ClPTMCel->select_table_query ( "SELECT p.* FROM {$tbl_sturture} p WHERE p.lang_id = 1 order by p.pos", 'page_id' );
	
	$PSSortObj = new CatalogHadler ( $ClPTMCel->table, $ClPTMCel->buld_table, 'p_menu', 'page_id', 'parent_id' );
	$PSSortObj->get_arr_formation ();
	
	/*
	 * echo "<prE>"; print_r($ClPTMCel->buld_table); echo "</prE>";
	 */
	if (empty ( $ClPTMCel->table ))
		die ( "<br><b>По Вашему запросу ничего не найдено!</b>" );
	
	for($i = 0; $i < count ( $PSSortObj->ArrFormation ); $i ++) {
		$tRclass = "";
		if ($i % 2 != 0)
			$tRclass = "class=random";
		
		$p_level = $ClPTMCel->buld_table[$PSSortObj->ArrFormation[$i][0]]['p_level'] * 7;
		$pagesReturn .= "<tr {$tRclass}>";
		$pagesReturn .= "<td><input type=\"radio\" value=\"{$ClPTMCel->buld_table[$PSSortObj->ArrFormation[$i][0]]['page_id']}\" name=\"page_id\"/></td>";
		$pagesReturn .= "<td>{$ClPTMCel->buld_table[$PSSortObj->ArrFormation[$i][0]]['page_id']}</td>";
		$pagesReturn .= "<td><span style=\"margin-left:{$p_level}px\">{$ClPTMCel->buld_table[$PSSortObj->ArrFormation[$i][0]]['p_w_menu']}</span></td>";
		$pagesReturn .= "<td>{$ClPTMCel->buld_table[$PSSortObj->ArrFormation[$i][0]]['page_url']}</td>";
		$pagesReturn .= "<td>{$ClPTMCel->buld_table[$PSSortObj->ArrFormation[$i][0]]['p_w_title']}</td>";
		$pagesReturn .= "<td><small>{$ClPTMCel->buld_table[$PSSortObj->ArrFormation[$i][0]]['p_w_keyw']}</small></td>";
		$pagesReturn .= "<td>{$ClPTMCel->buld_table[$PSSortObj->ArrFormation[$i][1]]['p_w_menu']}</td>";
		$pagesReturn .= "<td>{$ClPTMCel->buld_table[$PSSortObj->ArrFormation[$i][0]]['pos']}</td>";
		$pagesReturn .= "<td>{$ClPTMCel->buld_table[$PSSortObj->ArrFormation[$i][0]]['p_level']}</td>";
		$pagesReturn .= "<td>{$dictionaries->buld_table[$ClPTMCel->buld_table[$PSSortObj->ArrFormation[$i][0]]['page_type']]['dict_name']}</td>";
		$pagesReturn .= "<td>{$dictionaries->buld_table[$ClPTMCel->buld_table[$PSSortObj->ArrFormation[$i][0]]['p_type']]['dict_name']}</td>";
		$pagesReturn .= "<td>{$CMSImagesNum[$ClPTMCel->buld_table[$PSSortObj->ArrFormation[$i][0]]['hide']]}</td>";
		$pagesReturn .= "<td>{$CMSImagesNum[$ClPTMCel->buld_table[$PSSortObj->ArrFormation[$i][0]]['is_cache']]}</td>";
		$pagesReturn .= "</tr>";
	}
	
	$pagesReturnHeader = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"table-list\">
								<tr class=\"headings\">
								    <td width=\"10\"></td>
									<td width=\"100\">Id</td>
									<td width=\"300\">Cтраница (меню)</td>
									<td>Url страницы</td>
									<td width=\"\">(web) Заголовок страницы</td>
									<td width=\"\">(web) Ключевые слова</td>
									<td width=\"\">Родительская страница</td>
									<td width=\"\">Позиция</td>
									<td width=\"\">Уровень</td>
									<td width=\"\">Тип стр.</td>
									<td width=\"\">Тип меню</td>
									<td width=\"50\">Отображать</td>
									<td width=\"50\">Кешировать</td>
								</tr>";
	$pagesReturnBottom = "</table>";
	
	echo $pagesReturnHeader . $pagesReturn . $pagesReturnBottom;
}
?>
    	
        