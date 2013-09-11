<!-- ДОБАВЛЕНИЕ ПОЗИЦИИ -->
<?php require_once '../utils/template.ajax/js.css.php';?>
<?php
	
	#объявляем класс словаря
		$dictionaries = new dictionaries();
		#формируем массив имени словарей
		$dct_list 	=	$dictionaries->buid_dictionaries_list($tbl_list_dictionaries);
		#формируем массив значений словарей
		$dct		=	 $dictionaries->buid_dictionaries($tbl_dictionaries,
									 	 				 "WHERE lang_id = {$_COOKIE[lang_id]}");
	#задаем айди значение справочника меню
		$dictionaries->do_dictionaries(2);
		#перечень значение словаря новостей
		$menu_dct	 = $dictionaries->my_dct;
			
	#	функция формирует списов возможный родителей, справочник меню
		function sel_parent_id($arr, $sel = 'NULL', $name_id = 'pc_id', $echo_id = 'menu_words')
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
//	page dialog hide
function hide_ajax_div()
{
	 $('#DivRequest').load('template.load.php?print=list_page');
	 $('#dialog-page-body').hide();
	 $('#d-dialog').hide();
}
$(function() {
	$("#tabs").tabs();
});
</script>
<!--<script type='text/javascript' src='template.edit/demo.js'></script>-->
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
							<?php
			                   	#	подключение формы для редактирования
								include_once("template.add/form.page.php");
			                ?>
			           </div>
                    </td>
                </tr>
            </table>	
		</div>
	</div>   
<!-- ДОБАВЛЕНИЕ ПОЗИЦИИ -->