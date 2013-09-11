<?php require_once("application/includes/agent/http.php");?>
<?php
	#вход для пользователя
    $EA = new EnterAccess(	 $tbl_DB = $tbl_user_site,
							 $EA_login = array('login_db'=>'user_login','login_form'=>'user_enter_login','login_err'=>'Неверное имя пользователя.'),
							 $EA_pass = array('pass_db'=>'user_password','pass_form'=>'user_enter_password','pass_err'=>'Неверный пароль.'),
							 $location = array('Location: http://alfabrok.ua/index.html', 'Location: http://alfabrok.ua/index.html'),
							 $EA_check = array('check_db'=>'user_activity','check_val'=>'activity','check_err'=>'Ваш аккаунт не ативирован.'),
							 $IsDoCheck = true);
  	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo $title_web;?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta content="<?php echo $description_web;?>" name="description" />
	<meta content="<?php echo $keywords_web;?>" name="keywords" />
	<meta content="<?php echo $keywords_web;?>" name="page-topic" />
	<meta name='robot' content='all' />
 	<link rel="shortcut icon" href="/files/images/bg/favicon.ico" />
    <meta name="author" content="Alex Tsurkin www.alex-ts.com"/>
	<link rel="stylesheet" href='/css/index.css' type="text/css" media="screen, projection" />
    <link rel="stylesheet" href='/css/jquery-ui-1.8.4.custom.css' type="text/css" media="screen, projection" />
    <link type="text/css" href="/css/dialog.windows.css" rel="stylesheet" />
    
	<script src="/js/jquery-1.4.2.js" type="text/javascript"></script>
	<script src="/js/jquery-ui-1.8.4.custom.min.js" type="text/javascript"></script>
	<script src="/js/jquery.easing.1.3.js" type="text/javascript"></script>
    <script type="text/javascript" src="/js/jquery.form.js"></script>
	<script src="/js/DD_roundies.js" type="text/JavaScript" ></script>
   	<?php
	if(in_array(maxsite_browser(), array("FF", "CH", "SF", "OP"))) {
		echo "<script src=\"/js/jquery.corner.js\" type=\"text/JavaScript\" ></script>";
    }
	?>
    <script src="/js/Scripts/swfobject_modified.js" type="text/javascript"></script>
    <script src="/js/jquery.cycle.js" type="text/javascript"></script>
    <script src="/js/easySlider1.7.js" type="text/javascript" ></script>	
    <script src="/js/jquery.tooltip.js" type="text/javascript"></script>
    <script type="text/javascript" src="/js/jquery.cookie.js"></script>
	<script type="text/javascript" src="/js/jquery.treeview.js"></script>
    <script type="text/javascript" src="/js/ui/i18n/jquery.ui.datepicker-ru.js"></script>
    <script type="text/javascript" src="/js/swfobject/swfobject.js"></script>
    <script type="text/javascript" src="/js/jquery-impromptu.js"></script>
	<script type="text/javascript" src="/js/common.js"></script>
    
    <!-- Common ZAPATEC -->
	<script type='text/javascript' src='/js/js-zapatec/utils/zapatec.js'></script>
	<script type="text/javascript" src="/js/js-zapatec/lang/ru-utf8.js"></script>
	<script type='text/javascript' src='/js/js-zapatec/src/form-<?php echo $_COOKIE['lang_code'];?>.js'></script>
	<script type='text/javascript' src='/js/js-zapatec/demo.js'></script>
    
    <script type="text/javascript" src="/js/YMapUserFunctional.js"></script>
    <script type="text/javascript" src="/js/fixpng.js"></script>
    <script type="text/javascript" src="/js/href.im.js"></script>
    <script type="text/javascript" src="/js/design.js"></script>
    <script type="text/javascript" src="/js/im.post.get.js"></script>
    <script type="text/javascript" src="/js/functions.js"></script>
    <script type="text/javascript" src="/js/round/round.<?php echo maxsite_browser();?>.js"></script>
   	<!-- ZAPATEC ALL demos need these css -->
	<link href="/css/css.zapatec/zpcal.css" rel="stylesheet" type="text/css"/>
	<link href="/css/css.zapatec/template.css" rel="stylesheet" type="text/css"/>
    <link href="/css/css.zapatec/winxp.css" rel="stylesheet" type="text/css"/>
    
    <!-- YANDEX MAP -->
    <script src="http://api-maps.yandex.ru/1.1/index.xml?key=<?php echo $arWords['YMapSiteKey'];?>&modules=pmap" type="text/javascript"></script>
    <script type="text/javascript" src="/js/YMaps.js"></script>
    
    <script type="text/javascript" src="/js/highslide/highslide-with-gallery-<?php echo $_COOKIE['lang_code']?>.js"></script>
    <link rel="stylesheet" type="text/css" href="/js/highslide/highslide.css" />
    <!--[if lt IE 7]>
    <link rel="stylesheet" type="text/css" href="/js/highslide/highslide-ie6.css" />
    <![endif]-->
    <!--
        2) Optionally override the settings defined at the top
        of the highslide.js file. The parameter hs.graphicsDir is important!
    -->
    <script type="text/javascript">
    hs.graphicsDir = '/js/highslide/graphics/';
    hs.align = 'center';
    hs.transitions = ['expand', 'crossfade'];
    hs.fadeInOut = true;
    hs.dimmingOpacity = 0.8;
    hs.outlineType = 'rounded-white';
    hs.captionEval = 'this.thumb.alt';
    hs.marginBottom = 105; // make room for the thumbstrip and the controls
    hs.numberPosition = 'caption';
    
    // Add the slideshow providing the controlbar and the thumbstrip
    hs.addSlideshow({
        //slideshowGroup: 'group1',
        interval: 5000,
        repeat: true,
        useControls: true,
        overlayOptions: {
            className: 'text-controls',
            position: 'bottom center',
            relativeTo: 'viewport',
            offsetY: -60
        },
        thumbstrip: {
            position: 'bottom center',
            mode: 'horizontal',
            relativeTo: 'viewport'
        }
    });
	
	$(function() {
		$(".highslide").click(function () {
			$("body").css("overflow", "hidden");
		});
		$("#accordionVideo").accordion();
		$("#tabs").tabs();
	});
	</script>
    <!--[if lt IE 7]>
    <![if gte IE 5.5]>
    <script type="text/javascript" src="/js/fixpng.js"></script>
    <![endif]>
    <![endif]-->
    
    <link rel="stylesheet" href='/css/css.browser/<?php echo $MBrowser = maxsite_browser();?>.css' type="text/css" media="screen, projection" />
</head>
<body>
<style>
body { overflow:scroll}
</style>
<div class="HeaderPage">
	<div class="DHeaerUserLib"> 
		<?php	if($EA->ShowForm($_COOKIE)) require_once 'application/module/user/form.exit.php';
  				else require_once 'application/module/user/form.enter.php';	?>
  		<div id="UserImFavoritesId"></div>			
    </div>
    <div class="Headerlogo">
       	<a href="/" title="<?php echo $arWords['CompaniName'];?>"><img src="/files/images/bg/alfabrok.logo.png" width="180" height="120" title="<?php echo $arWords['CompaniName'];?>" alt="<?php echo $arWords['CompaniName'];?>" /></a>
    </div>
    <div class="DHeaderStat"><div class="DHeaderTel"><?php echo $arWords['CompaniTelContact'];?></div><?php require_once("application/includes/search/im.code.search.form.top.inc");?></div>           
</div>
<div class="HeaderMenu">
	<?php 
		if(in_array(maxsite_browser(), array("FF", "CH", "SF", ""))) {
			echo $ret_menu_index;
			require_once("application/includes/language/form.language.php");								 
		}
		else {
			echo "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\"><tr><td class=\"td_ret_menu_index\">{$ret_menu_index}</td><td>";
			require_once("application/includes/language/form.language.php");
			echo "</td></tr></table>";
		}
	?>
</div>

