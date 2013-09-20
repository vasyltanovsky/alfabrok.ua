<?php 
global $routingObj;
?>
<meta property="og:type" content="website" />
<meta property="og:title" content="<?php echo $appDataObj->getTitle();?>" />
<meta property="og:url" content="<?php echo $appDataObj->social["fb"]->url;?>" />
<meta property="og:image" content="<?php echo $appDataObj->social["fb"]->image;?>" />
<meta property="og:site_name" content="<?php echo getLangString("site_name")?>" />
<meta property="fb:admins" content="<?php echo $appDataObj->social["fb"]->id;?>" />