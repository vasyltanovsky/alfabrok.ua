<!-- РЕДАКТИРОВАНИЕ ПОЗИЦИИ -->
<?php
	$ZpFormInc = 'formEdit.js';
	require_once '../utils/template.ajax/js.css.php';
	#	селектим таблицу страниц
   		$cl_sel_pages = new mysql_select($tbl_cache_site);
		$cl_sel_pages -> select_table("cs_id");
?>
<script type="text/javascript">
//	page dialog hide
function hide_ajax_div()
{
	 $('#DivRequest').load('template.load.php?print=list_page');
	 $('#dialog-page-body').hide();
	 $('#d-dialog').hide();
}
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
						<?php
                            #	преобразуем флажки
								$active_id = $cl_sel_pages -> buld_table[$_POST['cs_id']];
								
								$is_cache_on = "checked=\"checked\"";
								if(!$active_id['is_cache_on']) $is_cache_on  = '';
							
							#	подключение формы для редактирования
								include_once("template.edit/form.page.php");
                        ?>
                        </div>
                    </td>
                </tr>
            </table>	
		</div>
	</div>   
<!-- РЕДАКТИРОВАНИЕ ПОЗИЦИИ -->