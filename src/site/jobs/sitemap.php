<?php
/* grab ressources */
@set_time_limit(0);
@ini_set('memory_limit', '128M');
@ini_set('allow_url_fopen','1');

require '../application/module/SitemapGenerator/SiteMapGenerator.class.php';

$mySite="http://" . $_SERVER['HTTP_HOST'];
$siteMapNoFollowWords = array ("javascript", "print", "jpg", "png");
$siteMapGenerator = new SiteMapGenerator($mySite, true, $siteMapNoFollowWords);
$f = fopen("../sitemap.xml","w+");
fwrite($f,$siteMapGenerator->generateSiteMap());
fclose($f);

//формируем siteMap.xml для страницы 
$siteMapGenerator = new SiteMapGenerator ( $mySite, true, $siteMapNoFollowWords, true );
$f = fopen ( "../files/xml/sitemapForPage.xml", "w+" );
fwrite ( $f, $siteMapGenerator->generateSiteMapForPage () );
fclose ( $f );
