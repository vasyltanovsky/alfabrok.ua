<?php
class cl_news {
	# гет выбранной новости
	var $get_news_id;
	# таблица новостей
	var $tbl_news;
	# имя таблици для селекта
	var $name_table_select;
	# параметры для селекта		
	var $where_table_select;
	# сортировка для селекта
	var $order_table_select;
	# 
	var $news_active;
	# айди для таблици новостей
	var $id;
	
	// Конструктор класса
	public function __construct($get_news_id = NULL, $name_table_select = NULL, $where_table_select = NULL, $order_table_select = NULL, $tbl_news = array(), $news_active = NULL, $id = "news_id") {
		$this->get_news_id = $get_news_id;
		$this->name_table_select = $name_table_select;
		$this->where_table_select = $where_table_select;
		$this->order_table_select = $order_table_select;
		$this->tbl_news = $tbl_news;
		$this->news_active = $news_active;
		$this->id = $id;
	}
	
	#функция определяет выбрана ли какая-то новость и селектит в зависимости
	public function is_active_news($lang_id = NULL, $link_string) {
		if ($this->get_news_id) {
			# если выбрали новость
			# объявляем  класс для селекта
			$cl_sel = new mysql_select ( $this->name_table_select, $this->where_table_select, $this->order_table_select );
			# селектим данные по этой новости
			if ($land_id) {
				$this->tbl_news = $cl_sel->select_table_id ( "WHERE {$this->id} = '{$this->get_news_id}' AND lang_id = {$_COOKIE['lang_id']}" );
			} else {
				$this->tbl_news = $cl_sel->select_table_id ( "WHERE {$this->id} = '{$this->get_news_id}'" );
			}
			return;
		} else {
			/*
				$cl_sel = new mysql_select($this->name_table_select,
										   $this->where_table_select,
										   $this->order_table_select);
				
				$this->tbl_news = $cl_sel->select_table();*/
			#
			# Объявляем объект 
			# селектим все новости
			$obj = new pager_mysql_right ( $this->name_table_select, $this->where_table_select, $this->order_table_select, "10", // Число позиций на странице
"10", // Число ссылок в постраничной навигации
"{$link_string}" );// Объявляем объект постраничной навигации

			
			# Получаем содержимое текущей страницы
			$this->tbl_news = $obj->get_page ();
			# возвращаем постраничную навигацию
			return $obj;
		}
	}

}
?>