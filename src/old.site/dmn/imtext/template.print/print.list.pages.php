<?php
	$CLDate = new class_date();
	
#	формирование таблици контенка
		for($i=0; $i<count($page); $i++)	{
			$tRclass= "";  
		  	if ($i%2 != 0) $tRclass = "class=random";  
		  
		  	$type_rs = "Аренда";
		  	if ($page[$i]['type_rs'] == 'sale')
			  	$type_rs = "Продажа";
			$pagesReturn .= "<tr {$tRclass}>";
				$pagesReturn .=	"<td><input type=\"radio\" value=\"{$page[$i]['it_id']}\" name=\"it_id\"/></td>";
				$pagesReturn .=	"<td>{$page[$i]['it_id']}</td>";
				$pagesReturn .=	"<td>{$dictionaries->buld_table[$page[$i]['dict_id']]['dict_name']}</td>";
				$pagesReturn .=	"<td>".substr($page[$i]['it_text'], 0 , 300)."</td>";
				
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
		<td width=200>Територия</td>
		<td>Текст</td>
	</tr>
		<?php echo $pagesReturn;?>
	</table>