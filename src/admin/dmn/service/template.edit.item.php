<?php
	$ZpFormInc = 'formEdit.js';
	require_once '../utils/template.ajax/js.css.php';
	#	селектим таблицу страниц
   		$cl_sel_pages = new mysql_select($tbl_service,
									   	 "WHERE lang_id = $_COOKIE[lang_id] AND dict_id='4c7e1b724c295'",
									     "ORDER BY pos");
		$cl_sel_pages -> select_table("sc_id");
	#объявляем класс словаря
		$dictionaries = new dictionaries();
		#формируем массив имени словарей
		$dct_list 	=	$dictionaries->buid_dictionaries_list($tbl_list_dictionaries);
		#формируем массив значений словарей
		$dct		=	 $dictionaries->buid_dictionaries($tbl_dictionaries,
									 	 				 "WHERE lang_id = $_COOKIE[lang_id]");
	#задаем айди значение справочника меню
		$dictionaries->do_dictionaries(2);
		#перечень значение словаря новостей
		$menu_dct	 = $dictionaries->my_dct;
		
	#задаем айди значение справочника меню
		$dictionaries->do_dictionaries(21);
	#перечень значение словаря новостей
		$CatSer_dct	 = $dictionaries->my_dct;
		
	#	функция формирует списов возможный родителей, справочник меню
		function sel_parent_id($arr, $sel = 'NULL', $name_id = 'sc_id', $echo_id = 'menu_words')
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
                #	преобразуем флажки
								$active_id = $cl_sel_pages -> buld_table[$_POST['sc_id']];
								$menu_show = "checked=\"checked\"";
								if($active_id['menu_show'] == 'hide') $menu_show = '';
								$title_show = "checked=\"checked\"";
								if($active_id['title_show'] == 'hide') $title_show = '';
								$description_show = "checked=\"checked\"";
								if($active_id['description_show'] == 'hide') $description_show = '';
								$summary_show = "checked=\"checked\"";
								if($active_id['summary_show'] == 'hide') $summary_show = '';
								$hide = "checked=\"checked\"";
								if($active_id['hide'] == 'hide') $hide = '';
								
			if(empty($active_id['img'])) {
				$requeryImg = "template.add/form.add.img.php";
			}
			else {
				$requeryImg = "template.load.img.php";
			}
			$is_top = "checked=\"checked\"";
			if(!$active_id['is_top']) $is_top = '';
			
			
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
	//$('#DivRequestImg').load('template.load.img.php?sc_id=<?php echo $_POST['sc_id'];?>');
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
									<li><a href="#tabs-2">Изображение</a></li>
                                </ul>
								<div id="tabs-1">
									<?php
			                         	#	подключение формы для редактирования
											include_once("template.edit/form.page.php");
			                        ?>
			                    </div>
								<div id="tabs-2">
									<div id="DivRequestImg">
                                    <?php
			                         	#	подключение формы для редактирования
											include_once($requeryImg);
			                        ?>
                                    
                                    </div>
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