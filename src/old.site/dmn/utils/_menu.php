<?php
error_reporting ( E_ALL & ~ E_NOTICE );

// Анализируем содержимое каталога системы
// администрирования для формирования меню


// Открываем каталог /dmn
$dir = opendir ( ".." );

$rolesAdmin = explode ( ",", $_COOKIE ["roles"] );
// В цикле проходимся по всем файлам и
// подкаталогам
while ( ($file = readdir ( $dir )) !== false ) {
	// Обрабатываем только подкаталоги, 
	// игнорируя файлы
	if (is_dir ( "../$file" )) {
		// Исключаем текущий ".", родительский ".."
		// каталоги, а также каталог utils
		if ($file != "." && $file != ".." && $file != "utils" && $file != ".svn" && $file != "firstPage") {
			// Ищем в каталоге файл с описанием
			// блока .htdir
			if (file_exists ( "../$file/.htdir" )) {
				// Файл .htdir существует - 
				// читаем название блока и его
				// описание
				list ( $block_name, $block_rools, $block_action ) = file ( "../$file/.htdir" );
			} else {
				// Файл .htdir не существует -
				// в качестве его названия 
				// выступает имя подкаталога
				$block_name = "$file";
				$block_description = "";
			}
			
			// Отмечаем текущий пункт другим стилем
			if (strpos ( $_SERVER ['PHP_SELF'], $file ) !== false)
				$style = "class=\"menu-link-a\"";
			else
				$style = "class=\"menu-link-na\"";
			
			if ($block_name != "enterDmn") {
				if (strpos ( $_COOKIE ["roles"], $block_rools ) || empty($block_rools)) {
					
					echo $menu_item = sprintf ( "<div class=\"menu-item\"><a id=\"main-menu-item-%s\" title=\"%s\" href=\"%s\" %s onclick=\"%s\">%s</a><div id=\"%s\"></div></div>", $file, $block_name, ($block_action == "" ? "../" . $file : "#"), $style, ($block_action == "" ? "" : $block_action), $block_name, $file );
					
				//	echo "<a $style href='../$file'  title='$block_name'>$block_name</a><div id='{$file}'></div>";
				}
				else {
					echo $block_name . "<br/>";
					echo $block_rools . "<br/>";
					echo $_COOKIE ["roles"] . "<br/>";
				}
			}
		}
	}
}
// Закрываем каталог
closedir ( $dir );
?>