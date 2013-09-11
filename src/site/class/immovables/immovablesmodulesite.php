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


class ModuleSiteIm {
	
	public $TemplateHtml; # массив шаблонов блока
	public $lang_arr; # массив параметров языка сайта
	public $ImPropData;
	public $ImPropArrData;
	public $DictData;
	
	public function __construct($TemplateHtml = array(), $lang_arr = array(), $DictData = array(), $ImPropData = array(), $ImPropArrData = array()) {
		$this->TemplateHtml = $TemplateHtml;
		$this->lang_arr = $lang_arr;
		$this->DictData = $DictData;
		$this->ImPropData = $ImPropData;
		$this->ImPropArrData = $ImPropArrData;
		
		$this->ClassPropPrint = new PropPrint ( $this->DictData );
	}
	
	# 
	/* Функция: обрабатывает массив и подставляет данные в массив
	    *
	    * @param $IdTemplateHtml - айди шаблона
	    * @param $ArrRequest - выбранный массив
	    * @param $ArrIdAndAction -	массив айдишников данных, и функция обработчиков 
	    * 
	    */
	public function Handler_Template_Html($IdTemplateHtml, $ArrRequest = array(), $ArrIdAndAction = array()) {
		#	если нет массива выходим
		if (empty ( $ArrRequest ))
			return "";
			#	поиск шаблона
		$HTML = $this->TemplateHtml [$IdTemplateHtml];
		#	проходим весь массив данных
		for($i = 0; $i < count ( $ArrRequest ); $i ++) {
			#	вызов функции подстановки значений в шаблон
			$return .= $this->BuildHTML ( $ArrRequest [$i], $HTML, $ArrIdAndAction );
		}
		#	вставка шапки и футера шаблона
		if ($this->TemplateHtml [$IdTemplateHtml . "_header"])
			$return = $this->TemplateHtml [$IdTemplateHtml . "_header"] . $return;
		if ($this->TemplateHtml [$IdTemplateHtml . "_bottom"])
			$return .= $this->TemplateHtml [$IdTemplateHtml . "_bottom"];
			#	возврщение сформированого шаблона
		return $return;
	}
	
	/*
		 * функция подстановки значений в шаблон
		 */
	public function BuildHTML($data, $html, $Action) {
		//if(empty($Action)) return;
		foreach ( $Action as $key => $value ) {
			$html_data = $this->$value ( $data, $key );
			$html = str_replace ( "#" . $key . "#", $html_data, $html );
		}
		return $html;
	}
	
	private function GetDataValue($data, $key) {
		return $data [$key];
	}
	/* 	Функция: возвращает значение справочника по айди 
		    * 	@param $data	-	
		    * 	@param $key		-	
		    */
	function GetDictValue($data, $key) {
		return $this->DictData->buld_table [$data [$key]] ['dict_name'];
	}
	/* 	Функция: возвращает значение справочника по айди 
		    * 	@param $data	-	
		    * 	@param $key		-	
		    */
	function GetPropValue($data, $key) {
		if (empty ( $this->ImPropArrData [$data ['im_id']] [$key] ['im_prop_value'] ))
			return "-";
		else
			return $this->ImPropArrData [$data ['im_id']] [$key] ['im_prop_value'];
		//return $key."GET";
	}
	/* 	Функция: возвращает значение справочника по айди 
		    * 	@param $data	-	
		    * 	@param $key		-	
		    */
	function GetPropListValue($data, $key) {
		//echo "<pre>";
		//print_r($this->ImPropData);
		//echo "</pre>";
		

		$return = $this->ClassPropPrint->GetPrintImg ( $this->ImPropData ['is_print_list'] [$data ['im_id']] );
		return $return;
	}
	/* 	Функция: возвращает значение справочника по айди 
		    * 	@param $data	-	
		    * 	@param $key		-	
		    */
	function GetPropListValueText($data, $key) {
		$return = $this->ClassPropPrint->GetPrint ( $this->ImPropData ['is_print_st'] [$data ['im_id']], 'GetPropTextTr' );
		return $return;
	}
	/* 	Функция: возвращает значение справочника по айди 
		    * 	@param $data	-	
		    * 	@param $key		-	
		    */
	function GetPropListWord($data, $key) {
		$return = $this->ClassPropPrint->GetPrint ( $this->ImPropData ['is_print_ad'] [$data ['im_id']], 'GetTextWord' );
		return $return;
	}
	/* 	Функция: возвращает значение справочника по айди 
		    * 	@param $data	-	
		    * 	@param $key		-	
		    */
	function GetPropListImgText($data, $key) {
		$return = $this->ClassPropPrint->GetPrint ( $this->ImPropData ['is_print_ad'] [$data ['im_id']], 'GetPropTextImgTr' );
		return $return;
	}
	/* 	Функция: возвращает значение справочника по айди 
		    * 	@param $data	-	
		    * 	@param $key		-	
		    */
	function GetDateValue($data, $key) {
		list ( $date, $time ) = explode ( " ", $data [$key] );
		list ( $year, $month, $day ) = explode ( "-", $date );
		return $date = "$day.$month.$year " . substr ( $time, 0, 5 );
		;
	}
	
	function GetPriceExchangeRate($data, $key) {
		return $this->GetDataValuePrice ( $data, $key ) . "<span class=\"ImSpanPriceUSA\" title=\"{$this->lang_arr['exchange_by_ndu']}\">(" . Discharge::GetDisValue ( $data [$key], 4, " $" ) . ")</span>";
	}
	
	function GetDataValuePriceBlock($data, $key) {
		return $this->GetDataValuePrice ( $data, $key ) . $this->getExchangeRateBlock ( $data [$key] );
	}
	
	/* 	Функция: возвращает другую стоимость обьекта, если аренда то продажу, и наоборот 
		    * 	@param $data	-	
		    * 	@param $key		-	
		    */
	function GetOtherPrice($data, $key) {
		global $exchangeRateObj;
		global $routingObj;
		$type_cat = $routingObj->getParamItem ( 'type_cat' );
		if (! empty ( $type_cat )) {
			$ClDisImPrice = new Discharge ( );
			if (($type_cat == "sale") && $data ['im_is_rent'])
				return sprintf ( '<h4 class="im-other-price"> %s %s<span>(%s)</span></h4>', $ClDisImPrice->GetDisValue ( $data ["im_prace_manth"] * $exchangeRateObj->GetItemData ( 'USD' ), 4 ), $this->getExchangeRateBlock ( $data ["im_prace_manth"] ), $this->lang_arr ['ImRent'] );
			
			if (($type_cat == "rent") && $data ['im_is_sale'])
				return sprintf ( '<h4 class="im-other-price"> %s %s<span>(%s)</span></h4>', $ClDisImPrice->GetDisValue ( $data ["im_prace"] * $exchangeRateObj->GetItemData ( 'USD' ), 4 ), $this->getExchangeRateBlock ( $data ["im_prace"] ), $this->lang_arr ['ImSale'] );
		
		}
		return;
	}
	
	/* 	Функция: возвращает значение справочника по айди 
		    * 	@param $data	-	
		    * 	@param $key		-	
		    */
	function GetDataValuePriceSpan($data, $key) {
		if (empty ( $data [$key] ))
			return;
		if ($data ['im_is_sale'] == 0)
			return;
		return "<span class=\"DivListImHotImSpanRS\">" . $data [$key] . "</span>";
	}
	
	function GetPriceExchangeRateNoUsa($data, $key) {
		global $exchangeRateObj;
		return "<span>" . Discharge::GetDisValue ( $data [$key] * $exchangeRateObj->GetItemData ( 'USD' ), 4 ) . "</span>";
	}
	
	/* 	Функция: возвращает значение справочника по айди 
		    * 	@param $data	-	
		    * 	@param $key		-	
		    */
	function GetMap($data, $key) {
		if (! empty ( $data ['im_geopos'] )) {
			return "<img src=\"http://static-maps.yandex.ru/1.x/?key={$this->lang_arr[YMapSiteKey]}&amp;l=map&amp;pt={$data[im_geopos]},pmywl&amp;size=140,140\" alt=\"\">";
		} else {
			return "<script type=\"text/javascript\">$(function() {GetYMapsGeoPointer('{$data[im_id]}','{$this->GetDictValue($data, 'im_city_id')}, {$this->GetDictValue($data, 'im_adress_id')}, {$data[im_adress_house]}');});</script> <div id=\"im_map_{$data[im_id]}\" class=\"im_map_{$data[im_id]}\"></div>";
		}
	}
	/* 	Функция: возвращает значение справочника по айди 
		    * 	@param $data	-	
		    * 	@param $key		-	
		    */
	function GetAdressTable($data, $key) {
		$AdrArr = array ('im_region_id' => 'FormSearchNameRegion', 'im_a_region_id' => 'FormSearchNameRRegionN', 'im_city_id' => 'FormSearchNameCity', 'im_area_id' => 'FormSearchNameACityN', 'im_array_id' => 'FormSearchNameACity', 'im_adress_id' => 'FormSearchNameAdress' );
		return $this->ArrGetSomeDictTr ( $data, $AdrArr );
	}
	function GetStandartTable($data, $key) {
		$AdrArr = array ('im_code' => 'ImFListHeaderCodeN', 'im_prace_sq' => 'FormSearchNamePriceMS', 'im_prace_day' => 'FormSearchNamePriceDay', 'im_prace_manth' => 'FormSearchNamePriceManth', 'im_space' => 'FormSearchNameSq', '4c4069e4f04ec' => 'FormSearchNameSqYchastka' );
		return $this->ArrGetSomeDataTr ( $data, $AdrArr );
	}
	
	function ArrGetSomeDictTr($data, $ArrTr) {
		foreach ( $ArrTr as $key => $value ) {
			if (! empty ( $data [$key] )) {
				switch ($key) {
					case 'im_adress_id' :
						{
							$return .= "<tr class=\"{$key}\"><td class=\"ImTableAdressTdlang\">{$this->lang_arr[$value]}</td><td class=\"some-width\">{$this->GetDictValue($data, $key)}, {$data[im_adress_house]}</td></tr>";
							break;
						}
					default :
						{
							$return .= "<tr class=\"{$key}\"><td class=\"ImTableAdressTdlang\">{$this->lang_arr[$value]}</td><td class=\"some-width\">{$this->GetDictValue($data, $key)}</td></tr>";
							break;
						}
				}
			}
		}
		return $return;
	}
	
	function GetFullAdress($data, $key) {
		$AdrArr = array ('im_city_id' => '', 'im_adress_id' => '', 'im_adress_house' => '', "im_adress_flat" => "" );
		$ret = "";
		foreach ( $AdrArr as $key => $value ) {
			if (! empty ( $data [$key] )) {
				if (($key != "im_adress_house") && ($key != "im_adress_flat"))
					$ret .= ", " . $this->GetDictValue ( $data, $key );
				else
					$ret .= ", " . $data [$key];
			}
		}
		#im_city_id#, #im_adress_id#,========== #im_adress_house#, #im_adress_flat#
		return substr ( $ret, 2, strlen ( $ret ) );
	}
	
	function ArrGetSomeDataTr($data, $ArrTr) {
		global $exchangeRateObj;
		$ClDisImPrice = new Discharge ( );
		foreach ( $ArrTr as $key => $value ) {
			if (! empty ( $data [$key] )) {
				switch ($key) {
					case 'im_prace_day' :
						{
							$return .= "<tr class=\"{$key}\">
							<td class=\"ImTableAdressTdlang\">{$this->lang_arr[$value]}</td>
							<td class=\"some-width\">" . Discharge::GetDisValue ( $this->GetDataValue ( $data, $key ) * $exchangeRateObj->GetItemData ( 'USD' ), 4 ) . "</td></tr>";
							break;
						}
					case 'im_prace_manth' :
						{
							$return .= "<tr class=\"{$key}\">
							<td class=\"ImTableAdressTdlang\">{$this->lang_arr[$value]}</td>
							<td class=\"some-width\">" . Discharge::GetDisValue ( $this->GetDataValue ( $data, $key ) * $exchangeRateObj->GetItemData ( 'USD' ), 4 ) . "</td></tr>";
							break;
						}
					case 'im_prace_sq' :
						{
							$return .= "<tr class=\"{$key}\">
							<td class=\"ImTableAdressTdlang\">{$this->lang_arr[$value]} {$this->GetDictValue($data, 'im_space_value_id')}</td>
							<td class=\"some-width\">" . Discharge::GetDisValue ( $this->GetDataValue ( $data, $key ) * $exchangeRateObj->GetItemData ( 'USD' ), 4 ) . "</td></tr>";
							break;
						}
					default :
						{
							$return .= "<tr class=\"{$key}\">
							<td class=\"ImTableAdressTdlang\">{$this->lang_arr[$value]}</td>
							<td class=\"some-width\">{$this->GetDataValue($data, $key)}</td></tr>";
							break;
						}
				}
			}
		}
		return $return;
		
		;
	}
	
	/* 	Функция: возвращает значение справочника по айди 
		    * 	@param $data	-	
		    * 	@param $key		-	
		    */
	function GetCurrentPriceOne($data, $key) {
		return Controller::Template ( "application/template/immovables/price.current.item.php", array ("data" => $data, "key" => $key ) );
	}
	
	function getExchangeRateBlock($value) {
		return Controller::Template ( "application/template/exchangeRate/exchange.rate.block.php", array ("value" => $value ) );
	}
	function GetCurrentPrice($data, $key) {
		return appHtmlClass::partial("immovables/price/pricecurrent", array("Data" => $data, "key" => $key));
	}
	function GetCurrentPriceNoImage($data, $key) {
		return appHtmlClass::partial("immovables/price/pricecurrentnoimage", array("Data" => $data, "key" => $key));
	}
	function GetDataValuePrice($data, $key) {
		global $exchangeRateObj; 
		if (empty ( $data [$key] ))
			return;
		else
			return Discharge::GetDisValue ( $data [$key] * $exchangeRateObj->GetItemData('USD'), 4 ) . "";
	}
	function GetSimplePrice($data, $key) {
		global $exchangeRateObj; 
		if (empty ( $data [$key] ))
			return;
		else
			return appHtmlClass::partial ( "immovables/price/pricesimple", array ("Data" => $data, "key" => $key ) );
	}
	
	/* 	Функция: возвращает значение справочника по айди 
			 * 	@param $data	-	
			* 	@param $key		-	
			 */
	function GetCatIm($data, $key) {
		return $this->lang_arr ['TypeCatImNameArrIdName'] [$data ['im_catalog_id']];
	}
	
	/* 	Функция: возвращает значение справочника по айди 
			 * 	@param $data	-	
			* 	@param $key		-	
			 */
	function GetLinkIm($data, $key) {
		if ($data ['im_is_sale'])
			return $this->lang_arr ['TypeCatImNameArrIdPAge'] [$data ['im_catalog_id']] . "/sale";
		else
			return $this->lang_arr ['TypeCatImNameArrIdPAge'] [$data ['im_catalog_id']] . "/rent";
	}
	/* 	Функция: возвращает значение справочника по айди 
			 * 	@param $data	-	
			* 	@param $key		-	
			 */
	function GetRentIm($data, $key) {
		if ($data ['im_is_rent'])
			return "<a href=\"/immovables/{$this->lang_arr ['TypeCatImNameArrIdPAge'] [$data ['im_catalog_id']]}/rent/1/{$data['im_id']}.html\"><img src=\"/files/images/bg/rent_im.png\" class=\"ImPriceUpImg\" alt=\"{$this->lang_arr['ImRent']}\" title=\"{$this->lang_arr['ImRent']}\"/></a>";
		return;
	}
	/* 	Функция: возвращает значение справочника по айди 
			 * 	@param $data	-	
			* 	@param $key		-	
			 */
	function GetSaleIm($data, $key) {
		if ($data ['im_is_sale'])
			return "<a href=\"/immovables/{$this->lang_arr ['TypeCatImNameArrIdPAge'] [$data ['im_catalog_id']]}/sale/1/{$data['im_id']}.html\"><img src=\"/files/images/bg/sale_im.png\" class=\"ImPriceUpImg\" alt=\"{$this->lang_arr['ImSale']}\" title=\"{$this->lang_arr['ImSale']}\"/></a>";
		return;
	}

}