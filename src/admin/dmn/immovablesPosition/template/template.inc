<?php
	$ModuleTemplate['photo_list_block_header'] = "";
	$ModuleTemplate['photo_list_block_bottom'] = "<div style=\"clear:both; font-size:1px; height:1px; line-height:1px; min-height:1px; width:100%;\"></div>";		
	$ModuleTemplate['photo_list_block'] = "<li id=\"#im_photo_id#\"> <style>.TablePhoto{ width:200px; float:left;}</style><table class=\"TablePhoto\"><tr><td><input type=\"radio\" value=\"#im_photo_id#\" name=\"im_photo_id\"/><br /><br /> \"#im_photo_order#\" </td><td class=\"TdListLogoALignCenter\"><a class=\"highslide\" href=\"$images_root/files/images/immovables/#im_photo_id#.#im_file_type#\" onclick=\"return hs.expand(this)\"><img src=\"$images_root/files/images/immovables/s_#im_photo_id#.#im_file_type#\" alt=\"\" title=\"\"></a></td></tr><td colspan=\"2\">#im_photo_type#</td></tr></table> </li>";

	$ModuleTemplate['task_list_block_header'] = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"table-list\"><tr class=\"headings\"><td>Id</td><td>Дата записи</td><td>Дата планирования</td><td>Риэлтор</td><td>Заголовок</td><td>Описание</td></tr>";
	$ModuleTemplate['task_list_block_bottom'] = "</table>";		
	$ModuleTemplate['task_list_block'] = "<tr><tr><td>#t_id#</td><td>#t_date_add#</td><td>#t_date_do#</td><td>#realtor_id#</td><td>#t_title#</td><td>#t_text#</td></tr>";
	
?>