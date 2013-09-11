<?php if($Model->summary):?>
	<h3 class="ImSummaryHeader"><?php echo getLangString("ImSummaryHeader");?></h3>
	<div id="DivSummaryTextId"><?php echo $Model->summary["im_su_text"]?></div>
<?php endif;?>