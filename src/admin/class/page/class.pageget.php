<?php
# ========================================================================#
#
#  Author:    Alex Tsurkin
#  Version:	  1.0
#  Date:      15.02.2010
#  Purpose:   парсер url, формирует ГЕТ массив, и имя активной страницы
#  Requires : Requires PHP5, GD library.
#  Usage Example:
#                     $PageGetObj = new PageGet();
#                     $PageGetObj -> getPageGetArr();
#                     $PageGetObj -> getPagePhpself();
#	на входе:
#	http://pr.loc/ru/brands/Pierre-Cardin?statistic=page
#   результат:
#	[PHP_SELF:private] => brands
#	[GET:private] => Array
#   (
#       [ct_id] => Pierre-Cardin
#   	[statistic] => page
#   )
# ========================================================================#


class PageGet {
	/* Функция: преобразовует url в ГЕТ массив и имени активной страницы
	 * @param $is_phpself - получение GET или PAGE
	 * @return 
     */
	public function getPageGetArr($is_phpself = false) {
		//подключание настроек 
		require $_SERVER ['DOCUMENT_ROOT'] . '/config/get.articles.php';
		//проверка для ебанутого хостинга
		if ($_SERVER ['SERVER_NAME'] != 'webroom.loc') {
			if (strpos ( $_SERVER ['REQUEST_URI'], '?' ))
				$_SERVER ['REDIRECT_URL'] = substr ( $_SERVER ['REQUEST_URI'], 0, strpos ( $_SERVER ['REQUEST_URI'], '?' ) );
			else {
				if ($_SERVER ['REDIRECT_URL'] != '/')
					$_SERVER ['REDIRECT_URL'] = $_SERVER ['REQUEST_URI'];
				else
					unset ( $_SERVER ['REDIRECT_URL'] );
			}
		}
		if ($_SERVER ['REDIRECT_URL'] == "/")
			$_SERVER ['REDIRECT_URL'] = "";
			//преобразование строки REDIRECT_URL в массив
		$GET = explode ( '/', $_SERVER ['REDIRECT_URL'] );
		//если нет никаких параметров- это главная страница
		if (count ( $GET ) == 1)
			$ret ['phpself'] = 'index';
		else {
			if (strlen ( $GET [1] ) == 2) {
				//значит первые элемент версия языка
				$ret = PageGet::ParserElementGet ( $PageGetArticles, $GET, 0 );
			} else {
				//значит первый элемент имя страницы
				$ret = PageGet::ParserElementGet ( $PageGetArticles, $GET, - 1 );
			}
		}
		//слияние массивов GET: сформированного и стандартного 
		if (is_array ( $ret ['get'] )) {
			if (is_array ( $_GET ))
				$ret ['get'] = array_merge ( $ret ['get'], $_GET );
		} elseif (is_array ( $_GET ))
			$ret ['get'] = $_GET;
		
		$_GET = $ret ['get'];
		if ($is_phpself)
			return $ret ['phpself'];
		else
			return $ret ['get'];
	}
	/* Функция: вызывает функцию getPageGetArr и получает имя активной страницы
     * @return 
     */
	public function getPagePhpself() {
		return PageGet::getPageGetArr ( true );
	}
	/* Функция: парсер массива ГЕТ (полученный со строки) и изминение именей полей массива согласной законов активной страницы 
     * @return $ret['phpself', get[]]
     */
	public function ParserElementGet($articles, $getArr, $NumArr) {
		$ret ['phpself'] = $getArr [2 + $NumArr];
		if (count ( $getArr ) > 1)
			foreach ( $getArr as $key => $value ) {
				if (isset ( $articles [$ret ['phpself']] [$key - $NumArr] )) {
					if ($articles [$ret ['phpself']] [$key - $NumArr] == 'active_page') {
						$ret ['phpself'] = $value;
					} else
						$ret ['get'] [$articles [$ret ['phpself']] [$key - $NumArr]] = $value;
				}
			}
		return $ret;
	}
}

function getPhpSelf() {
	global $PhpSelf;
	return $PhpSelf;
}
//		if (! strpos ( $_SERVER ['REQUEST_URI'], '?' )) {
//			return $return;
//		} else {
//			$str = substr ( $_SERVER ['REQUEST_URI'], strpos ( $_SERVER ['REQUEST_URI'], '?' ) + 1, strlen ( $_SERVER ['REQUEST_URI'] ) );
//			$Arr = explode ( '&', $str );
//			if (is_array ( $Arr )) {
//				for($i = 0; $i < count ( $Arr ); $i ++) {
//					$j = explode ( "=", $Arr [$i] );
//					$j [1] = htmlspecialchars ( urldecode ( $j [1] ) );
//					
//					if (! empty ( $j [1] )) {
//						if (strpos ( $j [0], '-sale' ) or strpos ( $j [0], '-rent' ))
//							$j [0] = substr ( $j [0], 0, strlen ( $j [0] ) - 5 );
//						if (substr ( $j [0], 0, 2 ) == "m_") {
//							$pos_ = strpos ( substr ( $j [0], 2, strlen ( $j [0] ) ), '%23', true );
//							$key = substr ( $j [0], 0, $pos_ + 2 );
//							$key_in = substr ( $j [0], $pos_ + 5, strlen ( $j [0] ) );
//							$key_in = substr ( $key_in, 0, strlen ( $key_in ) - 3 );
//							$return [$key] [$key_in] = $j [1];
//						} else
//							$return [$j [0]] = $j [1];
//					}
//				}
//				return $return;
//			}
//		}
?>