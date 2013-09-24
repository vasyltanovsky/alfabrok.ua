<?php
$CLDate = new class_date ( );

for($i = 0; $i < count ( $ClCertifPQ->table ); $i ++) {
	$cr_id = $ClCertifPQ->table [$i] ['cr_id'];
	$cr_num = $ClCertifPQ->table [$i] ['cr_num'];
	$cr_date_from = $CLDate->GetPeapleDateView ( $ClCertifPQ->table [$i] ['cr_date_from'] );
	$cr_date_to = $CLDate->GetPeapleDateView ( $ClCertifPQ->table [$i] ['cr_date_to'] );
	
	$client_fio = $ClCertifPQ->table [$i] ['client_fio'];
	$client_tel = $ClCertifPQ->table [$i] ['client_tel'];
	$client_inn = $ClCertifPQ->table [$i] ['client_inn'];
	
	$auto_num = $ClCertifPQ->table [$i] ['auto_num'];
	$auto_vin = $ClCertifPQ->table [$i] ['auto_vin'];
	$name = $ClCertifPQ->table [$i] ['name'];
	$model_id = $ModelDataBT [$ClCertifPQ->table [$i] ['model_id']] ['name'];
	
	$fio = $ClCertifPQ->table [$i] ['fio'];
	$login = $ClCertifPQ->table [$i] ['login'];
	
	$status = "действительный";
	$tRclass = "";
	if ($i % 2 != 0)
		$tRclass = "class=random";
	if ($ClCertifPQ->table [$i] ['hide'] == 'f') {
		$tRclass = "class=randomHide";
		$status = "отмененный";
	}
	if ($ClCertifPQ->table [$i] ['cr_date_to'] < date ( "Y-m-d" )) {
		$tRclass = "class=randomRed";
		$status = "просроченный";
	}
	if ($ClCertifPQ->table [$i] ['cr_is_done'] == 't') {
		$tRclass = "class=randomOk";
		$status = "активированный";
	}
	
	$pagesReturn .= "<tr {$tRclass}>";
	$pagesReturn .= "<td><input type=\"radio\" value=\"{$cr_id}\" id=\"cr_id\" name=\"cr_id\"/></td>";
	$pagesReturn .= "<td>{$cr_num}</td>";
	$pagesReturn .= "<td>{$cr_date_from}</td>";
	$pagesReturn .= "<td>{$cr_date_to}</td>";
	$pagesReturn .= "<td>{$client_fio}</td>";
	$pagesReturn .= "<td>{$client_tel}</td>";
	$pagesReturn .= "<td>{$client_inn}</td>";
	$pagesReturn .= "<td>{$auto_num}</td>";
	$pagesReturn .= "<td>{$auto_vin}</td>";
	$pagesReturn .= "<td>{$name}</td>";
	$pagesReturn .= "<td>{$model_id}</td>";
	$pagesReturn .= "<td>{$fio} {$login}</td>";
	$pagesReturn .= "<td>{$status}</td>";
	$pagesReturn .= "</tr>";
}

$pagesReturn .= "<input value=\"" . substr ( $_SERVER ['REQUEST_URI'], strpos ( $_SERVER ['REQUEST_URI'], '?' ) + 1, strlen ( $_SERVER ['REQUEST_URI'] ) ) . "\" name=\"requery_id\" type=\"hidden\" >";

?>

<table cellpadding="0" cellspacing="0" border="0" class="table-list">
	<tr class="headings">
		<td width="10"></td>

		<td>Номер сертификата</td>
		<td>Действителен от</td>
		<td>Действителен до</td>

		<td>Клиент ФИО</td>
		<td>Клиент Тел</td>
		<td>Клиент ИНН</td>

		<td>Номер авто</td>
		<td>VIN авто</td>
		<td>Марка авто</td>
		<td>Модель авто</td>

		<td>Добавил</td>
		<td>Статус</td>
	</tr>
		<?php
		echo $pagesReturn;
		?>
	</table>