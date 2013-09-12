<?php 
global $routingObj;
global $renderHtmlLinkObj;
$renderHtmlLinkObj->addJs("js/libs/highslide/highslide-with-gallery-ru");
$renderHtmlLinkObj->addJs("js/ant/libs/immovables.item");  
$renderHtmlLinkObj->addCss("js/libs/highslide/highslide");
?>
<div class="DivImOneTitle"><a href="javascript: history.go(-1)" alt="<?php echo getLangString("btm_back");?>" title="<?php echo getLangString("btm_back");?>"><span class="ui-icon ui-icon-circle-triangle-w"></span><?php echo getLangString("btm_back");?></a><span class="DivTitleImOneSpan"><?php echo $Model->item["im_title"];?></span></div>
<div class="DivImOne">
	<table cellpadding="0" cellspacing="0" border="0" class="TableOneImmovableHeder">
		<tr>
			<td class="TOIItdPhotoIndex">
				<a onclick="return hs.expand(this)" href="<?php echo getLangString("imageDomain");?>/files/images/immovables/<?php echo $Model->item["im_photo"];?>" class="highslide"><img src="<?php echo getLangString("imageDomain");?>/files/images/immovables/si_<?php echo $Model->item["im_photo"];?>" alt="<?php echo $Model->item["im_title"];?>" title="<?php echo $Model->item["im_title"];?>"/></a>
			</td>
			<td class="TOIItdPhotos"><?php echo appHtmlClass::partialAction("immovables", "partailImages", $routingObj->getParam());?></td>
			<td class="TOIItdIminfo">
				<?php echo appHtmlClass::partial("immovables/details/adress", array("Model" => $Model));?>
				<?php echo appHtmlClass::partial("immovables/details/price", array("Data" => $Model->item));?>
				<?php echo appHtmlClass::partial("immovables/details/priceother", array("Data" => $Model->item, "key" => "im_prace_manth"));?>
			</td>
			<td class="TOIItdPropStandart">
				<?php echo appHtmlClass::partial("immovables/details/propStandart", array("Model" => $Model));?>
			</td>
			<td class="TOIItdFunctional">
				<a id="" href="http://admin.alfabrok.ua/report_center.php?im_id=<?php echo $Model->item["im_id"];?>&lang_id=1&act=word"  alt="<?php echo getLangString("SubmitImWord");?>" title="<?php echo getLangString("SubmitImWord");?>"><img src="<?php echo getLangString("imageDomain");?>/files/images/submit/submitWord.png" alt="<?php echo getLangString("SubmitImWord");?>" title="<?php echo getLangString("SubmitImWord");?>"/></a><br/>                           
				<a id="TOIItdFunctional" target="_blank" href="http://admin.alfabrok.ua/application/topdf/examples/pdf.php?im_id=<?php echo $Model->item["im_id"];?>&lang_id=1" alt="<?php echo getLangString("SubmitPdf");?>" target="_blank" title="<?php echo getLangString("SubmitPdf");?>"><img src="<?php echo getLangString("imageDomain");?>/files/images/submit/submitPdf.png" alt="<?php echo getLangString("SubmitImPrint");?>" title="<?php echo getLangString("SubmitPdf");?>"/></a><br/>
				<a id="" href="javascript:SendImToFriend(<?php echo $Model->item["im_id"]?>);" alt="<?php echo getLangString("SubmitImFriend");?>" title="<?php echo getLangString("SubmitImFriend");?>"><img src="<?php echo getLangString("imageDomain");?>/files/images/submit/submitMailFrient.png" alt="<?php echo getLangString("SubmitImFriend");?>" title="<?php echo getLangString("SubmitImFriend");?>"/></a><br/>
				<a id="" href="/ru/report/printpage/<?php echo $Model->item["im_id"];?>" alt="<?php echo getLangString("SubmitImPrint");?>" target="_blank" title="<?php echo getLangString("SubmitImPrint");?>"><img src="<?php echo getLangString("imageDomain");?>/files/images/submit/submitPrint.png" alt="<?php echo getLangString("SubmitImPrint");?>" title="<?php echo getLangString("SubmitImPrint");?>"/></a>
			</td>
		</tr>
	</table>
	<table cellpadding="0" cellspacing="0" border="0" class="TableOneImmovableInfo">
		<tr>
			<td class="TOIItdText">
				<?php echo appHtmlClass::partialAction("immovables", "partailSummary", $routingObj->getParam());?>
			</td>
			<td class="TOIItdProp">
				<?php echo appHtmlClass::partial("immovables/details/propAdviced", array("Model" => $Model));?>
			</td>
		</tr>
	</table>
	<table cellpadding="0" cellspacing="0" border="0" class="TableOneImmovableMapVideo">
		<tr>
			<td class="TOIMVtdMap">
				<span id="showFullOneMap"><span>&nbsp;</span><?php echo getLangString("formYMapSearchFullScreenTitle");?></span>
				<?php echo appHtmlClass::partial("immovables/details/ymap", array("Model" => $Model) )?>
			</td>
			<td class="TOIMVtdVideo">
				<?php echo appHtmlClass::partialAction("immovables", "partailPlan", $routingObj->getParam());?>
			</td>
		</tr>
	</table>
</div>
<!-- similar -->
<?php
$paramSimilar = array("is_cashe" => true, "im_is_sale" => true, "hide" => "show",  "im_catalog_id" => $Model->item["im_catalog_id"], "im_id" => $Model->item["im_id"], "im_area_id" => $Model->item["im_area_id"], "im_adress_id" => $Model->item["im_adress_id"], "im_space_like" => $Model->item["im_space"], "im_prace_like" => $Model->item["im_prace"], "limit" => 10);
echo appHtmlClass::partialAction("immovables", "similarList", $paramSimilar); 
?>
<script type="text/javascript">
	$(document).keydown(function(objEvent) {       
		if (objEvent.ctrlKey) {         
			if (objEvent.keyCode == 80) {               
				objEvent.preventDefault();           
				objEvent.stopPropagation();
				location.href = '/ru/report/printname/<?php echo $Model->item["im_id"]?>';
				return false;
			}           
		}       
	});
</script>