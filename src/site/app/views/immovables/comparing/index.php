<?php
global $renderHtmlLinkObj;
global $arWords;
$renderHtmlLinkObj->addJs ( "js/libs/jquery.bxslider.min" );
$renderHtmlLinkObj->addJs ( "js/libs/jquery.synctranslit" );
$renderHtmlLinkObj->addJs ( "js/ant/libs/comparing" );
?>
<?php if(!empty($Model->list)): ?>
<?php $Model->buildDictionaries(); ?>
<?php $m = new ModuleSiteIm(array(), $arWords, $Model->dictionaries, $Model->propertiesData->ImPropData, $Model->propertiesData->ImPropArrData);?>
<div class="comparing-list">
	<div class="param-list">
		<div class="header">
		</div>
		<div class="params">
			<span class="izobrazhenie"><?php echo getLangString("ImFListHeaderImg")?></span>
			<span class="kod"><?php echo getLangString("ImFListHeaderCodeN")?></span>
			<span class="oblast"><?php echo getLangString("FormSearchNameRegion")?></span>
			<span class="r-n-oblasti"><?php echo getLangString("FormSearchNameRRegionN")?></span>
			<span class="gorod-poselok"><?php echo getLangString("FormSearchNameCity")?></span>
			<span class="r-n-goroda"><?php echo getLangString("FormSearchNameACityN")?></span>
			<span class="ulitsa"><?php echo getLangString("FormSearchNameAdress")?></span>
			<a href="" class="tsena-prodazha" title="<?php echo getLangString("fai_fv_im_prace")?>"><?php echo substr(getLangString("fai_fv_im_prace"), 0, strlen(getLangString("fai_fv_im_prace")) - 1)?><?php echo $value["im_prop_name"]?><span class="to"><?php echo getLangString("comparingParamTo")?></span><span class="from"><?php echo getLangString("comparingParamFrom")?></span></a>
			<a href="" class="tsena-arenda" title="<?php echo getLangString("fai_fv_im_prace_manth")?>"><?php echo substr(getLangString("fai_fv_im_prace_manth"), 0, strlen(getLangString("fai_fv_im_prace_manth")) - 1)?><?php echo $value["im_prop_name"]?><span class="to"><?php echo getLangString("comparingParamTo")?></span><span class="from"><?php echo getLangString("comparingParamFrom")?></span></a>
			<a href="" class="tsena-za-m2" title="<?php echo getLangString("ImFListHeaderM2Sotku")?>"><?php echo getLangString("ImFListHeaderM2Sotku")?><?php echo $value["im_prop_name"]?><span class="to"><?php echo getLangString("comparingParamTo")?></span><span class="from"><?php echo getLangString("comparingParamFrom")?></span></a>
			<a href="" class="obschaja-ploschad" title="<?php echo getLangString("FormSearchNameSq")?>"><?php echo getLangString("FormSearchNameSq")?><?php echo $value["im_prop_name"]?><span class="to"><?php echo getLangString("comparingParamTo")?></span><span class="from"><?php echo getLangString("comparingParamFrom")?></span></a>
			<div class="properties">
				<?php if($Model->propertiesListGroup):?>
					<?php foreach ($Model->propertiesListGroup as $key => $value):?>
						<a href="" class="<?php echo strtolower(translit($value["im_prop_name"]))?>" title="<?php echo $value["im_prop_name"]?>"><?php echo $value["im_prop_name"]?><span class="to"><?php echo getLangString("comparingParamTo")?></span><span class="from"><?php echo getLangString("comparingParamFrom")?></span></a>
					<?php endforeach;?>
				<?php endif;?>
			</div>
		</div>
	</div>
	<div class="item-list">
		<div class="item-list-inner">
			<?php $comparinglist = json_decode($_COOKIE["comparing"]); //devLogs::_printr($Model->listData); ?>
			<ul id="comparing-sort" class="comparison-slider">
				<?php foreach (json_decode($_COOKIE["comparing"]) as $key => $value) :?>
				 	<?php echo appHtmlClass::partial("immovables/comparing/item", array("Model"=> $Model, "m" => $m, "item" => $Model->listData[$value]));?>
	 			<?php endforeach;?>
			</ul>
		</div>
	</div>
	<div class="clear"></div>
</div>
<?php else:?>
	<div class="comparing-no-item-list"><?php echo getLangString("comparingNoSelectedItems")?></div>
<?php endif;?>
	<div class="comparing-no-item-list hide"><?php echo getLangString("comparingNoSelectedItems")?></div>
<style>
	.comparing-list p { margin:0; padding:0; }
  	.comparing-list .param-list { padding:1px 5px 0 0; width: 195px; display: inline-block; float: left; }
  	.comparing-list .header { height: 20px; line-height: 20px; }
		.comparing-list .header a { }
		.comparing-list .params { }
			.comparing-list .params .izobrazhenie { height: 155px; }
				.comparing-list .params .izobrazhenie img { width:150px; }
			.comparing-list .params .kod { font-weight: bold; }
				.comparing-list .params .properties { margin: 10px 0 0 0;}
			.comparing-list .params a { display:block; height: 20px; line-height: 20px; border-bottom:1px solid #dfdfdf; text-decoration: none; color: #333333; }
			.comparing-list .params a span { float:right; border: none; margin: 0 0 0 5px; color:#3A7BEE; }
			.comparing-list .params a span.sort { text-decoration: underline; }
			.comparing-list .params a.span { color: #333333; cursor: text; }
				.comparing-list .params a.span span { display: none; }
			.comparing-list .params span {  display:block; height: 20px; line-height: 20px; border-bottom:1px solid #dfdfdf; }
/*   	.comparing-list .item-list { width: 770px; display: inline-block; float: left; } */
  		.comparing-list .item-list .header { text-align: right; }
  		.comparing-list .large { height: 50px!important; }
	
  		.item-list { width: 800px; overflow-x:auto; overflow-y:hidden; }
  		.item-list-inner {}
  		
  	#comparing-sort { width:1000px; list-style: inside; margin: 0; padding: 0; max-height:200px; padding: 0; margin: 0; }
 	#comparing-sort li.ui-state-default { background:none; margin: 0 5px 0 0; display:inline; float: left; padding:0 0 0 4px; width: 150px; text-align: center; border:none; border-left:1px solid #dfdfdf; }
  	.bx-controls-direction { display: none;}
  	#comparing-sort li.ui-sortable-helper { border:1px solid #000; }
 </style>