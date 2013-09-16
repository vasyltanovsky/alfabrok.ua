<?php
/*
 * Класс чтения файлов
 *  
 *
 * @version class.FileReader.php,v 1.0 2010/10/08
 * @author <AlexTsurkin/>
 * @license GNU GPLv3
 */

class fileReaderClass {
	
	public $file_content;
	
	public function __construct($file_content = NULL) {
		$this->file_content = $file_content;
	}
	
	/* Функция: производит чтение данных с файла
	* @param  $template_path - путь к файлу
	* @param  $template_file - имя файла
	* @param  $method - метод чтения
	* @return 
	*/
	public function get_file_content($template_path, $template_file, $method = 'cont') {
		
		if (! $this->checking_existence ( $template_path, $template_file ))
			return false;
		
		switch ($method) {
			case 'strings' :
				{
					$this->file_content = $this->f_read_strings ( $template_path, $template_file );
					break;
				}
			case 'full' :
				{
					$this->file_content = $this->f_read_full ( $template_path, $template_file );
					break;
				}
			case 'cont' :
				{
					$this->file_content = $this->f_read_cont ( $template_path, $template_file );
					break;
				}
		}
		return $this->file_content;
	}
	
	/* Функция: формирует тело и тему сообщения для отправки по почте
	* @param  $arWords - массив слов версии языка
	* @param  $this->file_content; - прочтенный текст
	* @return $return - массив (тело и тему сообщения)
	*/
	public function get_email_template($txt = NULL) {
		global $arWords;
		$FC = $this->file_content;
		$return = array ();
		$drop_header = '';
		$match = array ();
		if (preg_match ( '#^(Subject:(.*?))$#m', $FC, $match )) {
			$return ['subject'] = (trim ( $match [2] ) != '') ? trim ( $match [2] ) : (($return ['subject'] != '') ? $return ['subject'] : $arWords ['DEFAULT_EMAIL_SUBJECT']);
			$drop_header .= '[\r\n]*?' . preg_quote ( $match [1], '#' );
		} else {
			$return ['subject'] = (($return ['subject'] != '') ? $return ['subject'] : $arWords ['DEFAULT_EMAIL_SUBJECT']);
		}
		
		if ($drop_header) {
			$FC = trim ( preg_replace ( '#' . $drop_header . '#s', '', $FC ) );
		}
		$return ['msg'] = str_replace ( "\n", "<br>", $FC );
		
		if ($txt) {
			$ClFunc = new functionalClass ( );
			//			$txt = $ClFunc->CleanText ( $txt );
			$return ['subject'] = $ClFunc->Str_Replace ( $return ['subject'], $txt );
			$return ['msg'] = $ClFunc->Str_Replace ( $return ['msg'], $txt );
		}
		
		return $return;
	}
	
	/* Функция:	читает данные с файла 
	* @param  $template_path - путь к файлу
	* @param  $template_file - имя файла
	* @return 
	*/
	private function f_read_cont($template_path, $template_file) {
		return file_get_contents ( $template_path . $template_file );
	}
	
	/* Функция: читает данные с файла 
	* @param  $template_path - путь к файлу
	* @param  $template_file - имя файла 
	* @return 
	*/
	private function f_read_strings($template_path, $template_file) {
		return file ( $template_path . $template_file );
	}
	
	/* Функция:	читает данные с файла  
	* @param  $template_path - путь к файлу
	* @param  $template_file - имя файла
	* @return 
	*/
	private function f_read_full($template_path, $template_file) {
		$f = fopen ( $template_path . $template_file, "r" );
		while ( ! feof ( $f ) ) {
			$data .= fread ( $f, 1000 );
		}
		return $data;
	}
	
	/* Функция: проверяет правильность пути и имя файла
	* @param  $template_path - путь к файлу
	* @param  $template_file - имя файла 
	* @return 
	*/
	private function checking_existence($template_path, $template_file) {
		if (! is_dir ( $template_path )) {
			die ( $template_path . "Folder Not Exists" );
		}
		if (! file_exists ( $template_path . $template_file )) {
			die ( $template_path . $template_file . "File Not Exists" );
		}
		return true;
	}
}

?>