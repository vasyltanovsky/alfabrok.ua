<?php
/**
 * HTML2PDF Librairy - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @author      Laurent MINGUET <webmaster@html2pdf.fr>
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */

require_once ("../../../config/config.php");
include ("../../../class/dictionaries/class.dictionaries.php");
include ("../../../class/pager/class.mysql.select.php");
include ("../../../class/propertis/class.propertis.print.php");
include ("../../../class/propertis/class.propertis.sort.php");
include ("../../../application/includes/language/rus.words.language.php");
error_reporting ( E_ERROR );
include ("../../../class/modules/class.module.site.php");
require_once (dirname ( __FILE__ ) . '/../html2pdf.class.php');
require_once DOC_ROOT . '/class/work/class.discharge.php';

$_COOKIE ['lang_id'] = $_GET ['lang_id'];
$im_id = $_GET ['im_id'];

// get the HTML
function GetCountRtfTableRows($table_image = NULL) {
	$count_img = count ( $table_image );
	$count_rows = intval ( $count_img / 3 ) + 1;
	for($i = 0; $i < $count_rows; $i ++) {
		$ret [] = 5;
	}
	return $ret;
}

function Generate($text) {
	global $ImDataOne;
	foreach ( $ImDataOne as $key => $value ) {
		$text = str_replace ( "#" . $key . "#", $value, $text );
	}
	return $text;
}
function PReplase($text) {
	$text = str_replace ( "<p>", "<br />", $text );
	$text = str_replace ( "</p>", "", $text );
	return $text;
}
function GetImFildsDictValue($data) {
	
	global $arWords;
	global $dictionaries;
	$AdrArr = array ('im_region_id' => 'FormSearchNameRegion', 'im_a_region_id' => 'FormSearchNameRRegion', 'im_city_id' => 'FormSearchNameCity', 'im_area_id' => 'FormSearchNameRCIty', 'im_array_id' => 'FormSearchNameACity', 'im_adress_id' => 'FormSearchNameAdress' );
	foreach ( $AdrArr as $key => $value ) {
		if (! empty ( $data [$key] )) {
			switch ($key) {
				case 'im_adress_id' :
					{
						$return .= "<b>{$arWords[$value]} - {$dictionaries->buld_table[$data[$key]][dict_name]}, {$data[im_adress_house]}</b><br />";
						break;
					}
				default :
					{
						$return .= "{$arWords[$value]} - {$dictionaries->buld_table[$data[$key]][dict_name]}<br />";
						break;
					}
			}
		}
	}
	return $return;
}
function GetImFildsValue($data) {
	global $arWords;
	$AdrArr = array ('im_prace_sq' => 'ImFListHeaderM2Sotku', 'im_prace_day' => 'FormSearchNamePriceDay', 'im_prace_manth' => 'FormSearchNamePriceManth', 'im_space' => 'FormSearchNameSqMS', '4c4069e4f04ec' => 'FormSearchNameSqYchastka' );
	foreach ( $AdrArr as $key => $value ) {
		if (! empty ( $data [$key] )) {
			switch ($key) {
				default :
					{
						$return .= "{$arWords[$value]} - {$data[$key]}<br />";
						break;
					}
			}
		}
	}
	return $return;
}

#объявляем класс словаря
$dictionaries = new dictionaries ( );
#формируем массив имени словарей
$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries );
#формируем массив значений словарей
$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = {$_COOKIE['lang_id']} ORDER BY dict_name" );
$ImPageContentClass = new ModuleSite ( $ModuleTemplate );

$ImDataOneClass = new mysql_select ( $tbl_im );
$ImDataOne = $ImDataOneClass->select_table_id ( "WHERE im_id = $im_id" );
$ImDataOne["im_prace"] = $ImDataOne ["im_prace"]*$_COOKIE['exchange_USD']; 
$ImDataOne["im_prace_old"] = $ImDataOne ["im_prace_old"]*$_COOKIE['exchange_USD']; 
$ImDataOne["im_prace_sq"] = $ImDataOne ["im_prace_sq"]*$_COOKIE['exchange_USD']; 
$ImDataOne["im_prace_sq"] = $ImDataOne ["im_prace_sq"]*$_COOKIE['exchange_USD'];
$ImDataOne["im_prace_day"] = $ImDataOne ["im_prace_day"]*$_COOKIE['exchange_USD']; 
$ImDataOne["im_prace_manth"] = $ImDataOne ["im_prace_manth"]*$_COOKIE['exchange_USD'];
$im_code = $ImDataOne ['im_code'];
#выборка характеристик недвижимости	
$ImPropListInfo = new mysql_select ( $tbl_im_pl, "l left join {$tbl_im_pi} i ON l.im_prop_id = i.im_prop_id WHERE l.lang_id = {$_COOKIE['lang_id']} AND i.lang_id = {$_COOKIE['lang_id']} AND l.catalog_id='{$ImDataOne['im_catalog_id']}' AND hide='show' AND i.im_id = {$_GET[im_id]}", "ORDER BY im_prop_name ASC" );
$ImPropListInfo->select_table ( "im_prop_id" );

$ImPropData = new PropSort ( $ImPropListInfo->table );
$ImPropData->GetArrToPrint ( 'im_id', array ('is_print_list', 'is_print_ad', 'is_print_st' ) );

if ($ImDataOne ['im_catalog_id'] == '4c3ec51d537c0') {
	$ImDataOne ['4c4069e4f04ec'] = $ImPropData->ImPropData ['is_print_ad'] [$_GET ['im_id']] ['4c4069e4f04ec'] ['im_prop_value'];
	unset ( $ImPropData->ImPropData ['is_print_ad'] [$_GET ['im_id']] ['4c4069e4f04ec'] );
}
$RetImFieldInfo = GetImFildsDictValue ( $ImDataOne );
$RetImFieldInfo .= GetImFildsValue ( $ImDataOne );

#выборка фотографий
$PhotoQueryClass = new mysql_select ( $tbl_im_ph, "f WHERE f.im_id = {$_GET['im_id']} ORDER BY im_photo_order DESC" );
$PhotoQueryClass->select_table ( "im_photo_id" );
#формирование характеристик едвижимости
$ClassPropPrint = new PropPrint ( $dictionaries );
$RetPropStandart = $ClassPropPrint->GetPrint ( $ImPropData->ImPropData ['is_print_st'] [$ImDataOne ['im_id']], 'GetTextWord' );
$RetPropAdvased = $ClassPropPrint->GetPrint ( $ImPropData->ImPropData ['is_print_ad'] [$ImDataOne ['im_id']], 'GetTextWord' );
#формирование описание недв.	
$ImSuQClass = new mysql_select ( $tbl_im_su );
@$active_id = $ImSuQClass->select_table_id ( "WHERE lang_id = '4c5d58cd3898c' AND im_id = {$_GET[im_id]}" );
$SummaryIm ['im_su_text'] = $active_id ['im_su_text'];
@$SummaryIm ['title'] = $ImDataOne ['title'];
//print_r( $SummaryIm);


//$SummaryIm = $ImPageContentClass ->For_HTML("<b>#title#</b>#im_su_text#", $SummaryIm);
$RetSummaryIm = PReplase ( $SummaryIm );

if ($_COOKIE ['lang_id'] == 1) {
	$res ["im_prace"] = "#im_prace# грн.<br>";
	$res ["im_prace_manth"] = "#im_prace# грн.<br>";
	$res ["im_prace_USD"] = "#im_prace_USD# $<br>";
	$res ["im_prace_EUR"] = "#im_prace_EUR# €<br>";
	$res ["im_prace_RUB"] = "#im_prace_RUB# руб.<br>";
		
	$res ["im_prace_old"] = "(#im_prace_old# грн.) - старая цена<br>";
	$res ['readmore'] = "подробнее..<br>";
	$res ['4c3ec3ec5e9b5'] = "Квартиры";
	$res ['4c3ec3ec5e9b7'] = "Коммерческая недвижимость";
	$res ['4c3ec51d537c0'] = "Коттеджи. Дома. Дачи";
	$res ['4c3ec51d537c2'] = "ОСЗ. Здания";
	$res ['4c3ec51d537c3'] = "Земельные участки";
	$res ['code'] = "Код: #im_code#";
	$res ['codeN'] = "Код:";
	$res ['rooms'] = "к.";
	$res ["realtor"] = "Имя: #fio#<br>E-mail: #login#<br>Тел.: #tel#";
} else if ($_COOKIE ['lang_id'] == 2) {
	$res ["doc_im_header_1"] = "Недвижимость от www.alfabrok.ua<br>";
	$res ["doc_im_header_2_price"] = "Цена: #im_price#$<br>";
	$res ['readmore'] = "подробнее..<br>";
}

$CodeValue = $ImPageContentClass->For_HTML ( $res ["code"], $ImDataOne, array () );
// обработка цен недвижимости
$ImPriceOld = "";
$BasePrice = 0;
if ($ImDataOne ['im_is_sale'] == 1) {
	$ImPrice = $ImPageContentClass->For_HTML ( $res ["im_prace"], $ImDataOne, array () );
	$BasePrice = $ImDataOne["im_prace"];
	if ($ImDataOne ['im_prace_old'] != $ImDataOne ['im_prace_old']) {
		$ImPriceOld = $ImPageContentClass->For_HTML ( $res ["im_prace_old"], $ImDataOne, array () );
		$BasePrice = $ImDataOne["im_prace_old"];
}
} else {
	$ImPrice = $ImPageContentClass->For_HTML ( $res ["im_prace_manth"], $ImDataOne, array () );
	$BasePrice = $ImDataOne["im_prace_manth"];
}
$ImDataOne["im_prace_USD"] = Discharge::GetDisValue(round($BasePrice/$_COOKIE['exchange_USD']), 4, "");
$ImPriceUSD = $ImPageContentClass->For_HTML ( $res ["im_prace_USD"], $ImDataOne, array () );
$ImDataOne["im_prace_EUR"] = Discharge::GetDisValue(round($BasePrice/$_COOKIE['exchange_EUR']), 4, "");
$ImPriceEUR = $ImPageContentClass->For_HTML ( $res ["im_prace_EUR"], $ImDataOne, array () );
$ImDataOne["im_prace_RUB"] = Discharge::GetDisValue(round($BasePrice/$_COOKIE['exchange_RUB']), 4, "");
$ImPriceRUB = $ImPageContentClass->For_HTML ( $res ["im_prace_RUB"], $ImDataOne, array () );



$RealtorData = "";
$ImDataOne ['susr_id'] = ($_COOKIE ['id_account'] ? $_COOKIE ['id_account'] : $ImDataOne ['susr_id']);
if ($ImDataOne ['susr_id']) {
	$SusrIDCl = new mysql_select ( $tbl_accounts );
	$RealtorData = $SusrIDCl->select_table_id ( "WHERE id_account	= {$ImDataOne['susr_id']}" );
	//$RealtorData = $ImPageContentClass ->For_HTML($res["realtor"], $RealtorData);
}
$fotos = $PhotoQueryClass->table;

ob_start ();
?>
<page style="font-family: freeserif;">
<table cellpadding="0" cellspacing="0" border="0" width="800"
	style="border: 1px solid #000;">
	<tr>
		<td>
		<p>Код: <?php
		echo $ImDataOne ['im_code'];
		?></p>
		</td>
		<td align="center"><img
			src="../../../files/images/bg/alfabrok.pdf.logo.png" width="180" /></td>
		<td>
		<p>Имя : <?php
		echo $RealtorData ['fio'];
		?></p>
		<p>email : <?php
		echo $RealtorData ['login'];
		?></p>
		<p>TEL : <?php
		echo $RealtorData ['tel'];
		?></p>
		</td>
	</tr>
	<tr height="400" align="top">
		<td width="170">
			<?php
			if (file_exists ( '../../../files/images/immovables/st_' . $ImDataOne ['im_photo'] )) {
				echo '<img src="../../../files/images/immovables/st_' . $ImDataOne ['im_photo'] . '" />';
			}
			;
			?> 
		</td width="220">
		<td>
		<p><?php
		echo $RetPropAdvased;
		?></p>
		</td>
		<td>		
		<?php
		echo $RetImFieldInfo;
		?>
		<p style="color: red">ЦЕНА : <?php
		echo strip_tags ( $ImPrice );
		?>
		<br/>
		<?php
		echo strip_tags ( $ImPriceUSD );
		?>
		<br/>
		<?php
		echo strip_tags ( $ImPriceEUR );
		?>
		<br/>
		<?php
		echo strip_tags ( $ImPriceRUB );
		?></p>
		</td>

	</tr>
	<tr>

		<td colspan="3" align="justify"><br />
		<div style="width: 700; text-align: left;"><?php
		echo strip_tags ( str_replace ( 'Р', 'P', $SummaryIm ['im_su_text'] ) );
		?></div>
		</td>
	</tr>


</table>
<?php

//..$str = 'РРРРРРРРРРРррррррррPPPp';
//echo $str;


//$str2 = str_replace('Р','P',$str);
//echo $str2;
?>
<br />

<div style="padding-left: 90px;">
	<?php
	
	foreach ( $fotos as $foto ) :
		if (file_exists ( '../../../files/images/immovables/pr_' . $foto ['im_photo_id'] . '.' . $foto ['im_file_type'] )) {
			echo ' <img src=../../../files/images/immovables/pr_' . $foto ['im_photo_id'] . '.' . $foto ['im_file_type'] . ' />';
		}
	endforeach;
	?>
	</div>






</page>

<?php
$c = ob_get_clean ();

/*
echo $RealtorData;
echo '<br>';	
	

echo $ImPrice ;
echo '<br>';		
		

echo $RetSummaryIm;
echo '<br>';	
*/
//$c = ob_get_clean();
//echo $c;
$content = $c;
/*
$content = '<page style="font-family: freeserif">
<table cellpadding="0" cellspacing="0" border="1" width= "700">
	<tr>
		<td>
		</td>
		<td>
		
		</td>
		<td>
		</td>
	</tr>
	<tr>
		<td>
		
		</td>
		<td>
			'.$c.'
		</td>
		<td>
		</td>
	</tr>
	<tr>
		<td>
		</td>
		<td>
		</td>
		<td>
		</td>
	</tr>
</table>
</page>';
*/
//echo $content;
//$fotos = $PhotoQueryClass->table;


/*	
		
		$im_catalog_id = '4c3ec51d537c0';
		
		
		
	//	$tbl_dictionaries
		
		$im_id = $_GET['im_id'];
		$_COOKIE['lang_id'] = $_GET['lang_id'];
		$query = "SELECT  l.im_prop_name,i.im_prop_value,d.dict_name
						FROM $tbl_im_pl l 
						left join $tbl_im_pi i 
						ON l.im_prop_id = i.im_prop_id 
						left join $tbl_dictionaries d						
						ON l.ld_id = d.ld_id 
						WHERE l.lang_id = $_COOKIE['lang_id'] 
						AND i.lang_id = $_COOKIE['lang_id'] 
						AND l.catalog_id = '4c3ec51d537c0'
						AND l.hide='show' 
						AND i.im_id = $im_id
						AND d.lang_id =	$_COOKIE['lang_id']	
						ORDER BY im_prop_name ASC";// or die(mysql_error());
	echo $query;
	//$query = "SELECT * FROM $tbl_im_su WHERE  im_id = $im_id";
	//$tbl_im
	//echo $query;
		$result = mysql_query($query) or die(mysql_error());
		$query2 = "SELECT *FROM $tbl_im WHERE im_id = $im_id ";// or die(mysql_error());
		$result2 = mysql_query($query2) or die(mysql_error());
		function build_array($src)
		{
			 while ($row = mysql_fetch_assoc($src))
			 {
				$array[] = $row;
			 }
			 return $array;
		}
		
		
		
		
		
		$im =  build_array($result);
		$im2 =  build_array($result2);
echo '<pre>';
print_r($im2);
echo '</pre>';
		
	
echo '<pre>';
print_r($im);
echo '</pre>';
	
		
		
		
	/*	
   $content = '<page style="font-family: freeserif"><br /><p>'.print_r($im).'</p></page>';

     convert to PDF*/
try {
	$html2pdf = new HTML2PDF ( 'P', 'A4', 'en' );
	$html2pdf->pdf->SetDisplayMode ( 'real' );
	$html2pdf->writeHTML ( $content, isset ( $_GET ['vuehtml'] ) );
	$html2pdf->Output ( $ImDataOne ['im_code'] . '.pdf' );
} catch ( HTML2PDF_exception $e ) {
	echo $e;
	exit ();
} 
