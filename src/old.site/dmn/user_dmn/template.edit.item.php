<!-- РЕДАКТИРОВАНИЕ ПОЗИЦИИ -->
<?php
$ZpFormInc = 'formEdit.js';
require_once '../utils/template.ajax/js.css.php';
#	селектим таблицу страниц
$cl_sel_pages = new mysql_select ( "system_accounts" );
$active_id = $cl_sel_pages->select_table_id ( "WHERE id_account = '$_POST[id_account]'" );

#	функция формирует списов возможный родителей, справочник меню
function sel_parent_id($arr, $sel = 'NULL', $name_id = 'news_id', $echo_id = 'menu_words') {
	$str = NULL;
	for($i = 0; $i < count ( $arr ); $i ++) {
		$selecteOption = NULL;
		if ($sel)
			if ($sel == $arr [$i] [$name_id])
				$selecteOption = "selected=\"selected\"";
		$str .= "<option {$selecteOption} value=\"{$arr[$i][$name_id]}\">{$arr[$i][$echo_id]}</option>";
	}
	return $str;
}

#объявляем класс словаря
$dictionaries = new dictionaries ();
#формируем массив имени словарей
$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries );
#формируем массив значений словарей
$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = $_COOKIE[lang_id]" );
//
$dictionaries->do_dictionaries ( 74 );
$rolesAdminDict = $dictionaries->my_dct;
//
$dictionaries->do_dictionaries ( 75 );
$typeAdministrator = $dictionaries->my_dct;

#	преобразуем флажки
$hide = "checked=\"checked\"";
if ($active_id ['hide'] == 'hide')
	$hide = '';
$IsShowIndex = "checked=\"checked\"";
if (empty ( $active_id ['is_show_index'] ))
	$IsShowIndex = '';

$rolesAdmin = explode ( ",", $active_id ["rool"] );

if (empty ( $active_id ['photo'] )) {
	$requeryImg = "template.add/form.add.img.php";
} else {
	$requeryImg = "template.load.img.php";
}

?>

<script>
//	page dialog hide
function hide_ajax_div() {
	 $('#DivRequest').load('template.load.php?print=list_page');
	 $('#dialog-page-body').hide();
	 $('#d-dialog').hide();
}
$(function() {
	$("#tabs").tabs();
});
</script>
<div id="dialog-page-body">
</div>

    <div id="d-dialog">
 		<div id="d-dialog-in">
    		<table class="t-dialog">
            	<tr>
                	<td class="td-dialog-close">
                    	<a href="#" class="a-dialog-close" onclick="hide_ajax_div();"><h3 class="a-h3-dialog-close">закрыть</h3></a>
                    </td>
                </tr>
                <tr>
                	<td class="td-dialog-form">
                    <div id="d-overflow">
							<div id="tabs">
								<ul>
									<li><a href="#tabs-1">Текст</a></li>
								    <li><a href="#tabs-2">Фото</a></li>
								</ul>
								<div id="tabs-1">
									<?php
			                         	#	подключение формы для редактирования
											include_once("template.edit/form.page.php");
			                        ?>
			                    </div>
			                    <div id="tabs-2">
                                	<div id="DivRequestImg">
										<?php include_once($requeryImg);?>
			                    	</div>
                                </div>
			               </div>
						</div>						
                    </td>
                </tr>
            </table>	
		</div>
	</div>   
<!-- РЕДАКТИРОВАНИЕ ПОЗИЦИИ -->