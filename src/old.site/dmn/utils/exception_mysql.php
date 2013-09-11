<?php
  error_reporting(E_ALL & ~E_NOTICE);

  // Обрабатываем исключения, возникающие при 
  // обращении к СУБД MySQL

  // Включаем заголовок страницы
  require_once("../utils/top.php");

  echo "<p class=help>Произошла исключительная 
        ситуация (ExceptionMySQL) при обращении
        к СУБД MySQL.</p>";
  echo "<p class=help>{$exc->getMySQLError()}<br>
       ".nl2br($exc->getSQLQuery())."</p>";
  echo "<p class=help>Ошибка в файле {$exc->getFile()}
        в строке {$exc->getLine()}.</p>";

  // Включаем завершение страницы
  require_once("../utils/bottom.php");
  exit();
?>