<?php
  error_reporting(E_ALL & ~E_NOTICE); // Устанавливаем соединение с базой данных
  require_once("../../config/config.php");
  // Подключаем SoftTime FrameWork
require_once DOC_ROOT . '/config/class.config.php';
  // Подключаем блок авторизации
  require_once("../utils/security_mod.php");
 
  $title = 'Управление блоком &#8220;Характеристики недвижимости&#8221;.';
  $pageinfo = '<p class=help>Здесь можно добавлять, редактировать и удалять &#8220;Характеристики недвижимости&#8221;.</p>';
 
  
  // Включаем заголовок страницы
  require_once("../utils/top.php");

  try
  {
  		#объявляем класс словаря
		$dictionaries = new dictionaries();
		#формируем массив имени словарей
		$dct_list 	=	$dictionaries->buid_dictionaries_list($tbl_list_dictionaries);
		#формируем массив значений словарей
		$dct		=	 $dictionaries->buid_dictionaries($tbl_dictionaries,
									 	 				 "WHERE lang_id = {$_COOKIE[lang_id]}");
		
		$dictionaries->do_dictionaries(17);
		$IPcat_dct	 = $dictionaries->my_dct;
		
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
    	<h3>Фильтр страницы</h3>
		<form  action="index.php" method="get">
         	<ul>
            	<li>
                    <label>Каталог недвижимости</label><br />
                    <select name="catalog_id">
                        <option value="">не выбрано</option>
                        <?php echo printFormSelection($IPcat_dct, $_GET['catalog_id'], 'dict_id', 'dict_name');?>
                    </select>
                </li>
            </ul>
            <input type="submit" value="Применить"> 
        </form>
	</div>
		
<form  id="myForm" action="" method="post">  
	<input value="<?php echo $_GET[catalog_id];?>" size="13" name="catalog_id" type="hidden" > 
    <div class="eventForm">
     	<a href="#" title="добавить характеристику" id="submitAdd" ><img src="../utils/images/submit/submitAdd.png" width="28" height="24" /></a>
        <a href="#" title="редактировать характеристику"  id="submitEdit" ><img src="../utils/images/submit/submitEdit.png" width="28" height="24" /></a>
        <a href="#" title="удалить характеристику" id="submitDell" ><img src="../utils/images/submit/submitDell.png" width="28" height="24" /></a>
    </div>
    
    <!--	-->
        <div id="loading">
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
		$('#DivRequest').load('template.load.php?print=list_page&catalog_id=<?php echo $_GET[catalog_id];?>');
		$("#loading").ajaxComplete(function(){
  		$(this).hide();});
	
	// ---- Форма -----
	//	опции для добавления нового пункта
		  var optionsAdd = { 
			target: "#output",
			beforeSubmit: valideAdd,
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
			beforeSubmit: valideDell
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

//функция проверки выбран ли пункт для редактирования
function valideAdd(formData, jqForm, options)
{
	var queryString = $.param(formData); 

	if(queryString == '')
	{
		return true;
	}
	else
		return true; 
}

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
		$('#DivRequest').load('template.load.php?print=list_page&catalog_id=<?php echo $_GET[catalog_id];?>');
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