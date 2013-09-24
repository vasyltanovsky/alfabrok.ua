<?php
require_once '../utils/template.ajax/js.css.php';

#объявляем класс словаря
$dictionaries = new dictionaries ( );
#формируем массив имени словарей
$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries );
#формируем массив значений словарей
$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = {$_COOKIE[lang_id]}" );

#задаем айди значение справочника меню
$dictionaries->do_dictionaries(10);
#перечень значение словаря новостей
$menu_dct	 = $dictionaries->my_dct;

#задаем айди значение справочника меню
$dictionaries->do_dictionaries(76);
#перечень значение словаря новостей
$typesPage	 = $dictionaries->my_dct;

#	селектим таблицу страниц
$cl_sel_pages = new mysql_select($tbl_sturture,
								 "WHERE lang_id = $_COOKIE[lang_id]");
$cl_sel_pages->select_table ("page_id");

#	функция формирует списов возможный родителей, справочник меню
function sel_parent_id($arr, $sel = 'NULL', $name_id = 'page_id', $echo_id = 'menu_words')
{
	$str = NULL;
	for($i=0; $i<count($arr); $i++)
	{
		$selecteOption = NULL;
		if($sel)
		if($sel == $arr[$i][$name_id]) $selecteOption = "selected=\"selected\"";
		$str .= "<option {$selecteOption} value=\"{$arr[$i][$name_id]}\">{$arr[$i][$echo_id]}</option>";
	}
	return $str;
}
?>
<script type="text/javascript">
function hide_ajax_div() {
	 $('#dialog-page-body').hide();
	 $('#d-dialog').hide();
}
$(function() {
  $("#tabs").tabs();
});
</script>
<div id="dialog-page-body"></div>
<div id="d-dialog">
  <div id="d-dialog-in">
    <table class="t-dialog">
      <tr>
        <td class="td-dialog-close"><div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix" unselectable="on" style="-moz-user-select: none;"> <span class="ui-dialog-title" id="ui-dialog-title-outputWindows" unselectable="on" style="-moz-user-select: none;">Добавление &laquo;Страницы&raquo;</span> <a href="#" class="ui-dialog-titlebar-close ui-corner-all" role="button" unselectable="on" onclick="hide_ajax_div();" style="-moz-user-select: none;"> <span class="ui-icon ui-icon-closethick" unselectable="on" style="-moz-user-select: none;">close</span></a></div></td>
      </tr>
      <tr>
        <td class="td-dialog-form">
		<div id="d-overflow">
		<?php
			#	подключение формы для редактирования
			include_once "template.add/form.page.php";
		?>
		</div>
		</td>
      </tr>
    </table>
  </div>
</div>
