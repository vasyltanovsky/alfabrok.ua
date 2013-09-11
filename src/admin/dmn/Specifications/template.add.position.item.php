<!-- ДОБАВЛЕНИЕ ПОЗИЦИИ -->
<?php require_once '../utils/template.ajax/js.css.php';?>
<?php
	#	селектим таблицу страниц
   		$cl_sel_pages = new mysql_select($tbl_list_dictionaries,
									   	 "",
									     "");
		$cl_sel_pages -> select_table("ld_id");
	#объявляем класс словаря
		$dictionaries = new dictionaries();
		#формируем массив имени словарей
		$dct_list 	=	$dictionaries->buid_dictionaries_list($tbl_list_dictionaries);
		#формируем массив значений словарей
		$dct		=	 $dictionaries->buid_dictionaries($tbl_dictionaries,
									 	 				 "WHERE lang_id = {$_COOKIE[lang_id]}");

	 	$dictionaries = new dictionaries();
	#формируем массив имени словарей
		$dct_list 	=	$dictionaries->buid_dictionaries_list($tbl_list_dictionaries);
	#формируем массив значений словарей
		$dct		=	 $dictionaries->buid_dictionaries($tbl_dictionaries,
									 	 				 "WHERE lang_id = {$_COOKIE[lang_id]}");
	
		$dictionaries->do_dictionaries(23);
		$CatSer_dct	 = $dictionaries->my_dct;
		
	#	задаем айди значение справочника новостей
		$dictionaries->do_dictionaries(19);
	#	my_list_dct - сам словарь
		$cartype_lst 	 = $dictionaries->my_list_dct;
	#	перечень значение словаря новостей
		$new_dct_arr	 = $dictionaries->my_dct;
	#	родитель, ребенок формирование массива
		$new_dct_value = $dictionaries->BuildArrayParentChild($new_dct_arr);
	
	#	функция формирует списов возможный родителей, справочник меню
		function sel_parent_standart($arr, $sel = 'NULL', $name_id = 'sc_id', $echo_id = 'menu_words')
		{
			$str = NULL;
			for($i=0; $i<count($arr); $i++)
			{
				$selecteOption = NULL;
				if($sel)
				{
					if($sel == $arr[$i][$name_id]) 
					$selecteOption = "selected=\"selected\"";
				}
				
				$str .= "<option {$selecteOption} value=\"{$arr[$i][$name_id]}\">{$arr[$i][$echo_id]}</option>";
				
			}
			return $str;
		}	
			
	#	функция формирует списов возможный родителей, справочник меню
		function sel_parent_id($arr, $arr_build, $sel = 'NULL', $name_id = 'pc_id', $echo_id = 'menu_words')
		{
			$str = NULL;
			for($i=0; $i<count($arr); $i++)
			{
				$paddingLeft = $arr[$i][2]*10;
				$selecteOption = NULL;
				if($sel) if($sel == $arr[$i][$name_id]) $selecteOption = "selected=\"selected\"";
				$str .= "<option {$selecteOption} value=\"{$arr[$i][$name_id]}\" style=\"padding-left:{$paddingLeft}px!important\">{$arr_build[$arr[$i][$name_id]][$echo_id]}</option>";
			}
			return $str;
		}
?>
<script type="text/javascript">
//	page dialog hide
function hide_ajax_div()
{
	 $('#DivRequest').load('template.load.php?print=position_portfolio');
	 $('#dialog-page-body').hide();
	 $('#d-dialog').hide();
}
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
										include_once("template.add/form.page.position.php");
									?>
			            </div>
                    </td>
                </tr>
            </table>	
		</div>
	</div>   
<!-- ДОБАВЛЕНИЕ ПОЗИЦИИ -->