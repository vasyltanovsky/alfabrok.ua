<?php global $routingObj; ?>
<?php global $exchangeRateObj; ?>
<?php echo appHtmlClass::partial("immovables/immovablestypeform"); ?>
<?php echo appHtmlClass::partialActionFormat("immovables", "partialAdvancedSearchForm", $routingObj->getParam()); ?>
<?php if($Model->list):?>
	<?php echo appHtmlClass::partial("immovables/positiononpage"); ?>
		<?php echo appHtmlClass::partial("commercial/rentlist", array("Model"=> $Model));?>
	<?php echo $Model->pager; ?>
<?php else:?>
	<?php echo appHtmlClass::partial("immovables/immovablesnoposition"); ?>
	<!-- поиск возможных вариантов для вывода пользователю -->
	<?php $Model->getMayByList($routingObj->getParam (), "1",  "/ru/commercial/rent"); ?>
	<?php if($Model->list):?>
		<?php echo getLangString("mayByYouMine");?>
		<?php echo appHtmlClass::partial("commercial/rentlist", array("Model"=> $Model));?>
		<?php //$Model->pager; ?>
	<?php endif;?>
	<!-- поиск возможных вариантов для вывода пользователю -->
<?php endif;?>

		