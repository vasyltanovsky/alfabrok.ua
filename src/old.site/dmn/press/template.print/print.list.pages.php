<?php
	#	формирование таблици контенка
		for($i=0; $i<count($page); $i++)
		{
			$menuWords = $page[$i][news_title];
			$date = $page[$i][news_date];
			$id = $page[$i][news_id];
			$hideShow = $page[$i][hide];
			$IsShowIndex = $page[$i][is_show_index];
			$ShowIndex = 'hide';
			if($page[$i][is_show_index]) $ShowIndex = 'show';
			
			$tRclass= "";  
		  	if ($i%2 != 0) $tRclass = "class=random";  
		  
			$pagesReturn .= "<tr {$tRclass}>";
				$pagesReturn .=	"<td><input type=\"radio\" value=\"{$id}\" name=\"news_id\"/></td>";
				$pagesReturn .=	"<td>{$id}</td>";
				$pagesReturn .=	"<td>{$menuWords}</td>";
				$pagesReturn .=	"<td>{$date}</td>";
				$pagesReturn .=	"<td>{$CMSImages[$hideShow]}</td>";
			$pagesReturn .= "</tr>";
		}
?>
<script>
 DD_roundies.addRule('#d-dialog-in', '10px', true);
 DD_roundies.addRule('.t-dialog', '10px', true);
</script>

	<table cellpadding="0" cellspacing="0" border="0" class="table-list">
	<tr class="headings">
		<td width=10 ></td>
		<td width=80>ID</td>
		<td>Новость</td>
        <td width=70>Дата</td>
		<td width=30>Активность</td>
	</tr>
		<?php echo $pagesReturn;?>
	</table>