<?php
/**
 * джоба реализует связку между позициями недвижимости и wiki элементами
 */
require 'config.php';

// формируем версию языка
global $arWords;
$arWords = initLang ( "ru" );
header ( 'Content-Type: text/html; charset=utf-8' );
checkWikiImmovables ();