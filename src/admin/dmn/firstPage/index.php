<?php
error_reporting ( E_ALL & ~ E_NOTICE ); // Устанавливаем соединение с базой данных
require_once ("../../config/config.php");
require_once DOC_ROOT . '/config/class.config.php';

// Подключаем блок авторизации
require_once ("../utils/security_mod.php");

#обработчик языка
require_once DOC_ROOT . '/application/includes/language/set.cookie.php';

$title = 'Добро пожаловать в панель управления сайтом.';
$pageinfo = '<p class=help>Здесь можно редактировать текствое наполнение страниц.</p>';

// Включаем заголовок страницы
require_once ("../utils/top.php");

try {
	
	?>

<script type="text/javascript">
$(document).ready(function(){
	$('#loading').hide();
});
</script>
<!-- AJAX-ответ от сервера заменит этот текст. -->
<div id="output" style="padding: 30px 20px"><strong
	style="padding: 20px"> Добро пожаловать в панель управления сайтом.</strong>
</div>
<?php
} catch ( ExceptionMySQL $exc ) {
	require ("../utils/exception_mysql.php");
}

// Включаем завершение страницы
require_once ("../utils/bottom.php");
?>