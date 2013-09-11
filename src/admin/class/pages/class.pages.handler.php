<?php
//error_reporting(E_ALL & ~E_NOTICE);
//error_reporting(E_NOTICE);
// Если константа DEBUG определена, работает отладочный вариант, 
//в частности выводится подробные сообщения об исключительных ситуациях, связанных с MySQL и ООП
//define("DEBUG", 0);
class pages {
	#файл php
	public $get_page;
	#масcив $_GET
	public $get_array;
	#имя таблици для селекта
	public $name_table_select;
	#запрос таблици для селекта
	public $where_table_select;
	#сортировка таблици для селекта
	public $order_table_select;
	#активная страница
	public $active_page;
	#таблица селекта
	public $table;
	#таблица селекта гда на месле $i стоит page_id
	public $buld_table;
	#url для перехода в активном каталоге далее без использования меню 
	public $url_link_value;
	
	public $subtable;
	// Конструктор класса
	public function __construct($get_page, $get_array, $name_table_select, $where_table_select, $order_table_select, $active_page = NULL, $table = array(), $buld_table = array(), $submenu = array(), $url_link_value = NULL) {
		$this->get_page = $get_page;
		$this->get_array = $get_array;
		$this->name_table_select = $name_table_select;
		$this->where_table_select = $where_table_select;
		$this->order_table_select = $order_table_select;
		$this->active_page = $active_page;
		$this->table = $table;
		$this->buld_table = $buld_table;
		$this->submenu = $submenu;
		$this->url_link_value = $url_link_value;
	}
	#### селект таблицы
	public function select_table() {
		$query = "SELECT * FROM {$this->name_table_select}
					    		{$this->where_table_select}
								{$this->order_table_select}";
		$tbl = mysql_query ( $query );
		if (! $tbl)
			throw new ExceptionMySQL ( mysql_error (), $query, "Ошибка извлечений позиций" );
		$i = 0;
		if (mysql_num_rows ( $tbl ))
			while ( $t_pages [] = mysql_fetch_array ( $tbl ) ) {
				$this->buld_table [$t_pages [$i] [page_id]] = $t_pages [$i];
				$i ++;
			}
		unset ( $t_pages [count ( $t_pages ) - 1] );
		unset ( $this->buld_table [count ( $this->buld_table ) - 1] );
		return $this->table = $t_pages;
	}
	
	#### постраение главного меню  
	public function return_menu() {
		if (! $this->get_page)
			$this->get_page = 'index.php';
		$j = 0;
		for($i = 0; $i < count ( $this->table ); $i ++) {
			if (($this->table [$i] ['menu_show'] == 'show') and (empty ( $this->table [$i] ['parent_id'] ))) {
				$return [$j] = array ($this->table [$i] ['name_page'], $this->table [$i] ['page_id'], $this->table [$i] ['menu_words'], $this->table [$i] ['menu_link'], $this->table [$i] ['dict_id'] );
				$this->menu_sub ( $this->table [$i] ['name_page'], $j, $this->table [$i] ['page_id'] );
				$j ++;
			}
		}
		
		$this->update_get_array ();
		###
		###
		$this->array_navigation ();
		###
		###
		$this->active_page_value ();
		return $return;
	}
	
	#### постраение главного subменю 
	private function menu_sub($page_link, $j, $page_id) {
		$k = 0;
		for($i = 0; $i < count ( $this->table ); $i ++) {
			if ($this->table [$i] ['parent_id'] == $page_id) {
				$this->submenu [$j] [$k] = array ($page_link, $this->table [$i] ['page_id'], $this->table [$i] ['menu_words'] );
				$k ++;
			}
		}
		return $this->submenu;
	}
	
	//массив для навигации
	public function array_navigation() {
		for($i = 0; $i < count ( $this->table ); $i ++) {
			if ("/" . $this->table [$i] [name_page] == $this->get_page)
				return $this->get_array [0] = $this->table [$i] [page_id];
		}
	}
	
	#активная страница
	public function active_page_value() {
		if (isset ( $this->get_array [code] ))
			$last_id = $this->get_array [count ( $this->get_array ) - 2];
		else
			$last_id = $this->get_array [count ( $this->get_array ) - 1];
		
		if (in_array ( $this->buld_table [$last_id] ['page_id'], $this->get_array ))
			$this->active_page = $this->buld_table [$last_id];
			
		#проверка на существования страницы, от дураков если ее нет по загружаем первую страницу данного каталога
		if (! $this->active_page)
			$this->active_page = $this->buld_table [$this->get_array [0]];
		return;
	}
	
	#массив навигации
	public function navigation_array() {
		for($i = 0; $i < count ( $this->get_array ); $i ++) {
			$return [$i] = array ($this->buld_table [$this->get_array [$i]] [page_id], $this->buld_table [$this->get_array [$i]] [menu_words] );
		}
		return $return;
	}
	
	#строка навигации с учетом htaccess
	public function navigation_string_htaccess() {
		foreach ( $this->get_array as $key => $value ) {
			if (is_int ( $key ))
				$get_arr [$key] = $value;
			else
				$is_get_code = TRUE;
		}
		
		//asort($get_arr);
		//print_r($get_arr);
		for($i = 0; $i < count ( $get_arr ); $i ++) {
			$value = array ($this->buld_table [$get_arr [$i]] [page_id], $this->buld_table [$get_arr [$i]] [name_page], $this->buld_table [$get_arr [$i]] [menu_words] );
			
			$value [1] = substr ( $value [1], 0, strlen ( $value [1] ) - 4 );
			if (empty ( $value [1] ))
				$value [1] = $this->buld_table [$get_arr [$i]] [page_id];
			$link_radio = '';
			$link_f .= "/" . $value [1];
			if ($i == 0) {
				$link = "/" . $value [1] . ".html";
				$link_f = "/" . $value [1];
				$return .= "<a href =\"{$link}\">{$value[2]}</a> " . $link_radio;
			} else {
				if ($i == (count ( $get_arr ) - 1)) {
					$link .= "/" . $value [1] . ".html";
					$return .= "&raquo; " . $value [2];
					return $return;
				} else {
					$link .= "/" . $value [1] . "html";
					$return .= "&raquo; <a href =\"{$link_f}.html\">{$value[2]}</a> " . $link_radio;
				}
			}
		}
		
		return $return;
	}
	
	#строка навигации
	public function navigation_string() {
		foreach ( $this->get_array as $key => $value ) {
			if (is_int ( $key ))
				$get_arr [$key] = $value;
			else
				$is_get_code = TRUE;
		}
		
		for($i = 0; $i < count ( $get_arr ); $i ++) {
			
			$value = array ($this->buld_table [$get_arr [$i]] [page_id], $this->buld_table [$get_arr [$i]] [name_page], $this->buld_table [$get_arr [$i]] [menu_words] );
			
			if ($i == 0)
				$link = $value [1] . "?";
			else
				$link .= $i . "=" . $value [0] . "&";
			
			if ($is_get_code)
				$return .= "<a href =\"{$link}\">{$value[2]}</a> &raquo; ";
			else {
				if ($i == (count ( $get_arr ) - 1))
					$return .= "{$value[2]}";
				else
					$return .= "<a href =\"{$link}\">{$value[2]}</a> &raquo; ";
			}
		}
		$this->url_link_value = $link . "" . count ( $get_arr ) . "=";
		return $return;
	}
	
	# изменение ГЕТ при использывание пейджинга
	public function update_get_array($is_lot = FALSE) {
		#	массив ингорируемых слов при обработки
		$arr_updater = array ("page", "excel", "amount", "firstpay", "period", "lot", "auto_type", "currency", "body", "price_from", "price_to", "capacity", "unique", "brand", "real", "wheel", "special", "engine", "bets", "engine_capacity", "leased", "class", "gearbox", "status", "dict", "type_cat" );
		$get_arr = array ();
		foreach ( $this->get_array as $key => $value ) {
			if (is_int ( $key ))
				$get_arr [$key] = $value;
			else #флаг включение подробного отсеивания
if ($is_lot)
				# если ключ не попадает в массив ингорируеммых слов то мы записываем его в тот массив который надо сформировать
				if (! in_array ( $key, $arr_updater ))
					$get_arr [$key] = $value;
				else if ($key != 'page' and $key != 'page_id' and $key != 'excel' and $key != 'amount' and $key != 'firstpay' and $key != 'period')
					$get_arr [$key] = $value;
		}
		$this->get_array = array ();
		return $this->get_array = $get_arr;
	}
	
	#### получение нужного поля активного пункта каталога, при постраение меню
	public function active_page_item($name_item, $show = NULL) {
		if ($show) {
			$name_item_show = $name_item . "_show";
			if ($this->active_page [$name_item_show])
				return $this->active_page [$name_item];
			else
				return;
		} else
			return $this->active_page [$name_item];
	}
	
	#получение массива подкаталога
	public function text_array($name_item) {
		$j = 0;
		for($i = 0; $i < count ( $this->table ); $i ++) {
			if ($this->table [$i] [parent_id] == $name_item) {
				$return [$j] = $this->table [$i];
				$j ++;
			}
		}
		
		return $return;
	}
	
	#	функция формирует меню сайта
	public function Return_Menu_Site($menu_arr = NULL, $sub_menu = NULL) {
		#получение всего главного меню парент айди 0
		if (! $menu_arr)
			$menu_arr = $this->return_menu ();
			#получение главного подменю
		if (! $sub_menu)
			$sub_menu = $this->submenu;
		
		$count_index = 0;
		$count_link = 0;
		for($i = 0; $i < count ( $menu_arr ); $i ++) {
			if ($menu_arr [$i] [4] == '4b027416d9703') {
				$menu_index [$count_index] = $menu_arr [$i];
				$count_index ++;
			}
			if ($menu_arr [$i] [4] == '4b0274ac53ec9') {
				$menu_link [$count_link] = $menu_arr [$i];
				$count_link ++;
			}
		
		}
		#	menu index
		$menu_arr = NULL;
		$menu_arr = $menu_index;
		$k = 0;
		
		for($i = 0; $i < count ( $menu_arr ); $i ++) {
			$selected = "class=\"d-{$i}-na iePNG\"";
			if ($_SERVER ['PHP_SELF'] == "/" . $menu_arr [$i] [0])
				$selected = "class=\"iePNG MenuTopActive\"";
			
			$k ++;
			$linkHTML = substr ( $menu_arr [$i] [0], 0, strlen ( $menu_arr [$i] [0] ) - 3 ) . "html";
			//if($menu_arr[$i][1] == '1immovables') $linkHTML = '#';
			$ret_menu_index .= "<a {$selected} title=\"{$menu_arr[$i][2]}\" id=\"{$menu_arr[$i][1]}\" href=\"/{$linkHTML}\">";
			//$ret_menu_index .= "<img src=\"/files/images/bg/{$menu_arr[$i][1]}.png\" alt=\"{$menu_arr[$i][2]}\"/>";
			$ret_menu_index .= $menu_arr [$i] [2];
			$ret_menu_index .= "</a>";
			
			if ($sub_menu [$i]) {
				if ($_SERVER ['PHP_SELF'] == "/" . $menu_arr [$i] [0]) {
					$k = true;
					$j = 0;
					do {
						$style = NULL;
						if ($_SERVER ['REQUEST_URI'] == "/" . $menu_arr [$i] [0] . "?1=" . $sub_menu [$i] [$j] [1])
							$style = "class=\"topSubMenuA\"";
						$SubLinkHtml = substr ( $sub_menu [$i] [$j] [0], 0, strlen ( $sub_menu [$i] [$j] [0] ) - 4 ) . "/{$sub_menu[$i][$j][1]}.html";
						$ret_submenu_index .= "<a {$style} href=\"/{$SubLinkHtml}\">";
						$ret_submenu_index .= $sub_menu [$i] [$j] [2];
						$ret_submenu_index .= "</a>";
						$j ++;
						if (! $sub_menu [$i] [$j] [2])
							$k = false;
					} while ( $k == true );
				}
			}
		}
		
		for($i = 0; $i < count ( $menu_link ); $i ++) {
			$linkHTML = substr ( $menu_link [$i] [0], 0, strlen ( $menu_link [$i] [0] ) - 3 ) . "html";
			$selected = NULL;
			if ($_SERVER ['PHP_SELF'] == "/" . $menu_link [$i] [0])
				$selected = "id=\"selectedMenu\" style=\"text-decoration:none\"";
			if ($menu_arr [$i] [3] == 'hide')
				$ret_menu_link .= "<a   title=\"{$pages->buld_table[$menu_link[$i][1]]['title']}\" {$selected} href=\"{$sub_menu[$i][$j][0]}\">";
			else
				$ret_menu_link .= "<a  title=\"{$pages->buld_table[$menu_link[$i][1]]['title']}\" {$selected} href=\"/{$linkHTML}\">";
			$ret_menu_link .= $menu_link [$i] [2];
			$ret_menu_link .= "</a>";
		}
		
		for($i = 0; $i < count ( $menu_arr ); $i ++) {
			$linkHTML = substr ( $menu_arr [$i] [0], 0, strlen ( $menu_arr [$i] [0] ) - 3 ) . "html";
			$ret_menu_footer .= "<a title=\"{$pages->buld_table[$menu_link[$i][1]]['title']}\" href=\"/{$linkHTML}\">";
			$ret_menu_footer .= $menu_arr [$i] [2];
			$ret_menu_footer .= "</a>";
			
			if ($i != count ( $menu_arr ) - 1)
				$ret_menu_footer .= "<span>|</span>";
		
		}
		
		$ret_menu_footer .= "<span>|</span>";
		$ret_menu_footer .= "<a title=\"{$arWords[sitemap]}\" href=\"/sitemap.html\">";
		$ret_menu_footer .= "{$arWords[sitemap]}";
		$ret_menu_footer .= "</a>";
		
		$return = array ($ret_menu_index, $ret_menu_link, $ret_menu_footer, $ret_submenu_index );
		return $return;
	}
	
	#build_default_page() - функция формирует стандартную страницу если выполняються ниже указание условия
	public function build_default_page($SubMenuIndex) {
		#существует текст страницы и нет подключаемого модуля
		if (! empty ( $this->active_page ['adress_template'] ))
			return false;
			#существует подменю
		if ($SubMenuIndex)
			$this->active_page ['menu'] = $SubMenuIndex;
		else
			$this->active_page ['menu'] = '';
			#не существует краткий текст страницы
		if (empty ( $this->active_page ['description'] ))
			$this->active_page ['description'] = '';
			#проверка страница ли подменю
		if (isset ( $_GET [1] ))
			$this->active_page ['div_navigation'] = "<div class=\"DivNavigation\">{$this->navigation_string_htaccess()}</div>";
		else
			$this->active_page ['div_navigation'] = '';
		
		return true;
	}
	
	#### START
	#### функции для работы с древовидным каталогом 
	#### START
	

	####получение отсортированого массива саталога
	public function tree_get($tbl = NULL) {
		if (! $tbl)
			$tbl = $this->table;
		$j = 0;
		
		for($i = 0; $i < count ( $tbl ); $i ++) {
			if ($tbl [$i] [parent_id] == 0) {
				$return [$j] = array ($tbl [$i], $this->tree_get_for ( $tbl, $tbl [$i] [page_id] ) );
				$j ++;
			}
		}
		return $return;
	}
	####вспомагаетльная функция для function tree_get
	private function tree_get_for($tbl, $parent) {
		$j = 0;
		for($i = 0; $i < count ( $tbl ); $i ++) {
			if ($tbl [$i] [parent_id] == $parent) {
				$return [$j] = array ($tbl [$i], $this->tree_get_for ( $tbl, $tbl [$i] [page_id] ) );
				$j ++;
			}
		}
		return $return;
	}
	####построение самого дерева каталога
	public function tree_print($arr, $margin = 0) {
		global $margin;
		for($i = 0; $i < count ( $arr ); $i ++) {
			$return .= "<div style=\"border:none; padding-left:" . ($margin * 20) . "px\">" . $arr [$i] [0] [page_id] . ". (" . $arr [$i] [0] [title] . ")func</div>";
			if ($arr [$i] [1]) {
				$margin ++;
				$return .= $this->tree_print ( $arr [$i] [1], $margin );
				$margin --;
			}
		}
		return $return;
	}
	####получение массива активных пунктов каталога
	public function tree_id_active($id_active, $tbl = NULL, $return = NULL) {
		if (! $tbl)
			$tbl = $this->table;
		if (count ( $return ) == 0) {
			$j = 0;
		} else {
			$j = count ( $return );
		}
		
		for($i = 0; $i < count ( $tbl ); $i ++) {
			if ($tbl [$i] [id] == $id_active) {
				$return [$j] = $tbl [$i] [id];
				if ($tbl [$i] [parent_id] != 0) {
					$j ++;
					$return = $this->tree_id_active ( $tbl [$i] [parent_id], $tbl, $return );
				} else
					return $return;
			}
		}
		return $return;
	}
	private function tree_id_active_for($id, $tbl, $return) {
		$j = count ( $return ) + 1;
		for($i = 0; $i < count ( $tbl ); $i ++) {
			$return [$j] = $tbl [$i] [id];
			if ($tbl [$i] [parent_id] != 0) {
				$j ++;
				$return [$j] = $this->tree_id_active_for ( $tbl [$i] [id], $tbl, $return );
			} else
				return $return;
		
		}
		return $return;
	}
	#### END
	#### функции для работы с древовидным каталогом 
	#### END
	

	#функция возвращает сформулированный массив согласно выбранному справочнику
	public function ret_dict_builder($arr, $dict_id) {
		$j = 0;
		$ret_arr = array ();
		for($i = 0; $i < count ( $arr ); $i ++) {
			if ($arr [$i] ['dict_id'] == $dict_id) {
				$ret_arr [$j] = $arr [$i];
				$j ++;
			}
		}
		return $ret_arr;
	}

}
?>
