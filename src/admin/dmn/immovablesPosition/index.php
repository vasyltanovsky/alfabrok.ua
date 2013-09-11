<?php
error_reporting ( E_ALL & ~ E_NOTICE ); // Устанавливаем соединение с базой данных
require_once '../../config/config.php';
// Подключаем SoftTime FrameWork
require_once DOC_ROOT . '/config/class.config.php';

// Подключаем блок авторизации
require_once ("../utils/security_mod.php");

#обработчик языка
require_once DOC_ROOT . '/application/includes/language/set.cookie.php';
require_once DOC_ROOT . '/dmn/utils/cms.images.php';
#настройки отображение недвижимости на страницы
require_once DOC_ROOT . '/application/includes/immovables/settings.inc';
require_once DOC_ROOT . '/application/includes/immovables/setting.im.print.inc';
require_once DOC_ROOT . '/application/module/immovables/f.immobles.php';

$title = 'Управление блоком &#8220;Каталог недвижимости&#8221;.';
$pageinfo = '<p class=help>Здесь можно добавлять, редактировать и удалять позиции &#8220;Каталога недвижимости&#8221;.</p>';

// Включаем заголовок страницы
require_once ("../utils/top.php");

try {
	
	#объявляем класс словаря
	$dictionaries = new dictionaries ();
	#формируем массив имени словарей
	$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries );
	#формируем массив значений словарей
	$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = $_COOKIE[lang_id]" );
	
	$dictionaries->do_dictionaries ( 17 );
	$PMenu = $dictionaries->my_dct;
	#	родитель, ребенок формирование массива
	$PArrMenu = $dictionaries->BuildArrayParentChild ( $PMenu );
	
	function printFormSelection($arr, $sel = 'NULL', $name_id = 'ld_id', $echo_id = 'ld_name') {
		global $dictionaries;
		$str = NULL;
		for($i = 0; $i < count ( $arr ); $i ++) {
			$selecteOption = NULL;
			if ($sel)
				if ($sel == $dictionaries->buld_table [$arr [$i] [0]] [$name_id])
					$selecteOption = "selected=\"selected\"";
			$padding = 10 * $arr [$i] [2];
			$str .= "<option {$selecteOption} style=\"padding-left:{$padding}px\" value=\"{$dictionaries->buld_table[$arr[$i][0]][$name_id]}\">{$dictionaries->buld_table[$arr[$i][0]][$echo_id]}</option>";
		}
		return $str;
	}
	# 	Получаем содержимое текущей страницы
	$rieltorsData = new mysql_select ( "system_accounts", "ORDER BY id_account" );
	$rieltorsData->select_table ( "id_account" );

	//echo "<pre>";
	//print_r($rieltorsData);
	//echo "</pre>";
	$_GET[1] = (!empty($_GET[1]) ? $_GET[1] : "flat");
	$_GET["type_cat"] = (!empty($_GET["type_cat"]) ? $_GET["type_cat"] : "sale");
	
	if(($_GET[1] == "flat") && !strpos ( $_COOKIE ["roles"], '5125c267d62af'))
		$WIMTypeCat = " and i.im_id = 0 ";
		
	#выборка характеристик недвижимости	
	$ImPropListInfo = new mysql_select ( $tbl_im_pl, "l left join {$tbl_im_pi} i ON l.im_prop_id = i.im_prop_id WHERE l.lang_id = {$_COOKIE['lang_id']} {$WPListInfo} AND i.lang_id = {$_COOKIE['lang_id']} AND l.catalog_id='{$ImCatArr[$_GET[1]]}'", "ORDER BY im_prop_name ASC" );
	$ImPropListInfo->select_table ( "im_prop_id" );

	#класс обработчик заполнених полей формы поиска
	$SQForm = new ImSiteForm ( $_GET, 'ImFormSearchArray', 'SearchImCode', $dictionaries, $ImPropListInfo->buld_table );
	#формирование строки запроса
	$WhereQuery = " WHERE i.im_catalog_id = '{$ImCatArr[$_GET[1]]}'" . $WIMTypeCat;
	
	$SQForm->StandartImQuery = $WhereQuery = " WHERE i.im_catalog_id = '{$ImCatArr[$_GET[1]]}'" . $WIMTypeCat;
	#	
	if (strpos ( $_SERVER ['REQUEST_URI'], 'action=ImFormSearch' )) {
		$ImFormSearchArray = substr ( $_SERVER ['REQUEST_URI'], strpos ( $_SERVER ['REQUEST_URI'], '?' ) + 1, strlen ( $_SERVER ['REQUEST_URI'] ) );
	}
	
	if (! empty ( $ImFormSearchArray )) {
		#при существование в куки данных по форме формируем запрос для выборки с $tbl_im_pl и $tbl_im	
		$CookieData = $SQForm->StringToArray ( $ImFormSearchArray );
		//getStatistictics("CookieData", $CookieData);
		$WhereQuery .= $SQForm->PostGetParser ( $CookieData );
		
		#данные модуль формирует город для тайтла, также текст по региональной принадлежности
		$RegDictList = $SQForm->getProtectedField ( 'RegDict' );
		$ImRegionText = NUL;
		if ($ImRegionText = getImRegionText ( $RegDictList )) {
			$title_web = $dictionaries->buld_table [$ImRegionText ['reg_id']] ['dict_name'] . "-" . $title_web;
			$description_web = $dictionaries->buld_table [$ImRegionText ['reg_id']] ['dict_name'] . "-" . $description_web;
		}
		
	}
	//проверка только на Риэлтора
	$realtorQuery = (strpos($_COOKIE["roles"], "4f4bb3b6203be") ? sprintf (" and (i.susr_id=%s or i.susr_id = '' and i.operator_id is not null) " , $_COOKIE["id_account"]) : "");

	$operatorQuery = (strpos($_COOKIE["roles"], "4f4bb3b6203bf") ? " or 1=1 " : "");
	
	$ipQuery = ($_COOKIE["good_ip"] != "1" ? sprintf (" and i.susr_id=%s " , $_COOKIE["id_account"]) : "");
	
	$WhereImmovableQuery = "i {$WhereQuery}" . $realtorQuery. $ipQuery.$operatorQuery;
	$WhereImmovableOrder = "ORDER BY i.{$_COOKIE[im_where_sort]} {$_COOKIE['im_where_sort_order']}";

	#сортировка таблицы если выбрано к-во комнат
	if ($_COOKIE [im_where_sort] == 'im_val_room') {
		$WhereImmovableOrder = "";
	}
	if ($_COOKIE [im_where_sort] == 'im_code') {
		$WhereImmovableOrder = "ORDER BY substring(im_code, 2) - 0  {$_COOKIE['im_where_sort_order']}";
	}
	if ($ImFormSearchArray)
		$ImFormSearchArray = '?' . htmlspecialchars ( urldecode ( $ImFormSearchArray ? $ImFormSearchArray : "" ) );

	$paramForPager = "";
	foreach ($_GET as $key => $value) {
		if($key != "page")
		{
			if (is_array($value))
			{
				for($k = 0; $k < count($value); $k++)
				{
					$paramForPager .= sprintf("&%s[]=%s", $key, $value[$k]);
				}
			}
			else
			{
				$paramForPager .= sprintf("&%s=%s", $key, $value);
			}
		}
	}	
	
	if( $_GET ['action'] == "s_code" ) {
		$arr = str_replace ( ".", ",", $_GET ['inputCodes'] );
		$str = implode ( "','", explode ( ',', $arr ) );
		$WhereImmovableQuery = " i WHERE i.im_code IN ('{$str}') " . $realtorQuery;
	}
	
	#выборка недвижимоти
	$obj = new pager_mysql ( $tbl_im, $WhereImmovableQuery, $WhereImmovableOrder, ($_COOKIE['im_f_show_pnumber'] ? $_COOKIE['im_f_show_pnumber'] : 30), // Число позиций на странице
"5", // Число ссылок в постраничной навигации
$paramForPager, // Объявляем объект постраничной навигации
$ImFormSearchArray );
$ImData = $obj->get_page ();
	
	if (!empty ( $ImData )) {
		$ImPQStatistic = new mysql_select ( 'immovables_stat' );
		$ImPQStatistic->select_table ( "im_id" );
	
		$ImTasks = new mysql_select ( 'realtor_tasks', " where is_do=0" ); //t_date_reminder = '" . date ( "Y-m-d" ) . "' and 
		$ImTasks->select_table ( "im_id" );
	}

	
	#преобразование данных характеристик и значений
	$ImPropData = new PropSort ( $ImPropListInfo->table );
	$ImPropData->GetArrToPrint ( 'im_id', array ('is_print_list', 'is_print_ad', 'is_print_st' ) );
	
	$tempCount =  Controller::Template( "application/includes/immovables/template.im.show.form.inc", array());
	


	#формирование списка недвижимости
	$ModImPropP = new ModuleSiteIm ( $ModuleTemplate, $arWords, $dictionaries, $ImPropData->ImPropData, $ImPropData->ImPropArrData );
	$ImPagesContent  = "<div class=\"DivPaging\">" . $obj . "</div><div class=\"DicCount\">" . $tempCount . "</div><div class=\"clear\"></div>"; 
	    $ImPagesContent .= Controller::Template("dmn/immovablesPosition/template.print/im." .$_GET ['1'] . ".list." .$_GET["type_cat"]. ".inc", array("imData" => $ImData, "TemplateImList" => $TemplateImList [$_GET [1]] [$_GET ['type_cat']], "dictionaries" => $dictionaries, "CMSImagesNum" =>  $CMSImagesNum, "CMSImages" =>  $CMSImages, "ImPQStatistic" => $ImPQStatistic, "ImTasks" => $ImTasks, "ImPropData" => $ImPropData->ImPropData, "ImPropArrData" => $ImPropData->ImPropArrData, "rieltorsData" => $rieltorsData  ));
	$ImPagesContent .= "<div class=\"DivPaging\">" . $obj . "</div><div class=\"DicCount\">" . $tempCount . "</div><div class=\"clear\"></div>";
?>


<?php require_once DOC_ROOT . '/dmn/immovablesPosition/template.print/im.catalog.inc';?>
<?php require_once DOC_ROOT . '/application/module/search/template.form.im.php'; ?>
<link media="screen, projection" type="text/css" href="/css/formSearch.css" rel="stylesheet">
<!-- AJAX-ответ от сервера заменит этот текст. -->
<div id="output"></div>
<form id="myForm" action="" method="post">
    <div class="eventForm">
    	<a href="#" class="ui-state-default ui-corner-all bottom-padding" title="добавить позицию" id="submitAdd"><span class="ui-icon ui-icon-plus"></span>добавить позицию</a>
		<?php if(strpos($_COOKIE["roles"], "4f181cf5eb204")):?><a href="#" class="ui-state-default ui-corner-all bottom-padding" title="редактировать позицию" id="submitEdit"><span class="ui-icon ui-icon-pencil"></span>редактировать позицию</a><?php endif;?>
		<?php if(strpos($_COOKIE["roles"], "4f181cf5eb203")):?><a href="#" class="ui-state-default ui-corner-all bottom-padding" title="удалить позицию" id="submitDell"><span class="ui-icon ui-icon-trash"></span>удалить позицию</a><?php endif;?>
  		<a href="#" class="ui-state-default ui-corner-all bottom-padding" title="обновить просмотры" id="submitClean"><span class="ui-icon ui-icon-refresh"></span>обновить просмотры</a>
		<!--  <a href="#" class="ui-state-default ui-corner-all bottom-padding" title="добавить задание" id="submitTask"><span class="ui-icon ui-icon-plus"></span>добавить задание</a>  -->
	</div>
  	<!--	Подгрузка списка позиций таблицы с помощью аякс запроса-->
  	<div id="DivRequest">
  		<?php echo $ImPagesContent;?>
  	</div>
  	<div id="SortDivRequest"></div>
</form>

<script type="text/javascript">
function setStylePnumber(Fid,FValue) {
	$('#SortDivRequest').load('/application/module/immovables/get.post.hadler.php?action=set_style_show&'+Fid+'='+FValue+'');
	$("#SortDivRequest").ajaxComplete(function(){
  	//location.href = location.href.toLowerCase();
		location.href = location.href;
  	});
	return;
}
function setSortTable(FValue) {
	$('#SortDivRequest').load('/application/module/immovables/get.post.hadler.php?action=set_sort_table&sort='+FValue+'');
	//alert('asd');
	$("#SortDivRequest").ajaxComplete(function(){
  	location.href = location.href/*.toLowerCase();*/});
	return;
}
$(document).ready(function(){
	<?php if(strpos($_COOKIE["roles"], "4f181cf5eb204")):?>
	$('.im-item-position td:not(.im-item-noclick)').click(function () {
		if(!$(this).hasClass("td-radio-bottom")) {	
			var parentTr = $(this).parent();
			var id = $(parentTr).attr('id').substr(8, $(parentTr).attr('id').lenght);
			$('#output').load('template.edit.item.php?im_id=' + id);
			$("html:not(:animated),body:not(:animated)").animate({ scrollTop: 0}, 500 );
		}
	});
	<?php endif ?>
	var get = location.search;
	
	<?php 
	if(isset($_GET['msq'])) {
		if($_GET['msq'] == 'v_add') {
			echo "$.prompt('Видео добавлено!');";
		}
	}
	if(isset($_GET["im_add_full"]))
		if ($_GET["im_add_full"] == "true")
			echo "$('#output').load('template.edit.item.php?im_id="  . $_GET["im_id"] . "');";
	?>
	$(".display-list-design").hide();
	$("#loading").hide();
	//	подгрузка аяксом списка страниц,(таблица)	
		$("#loading").ajaxStart(function(){
  		$(this).show();});
		//$('#DivRequest').load('template.load.php?print=list_page&dict_id=<?php echo $_GET['dict_id']?>&date_add_ot=<?php echo $_GET['date_add_ot']?>&date_add_do=<?php echo $_GET['date_add_do']?>&s_im_id=<?php echo $_GET['s_im_id']?>');
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
	//  опции для редактирования пункта
		var optionsTask = { 
			target: "#output",
			beforeSubmit: valideEdit,
			url:'template.edit.task.php'
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
		  $('html,body').animate({scrollTop: 0}, 1000);//Cкроллинг вверх 
		return false;
		});
	//  запуск аякса для редактирования
		$('#submitEdit').bind("click", function(){
			$('#myForm').ajaxSubmit(optionsEdit); 		
			$('html,body').delay(500).animate({scrollTop: 0}, 1000);//полсекунды ждем для прорисовки окна
			return false;
		});
	//  запуск аякса для редактирования
		$('#submitTask').bind("click", function(){		
		  $('#myForm').ajaxSubmit(optionsTask);  
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

//aaaaa aaari krishnaaaa  aaaa haaaaariii ramaaaa
	var imm_id = null;		
	$('#submitClean').live('click', function() {			
		if(imm_id == null){
			$.prompt('Не выбран пункт!');
			return false;
		}
		$.ajax({
			type: "POST",
			data: ({im_id : imm_id}),	
			url: "template.clear.viewcount.php",
			dataType: "json",
			success: function(data) {				
				$("#loading").hide();
				$.prompt('Просмотры обновлены');
				location.href = location.search;
			}
		})
	});
	
	$("input[type=radio]").live("change",function(){
		imm_id = $(this).val();			
	});
});

//	функция проверки выбран ли пункт для редактирования
function valideEdit(formData, jqForm, options) {
	var queryString = $.param(formData); 
	if(queryString == "") {
		$.prompt('Не выбран пункт для редактирования!');
		return false;
	}
	else
		return true; 
}
//	функция проверки выбран ли пункт для удаления
function valideDell(formData, jqForm, options) {
	var queryString = $.param(formData); 
	if(queryString == "") {
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
		//window.location = location.href;
		return true;
	}
	else
		return false;
}
</script>

<?php 
} catch ( ExceptionMySQL $exc ) {
	require ("../utils/exception_mysql.php");
}
// Включаем завершение страницы
require_once ("../utils/bottom.php");
?>
