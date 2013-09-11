<?php
	$CLDate = new class_date();
	
#	формирование таблици контенка
		for($i=0; $i<count($cl_tree_pages->build_tree_id); $i++)
		{
			$menuWords = $cl_sel_pages->buld_table[$cl_tree_pages->build_tree_id[$i][0]][menu_words];
			$parentId = $cl_sel_pages->buld_table[$cl_tree_pages->build_tree_id[$i][0]][parent_id];
			$marginLeft = 10*$cl_tree_pages->build_tree_id[$i][1];
			$posNum = "<span style='margin-left:{$marginLeft}px'>".$cl_sel_pages->buld_table[$cl_tree_pages->build_tree_id[$i][0]][pos]."</span>";
			$hideShow = $cl_sel_pages->buld_table[$cl_tree_pages->build_tree_id[$i][0]][hide];
			$IsTop = $cl_sel_pages->buld_table[$cl_tree_pages->build_tree_id[$i][0]][is_top];
			$sc_date = $cl_sel_pages->buld_table[$cl_tree_pages->build_tree_id[$i][0]]['sc_date_add'];
			$sc_date = $CLDate -> GetPeapleDateView($sc_date);
			$tRclass= "";  
		  	if ($i%2 != 0) $tRclass = "class=random";  
		  
			$pagesReturn .= "<tr {$tRclass}>";
				$pagesReturn .=	"<td><input type=\"radio\" value=\"{$cl_tree_pages->build_tree_id[$i][0]}\" name=\"sc_id\"/></td>";
				$pagesReturn .=	"<td>{$cl_tree_pages->build_tree_id[$i][0]}</td>";
				$pagesReturn .=	"<td>{$menuWords}</td>";
				$pagesReturn .=	"<td>{$sc_date}</td>";
				$pagesReturn .=	"<td>{$CMSImages[$hideShow]}</td>";
			$pagesReturn .= "</tr>";
		}
		
		if(empty($cl_tree_pages->build_tree_id)) die("<b>Нет позиций</b>");
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
		<td width=120>Дата добавления</td>
		<td width=30>Отображать</td>
	</tr>
		<?php echo $pagesReturn;?>
	</table>