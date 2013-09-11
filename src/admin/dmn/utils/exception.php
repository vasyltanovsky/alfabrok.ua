<?php
  error_reporting(E_ALL & ~E_NOTICE);

  // Включаем заголовок страницы
  require_once("../utils/top.php");

  echo "<p class=help>{$exc->getMessage()}</p>";
  echo "<p class=help><a href=# onclick='history.back()'>Вернуться</a></p>";

  // Включаем завершение страницы
  require_once("../utils/bottom.php");
  exit();
?>