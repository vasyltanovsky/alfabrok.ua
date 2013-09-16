<?php 
global $routingObj;
global $renderHtmlLinkObj;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo $p_w_title;?></title>
    <meta name="description" content="<?php echo $p_w_desc;?>" />
    <meta name="keywords" content="<?php echo $p_w_keyw;?>" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="robots" content="INDEX,FOLLOW" />
    <meta name="sitemap" content="INDEX,FOLLOW" />
    <meta name="author" content="Alex Tsurkin www.webroom.in.ua" />
    <meta name="revisit-after" content="10 day" />
	<meta name="viewport" content="width=device-width"/>
 	<link rel="stylesheet" href='/css/ab5b64e.css'>
 	<link rel="shortcut icon" href="<?php echo getLangString("imageDomain")?>/files/images/bg/favicon.ico" />
	<?php echo $renderHtmlLinkObj->renderCss();?>
	<script type="text/javascript" src='/js/libs/zapatec/utils/zapatec.js'></script>
	<script type="text/javascript" src="/js/libs/zapatec/lang/ru-utf8.js"></script>
	<script type="text/javascript" src='/js/libs/zapatec/src/form-<?php echo $_COOKIE['lang_code'];?>.js'></script>
	<script type="text/javascript" src='/js/ant/libs/zapatec.js'></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="http://api-maps.yandex.ru/1.1/index.xml?key=<?php echo getLangString('YMapSiteKey');?>&modules=pmap" type="text/javascript"></script>
	<script type="text/javascript" src="/js/ant/libs/geocoder.im.list.js"></script>
	<script type="text/javascript" src="/js/ant/libs/indexbanner.js"></script>
	<script type="text/javascript" src="/js/ant/libs/ymap.user.functional.js"></script>
	<script type="text/javascript" src="/js/ant/libs/jquery-ui-1.8.18.custom.min.js"></script>
 	<script defer src='/js/ant/45e060d.js'></script>
	<?php echo $renderHtmlLinkObj->renderJs();?>
	<link rel="alternate" type="application/rss+xml" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/<?php echo $_COOKIE['lang_code'];?>/rss/news/stati" title="<?php echo $this->dict->buld_table['stati']['dict_name'];?>" />
	<link rel="alternate" type="application/rss+xml" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/<?php echo $_COOKIE['lang_code'];?>/rss/news/sovetu" title="<?php echo $this->dict->buld_table['sovetu']['dict_name'];?>" />
	<link rel="alternate" type="application/rss+xml" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/<?php echo $_COOKIE['lang_code'];?>/rss/news/novosti" title="<?php echo $this->dict->buld_table['novosti']['dict_name'];?>" />
</head>
<body>
<div class="wrapper" id="<?php echo sprintf("page-%s-%s", $routingObj->getController(), $routingObj->getAction()); ?>">
    <?php echo appHtmlClass::partialAction ( "block", "header", array("is_cashe" => 1) ); ?>
    <?php echo appHtmlClass::partialAction ( "block", "mainmenu", array ("hide" => "show", "menu_show" => "show", "parent_in" => "0" ) ); ?>
    <div class="DivCenterPage"><?php echo $body;?></div>
    <div class="DivFooter">© 2010-2013 alfabrok.ua All rights reserved</div>
    <div id="DivRequest"></div>
</div>
	<script type="application/javascript">
	var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
	g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
	s.parentNode.insertBefore(g,s)}(document,'script'));
</script>
</body>
</html>