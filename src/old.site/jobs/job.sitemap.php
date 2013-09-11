<?php
/* grab ressources */
@set_time_limit(0);
@ini_set('memory_limit', '128M');
@ini_set('allow_url_fopen','1');

require '../application/module/SitemapGenerator/SiteMapGenerator.class.php';

$mySite="http://alfabrok.ua";
$siteMapNoFollowWords = array ("javascript", "print", "jpg", "png");
$siteMapGenerator = new SiteMapGenerator($mySite, true, $siteMapNoFollowWords);
$f = fopen("../sitemap.xml","w+");
fwrite($f,$siteMapGenerator->generateSiteMap());
fclose($f);
?>