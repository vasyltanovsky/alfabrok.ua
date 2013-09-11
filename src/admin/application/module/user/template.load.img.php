<?php
  	// Устанавливаем соединение с базой данных
	require_once("../../../config/config.php");
require_once DOC_ROOT . '/config/class.config.php';
	include_once '../../includes/language/set.cookie.php';
	require_once '../../includes/module/template.module.php';
	
	#объявляем класс словаря
	$dictionaries = new dictionaries();
	#формируем массив имени словарей
	$dct_list 	=	$dictionaries->buid_dictionaries_list($tbl_list_dictionaries, "ORDER BY ld_name ASC");
	#формируем массив значений словарей
	$dct		=	 $dictionaries->buid_dictionaries($tbl_dictionaries,
									 	 				 "WHERE lang_id = {$_COOKIE[lang_id]}",
														 "ORDER BY dict_name ASC");

	if($_GET['im_id'])
	{
		//
		$cl_sel_pages = new mysql_select($tbl_im);
		$activeId = $cl_sel_pages -> select_table_id("WHERE im_id='{$_GET['im_id']}'");
	
       #выборка логотипов пользователя
		$cl_photo_class = new mysql_select($tbl_im_ph,
								  "WHERE im_id = {$_GET['im_id']}",
								  "order by im_photo_id");
		$cl_photo_class -> select_table("im_photo_id");
		
		if($cl_photo_class -> table) {
			#подстановка позиций в шаблон вывода логотипов 		
			
			$ModuleTemplate['photo_list_block_header'] = "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"list_Flat_table_block\"><tr class=\"list_Flat_table_block_header\"><td class=\"TdLeftBorder\"></td><td>{$arWords['im_add_im_img_label']}</td><td class=\"TdRightBorder\">{$arWords['im_add_im_img_type_label']}</td></tr>";
			$ModuleTemplate['photo_list_block_bottom'] = "</table>";		
			
			for($i= 0; $i<count($cl_photo_class->table); $i++) {
				
				if($activeId['im_photo'] == $cl_photo_class->table[$i]['im_photo_id'].'.'.$cl_photo_class->table[$i]['im_file_type']) 
					$im_photo_type = 'Главное изображение';
				else 	
					$im_photo_type = $dictionaries->buld_table[$cl_photo_class->table[$i]['im_photo_type']]['dict_name'];

				$ret .=	"<div class=\"TablePhotoListPhotoUserAdd\"><table><tr><td width=\"15\"><input type=\"radio\" value=\"{$cl_photo_class->table[$i]['im_photo_id']}\" name=\"im_photo_id\"/></td><td class=\"TdListLogoALignCenter\"><img src=\"../../files/images/immovables/s_{$cl_photo_class->table[$i]['im_photo_id']}.{$cl_photo_class->table[$i]['im_file_type']}\" alt=\"\" title=\"\"></td></tr><td colspan=\"2\" class=\"TdListLogoATypePhoto\">{$im_photo_type}</td></tr></table></div>";
					
//				$ret .= "<tr>
//				<td class=\"TdListLeftBorder\" width=\"15px\"><input type=\"radio\" value=\"{$cl_photo_class->table[$i]['im_photo_id']}\" name=\"im_photo_id\"/></td>
//				<td class=\"TdListLogoALignCenter\"  width=\"75px\"><img src=\"../../files/images/immovables/s_{$cl_photo_class->table[$i]['im_photo_id']}.{$cl_photo_class->table[$i]['im_file_type']}\" alt=\"\" title=\"\"></td>
//				<td class=\"TdListRightBorder\">{$im_photo_type}</td></tr>";
	
			}
			//$RetPhoto = $ModuleTemplate['photo_list_block_header'].$ret.$ModuleTemplate['photo_list_block_bottom'];
			$RetPhoto  = $ret. "<div class=\"clear\"></div>";
		}
		else {
			
			$RetPhoto = "<div id=\"DivEchoResult\" style=\"padding: 0pt 0.7em; display: block; margin-top:10px;\" class=\"ui-state-error ui-corner-all\"> 
						<p><span style=\"float: left; margin-right: 0.3em;\" class=\"ui-icon ui-icon-alert\"></span> 
						<strong>Нет добавленных изображений!</strong></p>
					</div>";
		}
		echo $RetPhoto;
	}
?>
 