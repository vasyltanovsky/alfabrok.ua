<?php global $routingObj; ?>
<?php global $exchangeRateObj; ?>
<?php echo appHtmlClass::partial("immovables/immovablestypeform"); ?>
<?php echo appHtmlClass::partialActionFormat("immovables", "partialAdvancedSearchForm", $routingObj->getParam()); ?>
<?php if($Model->list):?>
	<?php echo appHtmlClass::partial("immovables/positiononpage"); ?>
	    <?php echo appHtmlClass::partial("land/salelist", array("Model"=> $Model));?>
		<?php echo $Model->pager; ?>
<?php else:?>
	<?php echo appHtmlClass::partial("immovables/immovablesnoposition"); ?>
<?php endif;?>

		