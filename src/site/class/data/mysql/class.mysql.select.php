<?php
class mysql_select {
	// мя таблици для селекта
	public $name_table_select;
	// апрос таблици для селекта
	public $where_table_select;
	// ортировка таблици для селекта
	public $order_table_select;
	
	// аблица селекта
	public $table;
	// аблица селекта гда на месле $i стоит page_id
	public $buld_table;
	
	// Конструктор класса
	public function __construct($name_table_select = NULL, $where_table_select = NULL, $order_table_select = NULL, 

	$table = array(), $buld_table = array()) {
		$this->name_table_select = $name_table_select;
		$this->where_table_select = $where_table_select;
		$this->order_table_select = $order_table_select;
		
		$this->table = $table;
		$this->buld_table = $buld_table;
	}
	
	//
	public function select_table($name_field = "id", $st_table = NULL, $st_where = NULL, $st_order = NULL, $IsAllSelect = "SELECT * FROM") {
			try {
			if ($st_table)
				$this->name_table_select = $st_table;
			if ($st_where)
				$this->where_table_select = $st_where;
			if ($st_order)
				$this->order_table_select = $st_order;
			
			if (! $this->name_table_select)
				return;
			
		$query = "	{$IsAllSelect}
						{$this->name_table_select}
				   		{$this->where_table_select}
						{$this->order_table_select}";
			$tbl = mysql_query ( $query );
			if (! $tbl)
				throw new ExceptionMySQL ( mysql_error (), $query, "Ошибка извлечений позиций" );
			$i = 0;
			if (mysql_num_rows ( $tbl ))
				while ( $t_pages [] = mysql_fetch_array ( $tbl ) ) {
					$this->buld_table [$t_pages [$i] [$name_field]] = $t_pages [$i];
					$i ++;
				}
			unset ( $t_pages [count ( $t_pages ) - 1] );
			// unset($this->buld_table[count($this->buld_table) - 1]);
			return $this->table = $t_pages;
		} catch ( Exception $exc ) {
			 echo ExceptionFullGet::ExcMysql ( $exc );
		}
	}
	
	//
	public function select_table_id($where_table_id) {
		try {
			$query = "SELECT * FROM {$this->name_table_select} $where_table_id";
			$sql_query = mysql_query ( $query );
			if (! $sql_query)
				throw new ExceptionMySQL ( mysql_error (), $query, "Ошибка при выборка с таблицы" );
			return mysql_fetch_array ( $sql_query );
		} catch ( Exception $exc ) {
			// echo ExceptionFullGet::ExcMysql ( $exc );
		}
	}
	
	//
	public function update_table($where, $arr) {
		foreach ( $arr as $key => $value ) {
			$update .= "" . $key . " = " . $value;
		}
		
		if ($update) {
			try {
				$query = "UPDATE {$this->name_table_select} SET {$update} {$where}";
				mysql_query ( $query );
				if (! mysql_query ( $query ))
					throw new ExceptionMySQL ( mysql_error (), $query, "Ошибка при обновлении записи" );
			} catch ( Exception $exc ) {
				echo ExceptionFullGet::ExcMysql ( $exc );
			}
		}
		return;
	}
	
	//
	public function select_table_query($query, $name_field = false) {
		$t_pages = array ();
		try {
			$tbl = mysql_query ( $query );
			if (! $tbl)
				throw new ExceptionMySQL ( mysql_error (), $query, "Ошибка при выборка с таблицы" );
			$i = 0;
			if (mysql_num_rows ( $tbl ))
				while ( $t_pages [] = mysql_fetch_array ( $tbl ) ) {
					if ($name_field) {
						$this->buld_table [$t_pages [$i] [$name_field]] = $t_pages [$i];
						$i ++;
					}
				}
			unset ( $t_pages [count ( $t_pages ) - 1] );
			// unset($this->buld_table[count($this->buld_table) - 1]);
			return $this->table = $t_pages;
		} catch ( Exception $exc ) {
			echo ExceptionFullGet::ExcMysql ( $exc );
		}
	}
	public function insert($query) {
		try {
			if (! mysql_query ( $query ))
				throw new ExceptionMySQL ( mysql_error (), $query, "Ошибка при + каталога" );
			return mysql_insert_id ();
		} catch ( Exception $exc ) {
			echo ExceptionFullGet::ExcMysql ( $exc );
		}
	}
	public function query($query) {
		try {
			if (! mysql_query ( $query ))
				throw new ExceptionMySQL ( mysql_error (), $query, "Ошибка при + каталога" );
		} catch ( Exception $exc ) {
			echo ExceptionFullGet::ExcMysql ( $exc );
		}
	}
}
?>