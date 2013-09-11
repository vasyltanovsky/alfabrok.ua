<?php
#?????? ????????????? 
	$ClImMinPrice = new ImListPrint("i WHERE i.im_is_hot=1 AND i.im_photo != 'imnoimage.png' ORDER BY RAND() LIMIT 15", 
										$ModuleTemplate,
										$TemplateImList,
										$dictionaries,
										$arWords);
		
#	
	$arrContent['title'] 			= $pages->active_page['title'];
	$arrContent['div_navigation'] 	= $pages->navigation_string_htaccess();
	$arrContent['catalog_menu'] 	= $arWords['user_private_link'];
	$arrContent['summary'] 			= $pages->active_page['summary'];
	$arrContent['data'] 			= '';
	$arrContent['list_im_hot'] = $ClImMinPrice -> GetContent('div_im_list_ban_block', $arr = array('title' => $arWords['ImDivListHeaderHot'], 's_im_link' => 'hot_im', 'css_class' => 'links_block' ), 'DivListMinPrice');
	
	#
	$ClContentPage = new ModuleSite($ModuleTemplate);
	$PageInfoReturn = $ClContentPage -> For_HTML($ModuleTemplate['ttable_cimui_page'], $arrContent);
?>