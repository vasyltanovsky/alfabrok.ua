<?php
////////////////////////////////////////////////////
// PHPModuleSite - PHP module class
//
// Данный класс формирует модули сайта (новосной, последние работы, клианты, партнеры) 
// Для работы
// Copyright (C) 2010  Alex Tsurkin www.alex-ts.com
////////////////////////////////////////////////////


# Handler_Template_Html - функция подставляет в указанный шаблон значения из массива
# For_HTML - вспомогательная функция Handler_Template_Html


# подключение соответственных обработчиков даты изображения и т.д.   
# $propertis = array('gb_date'=>array('gb_date','date'));					 
# $key = 'gb_date';								 
# if(in_array($key, $propertis[$key])) echo $propertis[$key][1];


class ModuleSite {
	# массив параметров языка сайта
	public $lang_arr;
	# массив шаблонов блока
	public $TemplateHtml;
	public $ClassDict;
	
	public function __construct($TemplateHtml = array(), $lang_arr = array(), $ClassDict = NULL) {
		$this->lang_arr = $lang_arr;
		$this->TemplateHtml = $TemplateHtml;
		$this->ClassDict = $ClassDict;
	}
	
	public function Appeal_to_the_block($ArrRequest = array(), # выбранный массив
$RequestSample = NULL, # запрос для выборки
$IdTemplateHtml) # айди шаблона
{
		
		return;
	}
	
	public function SetFieldValue($NameField, $FieldValue) {
		return $this->$NameField = $FieldValue;
	}
	
	# обработчик шаблона HTML
	public function Handler_Template_Html($IdTemplateHtml, # айди шаблона
$ArrRequest = array(), # выбранный массив
$propertis = NULL) {
		#	если нет массива выходим
		if (empty ( $ArrRequest ))
			return "";
			#	поиск шаблона
		$HTML = $this->TemplateHtml [$IdTemplateHtml];
		#	проходим весь массив данных
		for($i = 0; $i < count ( $ArrRequest ); $i ++) {
			#	вызов функции подстановки значений в шаблон
			if (empty ( $propertis ))
				$return .= $this->For_HTML ( $HTML, $ArrRequest [$i] );
			else
				$return .= $this->For_HTML_Propertis ( $HTML, $ArrRequest [$i], $propertis );
		
		}
		#	вставка шапки и футера шаблона
		if ($this->TemplateHtml [$IdTemplateHtml . "_header"])
			$return = $this->TemplateHtml [$IdTemplateHtml . "_header"] . $return;
		if ($this->TemplateHtml [$IdTemplateHtml . "_bottom"])
			$return .= $this->TemplateHtml [$IdTemplateHtml . "_bottom"];
			#	возврщение сформированого шаблона
		return $return;
	}
	
	#	функция подстановки значений в шаблон
	public function For_HTML($html, $data) {
		if (empty ( $data ))
			return;
		foreach ( $data as $key => $unformattedValue ) {
			if (is_numeric($unformattedValue))
			{
				$value = number_format($unformattedValue, 0, ',', ' ');
			}
			else
			{
				$value = $unformattedValue;	
			}
			$html = str_replace ( "#" . $key . "#", $value, $html );
		}
		return $html;
	}
	
	#
	public function For_HTML_Propertis($html, $data, $propertis) {
		foreach ( $data as $key => $value ) {
			if ($propertis [$key])
				if (in_array ( $key, $propertis [$key] ))
					$value = $this->Do_Some_Propertis ( $value, $propertis [$key] [1] );
			
			$html = str_replace ( "#" . $key . "#", $value, $html );
		
		}
		return $html;
	}
	
	#
	public function Do_Some_Propertis($value, $propertis_name) {
		switch ($propertis_name) {
			case 'date' :
				{
					list ( $date, $time ) = explode ( " ", $value );
					list ( $year, $month, $day ) = explode ( "-", $date );
					return $date = "$day.$month.$year " . substr ( $time, 0, 5 );
					break;
				}
			case 'isset_img' :
				{
					if (empty ( $value ))
						return "cpnoimage.png";
					else
						return $value;
				}
			case 'isset_description' :
				{
					if (empty ( $value ))
						return "";
					else
						return $value;
				}
			case 'iseet_news_img' :
				{
					if (empty ( $value ))
						return "";
					else
						return "<img src=\"/files/images/press/#news_image#\" alt=\"\"/>";
				}
			case 'isset_partner_img' :
				{
					if (empty ( $value ))
						return "";
					else
						return "<img src=\"/files/images/partners/#partner_logo#\" alt=\"\"/>";
				}
			case 'PhotoImgType' :
				{
					if (empty ( $value ))
						return "";
					else
						return $this->ClassDict->buld_table [$value] ['dict_name'];
				}
			case 'get_lang_id' :
				{
					return $this->lang_arr [$value];
				}
			case 'get_img_ok' :
				{
					if (! empty ( $value ))
						return "+";
					else
						return;
				}
			case 'get_coords' :
				{
					echo 'ac_' . $value;
					if (isset ( $this->lang_arr ['ac_' . $value] ))
						return $this->lang_arr ['ac_' . $value];
					else
						return;
				}
			case 'isset_info_img' :
				{
					if (empty ( $value ))
						return "";
					else
						return "<img src=\"/files/images/service/{$value}\" alt=\"\"/>";
				}
			case 'isset_pl' :
				{
					if (empty ( $value ))
						return "";
					else
						return "<img src=\"/files/partner/{$value}\" alt=\"\"/>";
				}
			case 'isset_pu' :
				{
					if (empty ( $value ))
						return "";
					else
						return "<a class=\"HPartnerTitle\" href=\"http://{$value}\" target=\"_blank\">{$value}</a>";
				}
			case 'GetRealtorData' :
				{
					if (empty ( $value ))
						return "";
					else
						return $this->realtor_data [$value] ['fio'] . "(" . $this->realtor_data [$value] ['login'] . ")";
					break;
				}
		
		}
	}

}
?>