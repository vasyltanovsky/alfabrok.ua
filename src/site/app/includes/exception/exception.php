<?php
  error_reporting(E_ALL & ~E_NOTICE);
  echo "<p class=help>{$exc->getMessage()}</p>";
  echo "<p class=help><a href=# rel='nofollow' onclick='history.back()'>Вернуться</a></p>";
  exit();
?>