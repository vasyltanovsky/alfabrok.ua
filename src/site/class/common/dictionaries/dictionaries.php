<?php
use Zend\Crypt\PublicKey\Rsa\PublicKey;
/*
 * Класс обработчик справочников сайта @version class.dictionaries.php,v 2.0 2010/05/28 @author <AlexTsurkin/> @license GNU GPLv3
 */
class dictionariesClass {
	// аблица селекта
	public $table;
	// аблица селекта гда на месле $i стоит page_id
	public $buld_table;
	// аблица селекта list
	public $table_list;
	// аблица селекта гда на месле $i стоит page_id
	public $buld_table_list;
	public $my_dct;
	public $my_list_dct;
	private $field_value_dct;
	public $field_value_list_dct;
	
	// Конструктор класса
	public function __construct($my_dct = NULL, $my_list_dct = NULL, $table = array(), $buld_table = array(), $table_list = array(), $buld_table_list = array(), $field_dct = NULL, $field_value_list_dct = NULL) {
		$this->table = $table;
		$this->buld_table = $buld_table;
		$this->table_list = $table_list;
		$this->buld_table_list = $buld_table_list;
		$this->my_dct = $my_dct;
		$this->my_list_dct = $my_list_dct;
		$this->field_value_dct = $field_value_dct;
		$this->field_value_list_dct = $field_value_list_dct;
	}
	// ## селект таблицы
	public function select_table($table, $where = NULL, $order = NULL) {
		$query = "SELECT * FROM {$table}
					    		{$where} {$order}";
		$tbl = mysql_query ( $query );
		
		if (! $tbl) {
			echo $query;
			echo mysql_error ();
			throw new ExceptionMySQL ( mysql_error (), $query, "Ошибка извлечений позиций" );
		}
		return $tbl;
		$i = 0;
		if (mysql_num_rows ( $tbl ))
			while ( $t_pages[] = mysql_fetch_array ( $tbl ) ) {
				$this->buld_table[$t_pages[$i][page_id]] = $t_pages[$i];
				$i ++;
			}
		unset ( $t_pages[count ( $t_pages ) - 1] );
		unset ( $this->buld_table[count ( $this->buld_table ) - 1] );
		return $this->table = $t_pages;
	}
	// # постpоение массива словарей
	public function buid_dictionaries($table, $where = NULL, $order = NULL) {
		$tbl = $this->select_table ( $table, $where, $order );
		$i = 0;
		while ( $t_dictionaries[] = mysql_fetch_array ( $tbl ) ) {
			// слове Киев удаляем первую букву
			if ($t_dictionaries[$i]['dict_id'] == '4c3eb839f144e') {
				$t_dictionaries[$i][dict_name] = substr ( $t_dictionaries[$i][dict_name], 1, strlen ( $t_dictionaries[$i][dict_name] ) );
			}
			
			$this->buld_table[$t_dictionaries[$i]['dict_id']] = $t_dictionaries[$i];
			$i ++;
		}
		unset ( $t_dictionaries[count ( $t_dictionaries ) - 1] );
		// unset($this->buld_table[count($this->buld_table) - 1]);
		return $this->table = $t_dictionaries;
	}
	// # постpоение массива списка словаря
	public function buid_dictionaries_list($table, $where = NULL, $order = NULL) {
		$tbl = $this->select_table ( $table, $where, $order );
		$i = 0;
		while ( $t_dictionaries_list[] = mysql_fetch_array ( $tbl ) ) {
			$this->buld_table_list[$t_dictionaries_list[$i]['ld_id']] = $t_dictionaries_list[$i];
			$i ++;
		}
		unset ( $t_dictionaries_list[count ( $t_dictionaries_list ) - 1] );
		// unset($this->buld_table_list[count($this->buld_table_list) - 1]);
		return $this->table_list = $t_dictionaries_list;
	}
	
	// # постpоение массива списка словаря
	public function buid_propertis_list($table, $where = NULL, $order = NULL) {
		$tbl = $this->select_table ( $table, $where, $order );
		$i = 0;
		while ( $t_dictionaries_list[] = mysql_fetch_array ( $tbl ) ) {
			$this->buld_table_list[$t_dictionaries_list[$i][car_prop_id]] = $t_dictionaries_list[$i];
			$i ++;
		}
		unset ( $t_dictionaries_list[count ( $t_dictionaries_list ) - 1] );
		// unset($this->buld_table_list[count($this->buld_table_list) - 1]);
		return $this->table_list = $t_dictionaries_list;
	}
	
	// функция формирует два массива списка словаря и словаря,
	// для поиска указывается значение поля айди словаря,
	// и он записывает в $this->my_list_dct словарь, а массив $this->my_dct весь список этого словаря
	// мы получаем весь список словаря
	public function do_dictionaries($value_id) 	// йди словаря
	{
		$this->my_dct = NULL;
		$this->my_list_dct = $this->buld_table_list[$value_id];
		$j = 0;
		for($i = 0; $i < count ( $this->table ); $i ++) {
			if ($this->table[$i][ld_id] == $value_id) {
				// echo "<br>{$value_id}<hr><br>";
				// echo $this->table[$i][ld_id]."<br>";
				$this->my_dct[$j] = $this->table[$i];
				$j ++;
			}
		}
		return;
	}
	
	// функция вызывает функцию this->do_dictionaries
	// для поиска указывается значение поля айди списка словаря,
	// и он ищет сначала какой это словарь а потом вызывает функцию
	public function have_some_id($value_id) 	// йди списка словаря
	{
		return $this->do_dictionaries ( $this->buld_table[$value_id][ld_id] );
	}
	
	// ункция возвращает значение указаного поля с таблицы значений списка словаря и с таблицы словаря
	public function return_field_value($value_id, 	// йди списка словаря
	$name_field, 	// мя поля списка словаря
	$name_field_list = NULL) 	// мя поля словаря
	{
		$this->field_value_dct = $this->buld_table[$value_id][$name_field];
		if ($name_field_list)
			$this->field_value_list_dct = $this->buld_table_list[$this->buld_table[$value_id]['ld_id']][$name_field_list];
		return;
	}
	
	// ункция возвращает значение указаного поля с таблицы значений списка словаря и с таблицы словаря
	public function return_field_value_and_parent($value_id, 	// йди списка словаря
	$name_field, 	// мя поля списка словаря
	$name_field_paremt, 	// мя поля списка parent
	$name_field_list = NULL) 	// мя поля словаря
	{
		$parent = $this->buld_table[$value_id][parent_id];
		$return_parent_value = $this->buld_table[$parent][$name_field_paremt];
		$this->field_value_dct = $this->buld_table[$value_id][$name_field];
		if ($name_field_list)
			$this->field_value_list_dct = $this->buld_table_list[$this->buld_table[$value_id]['ld_id']][$name_field_list];
		return $return_parent_value;
	}
	
	//
	public function prerare_to_search_model($arr_build) {
		for($i = 0; $i < count ( $arr_build ); $i ++) {
			$return[$i] = $this->prerare_to_search_model_in ( $arr_build[$i]['dict_id'] );
			// if($this->table[$i][ld_id])
			// echo $i;
		}
		return $return;
	}
	function getDictValue($data, $key) {
		return $this->buld_table[$data[$key]]['dict_name'];
	}
	
	//
	public function prerare_to_search_model_in($value_id = NULL) {
		$j = 1;
		for($i = 0; $i < count ( $this->table ); $i ++) {
			if ($this->table[$i][parent_id] == $value_id) {
				$return[$j] = $this->table[$i];
				$j ++;
			}
		}
		return $return;
	}
	
	// переделка массива в вид "array("id"=> "value")"
	public function changes_of_array_field($array, $name_field, $name_id = NULL) {
		$return = array();
		foreach ( $array as $key => $value ) {
			$arr_id = $key;
			if ($name_id)
				$arr_id = $array[$key][$name_id];
			$return[$arr_id] = $array[$key][$name_field];
		}
		return $return;
	}
	
	/*
	 * Функция: функция формирует массив с массива, в вид радителей и детей @param $arr - массив всех элементов справочника @return $return - сформированный древовыдный массив
	 */
	public function BuildArrayParentChild($arr) {
		for($i = 0; $i < count ( $arr ); $i ++) {
			if (empty ( $arr[$i]['parent_id'] )) {
				$return[count ( $return )] = array(
						$arr[$i]['dict_id'],
						'NULL',
						0);
				$return = $this->BuildArrayParentChildIn ( $arr, $arr[$i]['dict_id'], $return, 0 );
			}
		}
		return $return;
	}
	
	/*
	 * Функция: вспомогательная функция для построения масива родитель и детей @param $arr - массив всех элементов справочника @param $searchID - искомый айди @param $return - сформированный древовыдный массив @param $in - уровень вхождения @return $return - сформированный древовыдный массив
	 */
	public function BuildArrayParentChildIn($arr, $searchID, $return, $in) {
		$in ++;
		for($i = 0; $i < count ( $arr ); $i ++) {
			// echo "dict_id search -{$searchID}<br>";
			// echo "for parent_id -{$arr[$i]['parent_id']}<br>";
			if ($arr[$i]['parent_id'] == $searchID) {
				// echo "dict_id search -{$searchID} -> for parent_id -{$arr[$i]['parent_id']}<br><br>";
				$return[count ( $return )] = array(
						$arr[$i]['dict_id'],
						$searchID,
						$in);
				$return = $this->BuildArrayParentChildIn ( $arr, $arr[$i]['dict_id'], $return, $in );
			}
		}
		return $return;
	}
	public function getItemValue($dict_id) {
		return $this->buld_table[$dict_id]["dict_name"];
	}
}
?>