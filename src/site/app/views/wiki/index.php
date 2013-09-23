<?php global $routingObj; ?>
<?php echo appHtmlClass::partialAction("wiki", "menu")?>
<?php echo appHtmlClass::partial("wiki/articleslist", array("Model" => $Model)); ?>
