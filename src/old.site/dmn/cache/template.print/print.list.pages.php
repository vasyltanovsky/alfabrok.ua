<?php
	#	формирование таблици контенка
		for($i=0; $i<count($cl_sel_pages -> table); $i++)
		{
			$IsCacheOn = '-';
			if($cl_sel_pages -> table[$i]['is_cache_on']) $IsCacheOn = '+';
			
			$tRclass= "";  
		  	if ($i%2 != 0) $tRclass = "class=random";  
		  
			$pagesReturn .= "<tr {$tRclass}>";
				$pagesReturn .=	"<td><input type=\"radio\" value=\"{$cl_sel_pages -> table[$i][cs_id]}\" name=\"cs_id\"/></td>";
				$pagesReturn .=	"<td>{$cl_sel_pages -> table[$i][cs_id]}</td>";
				$pagesReturn .=	"<td>{$IsCacheOn}</td>";
				$pagesReturn .=	"<td>{$cl_sel_pages -> table[$i][time_cache]}</td>";
			$pagesReturn .= "</tr>";
		}
?>
<script type="text/javascript">
 DD_roundies.addRule('#d-dialog-in', '10px', true);
 DD_roundies.addRule('.t-dialog', '10px', true);
 
</script>

	<table cellpadding="0" cellspacing="0" border="0" class="table-list">
	<tr class="headings">
		<td width=10 ></td>
		<td width=50>ID</td>
		<td width=50>Кeширование</td>
		<td>Время</td>
	</tr>
		<?php echo $pagesReturn;?>
	</table>