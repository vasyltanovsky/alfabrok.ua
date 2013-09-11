<?php global $arWords; ?>
<?php $m = new ModuleSiteIm(array(), $arWords, $Model->dictionaries, $Model->propertiesData->ImPropData, $Model->propertiesData->ImPropArrData);?>
<?php if($Model):?>
	<table cellpadding="0" cellspacing="0" border="0" class="TablePropAdvased">
		<?php echo $m->GetPropListImgText($Model->item, null);?>
	</table>
</div>
<?php endif;?>			