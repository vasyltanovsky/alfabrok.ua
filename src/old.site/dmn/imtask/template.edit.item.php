<?php require_once '../utils/template.ajax/js.css.php';?>
<?php 

$_POST = array_merge ( $_GET, $_POST );
	# 	Получаем содержимое текущей страницы
   		$cl_sel_pages = new mysql_select('realtor_tasks');
		$active_id = $cl_sel_pages -> select_table_id("where t_id = {$_POST[t_id]}");
											 
	#объявляем класс словаря
		$dictionaries = new dictionaries();
		#формируем массив имени словарей
		$dct_list 	=	$dictionaries->buid_dictionaries_list($tbl_list_dictionaries, "ORDER BY ld_name ASC");
		#формируем массив значений словарей
		$dct		=	 $dictionaries->buid_dictionaries($tbl_dictionaries,
									 	 				 "WHERE lang_id = {$_COOKIE[lang_id]}",
														 "ORDER BY dict_name ASC");

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
		
		function print_provider($data) {
			return $data['user_fio']."<br>".$data['user_phone_mobile']."<br>".$data['user_email'];
		}
		#
			function PrintLangSummary ($arr_lang) {
				for($i=0; $i<count($arr_lang); $i++) {
					 $ret .= "<a id=\"{$arr_lang[$i][dict_id]}\" href=\"javascript:SetImLang('{$arr_lang[$i][dict_id]}');\" alt=\"{$arr_lang[$i]['dict_name']}\" title=\"{$arr_lang[$i]['dict_name']}\">{$arr_lang[$i]['dict_name']}</a>";
				}
				return $ret;
			}
		$ProvData = '';	
		
		$is_do = '';
		if($active_id['is_do']) $is_do = "checked=\"checked\"";
			
		$ClProvQuery = new mysql_select($tbl_accounts);
		$ClProvQuery -> select_table_query("SELECT * FROM {$tbl_accounts}");
		
		$CLDate = new class_date();
		$active_id['t_date_reminder'] = $CLDate -> GetPeapleDateView($active_id['t_date_reminder']);
?>
<script type="text/javascript">
//	page dialog hide
function hide_ajax_div()
{
	 $('#DivRequest').load('template.load.php?<?php echo ($_POST['requery_id'] ? $_POST['requery_id']: 'print=list_page');?>');
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
							<div id="tabs">
								<ul>
									<li><a href="#tabs-1">Задание</a></li>
								</ul>
								<div id="tabs-1">
									<?php
			                         	#	подключение формы для редактирования
										include_once("template.edit/form.page.php");
			                        ?>
			                    </div>
								
							</div>
						</div>
                    </td>
                </tr>
            </table>	
		</div>
	</div>   
<!-- ДОБАВЛЕНИЕ ПОЗИЦИИ -->