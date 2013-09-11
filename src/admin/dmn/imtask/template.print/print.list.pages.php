<?php
	$CLDate = new class_date();
	$template['link'] = "<a href=\"/immovables/#type_im#/#type_rs#.html?#dict_id#_#type_reg#=#il_name#\">/immovables/#type_im#/#type_rs#.html?#dict_id#_#type_reg#=#il_name#</a>";
	
	$m = new ModuleSite($template);
	
#	формирование таблици контенка
		for($i=0; $i<count($page); $i++) {
			$tRclass= "";  
		  	if ($i%2 != 0) $tRclass = "class=random";  
		  
		  	$is_do =$CMSImagesNum[$page[$i]['is_do']];
		  	
			$pagesReturn .= "<tr {$tRclass}>";
				$pagesReturn .=	"<td><input type=\"radio\" value=\"{$page[$i]['t_id']}\" name=\"t_id\"/></td>";
				$pagesReturn .=	"<td>{$page[$i]['t_id']}</td>";
				$pagesReturn .=	"<td>{$page[$i]['t_date_add']}</td>";
				$pagesReturn .=	"<td>{$page[$i]['t_date_do']}</td>";
				$pagesReturn .=	"<td>{$page[$i]['t_date_reminder']}</td>";
				$pagesReturn .=	"<td>{$page[$i]['t_title']}</td>";
				$pagesReturn .=	"<td>{$page[$i]['im_id']}</td>";
				$pagesReturn .=	"<td>{$page[$i]['fio']}</td>";
				$pagesReturn .=	"<td>{$is_do}</td>";
			$pagesReturn .= "</tr>";
		}
		$pagesReturn .=	"<input value=\"".substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], '?')+1, strlen($_SERVER['REQUEST_URI']))."\" name=\"requery_id\" type=\"hidden\" >";
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
		<td>Дата добавления</td>
		<td>Дата выполнения</td>
		<td>Дата напоминания</td>
		<td>Загоовок</td>
		<td>Код недвижимости</td>
		<td>Исполнитель</td>
		<td>Выполнено</td>
	</tr>
		<?php echo $pagesReturn;?>
	</table>