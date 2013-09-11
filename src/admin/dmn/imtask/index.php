<?php
  error_reporting(E_ALL & ~E_NOTICE); // Устанавливаем соединение с базой данных
  require_once("../../config/config.php");
  // Подключаем SoftTime FrameWork
require_once DOC_ROOT . '/config/class.config.php';

  // Подключаем блок авторизации
  require_once("../utils/security_mod.php");
 
  $title = 'Управление боком &#8220;Задачи&#8221;';
  $pageinfo = '<p class=help>Здесь можно добавлять, редактировать и удалять &#8220;Задачи&#8221;.</p>';
  
  // Включаем заголовок страницы
  require_once("../utils/top.php");

  		$ClProvQuery = new mysql_select($tbl_accounts);
		$ClProvQuery -> select_table_query("SELECT * FROM {$tbl_accounts}");
		
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
  try
  {
	
	?>
<!-- AJAX-ответ от сервера заменит этот текст. -->
	<div id="output"></div>  
<script type="text/javascript">
$(function() {
	$("#t_date_do_b").datepicker();
	$("#t_date_do_e").datepicker();
});
</script>

<div id="d-filter">
  <h3>Фильтр страници</h3>
  <form  action="index.php" id="SearchForm" name="SearchForm" method="get">
    <ul>
      <li>
        <label>Каталог недвижимости</label>
        <br />
        <select name="realtor_id">
          <option value="">не выбрано</option>
          	<?php echo sel_parent_standart($ClProvQuery->table, $_GET['realtor_id'], 'id_account', 'fio');?>
        </select>
      </li>
      <li>
        <label>Дата выполнения от</label>
        <br />
        <input type="text" name="t_date_do_b" id="t_date_do_b" value="<?php echo $_GET['t_date_do_b'];?>"/>
      </li>
      <li>
        <label>Дата выполнения до</label>
        <br />
        <input type="text" name="t_date_do_e" id="t_date_do_e" value="<?php echo $_GET['t_date_do_e'];?>"/>
      </li>
    </ul>
    <input type="submit" value="Применить">
  </form>
</div>
   
<form  id="myForm" action="" method="post">   
     <div class="eventForm">
    	<a href="#" class="ui-state-default ui-corner-all bottom-padding" title="добавить задачу" id="submitAdd"><span class="ui-icon ui-icon-plus"></span>добавить задачу</a>
		<a href="#" class="ui-state-default ui-corner-all bottom-padding" title="редактировать задачу" id="submitEdit"><span class="ui-icon ui-icon-pencil"></span>редактировать задачу</a>
		<a href="#" class="ui-state-default ui-corner-all bottom-padding" title="удалить задачу" id="submitDell"><span class="ui-icon ui-icon-trash"></span>удалить задачу</a>
	 </div>
	
    <!--	Подгрузка списка позиций таблицы с помощью аякс запроса-->
        <div id="DivRequest">
        </div>  
</form>


<script type="text/javascript">
$(document).ready(function(){
	var get = location.search;
	if(get != "") {
		$('#output').load('template.edit.item.php'+get);
	}
	//	подгрузка аяксом списка страниц,(таблица)	
		$("#loading").ajaxStart(function(){
  		$(this).show();});
		$('#DivRequest').load('template.load.php?print=list_page&realtor_id=<?php echo $_GET['realtor_id']?>&t_date_do_b=<?php echo $_GET['t_date_do_b']?>&t_date_do_e=<?php echo $_GET['t_date_do_e']?>');
		$("#loading").ajaxComplete(function(){
  		$(this).hide();});
	//	подгрузка дополнительных пунктов подменю в гланое меню	 
	//	$("#service").append('<a href="index.packet.php">Модули сайтов</a>');
	// ---- Форма -----
	//	опции для добавления нового пункта
		  var optionsAdd = { 
			target: "#output",
			url:'template.add.item.php'
		  };
	//  опции для редактирования пункта
		  var optionsEdit = { 
			target: "#output",
			beforeSubmit: valideEdit,
			url:'template.edit.item.php'
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
			url:'template.dell.item.php'
		  };
		  
		$('#myForm').ajaxSubmit(optionsDellOk); 
		//	подгрузка аяксом списка страниц,(таблица)
		$('#DivRequest').load('template.load.php?print=list_page');
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