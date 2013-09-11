<?php
$ImStatAllClass = new pager_mysql_right ( $tbl_im, "i WHERE i.hide='show'" );
$ImStatAllMesjac = new pager_mysql_right ( $tbl_im, "i WHERE i.hide='show' AND DATE_SUB(CURDATE(),INTERVAL 30 DAY) <= i.im_date_add;" );
$ImStatAllNedely = new pager_mysql_right ( $tbl_im, "i WHERE i.hide='show' AND DATE_SUB(CURDATE(),INTERVAL 7 DAY) <= i.im_date_add;" );
$ImStatAllSegodnja = new pager_mysql_right ( $tbl_im, "i WHERE i.hide='show' AND CURDATE() = i.im_date_add;" );
$ArrSIS ['PageStatPosAll'] = $ImStatAllClass->get_total ();
$ArrSIS ['PageStatPosSegodnja'] = $ImStatAllSegodnja->get_total ();
$ArrSIS ['PageStatPosNedely'] = $ImStatAllNedely->get_total ();
$ArrSIS ['PageStatPosMesjac'] = $ImStatAllMesjac->get_total ();

$ClModSIS = new ModuleSite ( $ModuleTemplate );
$SiteImStat = $ClModSIS->For_HTML ( $ModuleTemplate ['div_stat_site'], $ArrSIS );
?>