<?php
error_reporting ( E_ALL & ~ E_NOTICE );
define ( 'DOC_ROOT', $_SERVER ['DOCUMENT_ROOT'] );

// Устанавливаем соединение с базой данных
require_once (DOC_ROOT . "/config/config.php");
// Подключаем блок авторизации
//require_once("../utils/security_mod.php");
// Подключаем SoftTime FrameWork
require_once (DOC_ROOT . "/config/class.config.php");
define ( 'SLASH', '../../' );

$title = 'Управление конструктором страниц';
$helpInfo = "";

// Включаем заголовок страницы
require_once ("../utils/top.php");

try {
	#объявляем класс словаря
	$dictionaries = new dictionaries ( );
	#формируем массив имени словарей
	$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries );
	#формируем массив значений словарей
	$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = $_COOKIE[lang_id]" );
	
	#	родитель, ребенок формирование массива
	$PArrMenu = $dictionaries->BuildArrayParentChild ( $PMenu );
	
	function printFormSelection($arr, $sel = 'NULL', $name_id = 'ld_id', $echo_id = 'ld_name') {
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
	?>
<!-- AJAX-ответ от сервера заменит этот текст. -->

<form id="myForm" action="" method="post">
<div class="eventForm">
<a href="#" class="ui-state-default ui-corner-all bottom-padding" title="добавить страницу" id="submitAdd"><span class="ui-icon ui-icon-plus"></span>добавить страницу</a>
<a href="#" class="ui-state-default ui-corner-all bottom-padding" title="редактировать страницу" id="submitEditPage"><span class="ui-icon ui-icon-pencil"></span>редактировать страницу</a>
<a href="#" class="ui-state-default ui-corner-all bottom-padding" title="удалить страницу" id="submitDell"><span class="ui-icon ui-icon-trash"></span>удалить страницу</a>
    <div class="clean"> </div>
</div>
<!--	Подгрузка списка позиций таблицы с помощью аякс запроса-->
<div id="DivRequest"></div>
<!-- AJAX-ответ от сервера заменит этот текст. -->
<div id="output"></div>
</form>
<script type="text/javascript">
$(document).ready(function(){
//	подгрузка аяксом списка страниц,(таблица)	
		$("#loading").ajaxStart(function(){
  		$(this).show();});
		$('#DivRequest').load('template.load.php?print=print_ptm');
		$("#loading").ajaxComplete(function(){
  		$(this).hide();});
});

$(document).ready(function(){
//	всплывающее окно
	$("#outputWindows").dialog({
		autoOpen: false,
		minWidth: 800,
		modal: true
	});

// ---- Форма -----
//  запуск аякса для добавления   
		var optionsAdd = { 
			target: "#output",
			success: showWindowsAdd,
			url:'template.add.page.php'
		  	};
		$('#submitAdd').bind("click", function(){
		  	$('#myForm').ajaxSubmit(optionsAdd); 
			return false;
			});

//  запуск аякса для редактирования
		  var optionsEdit = { 
			target: "#output",
			beforeSubmit: valideEdit,
			success: showWindowsEdit,
			url:'template.edit.temp.php'
		  	};
		$('#submitEdit').bind("click", function(){
			$('#myForm').ajaxSubmit(optionsEdit); 
			return false;
			});
		
//  запуск аякса для редактирования
		  var optionsEditPage = { 
			target: "#output",
			beforeSubmit: valideEdit,
			success: showWindowsEditPage,
			url:'template.edit.page.php'
		  	};
		$('#submitEditPage').bind("click", function(){
			$('#myForm').ajaxSubmit(optionsEditPage); 
			return false;
			});
		
//  запуск аякса для удаления
		var optionsDell = { 
			target: "#output",
			beforeSubmit: valideDell,
			//url:'template.event.hadler.php'
			};
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
});

function showWindowsAdd() {
	return true;
}
function showWindowsEdit() {
	return true;
}
function showWindowsEditPage() {
	return true;
}	
//	функция проверки выбран ли пункт для редактирования
function valideEdit(formData, jqForm, options)
{
	var queryString = $.param(formData); 
	if(queryString.search("page_id") != 0) 
	{
		$.prompt('Не выбран пункт для редактирования!');
		return false;
	}
	return true; 
}
//	функция проверки выбран ли пункт для удаления
function valideDell(formData, jqForm, options)
{
	var queryString = $.param(formData); 
	if(queryString.search("page_id") != 0) 
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
		$('#DivRequest').load('template.load.php?print=print_ptm');
		return true;
	}
	else
		return false;
}
</script>
<?php } catch ( ExceptionMySQL $exc ) {
	require "../utils/exception/exception_mysql.php";
}

// Включаем завершение страницы
require_once ("../utils/bottom.php");
?>
