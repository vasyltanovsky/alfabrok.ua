<?php
/*
 * Класс обработчик характеристик недвижимости
 *  
 *
 * @version class.catalog.php,v 1.0 2010/07/26
 * @author <AlexTsurkin/>
 * @license GNU GPLv3
 */
class ImSiteForm {
	public $PostGet; #POST, GET
	public $FNameArray; #имя COOKIE поля для записи POST, GET, массивов
	public $FNameCode; #имя COOKIE поля для записи кода поля
	public $Query; #сформулированный запрос для БД
	public $Dict;
	public $PropArrData;
	protected $RegDict;
	public $StandartImQuery;
	public $IsHaveImmovablesToReturn = true;
	
	function __construct($PostGet = NULL, $FNameArray = NULL, $FNameCode = NULL, $Dict = NULL, $PropArrData = NULL, $PropArrData = NULL) {
		
		$this->PostGet = $PostGet;
		$this->FNameArray = $FNameArray;
		$this->FNameCode = $FNameCode;
		$this->Dict = $Dict;
	}
	
	/* Функция: осущиствляет проверку на валидность кода с формы поиска и записывает код, массив GET в COOKIE
    */
	public function IsSavePostGet() {
		if (isset ( $_COOKIE [$this->FNameCode] )) {
			if ($this->PostGet [$this->FNameCode] >= $_COOKIE [$this->FNameCode]) {
				$this->SavePostGet ();
			}
		} else
			$this->SavePostGet ();
		return;
	}
	
	/* Функция: записывает cookie 
    */
	private function SavePostGet() {
		setcookie ( $this->FNameArray, $this->PostGetToString ( $this->PostGet ), 0, '/' );
		setcookie ( $this->FNameCode, $this->PostGet [$this->FNameCode], 0, '/' );
		return;
	}
	
	/* Функция:
    * @param   $arr массив который надо расспарсить 
    * @param   $pre_key айди поля принадлежности
    * @return  $string массива строка 
    */
	public function PostGetToString($arr, $pre_key = NULL) {
		foreach ( $arr as $key => $val ) {
			if (is_array ( $val ))
				$string .= $this->PostGetToString ( $val, $key . '_' );
			else {
				if (! empty ( $val ))
					$string .= "&" . $pre_key . "" . $key . "=" . $val;
			}
		}
		return $string;
	}
	
	/* Функция: формирует массив со строки
    * @param   $str - строка с которой надо сформировать массив
    * @return  $return - массив
    */
	public function StringToArray($str) {
		$return = array ();
		$Arr = explode ( '&', $str );
		if (is_array ( $Arr )) {
			for($i = 0; $i < count ( $Arr ); $i ++) {
				$j = explode ( "=", $Arr [$i] );
				if (! empty ( $j [1] )) {
					$j [0] = htmlspecialchars ( urldecode ( $j [0] ) );
					$j [1] = htmlspecialchars ( urldecode ( $j [1] ) );
					if (substr ( $j [0], 0, 2 ) == "m_") {
						$pos_ = strpos ( substr ( $j [0], 2, strlen ( $j [0] ) ), '%23', true );
						$key = substr ( $j [0], 0, $pos_ + 2 );
						$key_in = substr ( $j [0], $pos_ + 5, strlen ( $j [0] ) );
						$key_in = substr ( $key_in, 0, strlen ( $key_in ) - 3 );
						$return [$key] [$key_in] = $j [1];
					} else
						if (substr($j [0], -2) === "[]")
						{
							$key = substr($j [0], 0, strlen($j [0]) - 2);
							if (empty($return [$key]))
							{
								$return [$key] = array();
							}
							$return [$key][count($return [$key])] = $j [1];
						}
						else
						{
						$return [$j [0]] = $j [1];
				}
			}
		}
		}
		return $return;
	}
	
	/* Функция:
    * @param   
    * @return  
    */
	private function SaveData() {
		
		$query = "INSERT INTO form_data
						 VALUES ('{$this->PostGet[$this->FNameCode]}',
								 '',
								 '{$this->PostGet}',
								 NOW())";
		if (! mysql_query ( $query ))
			throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT FORM DATA" );
	}
	
	/* Функция: осущиствляет очиску нужных полей COOKIE
    */
	public function Clean() {
		setcookie ( $this->FNameArray, '', 0, '/' );
		setcookie ( $this->FNameCode, '', 0, '/' );
		return;
	}
	
	private function getMergeExchangeRate($code) {
		if($code == "USD")
			return 1;
		if($code == "UAH")
			return 1/$_COOKIE['exchange_USD'];	
		if($code == "EUR")
			return ($_COOKIE['exchange_EUR']/$_COOKIE['exchange_USD']);	
		if($code == "RUB")
			return 1/($_COOKIE['exchange_USD']/$_COOKIE['exchange_RUB']);	
	}
	
	/* Функция: формирует запрос для БД
    * @param   $Arr - массив с которого надо сформировать запрос
    * @return  
    */
	public function PostGetParser($Arr) {
		$ArrIssetChar = array ();
		#териториальная принадлежность
		$TerSqlQuery = "";
		$TerArr = array ('im_region_id', 'im_a_region_id', 'im_city_id', 'im_area_id', 'im_array_id' );
		
		$PropSelectStart = "SELECT fi.im_id FROM ";
		$PropGroupBY = " GROUP BY fi.im_id";
		$ReturnQuery = "";
		
		$ImQuery = "";
		$ArrNoDo = array ('exchange_rate', 'SearchImCode', 'action', '1', 'type_cat', 'SearchIsAdvasedChecked', "page" );
		$ArrStnField = array ('susr_id', 'im_adress_id', 'im_spaceb', 'im_spacee', 'im_praceb', 'im_pracee', 'im_prace_sqb', 'im_prace_sqe', 'im_prace_manthb', 'im_prace_manthe', 'im_prace_dab', 'im_prace_dae', 'im_date_add_s', 'im_date_add_e' );
		
		if (empty ( $Arr ))
			return;
		
		$exchange_rate_val = $this->getMergeExchangeRate($Arr["exchange_rate"]);
		
		//UAH
		//<p>EUR &#8364; ≈ <span class=val><?php echo Discharge::GetDisValue(round($value*($_COOKIE['exchange_USD']/$_COOKIE['exchange_EUR'])), 4, "") </span></p>
		//<p>RUB руб. ≈ <span class=val><?php echo Discharge::GetDisValue($value*$_COOKIE['exchange_USD']*$_COOKIE['exchange_EUR'], 4, "") </span></p>
    
		foreach ( $Arr as $key => $value ) {
			//$key = substr($key, 0, strlen($key)-5);
			$Char = $this->RandomChar ( $ArrIssetChar );
			$ArrIssetChar [$Char] = $Char;
			
			if (! in_array ( $key, $ArrNoDo )) {
				if (in_array ( $key, $ArrStnField )) {
					// обработка полей характеристик
					switch ($key) {
						case 'susr_id' :
							{
								$ImQuery .= " AND i.susr_id = $value";
								break;
							}
						case 'im_prace_manthb' :
							{
								$ImQuery .= " AND i.im_prace_manth >= $value*$exchange_rate_val";
								break;
							}
						case 'im_prace_manthe' :
							{
								$ImQuery .= " AND i.im_prace_manth <= $value*$exchange_rate_val";
								break;
							}
						case 'im_prace_dayb' :
							{
								$ImQuery .= " AND i.im_prace_day >= $value*$exchange_rate_val";
								break;
							}
						case 'im_prace_daye' :
							{
								$ImQuery .= " AND i.im_prace_day <= $value*$exchange_rate_val";
								break;
							}
						case 'im_spaceb' :
							{
								$ImQuery .= " AND i.im_space >= $value*$exchange_rate_val";
								break;
							}
						case 'im_spacee' :
							{
								$ImQuery .= " AND i.im_space <= $value*$exchange_rate_val";
								break;
							}
						case 'im_praceb' :
							{
								$ImQuery .= " AND i.im_prace >= $value*$exchange_rate_val ";
								break;
							}
						case 'im_pracee' :
							{
								$ImQuery .= " AND i.im_prace <= $value*$exchange_rate_val ";
								break;
							}
						case 'im_prace_sqb' :
							{
								$ImQuery .= " AND i.im_prace_sq >= $value*$exchange_rate_val ";
								break;
							}
						case 'im_prace_sqe' :
							{
								$ImQuery .= " AND i.im_prace_sq >= $value*$exchange_rate_val ";
								break;
							}
						case 'im_date_add_s' :
							{
								list ( $day, $month, $year ) = explode ( ".", $value );
								$value = $year . "-" . $month . "-" . $day;
								$ImQuery .= " AND i.im_date_add >= '$value' ";
								break;
							}
						case 'im_date_add_e' :
							{
								list ( $day, $month, $year ) = explode ( ".", $value );
								$value = $year . "-" . $month . "-" . $day;
								$ImQuery .= " AND i.im_date_add <= '$value' ";
								break;
							}
						case 'im_adress_id' :
							{
								$ClQueryDict = new mysql_select ( 'dictionaries' );
								$DictDataSelect = $ClQueryDict->select_table_id ( "WHERE dict_name = '{$value}'" );
								if ($DictDataSelect)
									$ImQuery .= " AND i.im_adress_id = '$DictDataSelect[dict_id]' ";
								else
								{
								$DictDataSelect = $ClQueryDict->select_table_id ( "WHERE dict_name LIKE '%{$value}%'" );
								if ($DictDataSelect)
									$ImQuery .= " AND i.im_adress_id = '$DictDataSelect[dict_id]' ";
								else
									$ImQuery .= " AND i.im_date_add = '0' ";
								}
								break;
							}
						default :
							echo $ImQuery .= " AND i.$key = '$value'";
							break;
					}
				
				} else {
					$s_ = strpos ( $key, '_' );
					if ($s_ == 1) {
						// обработка полей характеристик
						$pre_key = substr ( $key, 0, $s_ ); // признак поля
						$key = substr ( $key, 2, strlen ( $key ) ); // имя поля
						if (! empty ( $value )) {
							switch ($pre_key) {
								case 's' :
									{ // select
										$ImPropS .= "'{$value}',";
										break;
									}
								case 'b' :
									{ // begunok
										$SlideValueOne = substr ( $value, 0, (strpos ( $value, '-' ) - 1) );
										$SlideValueTwo = substr ( $value, (strpos ( $value, '-' ) + 1), strlen ( $value ) );
										//проверка на изминение поля бегунка
										//if ($this->SlideValuesIsValid($key, $SlideValueOne, $SlideValueTwo)) 
										$ReturnQuery .= " join im_properties_info {$Char} ON fi.im_id = {$Char}.im_id AND {$Char}.im_prop_id  = '{$key}' AND {$Char}.im_prop_value >= {$SlideValueOne} AND {$Char}.im_prop_value <= {$SlideValueTwo} ";
										break;
									}
								case 't' :
									{ // text
										$ReturnQuery .= " join im_properties_info {$Char} ON fi.im_id = {$Char}.im_id AND {$Char}.im_prop_id  = '{$key}' AND {$Char}.im_prop_value LIKE '%" . mysql_real_escape_string ( $value ) . "%' ";
										break;
									}
								case 'm' :
									{ // select mylt
										$PostFieldValue = $value;
										foreach ( $value as $keyr => $kvalue ) {
											$Char = $this->RandomChar ( $ArrIssetChar );
											$ArrIssetChar [$Char] = $Char;
											if (! empty ( $kvalue ))
												$ReturnQuery .= " join im_properties_info {$Char} ON fi.im_id = {$Char}.im_id AND  {$Char}.im_prop_value_dict_list LIKE '%{$kvalue}%'";
										}
										break;
									}
								case 'c' :
									{ // checkbox
										$ReturnQuery .= " join im_properties_info {$Char} ON fi.im_id = {$Char}.im_id AND {$Char}.im_prop_id='{$key}' AND {$Char}.im_prop_value = '{$value}' ";
										break;
									}
								case 'l' :
									{ // checkboxlist
										$valstr = implode(",", $value);
										$subSelect = "(select max(im_prop_value) from im_properties_info p where p.im_prop_id = '4c400ed4e5797' and p.im_id=i.im_id)";
										if (in_array("4", $value))
										{
											$ImQuery .= " AND ($subSelect > 4 OR $subSelect IN ($valstr))";
										}
										else
										{
											$ImQuery .= " AND $subSelect IN ($valstr)";
										}
										break;
									}
								default :
									break;
							}
						}
					} else {
						// обработка полей териториальной принадлежности
						$s_ = strpos ( $key, '_' );
						$post_key = substr ( $key, ($s_ + 1), strlen ( $key ) ); // признак поля
						$key = substr ( $key, 0, $s_ ); // имя поля
						$this->RegDict [] = $key;
						$TerSqlQuery [$post_key] .= "'{$key}',";
					}
				}
			}
		}
		//формирование запроса по територии
		$TerSelectQuery = "";
		$TerSelectQueryStringImId = "";
		if (! empty ( $TerSqlQuery )) {
			//$TerSelectQuery = $this->TerFieldArr ( $TerArr, $TerSqlQuery );
			//$TerSelectQuery = "AND i.{$TerArr[$post_key]} IN (" . substr ( $TerSqlQuery [$post_key], 0, (strlen ( $TerSqlQuery [$post_key] ) - 1) ) . ")";
			//если нет по територии, заканчиваем поиск
			$TerSelectQuery = $this->queryResultReturn ( "AND i.{$TerArr[$post_key]} IN (" . substr ( $TerSqlQuery [$post_key], 0, (strlen ( $TerSqlQuery [$post_key] ) - 1) ) . ")" );
			if (! $TerSelectQuery)
				return " AND i.im_id IN ('0')";
			$TerSelectQueryStringImId = "";
			$TerSelectQuery = " AND i.im_id IN {$TerSelectQuery}";
		}
		
		if (! empty ( $ImPropS )) {
			$ReturnQuery .= " join im_properties_info fsa ON fi.im_id = fsa.im_id  AND fsa.im_prop_value_dict_id IN ( " . substr ( $ImPropS, 0, (strlen ( $ImPropS ) - 1) ) . ") AND fsa.lang_id={$_COOKIE[lang_id]} ";
		}
		
		$PropSelectQuery = "";
		if ($Arr ["SearchIsAdvasedChecked"]) {
			//' WHERE fi.lang_id = '.$_COOKIE[lang_id].
			//echo $PropSelectStart . " im_properties_info fi " . $ReturnQuery . " left join immovables i on fi.im_id = i.im_id " . $this->StandartImQuery . $PropGroupBY;
			$PropSelectClass = new mysql_select ( 'im_properties_info fi', $ReturnQuery . " left join immovables i on fi.im_id = i.im_id " . $this->StandartImQuery . $PropGroupBY );
			$PropSelectClass->select_table ( "im_prop_id", NULL, NULL, NULL, $PropSelectStart );
			$PropSelectArrClass = new functional ( );
			$PropSelectQuery = $PropSelectArrClass->prepare_array_to_select_mor ( $PropSelectClass->table, 'im_id' );
			
			if ($PropSelectQuery)
				$PropSelectQuery = ' AND i.im_id IN ' . $PropSelectQuery;
			else
				return " AND i.im_id IN ('0')";
		}
		
		return $PropSelectQuery . $ImQuery . $TerSelectQuery;
	}
	
	public function queryResultReturn($query) {
		$provider = new mysql_select ( "" );
		$provider->select_table_query ( sprintf ( "select i.im_id from immovables i %s %s", $this->StandartImQuery, $query ) );
		if (count ( $provider->table ) > 0)
			return functional::prepare_array_to_select_mor ( $provider->table, 'im_id' );
		else
			return FALSE;
	}
	
	public function getProtectedField($NameField) {
		if (empty ( $NameField ))
			return;
		else
			return $this->$NameField;
	}
	
	/* Функция: 
    	* @param   
    	* @return  
    	*/
	private function TerFieldArr($TerArr, $Arr) {
		foreach ( $Arr as $key => $value ) {
			if (! empty ( $TerArr [$key] ))
				$return .= "  AND i.{$TerArr[$key]} IN (" . substr ( $value, 0, (strlen ( $value ) - 1) ) . ")";
		}
		return $return;
	}
	/* Функция: формирует позиции для запроса SQl при select mylt 
    	* @param   
    	* @return  
    	*/
	private function PostField($PostFieldValue, $ArrChars) {
		return $update = "";
		for($i = 0; $i < count ( $PostFieldValue ); $i ++) {
			if (! empty ( $PostFieldValue [$i] ))
				$update .= " left outer join im_properties_info {$Char} ON fi.im_id = {$Char}.im_id AND  fm.im_prop_value_dict_list = '{$PostFieldValue[$i]}'";
			//$update .= " left outer join im_properties_info {$Char} ON fi.im_id = {$Char}.im_id AND  fm.im_prop_value_dict_list LIKE '%{$PostFieldValue[$i]}%'";
		

		}
		return $update;
	}
	/* Функция: формирует рендомную букву для запроса  БД
    	* @param  $ArrIssetChar - массив использованных букв
    	* @return $ret - буква которая возвращаеться
    	*/
	private function RandomChar($ArrIssetChar) {
		$CharArr = range ( 'a', 'z' );
		if ((count ( $ArrIssetChar ) % 26 == 0)) {
			for($i = 0; $i <= (count ( $ArrIssetChar ) / 26); $i ++)
				$ret .= $CharArr [rand ( 0, 25 )];
		} else
			$ret = $CharArr [rand ( 0, 25 )];
		if (in_array ( $ret, $ArrIssetChar ))
			return $this->RandomChar ( $ArrIssetChar );
		else
			return $ret;
	}
	
	//проверка на изминение поля бегунка
	private function SlideValuesIsValid($prop_id, $minVal, $maxVal) {
		$this->Dict->do_dictionaries ( $this->PropArrData [$prop_id] ['ld_id'] );
		$ValueLdId = $this->Dict->my_dct;
		if (empty ( $ValueLdId ))
			return;
		$minPropVal = $ValueLdId [0] [dict_name];
		$maxPropVal = $ValueLdId [count ( $ValueLdId ) - 1] [dict_name];
		$maxPropVal = str_replace ( ' ', '', $maxPropVal );
		if (($minVal == $minPropVal) && ($maxVal == $maxPropVal))
			return false;
		else
			return true;
	}
	public function SelectImId($query) {
	
	}
	public function PostGetParser_() {
	}

}

?>