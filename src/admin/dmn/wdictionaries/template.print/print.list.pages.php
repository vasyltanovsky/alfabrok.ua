<?php
	#	формирование таблици контенка
		for($i=0; $i<count($cl_sel_pages->table); $i++)
		{
			$id = $cl_sel_pages->table[$i][ld_id];
			$menuWords = $cl_sel_pages->table[$i][ld_name];
			$parentId  = $cl_sel_pages->table[$i][ld_parent];
			
			$tRclass= "";  
		  	if ($i%2 != 0) $tRclass = "class=random";  
		  
			$pagesReturn .= "<tr {$tRclass}>";
				$pagesReturn .=	"<td><input type=\"radio\" value=\"{$id}\" name=\"ld_id\"/></td>";
				$pagesReturn .=	"<td>{$id}</td>";
				$pagesReturn .=	"<td>{$menuWords}</td>";
				$pagesReturn .=	"<td>{$cl_sel_pages->table[$i][ld_code]}</td>";
				$pagesReturn .=	"<td>{$parentId}</td>";
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
		<td>Пункт</td>
		<td width=50>Код</td>
		<td width=30>Родитель</td>
	</tr>
		<?php echo $pagesReturn;?>
	</table>