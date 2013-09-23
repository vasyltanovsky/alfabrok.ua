<!-- url ~=180 -->
<?php 
global $routingObj;
global $renderHtmlLinkObj;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo $appDataObj->getTitle();?></title><!-- I'd think about 60 characters are displayed? Try to find out looking at SERPs  -->
    <meta name="keywords" content="<?php echo $appDataObj->getKeyw();?>" /> <!-- 5 to 10 words should be enough, don't use words you haven't visible on the page too, 175 character -->
    <meta name="description" content="<?php echo $appDataObj->getDesc();?>" /> <!-- Same as title, I think up to something like 160 characters are displayed. 150 character-->
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="robots" content="INDEX,FOLLOW" />
    <meta name="sitemap" content="INDEX,FOLLOW" />
    <meta name="author" content="Alex Tsurkin www.webroom.in.ua" />
    <meta name="revisit-after" content="10 day" />
	<meta name="viewport" content="width=device-width"/>
 	<link rel="stylesheet" href="/css/style.css?v=2">
 	<link rel="shortcut icon" href="<?php echo getLangString("imageDomain")?>/files/images/bg/favicon.ico" />
	<?php echo appHtmlClass::partial("social/facebook.meta", array("appDataObj" => $appDataObj));?>
	<?php echo $renderHtmlLinkObj->renderCss();?>
	<script type="text/javascript" src='/js/libs/zapatec/utils/zapatec.js'></script>
	<script type="text/javascript" src="/js/libs/zapatec/lang/ru-utf8.js"></script>
	<script type="text/javascript" src='/js/libs/zapatec/src/form-<?php echo $_COOKIE['lang_code'];?>.js'></script>
	<script type="text/javascript" src='/js/ant/libs/zapatec.js'></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<!--<script src="http://api-maps.yandex.ru/1.1/index.xml?key=<?php echo getLangString('YMapSiteKey');?>&modules=pmap" type="text/javascript"></script>-->
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
	<link rel="alternate" type="application/rss+xml" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/<?php echo $_COOKIE['lang_code'];?>/rss" title="" />
</head>
<body>
<div class="wrapper" id="<?php echo sprintf("page-%s-%s", $routingObj->getController(), $routingObj->getAction()); ?>">
    <?php echo appHtmlClass::partialAction ( "block", "header", array("is_cashe" => 1) ); ?>
    <?php echo appHtmlClass::partialAction ( "block", "mainmenu", array ("hide" => "1", "p_type" => "p_index" ) ); ?>
    <?php echo appHtmlClass::partialAction ( "block", "stringnavigation", array ("controller"=> $routingObj->getController(), "action" => $routingObj->getAction(), "string_navigation" => $appDataObj->getStringNavigation (), "parent_controller" => $appDataObj->getPController (), "parent_action" => $appDataObj->getPAction (), "param" => $routingObj->getParamToString(), "is_cache" => true) ); ?>
    <div class="DivCenterPage"><?php echo $body;?></div>
    <div class="DivFooter">© 2010-2013 alfabrok.ua All rights reserved</div>
    <div id="DivRequest"></div>
    <div class="shadow-0-0-10-1 radius-3" id="log">
        <h4>Javascript log</h4>
    </div>
</div>
	<!-- Yandex.Metrika counter -->
	<script type="text/javascript">
	(function (d, w, c) {
	    (w[c] = w[c] || []).push(function() {
	        try {
	            w.yaCounter22351390 = new Ya.Metrika({id:22351390,
	                    clickmap:true,
	                    trackLinks:true,
	                    accurateTrackBounce:true});
	        } catch(e) { }
	    });
	
	    var n = d.getElementsByTagName("script")[0],
	        s = d.createElement("script"),
	        f = function () { n.parentNode.insertBefore(s, n); };
	    s.type = "text/javascript";
	    s.async = true;
	    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";
	
	    if (w.opera == "[object Opera]") {
	        d.addEventListener("DOMContentLoaded", f, false);
	    } else { f(); }
	})(document, window, "yandex_metrika_callbacks");
	</script>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-44164795-1', 'alfabrok.ua');
	  ga('send', 'pageview');
	
	</script>
</body>
</html>