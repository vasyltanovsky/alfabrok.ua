<?php
require_once ("../../../config/config.php");
require_once DOC_ROOT . '/config/class.config.php';
require_once ("../../includes/mail/template.mail.text.php");
require_once '../../../application/includes/language/set.cookie.php';
require_once '../../../application/includes/immovables/setting.im.print.inc';
require_once '../../../application/includes/module/template.module.php';
require_once '../../../application/module/immovables/f.immobles.php';

//echo "GET<pre>";
//print_r($_GET);
//echo "</pre>";


//echo "POST<pre>";
//print_r($_POST);
//echo "</pre>";


#стиль отображения таблицы
if ($_GET ['action'] == 'set_style_show') {
	if (! empty ( $_GET ['im_f_show_style'] ))
		setcookie ( 'im_f_show_style', $_GET ['im_f_show_style'], 0, '/' );
	if (! empty ( $_GET ['im_f_show_pnumber'] ))
		setcookie ( 'im_f_show_pnumber', $_GET ['im_f_show_pnumber'], 0, '/' );
}
#сортировка вывода таблицы
if ($_GET ['action'] == 'set_sort_table') {
	setcookie ( 'im_where_sort', $_GET ['sort'], 0, '/' );
	$im_where_sort = ($_COOKIE ['im_where_sort_order'] == "" ? "desc" : ($_COOKIE ['im_where_sort_order'] == "desc" ? "asc" : "desc"));
	setcookie ( 'im_where_sort_order', $im_where_sort, 0, '/' );
}

#сохраняем данные с формы
if ($_GET ['action'] == 'ImFormSearch') {
	$SQForm = new ImSiteForm ( $_GET, 'ImFormSearchArray', 'SearchImCode' );
	$SQForm->IsSavePostGet ();
}
#многоязычное описание недвижимости.
if ($_GET ['action'] == 'GetImSummary') {
	$ImSuQClass = new mysql_select ( $tbl_im_su );
	$active_id = $ImSuQClass->select_table_id ( "WHERE lang_id = '{$_GET[lang_id]}' AND im_id = {$_GET[im_id]}" );
	echo $active_id ['im_su_text'];
}
#многоязычное описание недвижимости.
if ($_GET ['action'] == 'SetImFavorites') {
	$ImFavQueryClass = new pager_mysql_right ( $tbl_user_if, "WHERE user_id = {$_COOKIE[user_id]} AND im_id={$_GET[im_id]}" );
	if ($ImFavQueryClass->get_total () == 0) {
		$query = "INSERT INTO {$tbl_user_if} (`uf_id`, `im_id` ,`user_id`) VALUES
											(NULL, {$_GET[im_id]}, {$_COOKIE[user_id]});";
		if (! mysql_query ( $query ))
			throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT or UPDATE USER FAVORITES" );
	}
	$ImFavQueryClass = new pager_mysql_right ( $tbl_user_if, "WHERE user_id = {$_COOKIE[user_id]}" );
	echo $ImFavQueryClass->get_total ();
}
?>