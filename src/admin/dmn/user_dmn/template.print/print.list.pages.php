<?php
#	формирование таблици контенка
for($i = 0; $i < count ( $page ); $i ++) {
	$fio = $page [$i] [fio];
	$login = $page [$i] [login];
	$date = $page [$i] [date];
	$id = $page [$i] [id_account];
	$hideShow = $page [$i] [hide];
	$IsShowIndex = $page [$i] [is_show_index];
	$ShowIndex = 'hide';
	if ($page [$i] [is_show_index])
		$ShowIndex = 'show';
	
	$tRclass = "";
	if ($i % 2 != 0)
		$tRclass = "class=random";
	
	$pagesReturn .= "<tr {$tRclass}>";
	$pagesReturn .= "<td><input type=\"radio\" value=\"{$id}\" name=\"id_account\"/></td>";
	$pagesReturn .= "<td>{$id}</td>";
	$pagesReturn .= "<td>" . ($page [$i]["photo"] ? "<img src=\"../../files/images/realtor/{$page [$i][photo]}\" width=\"120\">" : "" ). "</td>";
	$pagesReturn .= "<td>{$login}</td>";
	$pagesReturn .= "<td>{$fio}</td>";
	$pagesReturn .= "<td>{$dictionaries->buld_table[$page[$i]["type"]]["dict_name"]}</td>";
	$pagesReturn .= "<td>{$date}</td>";
	$pagesReturn .= "</tr>";
}
?>
<table cellpadding="0" cellspacing="0" border="0" class="table-list">
	<tr class="headings">
		<td width=10></td>
		<td width="20">ID</td>
		<td width="120">Фото</td>
		<td>Логин (Email)</td>
		<td>ФИО</td>
		<td>Тип администратора</td>
		<td width=70>Дата</td>
	</tr>
		<?php
		echo $pagesReturn;
		?>
	</table>