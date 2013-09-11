<?php
		require_once 'application/module/immovables/f.immobles.php';
		include_once 'application/includes/immovables/setting.im.print.ymap.inc';

		$ClModuleSite = new ModuleSite($ModuleTemplate);
	#
		$ClNews	= new mysql_select($tbl_news,
									"WHERE hide='show' AND lang_id={$_COOKIE[lang_id]} ORDER BY news_date DESC LIMIT 10");
		$ClNews	->select_table('news_id');
		if ($ClNews ->table) {
			$Content['NewsBlock'] = $ClModuleSite ->Handler_Template_Html('news_dynamic_block',$ClNews->table);
		}
	#
		$ClIndexImLink = new mysql_select($tbl_im_link,
										 "WHERE lang_id = {$_COOKIE['lang_id']} ORDER BY RAND(10)");
		$ClIndexImLink->select_table("il_id");
		
		$Content['im_link']		= "";
		if($ClIndexImLink->table){
			//
			$sorterImLink = sorterImLink($ClIndexImLink->table, $ModuleTemplate['index_im_link']);
			$Content['im_link'] = ModuleSite::For_HTML($ModuleTemplate['index_im_link_bock'], $sorterImLink);
			//$Content['im_link'] =  $ModuleTemplate['index_im_link_bock'];
		}
	#
		$ClImMinPrice = new ImListPrint("i WHERE i.hide='show' AND i.im_photo != 'imnoimage.png' AND i.im_prace < i.im_prace_old and im_is_sale=1 limit 20", 
										$ModuleTemplate,
										$TemplateImList,
										$dictionaries,
										$arWords);
										
		$Content['ImMinPrice'] = $ClImMinPrice -> GetContent('div_im_list_ban_block', $arr = array('title' => $arWords['ImDivListHeaderPrice'], 's_im_link' => 'hot_price'), 'DivListMinPrice');
		
//		$ClImHOT = new ImListPrint("i WHERE i.im_is_hot=1 AND i.im_photo != 'imnoimage.png' ORDER BY RAND() LIMIT 4", 
//										$ModuleTemplate,
//										$TemplateImList,
//										$dictionaries,
//										$arWords);
//										
//		$Content['ImHOT'] = $ClImHOT -> GetContent('div_im_list_hot_block', $arr = array('title' => $arWords['ImDivListHeaderHot'], 's_im_link' => 'hot_im'), 'DivListMinPrice');
		
		#объявляем класс словаря
		$dictionaries = new dictionaries ( );
		#формируем массив имени словарей
		$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries );
		#формируем массив значений словарей
		$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = {$_COOKIE['lang_id']} ORDER BY dict_name" );
		
		#
		/*$ClYIm = new mysql_select ( $tbl_im );
		$ClYIm->select_table_query ( "select i.im_title, i.im_id, i.im_code, i.im_catalog_id, 
											  i.im_city_id, dc.dict_name as im_city_name, 
											  i.im_area_id, dre.dict_name as im_area_name,  
											  i.im_adress_id, dad.dict_name as im_adress_name, 
											  i.im_adress_house, i.im_prace, i.im_prace_old, i.im_prace_sq, i.im_prace_day, i.im_prace_manth, i.im_photo, i.im_space, i.im_space_value_id, i.hide, i.im_is_sale, i.im_is_rent, i.im_code_input, i.im_geopos
											  from {$tbl_im} i 
											  left join {$tbl_dictionaries} dc on i.im_city_id = dc.dict_id and dc.lang_id = {$_COOKIE[lang_id]}
											  left join {$tbl_dictionaries} dre on i.im_area_id = dre.dict_id and dre.lang_id = {$_COOKIE[lang_id]}
											  left join {$tbl_dictionaries} dad on i.im_adress_id = dad.dict_id and dad.lang_id = {$_COOKIE[lang_id]}
											  where i.hide='show' limit 20" );*/
		$ClYIm = new mysql_select ( $tbl_im );
		$ClYIm->select_table_query ( "select i.im_title, i.im_id, i.im_code, i.im_catalog_id, 
											  i.im_city_id,
											  i.im_area_id,
											  i.im_adress_id,
											  i.im_adress_house, i.im_prace, i.im_prace_old, i.im_prace_sq, i.im_prace_day, i.im_prace_manth, i.im_photo, i.im_space, i.im_space_value_id, i.hide, i.im_is_sale, i.im_is_rent, i.im_code_input, i.im_geopos
											  from {$tbl_im} i 
											  where i.hide='show' limit 20" );
		$data = $ClYIm->table;
		
		//$response['imData'] = $ClYIm->table;
		#выборка характеристик недвижимости	
		$ImPropListInfo = new mysql_select ( $tbl_im_pl, "l left join {$tbl_im_pi} i ON l.im_prop_id = i.im_prop_id where l.type_prop = 'standard'", "order by l.im_prop_name ASC" );
		$ImPropListInfo->select_table ( "im_prop_id" );
		
		#преобразование данных характеристик и значений
		$ImPropData = new PropSort ( $ImPropListInfo->table );
		$ImPropData->GetArrToPrint ( 'im_id', array ('is_print_list', 'is_print_ad', 'is_print_st' ) );
		
		$javaImData = getImToYMapJS ( $ClYIm, $ImPropData );
?>
<script type="text/javascript">
	$(function() {
		var icons = {
			header: "ui-icon-ymap-arrow-e",
			headerSelected: "ui-icon-ymap-arrow-s"
		};
		$("#accYMapSearchTypeIm").accordion({
			icons:false,
			autoHeight: false,
			active: false,
			navigation: false,
			collapsible: true
		});
	});
	<?php echo $javaImData;?>
</script>

<div class="clear"></div>
<div class="DivCenterPageNP">
<div id="DivYMapPage">
  <table border="0" id="TableIndexPage" cellpadding="0" cellspacing="0" class="TableIndexPage">
     <tr>
      <td colspan="2"><!--<div id="divYSearchAdress">
          <p class="help"><?php echo $arWords['helpYSearchAdress'];?></p>
          <form enctype="application/x-www-form-urlencoded" name="formYSearchAdress" method="get" id="formYSearchAdress" action="">
            <input type="text" name="fieldYSearchAdress" value="" title="<?php echo $arWords['helpYSearchAdress'];?>" id="fieldYSearchAdress">
            <input type="submit" value="<?php echo $arWords['btmYSearchAdress'];?>" title="<?php echo $arWords['btmYSearchAdress'];?>" name="btmYSearchAdress" id="btmYSearchAdress">
          </form>
          <p class="example"><?php echo $arWords['helpExampleYSearchAdress'];?></p>
        </div> -->
        <h1 class="YMapTitle"><?php echo $arWords['formYMapTitle'];?></h1> <a href="#" onclick="" title="<?php echo $arWords['formYMapSearchStrtScreenTitle'];?>" class="hideFullScreen" id="hideFullScreen"><?php echo $arWords['formYMapSearchStrtScreen'];?></a></td>
    </tr>
    <tr>
      <td id="TdYMap">
      	<div id="YHelp">
      		<div id="YHelpTypeObject">
      			<h1 class="title"><?php echo $arWords['formYMapHelpObject_title'];?></h1>
      			<div class="list">
      				<div class="pos">
      					<a href="#" onclick="setHelpSearch('4c3ec3ec5e9b5', 0);" title=""><?php echo $arWords['4c3ec3ec5e9b5'];?></a>
      				</div>
      				<div class="pos">
      					<a href="#" onclick="setHelpSearch('4c3ec3ec5e9b7', 1);"><?php echo $arWords['4c3ec3ec5e9b7'];?></a>
      				</div>
      				<div class="pos">
      					<a href="#" onclick="setHelpSearch('4c3ec51d537c0', 2);"><?php echo $arWords['4c3ec51d537c0'];?></a>
      				</div>
      				<div class="pos">
      					<a href="#" onclick="setHelpSearch('4c3ec51d537c2', 3);"><?php echo $arWords['4c3ec51d537c2'];?></a>
      				</div>
      				<div class="pos">
      					<a href="#" onclick="setHelpSearch('4c3ec51d537c3', 4);"><?php echo $arWords['4c3ec51d537c3'];?></a>
      				</div>
      				<div class="clear"></div>
      			</div>
      			<div class="list">
      				<div class="pos">
      					<p><?php echo $arWords['formYMapHelpObject_4c3ec3ec5e9b5'];?></p>
      				</div>
      				<div class="pos">
      					<p><?php echo $arWords['formYMapHelpObject_4c3ec3ec5e9b7'];?></p>
      				</div>
      				<div class="pos">
      					<p><?php echo $arWords['formYMapHelpObject_4c3ec51d537c0'];?></p>
      				</div>
      				<div class="pos">
      					<p><?php echo $arWords['formYMapHelpObject_4c3ec51d537c2'];?></p>
      				</div>
      				<div class="pos">
      					<p><?php echo $arWords['formYMapHelpObject_4c3ec51d537c3'];?></p>
      				</div>
      				<div class="clear"></div>
      			</div>
      			
      		</div>
      	</div>
      	<div id="yLoading"></div><div id="indexYMap" style=" width:700px; height:520px;"></div>
        <div style="font-size:10px; line-height:1; display: none"><strong >Log</strong>
          <div id="RRSYM"></div>
          <strong>Action</strong>
          <div id="RRSYMNow"></div>
        </div></td>
      <td id="TdYMapForm"><h1 class="title"><?php echo $arWords['formYMapSearchTitle'];?></h1>
        <a href="#" onclick="" title="<?php echo $arWords['formYMapSearchFullScreenTitle'];?>" class="showFullScreen" id="showFullScreen"><span>&nbsp;</span><?php echo $arWords['formYMapSearchFullScreen'];?> </a>
        <span title="<?php echo $arWords['formYMapSearchClean'];?>" class="clean" id=""><span>&nbsp;</span><?php echo $arWords['formYMapSearchClean'];?></span>
        <p id="CountSearchIm"><?php echo $arWords['formYMapSearchCount'];?>: <span></span></p>
        <p class="RealEstateAds"><?php echo $arWords['formYMapSearchRealEstateAds'];?></p>
        <form enctype="application/x-www-form-urlencoded" name="formYMapSearch" method="get" id="formYMapSearch" action="">
           <div class="fDiv">
            <label id="" class="lName"><?php echo $arWords['FormSearchNamePrice']; ?>:</label>
            <div class="clear"></div>
            <label id="" class="lMin"><?php echo $arWords['from']; ?></label>
            <input id="im_priceb" class="fMin" type="text" size="20" value="" name="im_priceb">
            <label id="" class="lMin"><?php echo $arWords['to']; ?></label>
            <input id="im_pricee" class="fMin" type="text" size="20" value="" name="im_pricee">
            <div class="clear"></div>
          </div>
          <div class="fDiv">
            <label id="" class="lName"><?php echo $arWords['FormSearchNameSqMS']; ?>:</label>
            <div class="clear"></div>
            <label id="" class="lMin"><?php echo $arWords['from']; ?></label>
            <input id="im_spaceb" class="fMin" type="text" size="20" value="" name="im_spaceb">
            <label id="" class="lMin"><?php echo $arWords['to']; ?></label>
            <input id="im_spacee" class="fMin" type="text" size="20" value="" name="im_spacee">
            <div class="clear"></div>
          </div>
          <div id="accYMapSearchTypeIm">
            <h3 id="accPosImLinkFlat" onclick="setActiveTypeIm( '4c3ec3ec5e9b5' );"><a href="#"><?php echo $arWords['ImLinkFlat'];?></a></h3>
            <div id="blck-4c3ec3ec5e9b5">
              <input rel="4c3ec3ec5e9b5"  type="checkbox" title="" name="im_is_rent" id="" value="1"/>
              <label for=""><?php echo $arWords['ImRent'];?></label>
              <div class="clear"></div>
              <input rel="4c3ec3ec5e9b5" checked="checked" type="checkbox" title="" name="im_is_sale" id="" value="1"/>
              <label for=""><?php echo $arWords['ImSale'];?></label>
              <div class="clear"></div>
              <div class="fDiv">
                <label id="" class="lName"><?php echo $arWords['lYMapSearchCountRoom']; ?></label>
                <div class="clear"></div>
                <label id="" class="lMin"><?php echo $arWords['from']; ?></label>
                <input rel="4c3ec3ec5e9b5" id="im_roomb" class="fMin" type="text" size="20" value="" name="im_roomb">
                <label id="" class="lMin"><?php echo $arWords['to']; ?></label>
                <input rel="4c3ec3ec5e9b5" id="im_roome" class="fMin" type="text" size="20" value="" name="im_roome">
                <div class="clear"></div>
              </div>
            </div>
            <h3 id="accPosImLinkCommercial" onclick="setActiveTypeIm( '4c3ec3ec5e9b7' );"><a href="#"><?php echo $arWords['ImLinkCommercial'];?></a></h3>
            <div id="blck-4c3ec3ec5e9b7">
              <input rel="4c3ec3ec5e9b7" type="checkbox" title="" name="im_is_rent" id="" value="1"/>
              <label for=""><?php echo $arWords['ImRent'];?></label>
              <div class="clear"></div>
              <input rel="4c3ec3ec5e9b7" type="checkbox" title="" name="im_is_sale" id="" value="1"/>
              <label for=""><?php echo $arWords['ImSale'];?></label>
              <div class="clear"></div>
            </div>
            <h3 id="accPosImLinkHome" onclick="setActiveTypeIm( '4c3ec51d537c0' );"><a href="#"><?php echo $arWords['ImLinkHome'];?></a></h3>
            <div id="blck-4c3ec51d537c0">
              <input rel="4c3ec51d537c0" type="checkbox" title="" name="im_is_rent" id="" value="1"/>
              <label for=""><?php echo $arWords['ImRent'];?></label>
              <div class="clear"></div>
              <input rel="4c3ec51d537c0" type="checkbox" title="" name="im_is_sale" id="" value="1"/>
              <label for=""><?php echo $arWords['ImSale'];?></label>
              <div class="clear"></div>
            </div>
            <h3 id="accPosImLinkBuildings" onclick="setActiveTypeIm( '4c3ec51d537c2' );"><a href="#"><?php echo $arWords['ImLinkBuildings'];?></a></h3>
            <div id="blck-4c3ec51d537c2">
              <input rel="4c3ec51d537c2" type="checkbox" title="" name="im_is_rent" id="" value="1"/>
              <label for=""><?php echo $arWords['ImRent'];?></label>
              <div class="clear"></div>
              <input rel="4c3ec51d537c2" type="checkbox" title="" name="im_is_sale" id="" value="1"/>
              <label for=""><?php echo $arWords['ImSale'];?></label>
              <div class="clear"></div>
            </div>
            <h3 id="accPosImLinkLand" onclick="setActiveTypeIm( '4c3ec51d537c3' );"><a href="#"><?php echo $arWords['ImLinkLand'];?></a></h3>
            <div id="blck-4c3ec51d537c3">
              <input rel="4c3ec51d537c3" type="checkbox" title="" name="im_is_sale" id="" value="1"/>
              <label for=""><?php echo $arWords['ImSale'];?></label>
              <div class="clear"></div>
            </div>
          </div>
          <a href="#" title="<?php echo $arWords['btmYMapSearch'];?>" class="" id="btmYMapSearch"><?php echo $arWords['btmYMapSearch'];?></a>
        </form>
        <!-- <a href="#" onclick="" title="<?php echo $arWords['formYMapSearchInfrastructure'];?>" class="link" id=""><?php echo $arWords['formYMapSearchInfrastructure'];?></a> -->
        <hr />
        <!-- <span title="<?php //echo $arWords['formYMapSearchShowHelp'];?>" class="help" id="showHelp"><span>&nbsp;</span><?php //echo $arWords['formYMapSearchShowHelp'];?></span>
        <span title="<?php //echo $arWords['formYMapSearchHideHelp'];?>" class="help" id="hideHelp"><span>&nbsp;</span><?php //echo $arWords['formYMapSearchHideHelp'];?></span> -->
        <div class="claer"></div>
        <span title="<?php echo $arWords['formYMapSearchShowInfrastricture'];?>" class="infra" id="showInfra"><span>&nbsp;</span><?php echo $arWords['formYMapSearchShowInfrastricture'];?></span>
        <span title="<?php echo $arWords['formYMapSearchHideInfrastricture'];?>" class="infra" id="hideInfra"><span>&nbsp;</span><?php echo $arWords['formYMapSearchHideInfrastricture'];?></span>
        <!-- 
        
        <input type="checkbox" title="" name="" id="" value=""/>
                <label></label>
                <div class="clear"></div>
                
        
        <a href="#" onclick="" title="" class="" id=""></a>
            <a href="#" onclick="" title="" class="" id=""></a>
            <a href="#" onclick="" title="" class="" id=""></a>
            <a href="#" onclick="" title="" class="" id=""></a>--></td>
    
    </tr>
    <tr>
		<td colspan="2" style="padding:10px 0 0 0;"><?php echo $Content['im_link'];?></td>
	</tr>
    <tr>
    	<td colspan="2" style="padding:20px 0 0 0;"> <?php echo $Content['ImMinPrice'];?></td>
	</tr>
	</table>
</div>
</div>
