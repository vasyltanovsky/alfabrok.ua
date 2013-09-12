<?php $propPrintObj = new PropPrint ( $Model->dictionaries );?>
<?php global $routingObj;?>
<style>
table td{padding-bottom:10px; vertical-align:top} img{ margin-right:5px; margin-bottom:5px;}
</style>
<?php //devLogs::_printr();?>
<table cellpadding="0" cellspacing="0" border="0" width="1024px">
<tr>
	<td align="left">Код: <?php echo $Model->item["im_code"]?></td>
	<td align="center"><img width="200" src="<?php echo getLangString("imageDomain");?>/files/images/bg/alfabrok.logo.png"/></td>
	<td align="left"><?php echo appHtmlClass::partial("report/item/realtor", array("Model" => $Model->realtor))?></td>
</tr>												  
<tr>
	<td align="left">
		<img src="<?php echo getLangString("imageDomain");?>/files/images/immovables/si_<?php echo $Model->item["im_photo"]?>" alt="" title=""/>
	</td>
<td align="left">
	<?php echo GetImFildsDictValue ($Model->item, $Model->dictionaries);?>
	<?php echo GetImFildsValue ($Model->item, $Model->dictionaries);?>
	<?php echo appHtmlClass::partial("report/item/price", array("Model" => $Model->item, "param" => $routingObj->getParam()))?>
</td>
<td align="left">
	<?php echo $propPrintObj->GetPrint ( $Model->propertiesData->ImPropData ['is_print_st'] [$Model->item ['im_id']], 'GetTextWord' ); ?>
</td>
</tr>
<table cellpadding="0" cellspacing="0" border="0" width="1024px">
	<tr>
		<td align="left"  width="50%"><?php echo $Model->summary["im_su_text"]?></td>
		<td align="left"  width="50%" style="padding-left:15px;">
			<?php echo $propPrintObj->GetPrint ( $Model->propertiesData->ImPropData['is_print_ad'] [$Model->item ['im_id']], 'GetTextWord' ); ?>
		</td>
	</tr>	
</table>
<table cellpadding="0" cellspacing="0" border="0" width="1024px">
	<tr>
		<td align="left">
			<?php if($Model->imagesList):?>
				<?php foreach ($Model->imagesList as $key => $value):?>
					<img src="<?php echo getLangString("imageDomain");?>/files/images/immovables/si_<?php echo $value["im_photo_id"]?>.<?php echo $value["im_file_type"]?>">
				<?php endforeach;?>
			<?php endif;?>
		</td>
	</tr>
	<tr>
		<td align="center"><br>© 2010-2013 www.alfabrok.ua All rights reserved</td>
	</tr>		
</table>


