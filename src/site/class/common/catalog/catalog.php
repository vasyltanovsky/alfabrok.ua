<?php
/*
 * Класс обработчик каталога сайта @version class.catalog.php,v 1.0 2010/05/28 @author <AlexTsurkin/> @license GNU GPLv3
 */
class catalogClass {
	public $Arr; // е упорядоченный массив элеменов
	public $ArrBuild; // ассив данный Arr
	public $NWords; // мя текста эл.
	public $NId; // мя Id эл.
	public $NParent; // мя родителя эл.
	public $Page; // траница
	public $ArrFormation; // творатированный древовидный массив
	public function __construct($Arr = NULL, $ArrBuild = NULL, $NWords = NULL, $NId = NULL, $NParent = NULL, $Page = NULL, $ArrFormation = NULL) {
		$this->Arr = $Arr;
		$this->ArrBuild = $ArrBuild;
		$this->NWords = $NWords;
		$this->NId = $NId;
		$this->NParent = $NParent;
		$this->Page = $Page;
		$this->ArrFormation = $ArrFormation;
	}
	
	/*
	 * Функция: функция формирует массив с массива, в вид радителей и детей @param $this->Arr - массив всех элементов справочника @param $this->NId @param $this->NParent @return $return - сформированный древовыдный массив
	 */
	public function get_arr_formation($parent = "") {
		$this->ArrFormation = array();
		for($i = 0; $i < count ( $this->Arr ); $i ++) {
			if ($this->Arr[$i][$this->NParent] == $parent) {
				$this->ArrFormation[count ( $this->ArrFormation )] = array(
						$this->Arr[$i][$this->NId],
						'NULL',
						0);
				$this->get_arr_formation_private ( $this->Arr[$i][$this->NId], 0 );
			}
		}
		
		return $this->ArrFormation;
	}
	
	/*
	 * Функция: вспомогательная функция для построения масива родитель и детей @param $searchID - искомый айди @param $in - уровень вхождения @param $this->Arr - массив всех элементов справочника @param $this->NId @param $this->NParent @return $this->ArrFormation - сформированный древовыдный массив
	 */
	public function get_arr_formation_private($searchID, $in) {
		$in ++;
		for($i = 0; $i < count ( $this->Arr ); $i ++) {
			if ($this->Arr[$i][$this->NParent] == $searchID) {
				$this->ArrFormation[count ( $this->ArrFormation )] = array(
						$this->Arr[$i][$this->NId],
						$searchID,
						$in);
				$this->get_arr_formation_private ( $this->Arr[$i][$this->NId], $in );
			}
		}
		return;
	}
	
	/*
	 * Функция: функция формирует массив с массива, в вид радителей и детей @param $this->Arr - массив всех элементов справочника @param $this->NId @param $this->NParent @return $return - сформированный древовыдный массив
	 */
	public function get_arr_formation_in($parent = "") {
		$this->ArrFormation = array();
		for($i = 0; $i < count ( $this->Arr ); $i ++) {
			if ($this->Arr[$i][$this->NParent] == $parent) {
				$this->ArrFormation[count ( $this->ArrFormation )] = array(
						$this->Arr[$i][$this->NId],
						'NULL',
						0);
				$this->get_arr_formation_private_in ( $this->Arr[$i][$this->NId], 0, count ( $this->ArrFormation ) - 1 );
			}
		}
		
		return $this->ArrFormation;
	}
	
	/*
	 * Функция: вспомогательная функция для построения масива родитель и детей @param $searchID - искомый айди @param $in - уровень вхождения @param $this->Arr - массив всех элементов справочника @param $this->NId @param $this->NParent @return $this->ArrFormation - сформированный древовыдный массив
	 */
	public function get_arr_formation_private_in($searchID, $in, $j) {
		$in ++;
		for($i = 0; $i < count ( $this->Arr ); $i ++) {
			if ($this->Arr[$i][$this->NParent] == $searchID) {
				$this->ArrFormation[$j]['inner'][count ( $this->ArrFormation[$j]['inner'] )] = array(
						$this->Arr[$i][$this->NId],
						$searchID,
						$in);
				$this->get_arr_formation_private_in ( $this->Arr[$i][$this->NId], $in, count ( $this->ArrFormation ) - 1 );
			}
		}
		return;
	}
	
	/*
	 * Функция: формирует развернутое древовидное меню @param $this->ArrFormation - сформировованный древовидный массив @param $this->ArrBuild - массив элементов стравичников @param $this->Page - @param $this->NWords - @return $return - сформированный древовыдный массив
	 */
	public function get_tree_menu() {
		if (empty ( $this->ArrFormation ))
			return "EMPTY ArrFormation";
		if (empty ( $this->ArrBuild ))
			return "EMPTY ArrBuild";
		
		for($i = 0; $i < count ( $this->ArrFormation ); $i ++) {
			$Css = "class=\"CatalogMenu{$this->ArrFormation[$i][2]}\"";
			$ret .= "<a id=\"{$this->ArrFormation[$i][0]}\" {$Css} href=\"{$this->Page}/{$this->ArrFormation[$i][0]}.html\">{$this->ArrBuild[$this->ArrFormation[$i][0]][$this->NWords]}</a>";
		}
		return $ret;
	}
	
	/*
	 * Функция: формирует развернутое древовидное меню JQUERY @param $this->ArrFormation - сформировованный древовидный массив @param $this->ArrBuild - массив элементов стравичников @param $SearchId - искомый эл. @return $return - сформированный древовыдный массив
	 */
	public function get_tree_view_menu($SId = NULL, $Lvl = 0, $isDmn = false) {
		$CloseUl = FALSE;
		
		for($i = 0; $i < count ( $this->ArrFormation ); $i ++) {
			if ($isDmn)
				$href = "href=\"http://{$_SERVER['HTTP_HOST']}{$this->Page}/{$this->ArrFormation[$i][0]}.html\"";
			else
				$href = "href=\"?dict_id={$this->ArrFormation[$i][0]}\"";
				// обхо эл. уровня 0
			if ($SId == NULL and $this->ArrFormation[$i][2] == 0) {
				$ret .= "<li>";
				$ret .= "<a {$href} title=\"{$this->ArrBuild[$this->ArrFormation[$i][0]][$this->NWords]}\">{$this->ArrBuild[$this->ArrFormation[$i][0]][$this->NWords]}</a>";
				$ret .= $this->get_tree_view_menu ( $this->ArrFormation[$i][0], $this->ArrFormation[$i][2], $isDmn );
				$ret .= "</li>";
			}
			// если эл. вхлждения и нужного уровня
			if (($SId == $this->ArrFormation[$i][1]) and (($Lvl + 1) == $this->ArrFormation[$i][2])) {
				// если не открыт тег ul
				if (! $CloseUl) {
					$ret .= "<ul>";
					$CloseUl = TRUE;
				}
				// запись эл. и поиск остальных которые входят
				$ret .= "<li>";
				$ret .= "<a {$href} title=\"{$this->ArrBuild[$this->ArrFormation[$i][0]][$this->NWords]}\">{$this->ArrBuild[$this->ArrFormation[$i][0]][$this->NWords]}</a>";
				$ret .= $this->get_tree_view_menu ( $this->ArrFormation[$i][0], $this->ArrFormation[$i][2], $isDmn );
				$ret .= "</li>";
			}
			// закрываем тег ul
			if (($SId != $this->ArrFormation[$i][1]) and ($CloseUl)) {
				$ret .= "</ul>";
				$CloseUl = FALSE;
			}
		}
		
		return $ret;
	}
	
	/*
	 * Функция: строка навигации @param $NGet - имя массива $_GET для ориентирования @param $this->NWords @param $this->Page @param $this->NId @param $PosItem если уже выбран (позиция) элемент с каталога @return $ret - строка
	 */
	public function get_string_navigation($NGet, $PosItem = NULL, $IsLastLink = false) {
		$arr = $this->get_child_parent ( $NGet );
		if (empty ( $arr ))
			return;
		
		for($i = count ( $arr ) - 1; $i >= 0; $i --) {
			if ($i == 0) {
				if ($PosItem) {
					$ret .= "<a id=\"{$arr[$i][$this->NId]}\" href=\"{$this->Page}/{$arr[$i][$this->NId]}.html\" title=\"{$arr[$i][$this->NWords]}\">{$arr[$i][$this->NWords]}</a>";
				} else {
					if (! $IsLastLink)
						$ret .= $arr[$i][$this->NWords];
					else
						$ret .= "<a id=\"{$arr[$i][$this->NId]}\" href=\"{$this->Page}/{$arr[$i][$this->NId]}.html\" title=\"{$arr[$i][$this->NWords]}\">{$arr[$i][$this->NWords]}</a>";
				}
			} else
				$ret .= "<a id=\"{$arr[$i][$this->NId]}\" href=\"{$this->Page}/{$arr[$i][$this->NId]}.html\" title=\"{$arr[$i][$this->NWords]}\">{$arr[$i][$this->NWords]}</a><img src=\"/files/images/bg/NavLinkANext.png\" width=\"9\" height=\"11\" />";
		}
		
		$ret = "<div class=\"DivPrCatNav\">" . $ret . "</div>";
		return $ret;
	}
	
	/*
	 * Функция: строка заголовкой, ключевых слов, и т.д. @param $NGet - имя массива $_GET для ориентирования @param $NMeta - имя поля с массива єлементов @return $ret - строка
	 */
	public function get_meta($NGet, $NMeta) {
		$ret = null;
		if (empty ( $_GET[$NGet] ))
			return;
		$arr = $this->get_child_parent ( $NGet );
		if (empty ( $arr ))
			$arr[0] = $this->ArrBuild[$_GET[$NGet]];
		for($i = 0; $i < count ( $arr ); $i ++) {
			$ret .= $arr[$i][$NMeta] . ",";
		}
		return $ret;
	}
	
	/*
	 * Функция: строка заголовок @param $NGet - имя массива $_GET для ориентирования @return $ret - строка
	 */
	public function get_title($NGet) {
		if (empty ( $_GET[$NGet] ))
			return;
		return $this->ArrBuild[$_GET[$NGet]][$this->NWords];
	}
	
	/*
	 * Функция: обрабатывает от активного пункта до первого родителя @param $NGet - имя массива $_GET для ориентирования @param $this->ArrBuild @return $ret_arr - полученный массив
	 */
	public function get_child_parent($NGet) {
		if (empty ( $_GET[$NGet] ))
			return;
		$active_id = $_GET[$NGet];
		$ret_arr = array();
		while ( $this->ArrBuild[$active_id][$this->NParent] ) {
			$ret_arr[count ( $ret_arr )] = $this->ArrBuild[$active_id];
			$active_id = $this->ArrBuild[$active_id][$this->NParent];
		}
		// if(count($ret_arr) > 0)
		$ret_arr[count ( $ret_arr )] = $this->ArrBuild[$active_id];
		return $ret_arr;
	}
	public function getParentFirstLevel($id, $Nid, $Nparent) {
		$activeId = $this->ArrBuild[$id];
		while ( $activeId[$Nparent] ) {
			$activeId = $this->ArrBuild[$activeId[$Nparent]];
			echo $activeId[$Nparent];
		}
		return $activeId;
	}
	
	/*
	 * Функция: формирует строку для запроса с БД @param $NGet - имя поля $_GET @return строка
	 */
	public function get_select($NGet) {
		if (empty ( $_GET[$NGet] ))
			return;
		$ret_str = $this->get_next_id ( $_GET[$NGet] );
		return substr ( $ret_str, 0, (strlen ( $ret_str ) - 1) );
	}
	
	/*
	 * Функция: поиска элементов которые входят @param $SearchID - искомый эл. @return $ret - строка
	 */
	private function get_next_id($SearchID) {
		$ret_str .= "'" . $SearchID . "',";
		for($i = 0; $i < count ( $this->ArrFormation ); $i ++) {
			if ($this->ArrFormation[$i][1] == $SearchID)
				$ret_str .= $this->get_next_id ( $this->ArrFormation[$i][0] );
		}
		return $ret_str;
	}
}
?>