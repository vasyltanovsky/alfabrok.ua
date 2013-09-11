<?php
  error_reporting(E_ALL & ~E_NOTICE); // Устанавливаем соединение с базой данных
  require_once("../../config/config.php");
  // Подключаем SoftTime FrameWork
require_once DOC_ROOT . '/config/class.config.php';

  // Подключаем блок авторизации
  require_once("../utils/security_mod.php");
 
  $title = 'Управление блоком значение справочника';
 
  // Включаем заголовок страницы
  require_once("../utils/top.php");

  try
  {
		# 	Получаем содержимое текущей страницы
   		$cl_sel_pages = new mysql_select($tbl_list_dictionaries,
									   	 "",
									     "ORDER BY ld_id ASC");
		$cl_sel_pages -> select_table("id_id");
		
		function printFormSelection($arr, $sel = 'NULL', $name_id = 'ld_id', $echo_id = 'ld_name')
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
<!-- AJAX-ответ от сервера заменит этот текст. -->
	<div id="output"></div>  
	
	<div id="d-filter">
    	<h3>Фильтр страници</h3>
		<form  action="index.position.php" method="get">
         	<ul>
            	<li>
                    <label>каталог справочников</label><br />
                    <select name="position_id">
                        <option value="">не выбрано</option>
                        <?php echo printFormSelection($cl_sel_pages->table, $_GET['position_id']);?>
                    </select>
                </li>
            </ul>
            <input type="submit" value="Применить"> 
        </form>
	</div>
	   
<form  id="myForm" action="" method="post">  
	<input value="<?php echo $_GET[position_id];?>" size="13" name="position_id" type="hidden" > 
      <div class="eventForm">
     	<a href="#" class="ui-state-default ui-corner-all bottom-padding" title="добавить значение" id="submitAdd"><span class="ui-icon ui-icon-plus"></span>добавить значение</a>
		<a href="#" class="ui-state-default ui-corner-all bottom-padding" title="редактировать значение" id="submitEdit"><span class="ui-icon ui-icon-pencil"></span>редактировать значение</a>
		<a href="#" class="ui-state-default ui-corner-all bottom-padding" title="удалить значение" id="submitDell"><span class="ui-icon ui-icon-trash"></span>удалить значение</a>
	 </div>
    <!--	Подгрузка списка позиций таблицы с помощью аякс запроса-->
        <div id="DivRequest">
        </div>  
</form>


<script type="text/javascript">
$(document).ready(function(){
	//	подгрузка аяксом списка страниц,(таблица)	
		$("#loading").ajaxStart(function(){
  		$(this).show();});
		$('#DivRequest').load('template.load.php?print=position_portfolio&position_id=<?php echo $_GET[position_id];?>');
		$("#loading").ajaxComplete(function(){
  		$(this).hide();});
	//	подгрузка дополнительных пунктов подменю в гланое меню	 
		 $("#wdictionaries").append('<a class="sub_active" href="index.position.php">Значение справочников</a>');
	// ---- Форма -----
	//	опции для добавления нового пункта
		  var optionsAdd = { 
			target: "#output",
			url:'template.add.position.item.php'
		  };
	//  опции для редактирования пункта
		  var optionsEdit = { 
			target: "#output",
			beforeSubmit: valideEdit,
			url:'template.edit.position.item.php'
		  };
	//  опции для удаления пункта
		  var optionsDell = { 
			target: "#output",
			beforeSubmit: valideDell,
			//url:'template.event.hadler.php'
		  };
		  
	//  запуск аякса для добавления   
		$('#submitAdd').bind("click", function(){
		  $('#myForm').ajaxSubmit(optionsAdd); 
		return false;
		});
	//  запуск аякса для редактирования
		$('#submitEdit').bind("click", function(){
		  $('#myForm').ajaxSubmit(optionsEdit); 
		return false;
		});
	//  запуск аякса для удаления
		$('#submitDell').bind("click", function(){
		  $('#myForm').ajaxSubmit(optionsDell); 
		return false;
	  });
			$('#submitDellOk').bind("click", function(){
			  $('#myForm').ajaxSubmit(optionsDellOk); 
			return false;
		  });
			$('#submitDellOff').bind("click", function(){
			  $('#divSubmitDell').hide();	 
			return false;
		  });
	// ---- Форма -----
});

//	функция проверки выбран ли пункт для редактирования
function valideEdit(formData, jqForm, options)
{
	var queryString = $.param(formData); 
	if(queryString == '')
	{
		$.prompt('Не выбран пункт для редактирования!');
		return false;
	}
	else
		return true; 
}
//	функция проверки выбран ли пункт для удаления
function valideDell(formData, jqForm, options)
{
	var queryString = $.param(formData); 
	if(queryString == '')
	{
		$.prompt('Не выбран пункт для удаления!');
		return false;
	}
	else
	{
		$.prompt('Вы действительно хотите удалить позицию?',{ callback: mycallbackform, buttons: { Ok: 'dell', Отмена: false  } });
		return false;
	}
}
//функция отменяет либо производит удаление позиции
function mycallbackform(v,m,f){
	if(v == 'dell')
	{
		//  опции для удаления пункта
		  var optionsDellOk = { 
			target: "#output",
			//success: showResponse,
			url:'template.dell.position.item.php'
		  };
		  
		$('#myForm').ajaxSubmit(optionsDellOk); 
		//	подгрузка аяксом списка страниц,(таблица)
		$('#DivRequest').load('template.load.php?print=position_portfolio&position_id=<?php echo $_GET[position_id];?>');
		return true;
	}
	else
		return false;
}
</script>

<?
  }
  catch(ExceptionMySQL $exc)
  {
    require("../utils/exception_mysql.php"); 
  }

  // Включаем завершение страницы
  require_once("../utils/bottom.php");
?>