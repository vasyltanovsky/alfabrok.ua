<?php
$ZpFormInc = 'formEdit.js';
require_once '../utils/template.ajax/js.css.php';

if (isset ( $_GET ['im_id'] )) {
	$_POST ['im_id'] =$_GET ['im_id']  ;
}
if (isset ( $_POST ['im_id'] )) {
	#	селектим таблицу страниц
	$cl_sel_pages = new mysql_select ( $tbl_im );
	$active_id = $cl_sel_pages->select_table_id ( "WHERE im_id='{$_POST[im_id]}'" );
}

if (isset ( $_GET ['im_add_full'] )) {
	$ClUserIm = new mysql_select ( $tbl_im );
	$active_id = $ClUserIm->select_table_id ( "WHERE im_provider = {$_COOKIE[id_account]} ORDER BY im_id DESC LIMIT 1" );
	
	if (empty ( $active_id )) {
		die ();
	}
	$_POST ['im_id'] = $active_id ['im_id'];
}
# 	Риэлторы
	if (strpos ( $_COOKIE ["roles"], '4f4bb3b6f03bf'))
	{
		$rieltorsData = new mysql_select ( "system_accounts", "where type <> '4f4b95785a8c4'", "ORDER BY id_account" );
		$rieltorsData->select_table ( "id_account" );
	}
	else
	{
		if ($_COOKIE[id_account] == $active_id[susr_id])
		{
		$rieltorsData = new mysql_select ( "system_accounts", "where type <> '4f4b95785a8c4' and (id_account='$active_id[susr_id]' or login='rieltor@alfabrok.ua')", "ORDER BY id_account" );
		$rieltorsData->select_table ( "id_account" );
		}
		else
		{
			$rieltorsData = new mysql_select ( "system_accounts", "where type <> '4f4b95785a8c4' and (id_account='$active_id[susr_id]')", "ORDER BY id_account" );
			$rieltorsData->select_table ( "id_account" );
			if (count($rieltorsData->table) == 0 || $rieltorsData->table[0][login] == 'rieltor@alfabrok.ua')
			{
				$rieltorsData = new mysql_select ( "system_accounts", "where type <> '4f4b95785a8c4' and (id_account='$_COOKIE[id_account]' or id_account='$active_id[susr_id]')", "ORDER BY id_account" );
				$rieltorsData->select_table ( "id_account" );
			}
		}
	}
	
#объявляем класс словаря
$dictionaries = new dictionaries ();
#формируем массив имени словарей
$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries, "ORDER BY ld_name ASC" );
#формируем массив значений словарей
$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = {$_COOKIE[lang_id]}", "ORDER BY dict_name ASC" );

#выборка характеристик недвижимости	
$ImPropList = new mysql_select ( $tbl_im_pl, "WHERE lang_id = {$_COOKIE['lang_id']} AND catalog_id='{$active_id['im_catalog_id']}' AND hide='show'", "ORDER BY im_prop_name ASC" );
$ImPropList->select_table ( "im_prop_id" );
#выборка характеристик данной недвижимости
$ImPropInfo = new mysql_select ( $tbl_im_pi, "WHERE lang_id = {$_COOKIE['lang_id']} AND im_id='{$active_id['im_id']}'" );
$ImPropInfo->select_table ( "im_prop_id" );
#объеление клаасс построениея формы справочников, и поздтановка значений в поля формы	
$PrintPropForm = new ImPropAdvaced ( $ImPropList, $dictionaries, $ImPropInfo );
$PrintPropForm->ImPropListPrintField ();

//echo "<pre>";
//echo "</pre>";

#формирование массивов по стандартным справочникам для недвижимости	
# айди каталога недвижимости(словарь)
$dictionaries->do_dictionaries ( 17 );
$im_catalog_id_add = $dictionaries->my_dct;
#айди область(сл)
$dictionaries->do_dictionaries ( 11 );
$im_region_id_add = $dictionaries->my_dct;
#айди массив города(сл)
$dictionaries->do_dictionaries ( 15 );
$im_array_id_add = $dictionaries->my_dct;
#район области (айди)
$dictionaries->do_dictionaries ( 24 );
$im_a_region_add = $dictionaries->my_dct;
#айди город(сл)
$dictionaries->do_dictionaries ( 12 );
$im_city_id_add = $dictionaries->my_dct;
#айди район города(сл)
$dictionaries->do_dictionaries ( 13 );
$im_area_id_add = $dictionaries->my_dct;
#айди адресс(словарь) улица
$dictionaries->do_dictionaries ( 14 );
$im_adress_id_add = $dictionaries->my_dct;
#айди измирение площади(словарь)
$dictionaries->do_dictionaries ( 54 );
$im_space_value_id_add = $dictionaries->my_dct;
#айди измирение площади(словарь)
$dictionaries->do_dictionaries ( 22 );
$im_sale_id_add = $dictionaries->my_dct;

$dictionaries->do_dictionaries ( 66 );
$type_photo = $dictionaries->my_dct;

$dictionaries->do_dictionaries ( 67 );
$im_lang = $dictionaries->my_dct;

#	функция формирует списов возможный родителей, справочник меню
function sel_parent_id($arr, $arr_build, $sel = 'NULL', $name_id = 'pc_id', $echo_id = 'menu_words') {
	$str = NULL;
	for($i = 0; $i < count ( $arr ); $i ++) {
		$paddingLeft = $arr [$i] [2] * 10;
		$selecteOption = NULL;
		if ($sel)
			if ($sel == $arr [$i] [$name_id])
				$selecteOption = "selected=\"selected\"";
		$str .= "<option {$selecteOption} value=\"{$arr[$i][$name_id]}\" style=\"padding-left:{$paddingLeft}px!important\">{$arr_build[$arr[$i][$name_id]][$echo_id]}</option>";
	}
	return $str;
}

#	функция формирует списов возможный родителей, справочник меню
function sel_parent_standart($arr, $sel = 'NULL', $name_id = 'sc_id', $echo_id = 'menu_words') {
	$str = NULL;
	for($i = 0; $i < count ( $arr ); $i ++) {
		$selecteOption = NULL;
		if ($sel) {
			if ($sel == $arr [$i] [$name_id])
				$selecteOption = "selected=\"selected\"";
		}
		
		$str .= "<option {$selecteOption} value=\"{$arr[$i][$name_id]}\">{$arr[$i][$echo_id]}</option>";
	
	}
	return $str;
}

function print_provider($data) {
	return $data ['user_fio'] . "<br /><br />" . $data ['user_phone_mobile'] . "<br /><br />" . $data ['user_email'];
}
#
function PrintLangSummary($arr_lang) {
	for($i = 0; $i < count ( $arr_lang ); $i ++) {
		$ret .= "<a id=\"{$arr_lang[$i][dict_id]}\" href=\"javascript:SetImLang('{$arr_lang[$i][dict_id]}');\" alt=\"{$arr_lang[$i]['dict_name']}\" title=\"{$arr_lang[$i]['dict_name']}\">{$arr_lang[$i]['dict_name']}</a>";
	}
	return $ret;
}

$ProvData = '';
if (! empty ( $active_id ['im_provider'] )) {
	$ClProvQuery = new mysql_select ( $tbl_user_site );
	$ClProvQuery->select_table_query ( "SELECT user_fio, user_login, user_phone_mobile, user_email FROM {$tbl_user_site}  WHERE user_id = {$active_id[im_provider]}" );
	$ProvData = print_provider ( $ClProvQuery->table [0] );
}

#	CHECKED
$hide = "checked=\"checked\"";
if ($active_id ['hide'] == 'hide')
	$hide = '';
$im_is_hot = "checked=\"checked\"";
if (! $active_id ['im_is_hot'])
	$im_is_hot = '';
$im_is_rent = "checked=\"checked\"";
if (! $active_id ['im_is_rent'])
	$im_is_rent = '';
$im_is_sale = "checked=\"checked\"";
if (! $active_id ['im_is_sale'])
	$im_is_sale = '';
	
#	Video Im	
$ClViQuery = new mysql_select ( $tbl_im_vi );
$ViData = $ClViQuery->select_table_id ( "WHERE im_id = {$_POST[im_id]}" );
if ($ViData)
	$requeryVi = "template.load.video.php";
else
	$requeryVi = "template.add/form.add.video.php";
?>
<script type="text/javascript">
function SetImLang (lang_id) {
	$('#DivSummary').load('template.load.summary.php?im_id=<?php echo $_POST['im_id'];?>&lang_id='+lang_id);
	$('#DivSummaryLang a').removeClass("AlinkSelected");
	$('#DivSummaryLang a').addClass("AlinkNoSelected"); 
	$('#'+lang_id).removeClass("AlinkNoSelected"); 
	$('#'+lang_id).addClass("AlinkSelected"); 
	return;
}
//	page dialog hide
function hide_ajax_div() {
	location.href = location.search.replace("&im_add_full=true","");
}
$(function() {
		$("#tabsDmnImmovable").tabs();
		SetImLang ('4c5d58cd3898c');
});

//Highslide

/*setTimeout(function() {
	hs.graphicsDir = '/js/highslide/graphics/';
	hs.align = 'center';
	hs.transitions = ['expand', 'crossfade'];
	hs.fadeInOut = true;
	hs.dimmingOpacity = 0.8;
	hs.outlineType = 'rounded-white';
	hs.captionEval = 'this.thumb.alt';
	hs.marginBottom = 105; // make room for the thumbstrip and the controls
	hs.numberPosition = 'caption';
	
//	Add the slideshow providing the controlbar and the thumbstrip
	hs.addSlideshow({
    //	slideshowGroup: 'group1',
    	interval: 5000,
    	repeat: true,
    	useControls: true,
    	overlayOptions: {
	        className: 'text-controls',
        	position: 'bottom center',
        	relativeTo: 'viewport',
        	offsetY: -60
    	},
    	thumbstrip: {
	        position: 'bottom center',
        	mode: 'horizontal',
        	relativeTo: 'viewport'
    	}
	});
}, 2000);*/
	
</script>
<div id="dialog-page-body"> </div>
<div id="d-dialog">
  <div id="d-dialog-in">
    <table class="t-dialog">
      <tr>
        <td class="td-dialog-close"><a href="#" class="a-dialog-close" onclick="hide_ajax_div();">
          <h3 class="a-h3-dialog-close">закрыть</h3>
          </a></td>
      </tr>
      <tr>
        <td class="td-dialog-form"><div id="d-overflow">
            <div id="tabsDmnImmovable">
              <ul>
                <li><a href="#Dtabs-1">Недвижимость</a></li>
                <li><a href="#Dtabs-2">Характеристики</a></li>
                <li><a href="#Dtabs-3">Изображение</a></li>
                <li><a href="#Dtabs-4">Видео</a></li>
                <li><a href="#Dtabs-5">Описание</a></li>
                <?php  if (!empty($ProvData)) echo "<li><a href=\"#tabs-6\">Владелец</a></li>"; ?>
              </ul>
              <div id="Dtabs-1">
                <!--  подключение формы для редактирования стандартных характеристик-->
                <?php include_once("template.edit/form.page.php");?>
              </div>
              <div id="Dtabs-2">
                <div>
                  <?php include_once("template.edit/form.prop.php");?>
                </div>
              </div>
              <div id="Dtabs-3">
                <?php include_once("template.print/print.photo.php");?>
              </div>
              <div id="Dtabs-4">
                <div id="DivRequestVi">
                  <?php include_once $requeryVi;?>
                </div>
              </div>
              <div id="Dtabs-5">
              		<?php
						$ImSuQClass = new mysql_select($tbl_im_su);
						$active_text_id = $ImSuQClass -> select_table_id("WHERE lang_id = '4c5d58cd3898c' AND im_id = {$_POST['im_id']}");
						require_once 'template.edit/form.im.summary.php';
					?>
              </div>
              <?php 
					if (!empty($ProvData)) echo "<div id=\"tabs-6\">".$ProvData."</div>";
				?>
            </div>
          </div></td>
      </tr>
    </table>
  </div>
</div>
<!-- РЕДАКТИРОВАНИЕ ПОЗИЦИИ -->
