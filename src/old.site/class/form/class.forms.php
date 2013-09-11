<?php #	www.alex-ts.loc
#	ALEX TSURKIN 
#	19.11.2009
error_reporting ( E_ALL & ~ E_NOTICE );

////////////////////////////////////////////////////////////
// Класс HTML-формы
////////////////////////////////////////////////////////////


class form {
	// Массив элементов управления
	public $fields;
	// Название кнопки HTML-формы
	protected $button_name;
	
	// Класс CSS ячейки таблицы
	protected $css_td_class;
	// Стиль CSS ячейки таблицы
	protected $css_td_style;
	// Класс CSS элемента управления
	protected $css_fld_class;
	// Стиль CSS элемента управления
	protected $css_fld_style;
	
	// Класс CSS TABLE
	public $css_tbl_class;
	// Класс CSS FORM
	public $css_form_class;
	
	// Конструктор класса
	public function __construct($flds, $button_name, $css_td_class = "", $css_td_style = "", $css_fld_class = "", $css_fld_style = "", $css_td_fld_class = "", $css_td_fld_style = "", $css_tbl_class = "", $css_form_class = "") {
		$this->fields = $flds;
		$this->button_name = $button_name;
		
		$this->css_td_class = $css_td_class;
		$this->css_td_style = $css_td_style;
		$this->css_fld_class = $css_fld_class;
		$this->css_fld_style = $css_fld_style;
		$this->css_td_fld_class = $css_td_fld_class;
		$this->css_td_fld_style = $css_td_fld_style;
		$this->css_tbl_class = $css_tbl_class;
		$this->css_form_class = $css_form_class;
		
		// Проверяем, является ли элементы массива $flds
		// производными класса field
		foreach ( $flds as $key => $obj ) {
			if (! is_subclass_of ( $obj, "field" )) {
				throw new ExceptionObject ( $key, "\"$key\" не является элементом управления" );
			}
		}
	}
	
	// Вывод HTML-формы в окно браузера
	public function print_form() {
		$enctype = "";
		if (! empty ( $this->fields )) {
			foreach ( $this->fields as $obj ) {
				// Назначаем всем элементам управления единый стиль
				if (! empty ( $this->css_fld_class )) {
					$obj->css_class = $this->css_fld_class;
				}
				if (! empty ( $this->css_fld_class )) {
					$obj->css_style = $this->css_fld_style;
				}
				// Проверяем нет ли среди элементов управления
				// поля file, если имеется, включаем строку
				// enctype='multipart/form-data'
				if ($obj->type == "file") {
					$enctype = "enctype='multipart/form-data'";
				}
			}
		}
		
		// Если элементы оформления не пусты - учитываем их
		if (! empty ( $this->css_td_style )) {
			$style = "style=\"" . $this->css_td_style . "\"";
		} else
			$style = "";
		
		if (! empty ( $this->css_td_class )) {
			$class = "class=\"" . $this->css_td_class . "\"";
		} else
			$class = "";
		
		if (! empty ( $this->css_td_fld_class )) {
			$td_fl_class = "class=\"" . $this->css_td_fld_class . "\"";
		} else
			$td_fl_class = "";
		
		if (! empty ( $this->css_tbl_class )) {
			$tbl_class = "class=\"" . $this->css_tbl_class . "\"";
		} else
			$tbl_class = "";
		
		if (! empty ( $this->css_form_class )) {
			$form_class = "class=\"" . $this->css_form_class . "\"";
		} else
			$form_class = "";
			
		// Выводим HTML-форму
		echo "<form " . $form_class . " name=form $enctype method=post>";
		echo "<table " . $tbl_class . " border=\"0\" 
             cellpadding=\"0\" 
             cellspacing=\"0\">";
		if (! empty ( $this->fields )) {
			foreach ( $this->fields as $obj ) {
				// Получаем название поля, и его HTML-представление
				list ( $caption, $tag, $help, $alternative ) = $obj->get_html ();
				if (is_array ( $tag ))
					$tag = implode ( "<br>", $tag );
				switch ($obj->type) {
					case "hidden" :
						// Скрытое поле
						echo $tag;
						break;
					case "paragraph" :
					case "title" :
						echo "<tr>
                      <td $style $class colspan=2 valign=top>$tag</td>
                    </tr>\n";
						break;
					/*            case "city":
              echo "<tr>
                      <td width=100 $style $class valign=top>$caption:</td>
                      <td $style $class>$tag</td>
                    </tr>\n";
              echo "<tr>
                      <td width=100 $style $class valign=top>Если города<br> нет в списке:</td>
                      <td $style $class>$alternative $help</td>
                    </tr>\n";
              break;*/
					default :
						// Элементы управления по умолчанию
						echo "<tr>
                      <td 
                          $style $class valign=top>$caption:</td>
                      <td $style $td_fl_class valign=top>$tag</td>
                    </tr>\n";
						if (! empty ( $help )) {
							echo "<tr>
                        <td $style $class>&nbsp;</td>
                        <td $style valign=top>$help</td>
                      </tr>";
						}
						break;
				}
			}
		}
		
		// Выводим кнопку подтверждения
		echo "<tr>
              <td $style $class></td>
              <td $style $class>
                <input class=button 
                       type=submit 
                       value=\"" . htmlspecialchars ( $this->button_name, ENT_QUOTES ) . "\">
              </td>
            </tr>\n";
		echo "</table> ";
		echo "</form>";
	}
	
	// Перегрузка специального метода __toString()
	public function __toString() {
		$this->print_form ();
	}
	
	// Метод, проверяющий корректность ввода данных в форму
	public function check() {
		// Последовательно вызываем метод check для каждого
		// объекта field, принадлежащих классу
		$arr = array ();
		if (! empty ( $this->fields )) {
			foreach ( $this->fields as $obj ) {
				$str = $obj->check ();
				//if(!empty($str))
				$arr [] = $str;
			}
		}
		return $arr;
	}
}
?>