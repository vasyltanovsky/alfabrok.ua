<?php
#	класс формирует нужные настройки модуля, соглавно справочнику
#
#
#


class part_module extends dictionaries {
	
	public $tbl_list_dictionaries; #для подключения к БД название таблицы списка справочника
	public $tbl_dictionaries; #для подключения к БД название таблицы каталога справочника
	public $lang_id; #айди языка
	public $ParamOfPage; #параметры страницы, заголовки, строка навигации
	public $ValueDictData; #выбранные значения списка справочника
	public $ActiveDictListValue; #активный пункт значения списка справочника
	

	public function __construct($tbl_list_dictionaries, $tbl_dictionaries, $lang_id, $ParamOfPage = array(), $ValueDictData = NULL, $ActiveDictListValue = NULL) {
		$this->tbl_list_dictionaries = $tbl_list_dictionaries;
		$this->tbl_dictionaries = $tbl_dictionaries;
		$this->lang_id = $lang_id;
		$this->ParamOfPage = $ParamOfPage;
		$this->ValueDictData = $ValueDictData;
		$this->ActiveDictListValue = $ActiveDictListValue;
		
		#формируем массив имени словарей
		$this->buid_dictionaries_list ( $tbl_list_dictionaries );
		#формируем массив значений словарей
		$this->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = {$_COOKIE['lang_id']}" );
	}
	
	#	задаем айди справочника для формирование значений
	public function task_dict_Id($DictId) {
		#	задаем айди значение 
		$this->do_dictionaries ( $DictId );
		#	my_list_dct - сам словарь
		$cartype_lst = $this->my_list_dct;
		#	перечень значение словаря 
		$new_dct_arr = $this->my_dct;
		#	родитель, ребенок формирование массива
		$this->ValueDictData = $this->BuildArrayParentChild ( $new_dct_arr );
		
		return;
	}
	
	#формирует заголовки страницы и т.д. согласно меню справочника, $IsDoListDefault - задаем формировать ли контект по дефолтовому заходу на страницу
	public function value_of_the_active_item($Dict_id, $IsDoListDefault = false) {
		#запуск функции task_dict_Id - задаем айди справочника для формирование значений, получаем значения нужного справочника
		$this->task_dict_Id ( $Dict_id );
		#формируем меню	
		$this->dict_sub_menu ();
		#присваиваем активный пункт справочника 	
		$this->ActiveDictListValue = $_GET ['dict'];
		
		if (empty ( $this->ActiveDictListValue )) {
			$this->ActiveDictListValue = $this->ValueDictData [0] [0]; #если не выбран справочник присваиваем первый	
			#если выбрано по дуфолту формировать контент позучаем строку запроса
			if ($IsDoListDefault)
				return $this->select_requery ();
			else
				return;
		}
		#если существует активный пункт получаем строку для запроса	
		return $this->select_requery ();
	}
	
	#формирование запроса для селекта
	function select_requery() {
		#перебераем массив для формирование запроса
		for($i = 0; $i < count ( $this->ValueDictData ); $i ++) {
			#если активный пункт являеться подителем подпукта то добавляем его для селекта
			if ($this->ActiveDictListValue == $this->ValueDictData [$i] [1])
				$StringToRequery .= "'{$this->ValueDictData[$i][0]}',";
		}
		$StringToRequery .= "'{$this->ActiveDictListValue}'";
		
		if ($StringToRequery != '')
			return $StringToRequery;
		else
			return;
	}
	
	public function return_content_page($PageInfo, $ContentText = NULL) {
		#формируем древовидный разбок ативной ветки каталога справочника
		$CatalogDictTree = $this->catalog_dict_tree ( $this->ActiveDictListValue );
		#формируем строку для навмгации
		$this->string_navigation ( $PageInfo, $CatalogDictTree, $ContentText );
		#формируем ключевые слова и т.д.
		$this->words_page ( $PageInfo, $CatalogDictTree, $ContentText );
		
		return;
	}
	
	#формирование строки навигации	
	public function string_navigation($PageInfo, $CatalogDictTree, $ContentText = NULL) {
		$PageLink = substr ( $_SERVER ['PHP_SELF'], 0, strlen ( $_SERVER ['PHP_SELF'] ) - 4 ); #
		$this->ParamOfPage ['navigation'] = "<a href=\"{$PageLink}.html\">{$PageInfo['menu_words']}</a>"; #
		

		#
		if ($ContentText) {
			$this->ParamOfPage ['navigation'] .= $this->catalog_dict_string ( $CatalogDictTree, 'link', 'left', $PageLink, false );
			$this->ParamOfPage ['navigation'] .= " &raquo; " . $ContentText;
		} else
			$this->ParamOfPage ['navigation'] .= $this->catalog_dict_string ( $CatalogDictTree, 'link', 'left', $PageLink );
		
		return;
	}
	
	#формирование заголовков страницы, ключевых слов, описание	
	public function words_page($PageInfo, $CatalogDictTree, $ContentText = NULL) {
		#
		if ($ContentText)
			$this->ParamOfPage ['TitlePage'] = $ContentText;
		else
			$this->ParamOfPage ['TitlePage'] = $this->buld_table [$this->ActiveDictListValue] ['dict_name'];
			
		#	Веб заголовок страницы
		if ($ContentText)
			$this->ParamOfPage ['WebTitle'] .= $ContentText . ". ";
		$this->ParamOfPage ['WebTitle'] .= $this->catalog_dict_string ( $CatalogDictTree, 'text', 'right' );
		$this->ParamOfPage ['WebTitle'] .= $PageInfo ['title_web'];
		
		#	Веб ключевые слова страницы
		if ($ContentText)
			$this->ParamOfPage ['keywords'] .= $ContentText . ". ";
		$this->ParamOfPage ['keywords'] .= $this->catalog_dict_string ( $CatalogDictTree, 'text', 'right' );
		$this->ParamOfPage ['keywords'] .= $PageInfo ['keywords_web'];
		
		#	Веб краткое описание страницы
		if ($ContentText)
			$this->ParamOfPage ['WebDiscription'] .= $ContentText . ". ";
		$this->ParamOfPage ['WebDiscription'] .= $this->catalog_dict_string ( $CatalogDictTree, 'text', 'right' );
		$this->ParamOfPage ['WebDiscription'] .= $PageInfo ['description_web'];
		
		return;
	}
	
	#формируем древовидный разбок ативной ветки каталога справочника
	private function catalog_dict_tree($SearchId, $ReturnArrId = NULL) {
		for($i = 0; $i < count ( $this->ValueDictData ); $i ++) {
			if ($this->ValueDictData [$i] [0] == $SearchId) {
				$ReturnArrId [count ( $ReturnArrId )] = $this->ValueDictData [$i];
				if (! empty ( $this->ValueDictData [$i] [1] ))
					return $this->catalog_dict_tree ( $this->ValueDictData [$i] [1], $ReturnArrId );
			}
		}
		return $ReturnArrId;
	}
	
	#	
	private function catalog_dict_string($Data, $String, $float, $PageLink = NULL, $IsLast = true) {
		
		if ($float == 'right')
			for($i = 0; $i < count ( $Data ); $i ++) {
				if ($String == 'link')
					$Return .= " &raquo;<a href=\"{$PageLink}/{$Data[$i][0]}.html\">" . $this->buld_table [$Data [$i] [0]] ['dict_name'] . "</a>";
				else
					$Return .= $this->buld_table [$Data [$i] [0]] ['dict_name'] . ". ";
			}
		
		if ($float == 'left')
			for($i = count ( $Data ) - 1; $i >= 0; $i --) {
				if ($String == 'link') {
					if ($IsLast)
						if ($i == 0)
							$Return .= " &raquo; " . $this->buld_table [$Data [$i] [0]] ['dict_name'];
						else
							$Return .= " &raquo; <a href=\"{$PageLink}/{$Data[$i][0]}.html\">" . $this->buld_table [$Data [$i] [0]] ['dict_name'] . "</a>";
					else
						$Return .= " &raquo; <a href=\"{$PageLink}/{$Data[$i][0]}.html\">" . $this->buld_table [$Data [$i] [0]] ['dict_name'] . "</a>";
				
				} else
					$Return .= $this->buld_table [$Data [$i] [0]] ['dict_name'] . ". ";
			}
		
		return $Return;
	}
	
	#	функция формирует суб вспомогательное меню из справочников
	public function dict_sub_menu() {
		$arr = $this->ValueDictData;
		for($i = 0; $i < count ( $arr ); $i ++) {
			$classLink = "SubMenuLink";
			if ($arr [$i] [1] == 'NULL')
				$classLink = "SubMenuLinkFather";
			if ($arr [$i] [0] == $_GET ['dict'])
				$classLink .= ' ActiveLink';
			$ret .= "<a class=\"{$classLink}\" title = \"{$this->buld_table[$arr[$i][0]]['dict_name']}\" href='/press/{$arr[$i][0]}.html'>";
			$ret .= $this->buld_table [$arr [$i] [0]] ['dict_name'];
			$ret .= "</a>";
		}
		
		$this->ParamOfPage ['MenuDict'] = $ret;
		return;
	}
}

?>