<?php
#
#модуль активизации пользователя по почте
if ($_GET ['dict']) {
	$user_mail_code = trim ( $_GET ['dict'] );
	$query = "SELECT * FROM $tbl_user_site WHERE user_mail_code  = '{$user_mail_code}'";
	$acc = mysql_query ( $query );
	if (! $acc)
		throw new ExceptionMySQL ( mysql_error (), $query, "Ошибка пользователя" );
	$arr_user = mysql_fetch_array ( $acc );
	
	if ($arr_user) {
		$query = "UPDATE $tbl_user_site 
            			      SET user_activity = 'activity',
							  	  user_email_activity = 'activity', 
							  	  user_mail_code = ''
				  			  WHERE user_id = {$arr_user[user_id]}";
		if (! mysql_query ( $query ))
			throw new ExceptionMySQL ( mysql_error (), $query, "Ошибка добавления нового пользователя" );
		$CodeAnsver = $arWords ['RegistrationActivity'];
	} else
		$CodeAnsver = $arWords ['RegistrationActivityFalse'];
} else
	$CodeAnsver = $arWords ['RegistrationActivityFalse'];
?>

<div class="DivCenterPage">
<h1 class="TitleStandartPage"><?php echo $pages->active_page['title']?></h1>
<?php if($_GET[1]) {echo "<div class=\"DivNavigation\">"; $pages->navigation_string_htaccess(); echo "</div>";} ?>


<table class="TableStandartCenterPage">
	<tr>
		<td class="TSCPTdCenter"><?php echo $CodeAnsver;?></td>
		<td class="TSCPTdRight"></td>
	</tr>
</table>
</div>
