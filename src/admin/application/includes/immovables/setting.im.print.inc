<?php
/* Обработчики построения Html	
 * 
 * GetDataValue		-	значение поля
 * GetIndexImage	-	главное изображение
 * GetDictValue		-	значение справочника
 * GetPropValue		-	значение характеристики
 * GetPropListValue	-	значение списка характеристик
 * GetCurrentPrice	-	обработчик изминения цены
 * GetDateValue		-	преобразования даты
 * GetFullAdress	-	получение полного адреса
 * GetMap			-	карта 
 */
 
 //#im_city_id#, #im_adress_id#,========== #im_adress_house#, #im_adress_flat#
	$TemplateImList['flat']['sale'] =	array (
												'im_id'				=>'GetDataValue', 
												'im_code'			=>'GetDataValue', 
												'im_photo'			=>'GetIndexImage',
												'im_city_id'		=>'GetDictValue',
												'im_adress_id'		=>'GetDictValue',
												'im_adress_house'	=>'GetDataValue',
												'im_prop_list'		=>'GetPropListValue',
												'im_prices'			=>'GetCurrentPrice',
												'im_prices_ni'		=>'GetCurrentPriceNoImage',
												'im_prace_sq'		=>'GetDataValuePrice',
												'im_space'			=>'GetDataValue',
												'4c40122f31138'		=>'GetPropValue',
												'4c4012253a36f'		=>'GetPropValue',
												'im_date_add'		=>'GetDateValue',
												'4c400ea1b5657'		=>'GetPropValue',
												'4c400ec87481e'		=>'GetPropValue',
												'im_map'			=>'GetMap',
												'4c400ed4e5797'		=>'GetPropValue',
												'im_adress_flat'	=>'GetDataValue',
												'im_title'			=>'GetDataValue',
												'im_full_adress'	=>'GetFullAdress'
												);
	$TemplateImList['flat']['rent'] =	array (
												'im_id'				=>'GetDataValue', 
												'im_code'			=>'GetDataValue', 
												'im_photo'			=>'GetIndexImage',
												'im_city_id'		=>'GetDictValue',
												'im_adress_id'		=>'GetDictValue',
												'im_adress_house'	=>'GetDataValue',
												'im_prop_list'		=>'GetPropListValue',
												'im_prices'			=>'GetCurrentPrice',
												'im_prace_sq'		=>'GetDataValue',
												'im_prace_manth'	=>'GetSimplePrice',
												'im_prace_day'		=>'GetSimplePrice',
												'im_space'			=>'GetDataValue',
												'4c40122f31138'		=>'GetPropValue',
												'4c4012253a36f'		=>'GetPropValue',
												'im_date_add'		=>'GetDateValue',
												'4c400ea1b5657'		=>'GetPropValue',
												'4c400ec87481e'		=>'GetPropValue',
												'im_map'			=>'GetMap',
												'4c400ed4e5797'=>'GetPropValue',
												'im_adress_flat'	=>'GetDataValue',
												'im_title'			=>'GetDataValue',
												'im_prices_ni'		=>'GetCurrentPriceNoImage',
												'im_full_adress'	=>'GetFullAdress'
												);											
	$TemplateImList['commercial']['sale'] =	array (
												'im_id'				=>'GetDataValue', 
												'im_code'			=>'GetDataValue', 
												'im_photo'			=>'GetIndexImage',
												'im_city_id'		=>'GetDictValue',
												'im_adress_id'		=>'GetDictValue',
												'im_adress_house'	=>'GetDataValue',
												'im_prop_list'		=>'GetPropListValue',
												'im_prices'			=>'GetCurrentPrice',
												'im_prace_sq'		=>'GetDataValuePrice',
												'im_space'			=>'GetDataValue',
												'4c604016208bc'		=>'GetPropValue',
												'im_date_add'		=>'GetDateValue',
												'4c4050fc797b1'		=>'GetPropValue',
												'4c404804b576c'		=>'GetPropValue',
												'im_map'			=>'GetMap',
												'4c400ed4e5797'=>'GetPropValue',
												'4c4050b294c4f'		=>'GetPropValue',
												'im_adress_flat'	=>'GetDataValue',
												'im_title'			=>'GetDataValue',
												'im_prices_ni'		=>'GetCurrentPriceNoImage',
												'im_full_adress'	=>'GetFullAdress'
												);
	$TemplateImList['commercial']['rent'] =	array (
												'im_id'				=>'GetDataValue', 
												'im_code'			=>'GetDataValue', 
												'im_photo'			=>'GetIndexImage',
												'im_city_id'		=>'GetDictValue',
												'im_adress_id'		=>'GetDictValue',
												'im_adress_house'	=>'GetDataValue',
												'im_prop_list'		=>'GetPropListValue',
												'im_prace_manth'	=>'GetSimplePrice',
												'im_prace_day'		=>'GetSimplePrice',
												'im_prices'			=>'GetCurrentPrice',
												'im_prace_sq'		=>'GetDataValue',
												'im_space'			=>'GetDataValue',
												'4c604016208bc'		=>'GetPropValue',
												'im_date_add'		=>'GetDateValue',
												'4c4050fc797b1'		=>'GetPropValue',
												'4c404804b576c'		=>'GetPropValue',
												'im_map'			=>'GetMap',
												'4c4050b294c4f'=>'GetPropValue',
												'im_adress_flat'	=>'GetDataValue',
												'im_title'			=>'GetDataValue',
												'im_prices_ni'		=>'GetCurrentPriceNoImage',
												'4c400ed4e5797'=>'GetPropValue',
												'im_full_adress'	=>'GetFullAdress'
												);
	$TemplateImList['home']['sale'] =	array (
												'im_id'				=>'GetDataValue', 
												'im_code'			=>'GetDataValue', 
												'im_photo'			=>'GetIndexImage',
												'im_city_id'		=>'GetDictValue',
												'im_adress_id'		=>'GetDictValue',
												'im_adress_house'	=>'GetDataValue',
												'im_prop_list'		=>'GetPropListValue',
												'im_prices'			=>'GetCurrentPrice',
												'im_prace_sq'		=>'GetDataValuePrice',
												'im_space'			=>'GetDataValue',
												'4c402f924bc2a'		=>'GetPropValue',
												'im_date_add'		=>'GetDateValue',
												'im_map'			=>'GetMap',
												'4c402f345c83d'=>'GetPropValue',
												'im_adress_flat'	=>'GetDataValue',
												'im_title'			=>'GetDataValue',
												'4c400ed4e5797'=>'GetPropValue',
												'im_prices_ni'		=>'GetCurrentPriceNoImage',
												'im_full_adress'	=>'GetFullAdress',
												'im_full_adress'	=>'GetFullAdress'
												);
	$TemplateImList['home']['rent'] =	array (
												'im_id'				=>'GetDataValue', 
												'im_code'			=>'GetDataValue', 
												'im_photo'			=>'GetIndexImage',
												'im_city_id'		=>'GetDictValue',
												'im_adress_id'		=>'GetDictValue',
												'im_adress_house'	=>'GetDataValue',
												'im_prop_list'		=>'GetPropListValue',
												'im_prices'			=>'GetCurrentPrice',
												'im_prace_manth'	=>'GetSimplePrice',
												'im_prace_day'		=>'GetSimplePrice',
												'im_prace_sq'		=>'GetPriceExchangeRate',
												'im_space'			=>'GetDataValue',
												'4c402f924bc2a'		=>'GetPropValue',
												'im_date_add'		=>'GetDateValue',
												'im_map'			=>'GetMap',
												'4c400ed4e5797'=>'GetPropValue',
												'4c402f345c83d'=>'GetPropValue',
												'im_adress_flat'	=>'GetDataValue',
												'im_title'			=>'GetDataValue',
												'im_prices_ni'		=>'GetCurrentPriceNoImage',
												'im_full_adress'	=>'GetFullAdress'
												);
	$TemplateImList['buildings']['sale'] =	array (
												'im_id'				=>'GetDataValue', 
												'im_code'			=>'GetDataValue', 
												'im_photo'			=>'GetIndexImage',
												'im_city_id'		=>'GetDictValue',
												'im_adress_id'		=>'GetDictValue',
												'im_adress_house'	=>'GetDataValue',
												'im_prop_list'		=>'GetPropListValue',
												'im_prices'			=>'GetCurrentPrice',
												'im_prace_sq'		=>'GetDataValuePrice',
												'im_space'			=>'GetDataValue',
												'im_date_add'		=>'GetDateValue',
												'im_map'			=>'GetMap',
												'4c400ed4e5797'=>'GetPropValue',
												'4c40586e48e5f'=>'GetPropValue',
												'im_adress_flat'	=>'GetDataValue',
												'im_title'			=>'GetDataValue',
												'im_prices_ni'		=>'GetCurrentPriceNoImage',
												'im_full_adress'	=>'GetFullAdress'
												);
	$TemplateImList['buildings']['rent'] =	array (
												'im_id'				=>'GetDataValue', 
												'im_code'			=>'GetDataValue', 
												'im_photo'			=>'GetIndexImage',
												'im_city_id'		=>'GetDictValue',
												'im_adress_id'		=>'GetDictValue',
												'im_adress_house'	=>'GetDataValue',
												'im_prop_list'		=>'GetPropListValue',
												'im_prace_manth'	=>'GetSimplePrice',
												'im_prace_day'		=>'GetSimplePrice',
												'im_prices'			=>'GetCurrentPrice',
												'im_prace_sq'		=>'GetPriceExchangeRate',
												'im_space'			=>'GetDataValue',
												'im_date_add'		=>'GetDateValue',
												'im_map'			=>'GetMap',
												'4c400ed4e5797'=>'GetPropValue',
												'4c40586e48e5f'=>'GetPropValue',
												'im_adress_flat'	=>'GetDataValue',
												'im_title'			=>'GetDataValue',
												'im_prices_ni'		=>'GetCurrentPriceNoImage',
												'im_full_adress'	=>'GetFullAdress'
												);										
												
												
	$TemplateImList['land']['sale'] =	array (
												'im_id'				=>'GetDataValue', 
												'im_code'			=>'GetDataValue', 
												'im_photo'			=>'GetIndexImage',
												'im_city_id'		=>'GetDictValue',
												'im_adress_id'		=>'GetDictValue',
												'im_adress_house'	=>'GetDataValue',
												'im_prop_list'		=>'GetPropListValue',
												'im_prices'			=>'GetCurrentPrice',
												'im_prace_sq'		=>'GetDataValuePrice',
												'im_space'			=>'GetDataValue',
												'im_date_add'		=>'GetDateValue',
												'im_map'			=>'GetMap',
												'im_adress_flat'	=>'GetDataValue',
												'im_title'			=>'GetDataValue',
												'im_prices_ni'		=>'GetCurrentPriceNoImage',
												'im_full_adress'	=>'GetFullAdress'
												);	
	$TemplateImList['land']['rent'] =	array (
												'im_id'				=>'GetDataValue', 
												'im_code'			=>'GetDataValue', 
												'im_photo'			=>'GetIndexImage',
												'im_city_id'		=>'GetDictValue',
												'im_adress_id'		=>'GetDictValue',
												'im_adress_house'	=>'GetDataValue',
												'im_prop_list'		=>'GetPropListValue',
												'im_prices'			=>'GetCurrentPrice',
												'im_prace_manth'	=>'GetSimplePrice',
												'im_prace_day'		=>'GetSimplePrice',
												'im_prace_sq'		=>'GetPriceExchangeRate',
												'im_space'			=>'GetDataValue',
												'im_date_add'		=>'GetDateValue',
												'im_map'			=>'GetMap',
												'im_adress_flat'	=>'GetDataValue',
												'im_title'			=>'GetDataValue',
												'im_prices_ni'		=>'GetCurrentPriceNoImage',
												'im_full_adress'	=>'GetFullAdress'
												);	
	
	$TemplateImList['search'] =	array (
												'im_id'				=>'GetDataValue', 
												'im_code'			=>'GetDataValue', 
												'im_photo'			=>'GetIndexImage',
												'im_city_id'		=>'GetDictValue',
												'im_adress_id'		=>'GetDictValue',
												'im_adress_house'	=>'GetDataValue',
												'im_prop_list'		=>'GetPropListValue',
												'im_prices'			=>'GetCurrentPrice',
												'im_prices_ni'		=>'GetCurrentPriceNoImage',
												'im_prace_sq'		=>'GetDataValuePrice',
												'im_space'			=>'GetDataValue',
												'im_date_add'		=>'GetDateValue',
												'im_map'			=>'GetMap',
												'im_adress_flat'	=>'GetDataValue',
												'im_title'			=>'GetDataValue',
												'im_catalog_id'		=>'GetCatIm',
												'im_link' 			=>'GetLinkIm',
												'is_rent' 			=>'GetRentIm',
												'is_sale' 			=>'GetSaleIm',
												'im_region_id' 		=>'GetDictValue',
												'im_a_region_id' 	=>'GetDictValue',
												'im_space_value_id' =>'GetDictValue',
												'im_full_adress'	=>'GetFullAdress',
												'im_prace_manth'	=>'GetSimplePrice'
												
												);
																							
												
												
	$TemplateImOneData['im_Data'] =	array (
												'im_id'				=>'GetDataValue', 
												'im_code'			=>'GetDataValue', 
												'im_photo'			=>'GetDataValue',
												'im_adress_table'	=>'GetAdressTable',
												'im_price_table'	=>'GetCurrentPriceOne',
												'im_last_data'		=>'GetStandartTable',
												'im_prop_advaced'	=>'GetPropListImgText',
												'im_prop_standart'	=>'GetPropListValueText',
												'im_title'			=>'GetDataValue',
												'im_prace_manth'	=>'GetDataValuePriceBlock',
												'im_full_adress'	=>'GetFullAdress',
												'im_other_price'	=>'GetOtherPrice');												

	$TemplateImOneData['im_Data_map'] =	array ('im_city_id'			=>'GetDictValue',
												'im_adress_id'		=>'GetDictValue',
												'im_adress_house'	=>'GetDataValue',
												'im_full_adress'	=>'GetFullAdress',
												'im_geopos'			=>'GetDataValue');	
												
	$TemplateImOneData['im_Data_mail'] =	array (
												'im_id'				=>'GetDataValue', 
												'im_code'			=>'GetDataValue', 
												'im_photo'			=>'GetDataValue',
												'im_adress_table'	=>'GetAdressTable',
												'im_price_table'	=>'GetCurrentPriceOne',
												'im_last_data'		=>'GetStandartTable',
												'im_prop_advaced'	=>'GetPropListWord',
												'im_prop_standart'	=>'GetPropListValueText',
												'im_full_adress'	=>'GetFullAdress');		
		
	$TemplateImList['favorites'] =	array (
												'im_id'				=>'GetDataValue', 
												'im_code'			=>'GetDataValue', 
												'im_photo'			=>'GetIndexImage',
												'im_city_id'		=>'GetDictValue',
												'im_adress_id'		=>'GetDictValue',
												'im_adress_house'	=>'GetDictValue',
												'im_prop_list'		=>'GetPropListValue',
												'im_prices'			=>'GetCurrentPrice',
												'im_prace_sq'		=>'GetPriceExchangeRate',
												'im_space'			=>'GetDataValue',
												'im_date_add'		=>'GetDateValue',
												'im_map'			=>'GetMap',
												'is_rent' 			=>'GetRentIm',
												'is_sale' 			=>'GetSaleIm',
												'im_full_adress'	=>'GetFullAdress'
												);		
	$TemplateImList['DivListMinPrice'] =	array (
												'im_id'				=>'GetDataValue', 
												'im_code'			=>'GetDataValue', 
												'im_photo'			=>'GetDataValue',
												'im_title'			=>'GetDataValue', 
												'im_prace'			=>'GetPriceExchangeRateNoUsa',
												'im_link' 			=>'GetLinkIm',
												'im_title' 			=>'GetDataValue',
												'im_prace_manth'	=>'GetDataValuePriceSpan',
												'im_full_adress'	=>'GetFullAdress'
	
												);													

/*,
												
	
												
												
												'im_prop_list'		=>'GetPropListValue',
												'im_prices'			=>'GetCurrentPrice',
												'im_prace_sq'		=>'GetDataValue',
												'im_space'			=>'GetDataValue',
												'4c40122f31138'		=>'GetPropValue',
												'4c4012253a36f'		=>'GetPropValue',
												'im_date_add'		=>'GetDateValue',
												'4c400ea1b5657'		=>'GetPropValue',
												'4c400ec87481e'		=>'GetPropValue',
												'im_map'			=>'GetMap'
												
'im_region_id'		=>'GetDictValue',
												'im_a_region_id'	=>'GetDictValue',
												'im_city_id'		=>'GetDictValue',
												'im_area_id'		=>'GetDictValue',
												'im_array_id'		=>'GetDictValue',
												'im_adress_id'		=>'GetDictValue',
												'im_adress_house'	=>'GetDictValue',		*/																														
?>