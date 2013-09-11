<?php
/*
	 * Класс обработчик вывода характеристик недвижимости
	 *  
	 *
	 * @version class.catalog.php,v 1.0 2010/07/20
	 * @author <AlexTsurkin/>
	 * @license GNU GPLv3
	 */
class PropPrint {
	public $DictClass;
	
	public function __construct($DictClass = NULL) {
		$this->DictClass = $DictClass;
	}
	
	public function GetPrintImg($PropArrData) {
		if (empty ( $PropArrData ))
			return;
		foreach ( $PropArrData as $key => $value ) {
			$return .= $this->GetStyleId ( $value, 'GetImage' );
		}
		return $return;
	}
	
	public function GetPrint($PropArrData, $TypeAdction) {
		$j = 1;
		if (empty ( $PropArrData ))
			return;
		foreach ( $PropArrData as $key => $value ) {
			if ($TypeAdction == 'GetPropTextImgTr') {
				if ($j % 2 != 0)
					$return .= "<tr>";
				$return .= $this->GetStyleId ( $value, $TypeAdction );
				if ($j % 2 == 0)
					$return .= "</tr>";
				$j ++;
			} else
				$return .= $this->GetStyleId ( $value, $TypeAdction );
		}
		return $return;
	}
	
	private function GetStyleId($PropData, $Action) {
		switch ($PropData ['im_prop_style_id']) {
			#Выпадающий список
			case '4c3ec1f67fe1b' :
				{
					if (empty ( $PropData ['im_prop_value_dict_id'] ))
						return;
					if ($Action == 'GetImage') {
						if ($this->IsHaveDictImg ( $PropData ['im_prop_value_dict_id'] ))
							$return = $this->GetDictImage ( $PropData );
					}
					if ($Action == 'GetPropTextImgTr') {
						if ($this->IsHavePropImg ( $PropData ))
							$PropImg = $this->GetPropImage ( $PropData );
						if (empty ( $PropImg ) and $this->IsHaveDictImg ( $PropData ['im_prop_value_dict_id'] ))
							$PropImg = $this->GetDictImage ( $PropData );
						$return = "<td class=\"TablePropAdvasedTdImg\">{$PropImg}</td><td class=\"TablePropAdvasedTdText\">{$PropData[im_prop_name]} - {$this->GetDictName($PropData[im_prop_value_dict_id])}</td>";
					}
					if ($Action == 'GetPropTextTr') {
						$return = "<tr><td>{$PropData[im_prop_name]}</td><td>{$this->GetDictName($PropData[im_prop_value_dict_id])}</td></tr>";
					}
					if ($Action == 'GetTextWord') {
						$return = "{$PropData[im_prop_name]} - {$this->GetDictName($PropData[im_prop_value_dict_id])}<br>";
					}
					break;
				}
			#Флаг
			case '4c3ec1f67fe11' :
				{
					if ($Action == 'GetImage') {
						if ($this->IsHavePropImg ( $PropData ))
							$return = $this->GetPropImage ( $PropData );
					}
					if ($Action == 'GetPropTextImgTr') {
						if ($this->IsHavePropImg ( $PropData ))
							$PropImg = $this->GetPropImage ( $PropData );
						if ($PropData ['im_prop_value'] == 'on')
							$PropValue = " - " . $PropData ['im_prop_value'];
						$return = "<td class=\"TablePropAdvasedTdImg\">{$PropImg}</td><td class=\"TablePropAdvasedTdText\">{$PropData[im_prop_name]}</td>";
					}
					if ($Action == 'GetPropTextTr') {
						$return = "<tr><td>{$PropData[im_prop_name]}</td><td></td></tr>";
					}
					if ($Action == 'GetTextWord') {
						$return = "{$PropData[im_prop_name]} - есть<br>";
					}
					break;
				}
			#Радио-кнопки
			case '4c3ec1f67fe12' :
				{
					break;
				}
			#Бегунок
			case '4c3ec331811b8' :
			case '4c3ec331811b6' :
				{
					if ($Action == 'GetImage') {
						if ($this->IsHavePropImg ( $PropData ))
							$return = $this->GetPropImage ( $PropData );
					}
					if ($Action == 'GetPropTextImgTr') {
						if ($this->IsHavePropImg ( $PropData ))
							$PropImg = $this->GetPropImage ( $PropData );
						if (! empty ( $PropData ['im_prop_value'] ))
							$PropValue = " - " . $PropData ['im_prop_value'];
						$return = "<td class=\"TablePropAdvasedTdImg\">{$PropImg}</td><td class=\"TablePropAdvasedTdText\">{$PropData[im_prop_name]} {$PropValue}</td>";
					}
					if ($Action == 'GetPropTextTr') {
						$return = "<tr class=\"TrBgColor\"><td>{$PropData[im_prop_name]}</td><td>{$PropData['im_prop_value']}</td></tr>";
					}
					if ($Action == 'GetTextWord') {
						$return = "{$PropData[im_prop_name]} - {$PropData['im_prop_value']}<br>";
					}
					break;
				}
			#Выпадающий блок
			case '4c3ec331811b7' :
				{
					if (empty ( $PropData ['im_prop_value_dict_list'] ))
						return;
					if ($Action == 'GetImage') {
						$return = $this->StringToArray ( $PropData, $Action );
					}
					if ($Action == 'GetPropTextImgTr') {
						if ($this->IsHavePropImg ( $PropData ))
							$PropImg = $this->GetPropImage ( $PropData );
						if (empty ( $PropImg ))
							$PropImg = $this->StringToArray ( $PropData, 'GetOneImage' );
						$PropValue = $this->StringToArray ( $PropData, 'GetText' );
						$return = "<td class=\"TablePropAdvasedTdImg\">{$PropImg}</td><td class=\"TablePropAdvasedTdText\">{$PropData[im_prop_name]} - {$PropValue}</td>";
					}
					if ($Action == 'GetPropTextTr') {
						$PropValue = $this->StringToArray ( $PropData, 'GetText' );
						$return = "<tr><td>{$PropData[im_prop_name]}</td><td>{$PropValue}</td></tr>";
					}
					if ($Action == 'GetTextWord') {
						$PropValue = $this->StringToArray ( $PropData, 'GetText' );
						$return = "{$PropData[im_prop_name]} - {$PropValue}<br>";
					}
					break;
				}
			#Поле ввода
			case '4c3ec3ad35af9' :
				{
					if ($Action == 'GetImage') {
						if ($this->IsHavePropImg ( $PropData ))
							$return = $this->GetPropImage ( $PropData );
					}
					if ($Action == 'GetPropTextImgTr') {
						if ($this->IsHavePropImg ( $PropData ))
							$PropImg = $this->GetPropImage ( $PropData );
						if (! empty ( $PropData ['im_prop_value'] ))
							$PropValue = " - " . $PropData ['im_prop_value'];
						$return = "<td class=\"TablePropAdvasedTdImg\">{$PropImg}</td><td class=\"TablePropAdvasedTdText\">{$PropData[im_prop_name]} - {$PropValue}</td>";
					}
					if ($Action == 'GetPropTextTr') {
						$return = "<tr class=\"TrBgColor\"><td>{$PropData[im_prop_name]}</td><td>{$PropData['im_prop_value']}</td></tr>";
					}
					if ($Action == 'GetTextWord') {
						$return = "{$PropData[im_prop_name]} - {$PropData['im_prop_value']}<br>";
					}
					break;
				}
			default :
				die ( "NO VALUE STYLE FIELD STYLE" );
				break;
		}
		return $return;
	}
	
	private function StringToArray($PropData, $Action) {
		$arr = explode ( " ", $PropData ['im_prop_value_dict_list'] );
		$str = NULL;
		for($i = 0; $i < count ( $arr ); $i ++) {
			if ($Action == 'GetImage')
				if ($this->IsHaveDictImg ( $arr [$i] ))
					$str .= $this->GetDictImageForList ( $arr [$i], $PropData );
			if ($Action == 'GetText')
				$str .= $this->GetDictName ( $arr [$i] ) . ", ";
			if ($Action == 'GetOneImage') {
				if ($this->IsHaveDictImg ( $arr [$i] ))
					$str = $this->GetDictImageForList ( $arr [$i], $PropData );
				if ($str)
					return $str;
			}
		}
		if ($Action == 'GetText')
			$str = substr ( $str, 0, (strlen ( $str ) - 2) );
		return $str;
	}
	
	private function GetDictImage($PropData) {
		$AltTitle = $PropData ['im_prop_name'] . ' - ' . $this->DictClass->buld_table [$PropData ['im_prop_value_dict_id']] ['dict_name'];
		return $this->GetImg ( array ('folder' => 'dict', 'id' => $PropData ['im_prop_value_dict_id'], 'alt' => $AltTitle, 'title' => $AltTitle ) );
	}
	
	private function GetDictImageForList($DictId, $PropData) {
		$AltTitle = $PropData ['im_prop_name'] . ' - ' . $this->DictClass->buld_table [$DictId] ['dict_name'];
		return $this->GetImg ( array ('folder' => 'dict', 'id' => $DictId, 'alt' => $AltTitle, 'title' => $AltTitle ) );
	}
	
	private function GetPropImage($PropData) {
		$AltTitle = $PropData ['im_prop_name'];
		return $this->GetImg ( array ('folder' => 'prop', 'id' => $PropData ['im_prop_id'], 'alt' => $AltTitle, 'title' => $AltTitle ) );
	}
	
	private function IsHaveDictImg($DictId) {
		if ($this->DictClass->buld_table [$DictId] ['dict_have_image'])
			return true;
		else
			return false;
	}
	
	private function IsHavePropImg($PropData) {
		if ($PropData ['prop_have_image'])
			return true;
		else
			return false;
	}
	
	private function GetImg($Data) {
		$html = "<img src=\"". getLangString("imageDomain") ."/files/images/#folder#/#id#.png\" alt=\"#alt#\" title=\"#title#\"/>";
		foreach ( $Data as $key => $value ) {
			$html = str_replace ( "#" . $key . "#", $value, $html );
		}
		return $html;
	}
	
	private function GetPropName($Data, $PropId) {
		return;
	}
	
	private function GetDictName($DictId) {
		return $this->DictClass->buld_table [$DictId] ['dict_name'];
	}

}