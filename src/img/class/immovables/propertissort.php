<?php
/*
	 * Класс обработчик характеристик недвижимости
	 *  
	 *
	 * @version class.catalog.php,v 1.0 2010/07/20
	 * @author <AlexTsurkin/>
	 * @license GNU GPLv3
	 */
class PropSort {
	public $PropData; # 
	public $DictClass; #
	public $ImPropData; #
	public $ImPropArrData; #
	

	public function __construct($PropData = NULL, $ImPropData = NULL, $ImPropArrData = NULL) {
		$this->PropData = $PropData;
		$this->ImPropData = $ImPropData;
		$this->ImPropArrData = $ImPropArrData;
	}
	
	/* Функция:  формирует массив по im_id харатеристик недвижимости
	    *
	    * @param $this->ClassPropList - класс выборки характеристик каталога 	 
	    * @param $this->ClassDict - класс справочника
	    */
	public function GetArrToPrint($NameImPropId = NULL, $NameFieldTypeArrId = array()) {
		if (! $this->PropData)
			return "THE this->PropData IS EMPTY";
		for($i = 0; $i < count ( $this->PropData ); $i ++) {
			$this->ImPropArrData [$this->PropData [$i] [$NameImPropId]] [$this->PropData [$i] ['im_prop_id']] = $this->PropData [$i];
			if (is_array ( $NameFieldTypeArrId ))
				foreach ( $NameFieldTypeArrId as $key => $value ) {
					if ($this->PropData [$i] [$value] == 1) {
						$this->ImPropData [$value] [$this->PropData [$i] [$NameImPropId]] [$this->PropData [$i] ['im_prop_id']] = $this->PropData [$i];
					}
				}
		}
		return;
	}

}
?>