<!-- url ~=180 -->
<?php 
global $routingObj;
global $renderHtmlLinkObj;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo $p_w_title;?></title><!-- I'd think about 60 characters are displayed? Try to find out looking at SERPs  -->
    <meta name="keywords" content="<?php echo $p_w_keyw;?>" /> <!-- 5 to 10 words should be enough, don't use words you haven't visible on the page too, 175 character -->
    <meta name="description" content="<?php echo $p_w_desc;?>" /> <!-- Same as title, I think up to something like 160 characters are displayed. 150 character-->
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="robots" content="INDEX,FOLLOW" />
    <meta name="sitemap" content="INDEX,FOLLOW" />
    <meta name="author" content="Alex Tsurkin www.webroom.in.ua" />
    <meta name="revisit-after" content="10 day" />
	<meta name="viewport" content="width=device-width"/>
 	<link rel="stylesheet" href="/css/style.css?v=2">
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
 	<!-- scripts concatenated and minified via ant build script-->
	<script type="text/javascript" src="/js/ant/modules/jquery-impromptu.js"></script>
	<script type="text/javascript" src="/js/ant/modules/jquery.cookie.js"></script>
	<script type="text/javascript" src="/js/ant/modules/jquery.corner.js"></script>
	<script type="text/javascript" src="/js/ant/modules/jquery.cycle.js"></script>
	<script type="text/javascript" src="/js/ant/modules/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="/js/ant/modules/jquery.form.js"></script>
	<script type="text/javascript" src="/js/ant/modules/jquery.treeview.js"></script>
	<script type="text/javascript" src="/js/ant/modules/roundies.js"></script>
	<script type="text/javascript" src="/js/ant/modules/common.js"></script>
	<script type="text/javascript" src="/js/ant/modules/easySlider1.7.js"></script>
	<script type="text/javascript" src="/js/ant/modules/fixpng.js"></script>
	<script type="text/javascript" src="/js/ant/im.code.replace.js"></script>
	<script type="text/javascript" src="/js/ant/functions.js"></script>
	<script type="text/javascript" src="/js/ant/ymap.search.js"></script>
	<script type="text/javascript" src="/js/ant/im.search.js"></script>
	<script type="text/javascript" src="/js/ant/im.post.get.js"></script>
	<script type="text/javascript" src="/js/ant/round.js"></script>
	<script type="text/javascript" src="/js/ant/comparing.js"></script>
	<script type="text/javascript" src="/js/ant/script.js"></script>
	<!-- end scripts-->
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
    <div class="shadow-0-0-10-1 radius-3" id="log">
        <h4>Javascript log</h4>
    </div>
</div>
	<script type="application/javascript">
	var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
	g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
	s.parentNode.insertBefore(g,s)}(document,'script'));
</script>
</body>
</html>