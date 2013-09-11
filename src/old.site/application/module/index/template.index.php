<?php
require_once 'application/module/immovables/f.immobles.php';

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
										 "WHERE lang_id = {$_COOKIE['lang_id']} ORDER BY RAND(40)");
		$ClIndexImLink->select_table("il_id");
		
		$Content['im_link']		= "";
		if($ClIndexImLink->table){
			//
			$sorterImLink = sorterImLink($ClIndexImLink->table, $ModuleTemplate['index_im_link']);
			$Content['im_link'] = ModuleSite::For_HTML($ModuleTemplate['index_im_link_bock'], $sorterImLink);
			//$Content['im_link'] =  $ModuleTemplate['index_im_link_bock'];
		}
	#
		$ClImMinPrice = new ImListPrint("i WHERE i.hide='show' AND i.im_photo != 'imnoimage.png' AND i.im_prace < i.im_prace_old ORDER BY RAND() LIMIT 16", 
										$ModuleTemplate,
										$TemplateImList,
										$dictionaries,
										$arWords);
										
		$Content['ImMinPrice'] = $ClImMinPrice -> GetContent('div_im_list_ban_block', $arr = array('title' => $arWords['ImDivListHeaderPrice'], 's_im_link' => 'hot_price'), 'DivListMinPrice');
		
		$ClImHOT = new ImListPrint("i WHERE i.im_is_hot=1 AND i.im_photo != 'imnoimage.png' ORDER BY RAND() LIMIT 4", 
										$ModuleTemplate,
										$TemplateImList,
										$dictionaries,
										$arWords);
										
		$Content['ImHOT'] = $ClImHOT -> GetContent('div_im_list_hot_block', $arr = array('title' => $arWords['ImDivListHeaderHot'], 's_im_link' => 'hot_im'), 'DivListMinPrice');
?>
<div class="clear"></div>
<div class="DivCenterPageNP">
<table border="0" cellpadding="0" cellspacing="0" class="TableIndexPage">
  <tr>
    <td class="TableIndexPageTdPadding">
    	<div id="PreloaderM"></div>
        <div class="DivMapIndexBg">
        	<div id="DivCARequery">
			<?php 
				$PG_ARRAY['retention'] = 'get_index_ca_map';
				require_once('application/module/map_city/template.print.map.php');
			?></div>
 		</div> 
 		<?php // echo $Content['im_link'];?>   
    </td>
    <td><?php echo $Content['ImHOT'];?></td>
  </tr>
  <tr>
  	<td colspan="2" style="padding-top:10px;"><?php echo $Content['ImMinPrice'];?></td>
    <!-- <td class="TableIndexPageTdPadding">?php echo $Content['NewsBlock'];?></td> -->
  </tr>
</table>
</div>
