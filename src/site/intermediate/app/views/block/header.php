<div class="HeaderPage">
	<?php echo appHtmlClass::partialAction("account", "partialFastLogOn", array("cashe" => 1));?>
    <div class="Headerlogo">
       	<a href="/" title="Alfabrok®"><img src="<?php echo getLangString("imageDomain")?>/files/images/bg/alfabrok.logo.png" width="180" height="120" title="Alfabrok®" alt="Alfabrok®"/></a>
    </div>
    <div class="DHeaderStat"><div class="DHeaderTel">
	<img src="<?php echo getLangString("imageDomain")?>/files/images/bg/tel/i-c.png" alt="" class="icon i-city"/><span class="code">+38</span><span class="tel">(044) 233-75-25</span>
	<div class="clear"></div>
 	<img src="<?php echo getLangString("imageDomain")?>/files/images/bg/tel/i-l.png" alt="" class="icon i-life"/><span class="code">+38</span><span class="tel">(093) 170-07-27</span>
 	<div class="clear"></div>
	<img src="<?php echo getLangString("imageDomain")?>/files/images/bg/tel/i-m.png" alt="" class="icon i-mtc"/><span class="code">+38</span><span class="tel">(050) 313-80-10 </span>
 	<div class="clear"></div>
	<img src="<?php echo getLangString("imageDomain")?>/files/images/bg/tel/i-k.png" alt="" class="icon i-kievstar"/><span class="code">+38</span><span class="tel">(067) 246-60-17</span>
	<div class="clear"></div></div><div class="DivTopHeaderMenuSearch">
	<form action="/ru/immovables/search" id="im_code_top_form" method="get" name="im_code_top_form" enctype="application/x-www-form-urlencoded">
       	<input id="search_top_field" alt="" type="text" value="Поиск по коду" name="id" style="border-top-left-radius: 4px; border-top-right-radius: 4px; border-bottom-left-radius: 4px; border-bottom-right-radius: 4px;"/>
      	<input type="hidden" name="action" value="s_code"/>
		<input id="search_top_submit" type="submit" name="search" value="Найти" style="border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;"/>
	</form>
	<div id="divPointerCode">
		<span id="codeK" onclick="javascript:setPointerCodeToSCField('K');" title="Квартиры" style="border-top-left-radius: 4px; border-top-right-radius: 4px; border-bottom-left-radius: 4px; border-bottom-right-radius: 4px;">K</span>
		<span id="codeC" onclick="javascript:setPointerCodeToSCField('C');" title="Коммерческая недвижимость" style="border-top-left-radius: 4px; border-top-right-radius: 4px; border-bottom-left-radius: 4px; border-bottom-right-radius: 4px;">C</span>
		<span id="codeH" onclick="javascript:setPointerCodeToSCField('H');" title="Коттеджи. Дома. Дачи." style="border-top-left-radius: 4px; border-top-right-radius: 4px; border-bottom-left-radius: 4px; border-bottom-right-radius: 4px;">H</span>
		<span id="codeM" onclick="javascript:setPointerCodeToSCField('M');" title="ОСЗ. Здания." style="border-top-left-radius: 4px; border-top-right-radius: 4px; border-bottom-left-radius: 4px; border-bottom-right-radius: 4px;">M</span>
		<span id="codeT" onclick="javascript:setPointerCodeToSCField('T');" title="Земельные участки" style="border-top-left-radius: 4px; border-top-right-radius: 4px; border-bottom-left-radius: 4px; border-bottom-right-radius: 4px;">T</span>
	</div>
</div>
</div>    
    <div class="clear"></div>    
</div>