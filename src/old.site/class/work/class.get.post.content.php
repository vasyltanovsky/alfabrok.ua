<?php
/*
 * Класс отправки данных при регистрации кода СapriSonne
 *
 * @version register.user.php,v 1.0 2010/05/11
 * @author <AlexTsurkin/>
 * @license GNU GPLv3
 */
class CsGetCodeResult {
	//phttp://89.162.190.107/webform/index.php
	public $url;
	public $set;
	public $method;
	public function __construct($set, $url = 'http://89.162.190.107/webform/index.php', $method) {
		$this->set = $set;
		$this->url = $url;
		$this->method = $method;
	}
	/*
     * Функция: отправка и получения ответа от обработчика кодов 
     * @param  this->set - массив пост данных
     * @param  this->url - адресс файла
     * @return ответ от обработчика
     */
	public function GetResult() {
		$postdata = http_build_query ( $this->set );
		$opts = array ('http' => array ('method' => $this->method, 'header' => 'Content-type: application/x-www-form-urlencoded', 'content' => $postdata ) );
		return file_get_contents ( $this->url, true, stream_context_create ( $opts ) );
	}
}
?>