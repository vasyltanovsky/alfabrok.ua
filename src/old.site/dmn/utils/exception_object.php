<?php
  error_reporting(E_ALL & ~E_NOTICE);

  // Включаем заголовок страницы
  require_once("../utils/top.php");

  echo "<p class=help>Произошла исключительная 
        ситуация (ExceptionObject) - попытка 
        использования в качестве элемента управления
        объекта, класс которого не является 
        производным от базового класса field.
        {$exc->getMessage()}.</p>";
  echo "<p class=help>Ошибка в файле {$exc->getFile()}
        в строке {$exc->getLine()}.</p>";

  // Включаем завершение страницы
  require_once("../utils/bottom.php");
  exit();
?>