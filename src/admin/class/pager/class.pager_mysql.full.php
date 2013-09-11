<?php
class pager_mysql_right_full extends pager_right_full {
	// WHERE-условие
	protected $where;
	// Критерий сортировки ORDER
	protected $order;
	// Количество позиций на странице
	private $pnumber;
	// Количество ссылок слева и справа
	// от текущей страницы
	private $page_link;
	// Параметры
	private $parameters;
	// Конструктор
	public function __construct($where = "", $order = "", $pnumber = 10, $page_link = 3, $parameters = "") {
		$this->where = $where;
		$this->order = $order;
		$this->pnumber = $pnumber;
		$this->page_link = $page_link;
		$this->parameters = $parameters;
	}
	public function get_total() {
		// Формируем запрос на получение
		// общего количества записей в таблице
		$query = "{$this->where}";
		$tot = mysql_query ( $query );
		if (! $tot) {
			throw new ExceptionMySQL ( mysql_error (), $query, "Ошибка подсчёта количества записей" );
		}
		return mysql_result ( $tot, 0 );
	}
	public function get_pnumber() {
		// Количество позиций на старнице
		return $this->pnumber;
	}
	public function get_page_link() {
		// Количество ссылок слева и справа
		// от текущей страницы
		return $this->page_link;
	}
	public function get_parameters() {
		// Дополнительные параметры, которые
		// необходимо передать по ссылке
		return $this->parameters;
	}
	// Возвращает массив строк файла, по 
	// номеру страницы $index
	public function get_page() {
		// Текущая страница
		$page = intval ( $_GET ['page'] );
		if (empty ( $page ))
			$page = 1;
			// Количество записей в файле
		$total = $this->get_total ();
		// Вычисляем число страниц в системе
		$number = ( int ) ($total / $this->get_pnumber ());
		if (( float ) ($total / $this->get_pnumber ()) - $number != 0)
			$number ++;
			// Проверяем попадает ли запрашиваемый номер 
		// страницы в интервал от 1 до get_total()
		if ($page <= 0 || $page > $number)
			return 0;
			// Извлекаем позиции текущей страницы
		$arr = array ();
		// Номер, начиная с которого следует
		// выбирать строки файла
		$first = ($page - 1) * $this->get_pnumber ();
		// Извлекаем позиции для текущей страницы
		$query = "SELECT * FROM {$this->tablename}
                {$this->where}
                {$this->order}
                LIMIT $first, {$this->get_pnumber()}";
		$tbl = mysql_query ( $query );
		if (! $tbl) {
			throw new ExceptionMySQL ( mysql_error (), $query, "Ошибка извлечений позиций" );
		}
		// Если имеется хотя бы один элемент,
		// заполняем массив $arr
		if (mysql_num_rows ( $tbl )) {
			while ( $arr [] = mysql_fetch_array ( $tbl ) )
				;
		}
		// Удаляем последний нулевой элемент 
		// массива $arr
		unset ( $arr [count ( $arr ) - 1] );
		
		return $arr;
	}
}
error_reporting ( E_ALL & ~ E_NOTICE );

#
#--------------------------------
#--------------------------------
#


abstract class pager_right_full {
	abstract function get_total();
	abstract function get_pnumber();
	abstract function get_page_link();
	abstract function get_parameters();
	
	// Ссылки на другие страницы
	public function __toString() {
		$_SERVER [PHP_SELF] = substr ( $_SERVER [PHP_SELF], 0, strlen ( $_SERVER [PHP_SELF] ) - 4 );
		
		// Строка для возвращаемого результата
		$return_page = "";
		
		// Через GET-параметр page передаётся номер
		// текущей страницы
		$page = intval ( $_GET ['page'] );
		if (empty ( $page ))
			$page = 1;
			
		// Вычисляем число страниц в системе
		$number = ( int ) ($this->get_total () / $this->get_pnumber ());
		if (( float ) ($this->get_total () / $this->get_pnumber ()) - $number != 0) {
			$number ++;
		}
		// Проверяем есть ли ссылки слева
		if ($page - $this->get_page_link () > 1) {
			$return_page .= "<a href=$_SERVER[PHP_SELF]" . "{$this->get_parameters()}&page=1 class=main_txt_lnk>[1-{$this->get_pnumber()}]</a>&nbsp;&nbsp;...&nbsp;&nbsp;";
			// Есть
			for($i = $page - $this->get_page_link (); $i < $page; $i ++) {
				$return_page .= "&nbsp;<a href=$_SERVER[PHP_SELF]" . "{$this->get_parameters()}/$i.html class=main_txt_lnk>[" . (($i - 1) * $this->get_pnumber () + 1) . "-" . $i * $this->get_pnumber () . "]</a>&nbsp;";
			}
		} else {
			// Нет
			for($i = 1; $i < $page; $i ++) {
				$return_page .= "&nbsp;<a href=$_SERVER[PHP_SELF]" . "{$this->get_parameters()}/$i.html class=main_txt_lnk>[" . (($i - 1) * $this->get_pnumber () + 1) . "-" . $i * $this->get_pnumber () . "]</a>&nbsp;";
			}
		}
		// Проверяем есть ли ссылки справа
		if ($page + $this->get_page_link () < $number) {
			// Есть
			for($i = $page; $i <= $page + $this->get_page_link (); $i ++) {
				if ($page == $i)
					$return_page .= "&nbsp;[" . (($i - 1) * $this->get_pnumber () + 1) . "-" . $i * $this->get_pnumber () . "]&nbsp;";
				else
					$return_page .= "&nbsp;<a href=$_SERVER[PHP_SELF]" . "{$this->get_parameters()}/$i.html class=main_txt_lnk>[" . (($i - 1) * $this->get_pnumber () + 1) . "-" . $i * $this->get_pnumber () . "]</a>&nbsp;";
			}
			$return_page .= "&nbsp;...&nbsp;&nbsp;" . "<a href=$_SERVER[PHP_SELF]" . "{$this->get_parameters()}/$i.html class=main_txt_lnk>[" . (($number - 1) * $this->get_pnumber () + 1) . "-{$this->get_total()}]</a>&nbsp;";
		} else {
			// Нет
			for($i = $page; $i <= $number; $i ++) {
				if ($number == $i) {
					if ($page == $i)
						$return_page .= "&nbsp;[" . (($i - 1) * $this->get_pnumber () + 1) . "-{$this->get_total()}]&nbsp;";
					else
						$return_page .= "&nbsp;<a href=$_SERVER[PHP_SELF]" . "{$this->get_parameters()}/$i.html class=main_txt_lnk>[" . (($i - 1) * $this->get_pnumber () + 1) . "-{$this->get_total()}]</a>&nbsp;";
				} else {
					if ($page == $i)
						$return_page .= "&nbsp;[" . (($i - 1) * $this->get_pnumber () + 1) . "-" . $i * $this->get_pnumber () . "]&nbsp;";
					else
						$return_page .= "&nbsp;<a href=$_SERVER[PHP_SELF]" . "{$this->get_parameters()}/$i.html class=main_txt_lnk>[" . (($i - 1) * $this->get_pnumber () + 1) . "-" . ($i * $this->get_pnumber ()) . "]</a>&nbsp;";
				}
			}
		}
		return $return_page;
	}
	
	// Альтернативный вид постраничной навигации
	public function print_page() {
		// Строка для возвращаемого результата
		$return_page = "";
		
		// Через GET-параметр page передаётся номер
		// текущей страницы
		$page = intval ( $_GET ['page'] );
		if (empty ( $page ))
			$page = 1;
			
		// Вычисляем число страниц в системе
		$number = ( int ) ($this->get_total () / $this->get_pnumber ());
		if (( float ) ($this->get_total () / $this->get_pnumber ()) - $number != 0) {
			$number ++;
		}
		
		// Ссылка на первую страницу
		$return_page .= "<a href='$_SERVER[PHP_SELF]?page=1{$this->get_parameters()}' class=main_txt_lnk>&lt;&lt;</a> ... ";
		// Выводим ссылку "Назад", если это не первая страница 
		if ($page != 1)
			$return_page .= " <a href='$_SERVER[PHP_SELF]{$this->get_parameters()}'&page=" . ($page - 1) . " class=main_txt_lnk>&lt;</a> ... ";
			
		// Выводим предыдущие элементы 
		if ($page > $this->get_page_link () + 1) {
			for($i = $page - $this->get_page_link (); $i < $page; $i ++) {
				$return_page .= "<a href='$_SERVER[PHP_SELF]?page=$i' class=main_txt_lnk>$i</a> ";
			}
		} else {
			for($i = 1; $i < $page; $i ++) {
				$return_page .= "<a href='$_SERVER[PHP_SELF]?page=$i' class=main_txt_lnk>$i</a> ";
			}
		}
		// Выводим текущий элемент 
		$return_page .= "$i ";
		// Выводим следующие элементы 
		if ($page + $this->get_page_link () < $number) {
			for($i = $page + 1; $i <= $page + $this->get_page_link (); $i ++) {
				$return_page .= "<a href='$_SERVER[PHP_SELF]?page=$i' class=main_txt_lnk>$i</a> ";
			}
		} else {
			for($i = $page + 1; $i <= $number; $i ++) {
				$return_page .= "<a href='$_SERVER[PHP_SELF]?page=$i' class=main_txt_lnk>$i</a> ";
			}
		}
		
		// Выводим ссылку вперёд, если это не последняя страница 
		if ($page != $number)
			$return_page .= " ... <a href='$_SERVER[PHP_SELF]{$this->get_parameters()}&page=" . ($page + 1) . "' class=main_txt_lnk>&gt;</a>";
			// Ссылка на последнюю страницу
		$return_page .= " ... <a href='$_SERVER[PHP_SELF]?page=$number{$this->get_parameters()}' class=main_txt_lnk>&gt;&gt;</a>";
		
		return $return_page;
	}
}

?>