<?php
	require_once '../config/config.php';
require_once DOC_ROOT . '/config/class.config.php';
	$CONFIG['Lang']['default'] = 'rus';
	require_once '../application/includes/language/set.cookie.php';
	require_once '../application/includes/module/template.module.php';
	require_once '../application/module/immovables/f.immobles.php';
	require_once '../application/includes/immovables/setting.im.print.inc';
	require_once("../application/includes/mail/template.mail.text.php");

		
	if ($lang_id == 1) {
		$res["im_prace"] 		= "#im_prace# грн.<br>";
		$res["im_prace_manth"] 	= "#im_prace# грн.<br>";
		
		$res["im_prace_old"] = "(#im_prace_ua_old# грн.) - старая цена<br>";
		$res['readmore'] = "подробнее..<br>";
		$res['4c3ec3ec5e9b5'] = "Квартиры";
		$res['4c3ec3ec5e9b7'] = "Коммерческая недвижимость";
		$res['4c3ec51d537c0'] = "Коттеджи. Дома. Дачи";
		$res['4c3ec51d537c2'] = "ОСЗ. Здания";
		$res['4c3ec51d537c3'] = "Земельные участки";
		$res['code'] = "Код: #im_id#";
		$res['codeN'] = "Код:";
		$res['rooms'] = "к.";
		$res["realtor"] = "Имя: #fio#<br>E-mail: #login#<br>Тел.: #tel#";
	}
	else if ($lang_id == 2) {
		$res["doc_im_header_1"] = "Недвижимость от www.alfabrok.ua<br>";
		$res["doc_im_header_2_price"] = "Цена: #im_price#$<br>";
		$res['readmore'] = "подробнее..<br>";
	}
	/*
	 *	функция возвращает количество строк для таблицы с фотографиями недвижимости 
	 */
	function GetCountRtfTableRows($table_image=NULL) {
		$count_img = count($table_image);
		$count_rows = intval($count_img/3)+1;
		for ($i=0;$i<$count_rows; $i++){
			$ret[] = 5;
		}
		return $ret;
	}
	
	function Generate($text) {
		global $ImDataOne;
		foreach($ImDataOne as $key => $value)
		{
			$text = str_replace("#".$key."#",$value,$text);
		}
		return $text;
	}
	function PReplase($text) {
		$text = str_replace("<p>","<br>",$text);
		$text = str_replace("</p>","",$text);
		return $text;
	}
	function GetImFildsDictValue($data){
		global $arWords;
		global $dictionaries;
		$AdrArr = array('im_region_id'	 	=> 'FormSearchNameRegion', 
						'im_a_region_id' 	=> 'FormSearchNameRRegion',
						'im_city_id'		=> 'FormSearchNameCity',
						'im_area_id'		=> 'FormSearchNameRCIty',
						'im_array_id'		=> 'FormSearchNameACity',
						'im_adress_id'		=> 'FormSearchNameAdress');
		foreach ($AdrArr as $key => $value) {
			if(!empty($data[$key])) {
				switch ($key) {
					case 'im_adress_id': {$return .= "<b>{$arWords[$value]} - {$dictionaries->buld_table[$data[$key]][dict_name]}, {$data[im_adress_house]}</b><br>";
					break;}
					default:{ $return .= "{$arWords[$value]} - {$dictionaries->buld_table[$data[$key]][dict_name]}<br>";
					break;}
				}
			}
		}
		return $return;
	}
	function GetImFildsValue($data){
		global $arWords;
		$AdrArr = array('im_prace_sq'	 	=> 'ImFListHeaderM2Sotku', 
						'im_prace_day' 		=> 'FormSearchNamePriceDay',
						'im_prace_manth'	=> 'FormSearchNamePriceManth',
						'im_space'			=> 'FormSearchNameSqMS');
		foreach ($AdrArr as $key => $value) {
			if(!empty($data[$key])) {
				switch ($key) {
					default:{ $return .= "{$arWords[$value]} - {$data[$key]}<br>";
					break;}
				}
			}
		}
		return $return;
	}
	#
		function SendMailForUser($Message, $UsersData, $Files = NULL) {
			global $arWords;
			global $CONFIG;
			$ContentClass = new ModuleSite();
			
				$mail = new PHPMailer();
				$mail->From = $CONFIG['Email']['admin'];      // от кого
				$mail->CharSet = 'utf-8';
				$mail->FromName = '';   // от кого
				$mail->AddAddress($UsersData['user_email']); 		// кому - адрес, Имя
				$mail->IsHTML(true);        			// выставляем формат письма HTML
				$mail->Subject 	= $arWords['Email_subs'];  // тема письма 
				$mail->Body		= $Message;
				for ($j = 0; $j < count($Files); $j++) {
					$mail->AddAttachment($Files[$j]);
				}
				$mail->AddAttachment("../files/images/bg/alfabrok.jpg");
			  	// отправляем наше письмо
				if (!$mail->Send()) die ('Mailer Error: '.$mail->ErrorInfo);
			return;
		}
		
	#проверка на добавленные нов. позиции недвижимости 
		$ImDataClCount = new mysql_select($tbl_im);
		$ImDataClCount ->select_table_query("SELECT COUNT(i.im_id) FROM {$tbl_im} i WHERE i.im_date_add >= DATE_SUB(CURDATE(),INTERVAL 1 DAY)");
		if ($ImDataClCount->table[0][0] == 0) exit();
		echo "im isset<br>";
	
	#выборка подписчиков
		$UserSubsCl = new mysql_select($tbl_user_subs);
		$UserSubsCl ->select_table_query("SELECT u.*, s.user_id, s.user_fio, s.user_email FROM {$tbl_user_subs} u LEFT JOIN {$tbl_user_site} s ON u.user_id = s.user_id WHERE u.us_im_is_rent = 1");
		
		$UserSubsRent = $UserSubsCl ->table;
		$UserSubsCl ->select_table_query("SELECT u.*, s.user_id, s.user_fio, s.user_email FROM {$tbl_user_subs} u LEFT JOIN {$tbl_user_site} s ON u.user_id = s.user_id WHERE  u.us_im_is_sale = 1");
		$UserSubsSale = $UserSubsCl ->table;
		if (empty($UserSubsRent) and empty($UserSubsSale)) exit();
		echo "user isset<br>";
		
	#объявляем класс словаря
		$dictionaries	= new dictionaries();
		$dct_list 		= $dictionaries->buid_dictionaries_list($tbl_list_dictionaries);
		$dct			= $dictionaries->buid_dictionaries	($tbl_dictionaries,
									 	 					 		"WHERE lang_id = {$lang_id} ORDER BY dict_name");
	#выборка характеристик недвижимости	(rent)
		$ImPropListInfoRent = new mysql_select($tbl_im_pl,
											"l left join {$tbl_im_pi} i ON l.im_prop_id = i.im_prop_id WHERE l.lang_id = {$_COOKIE['lang_id']} AND l.is_prop_rent = 1 AND i.lang_id = {$_COOKIE['lang_id']} AND hide='show'",
											"ORDER BY im_prop_name ASC");
		$ImPropListInfoRent->select_table("im_prop_id");
	#выборка характеристик недвижимости	(sale)
		$ImPropListInfoSale = new mysql_select($tbl_im_pl,
											"l left join {$tbl_im_pi} i ON l.im_prop_id = i.im_prop_id WHERE l.lang_id = {$_COOKIE['lang_id']} AND l.is_prop_sale = 1 AND i.lang_id = {$_COOKIE['lang_id']} AND hide='show'",
											"ORDER BY im_prop_name ASC");
		$ImPropListInfoSale->select_table("im_prop_id");	
	#преобразование данных характеристик и значений (rent)
		$ImPropDataRent = new PropSort($ImPropListInfoRent->table);
		$ImPropDataRent ->GetArrToPrint('im_id', array('is_print_list', 'is_print_ad', 'is_print_st'));
	#преобразование данных характеристик и значений (sale)
		$ImPropDataSale = new PropSort($ImPropListInfoRent->table);
		$ImPropDataSale ->GetArrToPrint('im_id', array('is_print_list', 'is_print_ad', 'is_print_st'));
	#обработчик шаблонов	
		$ImPageContentClass = new ModuleSite($ModuleTemplate);
	
		header('Content-Type: text/html; charset=utf-8'); 	
		
//обработка аренды
	for ($i = 0; $i < count($UserSubsRent); $i++) {	
		$ClSelIm = new mysql_select($tbl_im,
									"i WHERE i.im_date_add >= DATE_SUB(CURDATE(),INTERVAL 1 DAY) AND i.im_is_rent = 1");
		$ClSelIm -> select_table();
		if (!empty($ClSelIm->table)) {
			echo "недвижмость rent сущест<br>";
			for ($j = 0; $j < count($ClSelIm->table); $j++) {	
					$MailFileArr = array(); 
					$ImDataOne 					= $ClSelIm->table[$j];
					$ModArray['im_photo']		= $ImDataOne['im_photo'];
					$MailFileArr[] = "../files/images/immovables/si_{$ImDataOne['im_photo']}";
				#формирование адреса
					$ModArray['im_adress_table'] = GetImFildsDictValue($ImDataOne);
					$ModArray['im_adress_table'] .= GetImFildsValue($ImDataOne);
				#преобразование данных характеристик и значений
					$ClassPropPrint				= new PropPrint($dictionaries);
					$ModArray['im_prop_standart'] = $ClassPropPrint->GetPrint($ImPropDataRent->ImPropData['is_print_st'][$ImDataOne['im_id']], 'GetTextWord');
					$ModArray['im_prop_advaced']  = $ClassPropPrint->GetPrint($ImPropDataRent->ImPropData['is_print_ad'][$ImDataOne['im_id']], 'GetTextWord');
				#формирование описание недв.
					$ModArray['summary']		= '';					
					$ImSuQClass 				= new mysql_select($tbl_im_su);
			  		$active_id 					= $ImSuQClass -> select_table_id("WHERE lang_id = '4c5d58cd3898c' AND im_id = {$ImDataOne[im_id]}");
			  		if(!empty($active_id)) {
			  			$SummaryIm['im_su_text']	= $active_id['im_su_text'];
			  			$SummaryIm['title']			= $ImDataOne['title'];
			  			$ModArray['summary']		= $ImPageContentClass ->For_HTML("<b>#title#</b>#im_su_text#", $SummaryIm);
			  		}
			  	#формирование кода	
			  		$ModArray['kode'] 			= $ImPageContentClass ->For_HTML($res["code"],$ImDataOne, array()); 	
			  	#обработка цен недвижимости	
			  		$ModArray['im_price_table'] = $ImPageContentClass ->For_HTML($res["im_prace_manth"],$ImDataOne, array()); 	
			  	#информация о Риэлторе	
					$ModArray['realtor'] 		= '';
					if($ImDataOne['susr_id']) {
						$SusrIDCl 				= new mysql_select($tbl_accounts);
						$RealtorData 			= $SusrIDCl -> select_table_id("WHERE id_account	= {$ImDataOne['susr_id']}");
						$ModArray['realtor'] 	= $ImPageContentClass ->For_HTML($res["realtor"], $RealtorData);
					}	
				#формирование плана	
					$PhotoPlanQueryClass = new mysql_select($tbl_im_ph);
					$ImPlanImg = $PhotoPlanQueryClass -> select_table_id("WHERE im_id = {$ImDataOne['im_id']} AND im_photo_type != '4c5a97c04ffa1'");
					$ModArray['img'] = '';
					if(!empty($ImPlanImg)) {
						$MailFileArr[]	 = "../files/images/immovables/si_{$ImPlanImg[im_photo_id]}.{$ImPlanImg[im_file_type]}";
						$ModArray['img'] = $ImPageContentClass->For_HTML($ModuleTemplate['im_foto_mail_list'], $ImPlanImg);	
					}
					$ReturnHtmlPage 		= $ImPageContentClass ->For_HTML($ModuleTemplate['table_one_immovable_mail_block'], $ModArray);
					
					SendMailForUser($ReturnHtmlPage, $UserSubsRent[$i], $MailFileArr);
					echo $ReturnHtmlPage;
					echo "<hr>";
			}
		}
	}
		
//обработка продажы
	for ($i = 0; $i < count($UserSubsSale); $i++) {	
		echo "enter sale us<br>";
		
		$ClSelIm = new mysql_select($tbl_im,
									"i WHERE i.im_date_add >= DATE_SUB(CURDATE(),INTERVAL 1 DAY) AND i.im_is_sale = 1");
		$ClSelIm -> select_table();
		if (!empty($ClSelIm->table)) {
			echo "недвижмость sale сущест<br>";
			for ($j = 0; $j < count($ClSelIm->table); $j++) {	
					$MailFileArr = array(); 
					$ImDataOne 					= $ClSelIm->table[$j];
					$ModArray['im_photo']		= $ImDataOne['im_photo'];
					$MailFileArr[] = "../files/images/immovables/si_{$ImDataOne['im_photo']}";
				#формирование адреса
					$ModArray['im_adress_table'] = GetImFildsDictValue($ImDataOne);
					$ModArray['im_adress_table'] .= GetImFildsValue($ImDataOne);
				#преобразование данных характеристик и значений
					$ClassPropPrint				= new PropPrint($dictionaries);
					$ModArray['im_prop_standart'] = $ClassPropPrint->GetPrint($ImPropDataSale->ImPropData['is_print_st'][$ImDataOne['im_id']], 'GetTextWord');
					$ModArray['im_prop_advaced']  = $ClassPropPrint->GetPrint($ImPropDataSale->ImPropData['is_print_ad'][$ImDataOne['im_id']], 'GetTextWord');
				#формирование описание недв.
					$ModArray['summary']		= '';					
					$ImSuQClass 				= new mysql_select($tbl_im_su);
			  		$active_id 					= $ImSuQClass -> select_table_id("WHERE lang_id = '4c5d58cd3898c' AND im_id = {$ImDataOne[im_id]}");
			  		if(!empty($active_id)) {
			  			$SummaryIm['im_su_text']	= $active_id['im_su_text'];
			  			$SummaryIm['title']			= $ImDataOne['title'];
			  			$ModArray['summary']		= $ImPageContentClass ->For_HTML("<b>#title#</b>#im_su_text#", $SummaryIm);
			  			//$ModArray['summary']		= PReplase($SummaryIm);	
			  		}
			  	#формирование кода	
			  		$ModArray['kode'] 			= $ImPageContentClass ->For_HTML($res["code"],$ImDataOne, array()); 	
			  	#обработка цен недвижимости	
					$ModArray['im_price_table']	= $ImPageContentClass ->For_HTML($res["im_prace"],$ImDataOne, array()); 
					if($ImDataOne['im_prace_old'] != $ImDataOne['im_prace_old']){
						$ModArray['im_price_table'] .= $ImPageContentClass ->For_HTML($res["im_prace_old"],$ImDataOne, array()); 
					}
			  		$ModArray['im_price_table'] = $ImPageContentClass ->For_HTML($res["im_prace_manth"],$ImDataOne, array()); 	
			  	#информация о Риэлторе	
					$ModArray['realtor'] 		= '';
					if($ImDataOne['susr_id']) {
						$SusrIDCl 				= new mysql_select($tbl_accounts);
						$RealtorData 			= $SusrIDCl -> select_table_id("WHERE id_account	= {$ImDataOne['susr_id']}");
						$ModArray['realtor'] 	= $ImPageContentClass ->For_HTML($res["realtor"], $RealtorData);
					}	
				#формирование плана	
					$PhotoPlanQueryClass = new mysql_select($tbl_im_ph);
					$ImPlanImg = $PhotoPlanQueryClass -> select_table_id("WHERE im_id = {$ImDataOne['im_id']} AND im_photo_type != '4c5a97c04ffa1'");
					$ModArray['img'] = '';
					if(!empty($ImPlanImg)) {
						$MailFileArr[]	 = "../files/images/immovables/si_{$ImPlanImg[im_photo_id]}.{$ImPlanImg[im_file_type]}";
						$ModArray['img'] = $ImPageContentClass->For_HTML($ModuleTemplate['im_foto_mail_list'], $ImPlanImg);	
					}
					
					$ReturnHtmlPage 		= $ImPageContentClass ->For_HTML($ModuleTemplate['table_one_immovable_mail_block'], $ModArray);
					print_r($MailFileArr);
					SendMailForUser($ReturnHtmlPage, $UserSubsSale[$i], $MailFileArr);
					//echo $ReturnHtmlPage;
					echo "<hr>";
			}
		}
	}	
		exit();
?>