<?php
global $renderHtmlLinkObj;
$renderHtmlLinkObj->addJs ( "js/ant/libs/index.page" );
$renderHtmlLinkObj->addJs ( "js/ant/libs/ymap.search" );
?>
<?php echo appHtmlClass::partial ( "block/indexBanner", array ("cashe" => 1 ) ); ?>
<?php //echo appHtmlClass::partialAction("index", "partiallist", array("cashe"=>1, "s" => "s")); 
?>
<div class="clear"></div>
<div class="DivCenterPageNP">
  <div id="DivYMapPage">
    <table border="0" id="TableIndexPage" cellpadding="0" cellspacing="0" class="TableIndexPage">
      <tr>
        <td colspan="2"><h1 class="YMapTitle"><?php echo getLangString("formYMapTitle");?></h1>
          <a href="#" onclick="" title="<?php echo getLangString("formYMapSearchStrtScreenTitle");?>" class="hideFullScreen" id="hideFullScreen"><?php echo getLangString("formYMapSearchStrtScreen");?></a>		</td>
      </tr>
      <tr>
        <td id="TdYMap"><div id="YHelp">
            <div id="YHelpTypeObject">
              <h1 class="title"><?php echo getLangString("formYMapHelpObject_title");?></h1>
              <div class="list">
                <div class="pos"> <a href="#" onclick="setHelpSearch('4c3ec3ec5e9b5', 0);" title=""><?php echo getLangString("4c3ec3ec5e9b5");?></a> </div>
                <div class="pos"> <a href="#" onclick="setHelpSearch('4c3ec3ec5e9b7', 1);"><?php echo getLangString("4c3ec3ec5e9b7");?></a> </div>
                <div class="pos"> <a href="#" onclick="setHelpSearch('4c3ec51d537c0', 2);"><?php echo getLangString("4c3ec51d537c0");?></a> </div>
                <div class="pos"> <a href="#" onclick="setHelpSearch('4c3ec51d537c2', 3);"><?php echo getLangString("4c3ec51d537c2");?></a> </div>
                <div class="pos"> <a href="#" onclick="setHelpSearch('4c3ec51d537c3', 4);"><?php echo getLangString("4c3ec51d537c3");?></a> </div>
                <div class="clear"></div>
              </div>
              <div class="list">
                <div class="pos">
                  <p><?php echo getLangString("formYMapHelpObject_4c3ec3ec5e9b5");?></p>
                </div>
                <div class="pos">
                  <p><?php echo getLangString("formYMapHelpObject_4c3ec3ec5e9b7");?></p>
                </div>
                <div class="pos">
                  <p><?php echo getLangString("formYMapHelpObject_4c3ec51d537c0");?></p>
                </div>
                <div class="pos">
                  <p><?php echo getLangString("formYMapHelpObject_4c3ec51d537c2");?></p>
                </div>
                <div class="pos">
                  <p><?php echo getLangString("formYMapHelpObject_4c3ec51d537c3");?></p>
                </div>
                <div class="clear"></div>
              </div>
            </div>
          </div>
          <div id="yLoading"></div>
          <div id="indexYMap" style=" width:700px; height:520px;"></div>
          <div style="font-size:10px; line-height:1; display: none"><strong >Log</strong>
            <div id="RRSYM"></div>
            <strong>Action</strong>
            <div id="RRSYMNow"></div>
          </div></td>
        <td id="TdYMapForm"><h1 class="title"><?php echo getLangString("formYMapSearchTitle");?></h1>
          <a rel='nofollow' href="#" onclick="" title="<?php echo getLangString("formYMapSearchFullScreenTitle");?>" class="showFullScreen" id="showFullScreen"><span>&nbsp;</span><?php echo getLangString("formYMapSearchFullScreen");?> </a> <span title="<?php echo getLangString("formYMapSearchClean");?>" class="clean" id=""><span>&nbsp;</span><?php echo getLangString("formYMapSearchClean");?></span>
          <p id="CountSearchIm"><?php echo getLangString("formYMapSearchCount");?>: <span></span></p>
          <p class="RealEstateAds"><?php echo getLangString("formYMapSearchRealEstateAds");?></p>
          <form enctype="application/x-www-form-urlencoded" name="formYMapSearch" method="get" id="formYMapSearch" action="">
            <div class="fDiv">
              <label id="" class="lName"><?php echo getLangString("FormSearchNamePrice"); ?>:</label>
              <div class="clear"></div>
              <label id="" class="lMin"><?php echo getLangString("from"); ?></label>
              <input id="im_priceb" class="fMin" type="text" size="20" value="" name="im_priceb"/>
              <label id="" class="lMin"><?php echo getLangString("to"); ?></label>
              <input id="im_pricee" class="fMin" type="text" size="20" value="" name="im_pricee"/>
              <div class="clear"></div>
            </div>
            <div class="fDiv">
              <label id="" class="lName"><?php echo getLangString("FormSearchNameSqMS"); ?>:</label>
              <div class="clear"></div>
              <label id="" class="lMin"><?php echo getLangString("from"); ?></label>
              <input id="im_spaceb" class="fMin" type="text" size="20" value="" name="im_spaceb"/>
              <label id="" class="lMin"><?php echo getLangString("to"); ?></label>
              <input id="im_spacee" class="fMin" type="text" size="20" value="" name="im_spacee"/>
              <div class="clear"></div>
            </div>
            <div id="accYMapSearchTypeIm">
              <h3 id="accPosImLinkFlat" onclick="setActiveTypeIm( '4c3ec3ec5e9b5' );"><a href="#"><?php echo getLangString("ImLinkFlat");?></a></h3>
              <div id="blck-4c3ec3ec5e9b5">
                <input rel="4c3ec3ec5e9b5"  type="checkbox" title="" name="im_is_rent" id="" value="1"/>
                <label><?php echo getLangString("ImRent");?></label>
                <div class="clear"></div>
                <input rel="4c3ec3ec5e9b5" checked="checked" type="checkbox" title="" name="im_is_sale" id="" value="1"/>
                <label><?php echo getLangString("ImSale");?></label>
                <div class="clear"></div>
                <div class="fDiv">
                  <label id="" class="lName"><?php echo getLangString("lYMapSearchCountRoom"); ?></label>
                  <div class="clear"></div>
                  <label id="" class="lMin"><?php echo getLangString("from"); ?></label>
                  <input rel="4c3ec3ec5e9b5" id="im_roomb" class="fMin" type="text" size="20" value="" name="im_roomb"/>
                  <label id="" class="lMin"><?php echo getLangString("to"); ?></label>
                  <input rel="4c3ec3ec5e9b5" id="im_roome" class="fMin" type="text" size="20" value="" name="im_roome"/>
                  <div class="clear"></div>
                </div>
              </div>
              <h3 id="accPosImLinkCommercial" onclick="setActiveTypeIm( '4c3ec3ec5e9b7' );"><a href="#"><?php echo getLangString("ImLinkCommercial");?></a></h3>
              <div id="blck-4c3ec3ec5e9b7">
                <input rel="4c3ec3ec5e9b7" type="checkbox" title="" name="im_is_rent" id="" value="1"/>
                <label><?php echo getLangString("ImRent");?></label>
                <div class="clear"></div>
                <input rel="4c3ec3ec5e9b7" type="checkbox" title="" name="im_is_sale" id="" value="1"/>
                <label><?php echo getLangString("ImSale");?></label>
                <div class="clear"></div>
              </div>
              <h3 id="accPosImLinkHome" onclick="setActiveTypeIm( '4c3ec51d537c0' );"><a href="#"><?php echo getLangString("ImLinkHome");?></a></h3>
              <div id="blck-4c3ec51d537c0">
                <input rel="4c3ec51d537c0" type="checkbox" title="" name="im_is_rent" id="" value="1"/>
                <label><?php echo getLangString("ImRent");?></label>
                <div class="clear"></div>
                <input rel="4c3ec51d537c0" type="checkbox" title="" name="im_is_sale" id="" value="1"/>
                <label><?php echo getLangString("ImSale");?></label>
                <div class="clear"></div>
              </div>
              <h3 id="accPosImLinkBuildings" onclick="setActiveTypeIm( '4c3ec51d537c2' );"><a href="#"><?php echo getLangString("ImLinkBuildings");?></a></h3>
              <div id="blck-4c3ec51d537c2">
                <input rel="4c3ec51d537c2" type="checkbox" title="" name="im_is_rent" id="" value="1"/>
                <label><?php echo getLangString("ImRent");?></label>
                <div class="clear"></div>
                <input rel="4c3ec51d537c2" type="checkbox" title="" name="im_is_sale" id="" value="1"/>
                <label><?php echo getLangString("ImSale");?></label>
                <div class="clear"></div>
              </div>
              <h3 id="accPosImLinkLand" onclick="setActiveTypeIm( '4c3ec51d537c3' );"><a href="#"><?php echo getLangString("ImLinkLand");?></a></h3>
              <div id="blck-4c3ec51d537c3">
                <input rel="4c3ec51d537c3" type="checkbox" title="" name="im_is_sale" id="" value="1"/>
                <label><?php echo getLangString("ImSale");?></label>
                <div class="clear"></div>
              </div>
            </div>
            <a href="" rel='nofollow' title="<?php echo getLangString("btmYMapSearch");?>" class="" id="btmYMapSearch"><?php echo getLangString("btmYMapSearch");?></a>
          </form>
          <!-- <a href="#" onclick="" title="<?php echo getLangString("formYMapSearchInfrastructure");?>" class="link" id=""><?php echo getLangString("formYMapSearchInfrastructure");?></a> -->
          <hr />
          <!-- <span title="<?php //echo getLangString("formYMapSearchShowHelp");?>" class="help" id="showHelp"><span>&nbsp;</span><?php //echo getLangString("formYMapSearchShowHelp");?></span>
        <span title="<?php //echo getLangString("formYMapSearchHideHelp");?>" class="help" id="hideHelp"><span>&nbsp;</span><?php //echo getLangString("formYMapSearchHideHelp");?></span> -->
          <div class="claer"></div>
          <span title="<?php echo getLangString("formYMapSearchShowInfrastricture");?>" class="infra" id="showInfra"><span>&nbsp;</span><?php echo getLangString("formYMapSearchShowInfrastricture");?></span> <span title="<?php echo getLangString("formYMapSearchHideInfrastricture");?>" class="infra" id="hideInfra"><span>&nbsp;</span><?php echo getLangString("formYMapSearchHideInfrastricture");?></span></td>
      </tr>
      <tr>
        <td colspan="2" style="padding:10px 0 0 0;"><?php echo appHtmlClass::partialAction("immovables", "partialListLink", array( "cashe" => 1, )); ?></td>
      </tr>
      <tr>
        <td colspan="2" style="padding:20px 0 0 0;"><?php echo appHtmlClass::partialAction("immovables", "partialListMinPrice", array( "cashe" => 1, "hide" => "show" )); ?></td>
      </tr>
    </table>
  </div>
</div>
<script type="text/javascript">
	<?php echo $javaImData;?>
</script>