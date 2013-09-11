<?php
	$CLDate = new class_date();
	$template['link'] = "<a href=\"/immovables/#type_im#/#type_rs#.html?#dict_id#_#type_reg#=#il_name#\">/immovables/#type_im#/#type_rs#.html?#dict_id#_#type_reg#=#il_name#</a>";
	
	$m = new ModuleSite($template);
	
#	формирование таблици контенка
		for($i=0; $i<count($page); $i++)
		{
			$link	= $m->For_HTML($template['link'], $page[$i]); 
			
			$tRclass= "";  
		  	if ($i%2 != 0) $tRclass = "class=random";  
		  
		  	$type_rs = "Аренда";
		  	if ($page[$i]['type_rs'] == 'sale')
			  	$type_rs = "Продажа";
			$pagesReturn .= "<tr {$tRclass}>";
				$pagesReturn .=	"<td><input type=\"radio\" value=\"{$page[$i]['il_id']}\" name=\"il_id\"/></td>";
				$pagesReturn .=	"<td>{$page[$i]['il_id']}</td>";
				$pagesReturn .=	"<td>{$page[$i]['il_name']}</td>";
				$pagesReturn .=	"<td>{$page[$i]['il_title']}</td>";
				$pagesReturn .=	"<td>{$im_catalog_id_add[$page[$i]['type_im']]['dict_name']}</td>";
				$pagesReturn .=	"<td>{$type_rs}</td>";
				$pagesReturn .=	"<td>{$link}</td>";
			$pagesReturn .= "</tr>";
		}
		
		if(empty($page)) die("<b>Нет позиций</b>");
?>
<script type="text/javascript">
DD_roundies.addRule('#d-dialog-in', '10px', true);
DD_roundies.addRule('.t-dialog', '10px', true);
</script>

	<table cellpadding="0" cellspacing="0" border="0" class="table-list">
	<tr class="headings">
		<td width=10 ></td>
		<td width=50>ID</td>
		<td>Название</td>
		<td>Заголовок</td>
		<td>Тип недвижимости</td>
		<td>Аренда/Продажа</td>
		<td>Ссылка</td>
	</tr>
		<?php echo $pagesReturn;?>
	</table>