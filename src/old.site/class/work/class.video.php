<?php
class cl_video {
	# гет выбрано
	public $get_video_id;
	# таблица новостей
	public $tbl_video;
	# имя таблици для селекта
	public $name_table_select;
	# параметры для селекта		
	public $where_table_select;
	# сортировка для селекта
	public $order_table_select;
	# 
	public $video_active;
	# айди для таблици новостей
	public $id;
	
	// Конструктор класса
	public function __construct($get_video_id = NULL, $name_table_select = NULL, $where_table_select = NULL, $order_table_select = NULL, $tbl_video = array(), $video_active = NULL, $id = "video_id") {
		$this->get_video_id = $get_video_id;
		$this->name_table_select = $name_table_select;
		$this->where_table_select = $where_table_select;
		$this->order_table_select = $order_table_select;
		$this->tbl_video = $tbl_video;
		$this->video_active = $video_active;
		$this->id = $id;
	}
	
	#функция определяет выбрана ли какая-то новость и селектит в зависимости
	public function is_active_video($land_id = NULL) {
		if ($this->get_video_id) {
			# если выбрали новость
			# объявляем  класс для селекта
			$cl_sel = new mysql_select ( $this->name_table_select, $this->where_table_select, $this->order_table_select );
			# селектим данные по этой новости
			if ($lang_id) {
				$this->tbl_video = $cl_sel->select_table_id ( "WHERE {$this->id} = '{$this->get_video_id}' AND lang_id = {$_COOKIE['lang_id']}" );
			} else {
				$this->tbl_video = $cl_sel->select_table_id ( "WHERE {$this->id} = '{$this->get_video_id}'" );
			}
			
			return;
		} else {
			/*
				$cl_sel = new mysql_select($this->name_table_select,
										   $this->where_table_select,
										   $this->order_table_select);
				
				$this->tbl_video = $cl_sel->select_table();*/
			#
			# Объявляем объект 
			# селектим все новости
			$obj = new pager_mysql_right ( $this->name_table_select, $this->where_table_select, $this->order_table_select, "10", // Число позиций на странице
"10", // Число ссылок в постраничной навигации
"?1=4ac310df7651a" );// Объявляем объект постраничной навигации

			
			# Получаем содержимое текущей страницы
			$this->tbl_video = $obj->get_page ();
			# возвращаем постраничную навигацию
			return $obj;
		}
	}

}
?>