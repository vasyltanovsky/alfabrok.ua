<?php

function connect_db()
{
	//Connect To Database
	$hostname='205.178.146.73';
	$username='allstarkiev';
	$password='Porky0259';
	$dbname='allstarkiev';


	// Connect to Williamsburg Daily News database
	$link = mysql_connect($hostname, $username, $password);

	if (!$link) {
		die("Could not connect to the internal database. Please contact web support at (757) 234-1214.<br>" . mysql_error());
	}
	
	mysql_select_db($dbname,$link) or die("Error: Could not select the proper database. Please contact support at (757) 234-1214: " . mysql_error());
	
	return $link;
}

function disconnect_db($dis)
{
	mysql_close($dis);
}



function display_header($page)
{

?>

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td class="header_bar">
    	<center>
    	<table width="800">
        <tr>
        	<td align="left"><span class="header_link"><a href="#" class="header_link">English</a></span> <font color='#666666'>|</font> <span class="header_link"><a href="rus/<?php echo $PHP_SELF; ?>" class="header_link">Russian</a></span></td>
        </tr>
        </table>
    	</center>
    </td>
</tr>
</table>



<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td class="background_repeat">
    &nbsp;&nbsp;
    </td>
    <td width="800">
    
    
    
    
<center>
<table class="main_content" cellpadding="0" cellspacing="0">
<tr>
	<td>
    	<table class="header" cellpadding="0" cellspacing="0">
        <tr>
        	<td colspan="4" height="30">&nbsp;</td>
        </tr>
        
        <tr>
        	<td valign="top" align="left">
            	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/Logo.jpg" alt="All Star Kiev Apartments">
            </td>
            <td valign="top" align="left">
            	<span class="phone_man">+380 44 484 1637<br>
                +380 67 656 2023<br>
                +380 50 441 5979</span>
                <span class="time_man">
                (for English)<br /><br />
                <b>Hours: </b>8:00 - 20:00<br /><br />
</span>
                <a href="mailto: info@allstar.com.ua">info@allstar.com.ua</a>
            	</td>
                <td valign="top" align="left" width="250">
                <span class="time_man"><b>Exchange rate: </b><br />UAH 7.6/ USD 1<br /><br />
                <span class="time_man"><b>Ukrainian Time: </b><br /><span id="clock">&nbsp;</span></span><br />
                <span class="time_man"><br /><b>Weather: </b></span><br /><a href="http://www.wunderground.com/global/stations/33345.html" target="_blank">View Current Conditions</a><br /><br />
            </td>
            <td valign="top" align="right">
         <img src="images/ms-visa.jpg" alt="MasterCard - Visa">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </td>
        </tr>
        <?php if($page != -1){?>
        <tr>
        	<td colspan="4">
            
            
            <script language="javascript">
	if (AC_FL_RunContent == 0) {
		alert("This page requires AC_RunActiveContent.js.");
	} else {
		AC_FL_RunContent(
			'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0',
			'width', '800',
			'height', '200',
			'src', 'NewHeader',
			'quality', 'high',
			'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
			'align', 'middle',
			'play', 'true',
			'loop', 'true',
			'scale', 'showall',
			'wmode', 'window',
			'devicefont', 'false',
			'id', 'NewHeader',
			'bgcolor', '#ffffff',
			'name', 'NewHeader',
			'menu', 'true',
			'allowFullScreen', 'false',
			'allowScriptAccess','sameDomain',
			'movie', 'flash/NewHeader',
			'salign', ''
			); //end AC code
	}
</script>
<noscript>
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="800" height="200" id="NewHeader" align="middle">
	<param name="allowScriptAccess" value="sameDomain" />
	<param name="allowFullScreen" value="false" />
	<param name="movie" value="flash/NewHeader.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" />	<embed src="flash/NewHeader.swf" quality="high" bgcolor="#ffffff" width="800" height="200" name="NewHeader" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
	</object>
</noscript>
            
            
            </td>
        </tr>
        <?php } ?>
        <tr>
        	<td colspan="4">
            	<?php display_menu($page); ?>
            </td>
        </tr>
        </table>

<?php

}


function display_header2($page)
{

?>

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td class="header_bar">
    	<center>
    	<table width="800">
        <tr>
        	<td align="left"><span class="header_link"><a href="#" class="header_link">English</a></span> <font color='#666666'>|</font> <span class="header_link"><a href="#" class="header_link">Russian</a></span></td>
        </tr>
        </table>
    	</center>
    </td>
</tr>
</table>



<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td class="background_repeat">
    &nbsp;&nbsp;
    </td>
    <td width="800">
    
    
    
    
<center>
<table class="main_content" cellpadding="0" cellspacing="0">
<tr>
	<td>
    	<table class="header" cellpadding="0" cellspacing="0">
        <tr>
        	<td colspan="4" height="30">&nbsp;</td>
        </tr>
        
        <tr>
        	<td valign="top" align="left">
            	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/Logo.jpg" alt="All Star Kiev Apartments">
            </td>
            <td valign="top" align="left">
            	<span class="phone_man">+380 44 484 1637<br>
                +380 67 656 2023<br>
                +380 50 441 5979</span>
                <span class="time_man">
                (for English)<br /><br />
                <b>Hours: </b>8:00 - 20:00<br /><br />
</span>
                <span class="time_man">
                <b>Hours: </b>8:00 - 20:00<br /></span>
                <a href="mailto: info@allstar.com.ua">info@allstar.com.ua</a>
            	</td>
                <td valign="top" align="left" width="250">
                <span class="time_man"><b>Exchange rate: </b><br />UAH 7.6/ USD 1<br /><br />
                <span class="time_man"><b>Ukrainian Time: </b><br /><span id="clock">&nbsp;</span></span><br />
                <span class="time_man"><br /><b>Weather: </b></span><br /><a href="http://www.wunderground.com/global/stations/33345.html" target="_blank">View Current Conditions</a>
            </td>
            <td valign="top" align="right">
            	<img src="../images/ms-visa.jpg" alt="MasterCard - Visa">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </td>
        </tr>
        
        <tr>
        	<td colspan="4">
            
            
            <script language="javascript">
	if (AC_FL_RunContent == 0) {
		alert("This page requires AC_RunActiveContent.js.");
	} else {
		AC_FL_RunContent(
			'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0',
			'width', '800',
			'height', '200',
			'src', 'flash/NewHeader',
			'quality', 'high',
			'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
			'align', 'middle',
			'play', 'true',
			'loop', 'true',
			'scale', 'showall',
			'wmode', 'window',
			'devicefont', 'false',
			'id', 'flash/NewHeader',
			'bgcolor', '#ffffff',
			'name', 'flash/NewHeader',
			'menu', 'true',
			'allowFullScreen', 'false',
			'allowScriptAccess','sameDomain',
			'movie', '../flash/NewHeader',
			'salign', ''
			); //end AC code
	}
</script>
<noscript>
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="800" height="200" id="flash/NewHeader" align="middle">
	<param name="allowScriptAccess" value="sameDomain" />
	<param name="allowFullScreen" value="false" />
	<param name="movie" value="../flash/NewHeader.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" />	<embed src="../flash/NewHeader.swf" quality="high" bgcolor="#ffffff" width="800" height="200" name="flash/NewHeader" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
	</object>
</noscript>
            
            
            </td>
        </tr>
        
        <tr>
        	<td colspan="4">
            	<?php display_menu2($page); ?>
            </td>
        </tr>
        </table>

<?php

}

function display_header_r($page)
{

?>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td class="header_bar">
    	<center>
    	<table width="800">
        <tr>
        	<td align="left"><span class="header_link"><a href="../" class="header_link">English</a></span> <font color='#666666'>|</font> <span class="header_link"><a href="#" class="header_link">Russian</a></span></td>
        </tr>
        </table>
    	</center>
    </td>
</tr>
</table>



<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td class="background_repeat">
    &nbsp;&nbsp;
    </td>
    <td width="800">
    
    
    
    
<center>
<table class="main_content" cellpadding="0" cellspacing="0">
<tr>
	<td>
    	<table class="header" cellpadding="0" cellspacing="0">
        <tr>
        	<td colspan="4" height="30">&nbsp;</td>
        </tr>
        
        <tr>
        	<td valign="top" align="left">
            	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/Logo.jpg" alt="All Star Kiev Apartments">
            </td>
            <td valign="top" align="left">
            	<span class="phone_man">+380 44 484 1637<br>
                +380 67 656 2023<br>
                +380 50 441 5979</span>
                <span class="time_man">
                (for English)<br /><br />
                8:00 - 20:00<br /><br />
</span>
                <a href="mailto: info@allstar.com.ua">info@allstar.com.ua</a>
            	</td>
                <td valign="top" align="left" width="250">
                <span class="time_man"><b>Обменный курс: </b><br />UAH 7.6/ USD 1<br /><br />
                <span class="time_man"><b>Время в Украине: </b><br /><span id="clock">&nbsp;</span></span><br />
                <span class="time_man"><br /><b>Погода: </b></span><br /><a href="http://www.wunderground.com/global/stations/33345.html" target="_blank">Посмотреть текущее состояние</a><br /><br />
            </td>
            <td valign="top" align="right">
            	<img src="../images/ms-visa.jpg" alt="MasterCard - Visa">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </td>
        </tr>
        <?php if($page != -1){?>
        <tr>
        	<td colspan="4">
            
            
            <script language="javascript">
	if (AC_FL_RunContent == 0) {
		alert("This page requires AC_RunActiveContent.js.");
	} else {
		AC_FL_RunContent(
			'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0',
			'width', '800',
			'height', '200',
			'src', 'flash/NewHeader',
			'quality', 'high',
			'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
			'align', 'middle',
			'play', 'true',
			'loop', 'true',
			'scale', 'showall',
			'wmode', 'window',
			'devicefont', 'false',
			'id', 'flash/NewHeader',
			'bgcolor', '#ffffff',
			'name', 'flash/NewHeader',
			'menu', 'true',
			'allowFullScreen', 'false',
			'allowScriptAccess','sameDomain',
			'movie', '../flash/NewHeader',
			'salign', ''
			); //end AC code
	}
</script>
<noscript>
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="800" height="200" id="flash/NewHeader" align="middle">
	<param name="allowScriptAccess" value="sameDomain" />
	<param name="allowFullScreen" value="false" />
	<param name="movie" value="../flash/NewHeader.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" />	<embed src="../flash/NewHeader.swf" quality="high" bgcolor="#ffffff" width="800" height="200" name="flash/NewHeader" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
	</object>
</noscript>
            
            
            </td>
        </tr>
        <?php } ?>
        <tr>
        	<td colspan="4">
            	<?php display_menu_r($page); ?>
            </td>
        </tr>
        </table>

<?php

}

function display_menu_r($page)
{
?>

<ul id="menu">
<li><a href="../rus/index.php" target="_self" title="главная" <?php if($page==1){ echo " class='current'"; }?>>главная</a></li>
<li><a href="../rus/properties.php" target="_self" title="все апартаменты" <?php if($page==2){ echo " class='current'"; }?>>все апартаменты</a></li>
<li><a href="../rus/howtobook.php" target="_self" title="как забронировать" <?php if($page==3){ echo " class='current'"; }?>>как забронировать</a></li>
<li><a href="../rus/guestservices.php" target="_self" title="дополнительные услуги" <?php if($page==4){ echo " class='current'"; }?>>дополнительные услуги</a></li>
<li><a href="../rus/faq.php" target="_self" title="Вопросы и ответы" <?php if($page==5){ echo " class='current'"; }?>>Вопросы и ответы</a></li>
<li><a href="../rus/contactus.php" target="_self" title="контакты" <?php if($page==6){ echo " class='current'"; }?>>контакты</a></li>
</ul>

<?php
}


function start_content()
{
?>

<table class="one_column_content" cellspacing="30" padding="0">
<tr>
	<td valign="top" align="left">


<?php
}


function start_content_w_search($link)
{
?>

<table class="one_column_content" cellspacing="30">
<tr>
	<td valign="top" width="350">
    	<table width="340" cellspacing="0" cellpadding="0">
        <tr>
        	<td height="35" background="images/find-an-apartment-header.jpg">
            
            </td>
        </tr>
        <tr>
        	<td>
            	<div class="search_box">
              
                
                <form method="get" action="search.php">
                
                <?php
				
				if($_GET['error'] != "")
				{
					echo "<font color='#990000'>You have an error in your dates. Please revise.</font><br><br />";
				
				}
				
				?>
                
                <table>
                	<tr>
                    	<td valign="middle" align="left">
                        <b>Arrival Date</b>
                        </td>
                        <td valign="middle" align="left">
                        <input type="text" id="arrival" name="arrival"> <img src="images/cal_icon.gif" name="trigger" align="absmiddle" id="trigger" style="cursor: pointer;"/>              
                        </td>
                    </tr>
                    <tr>
                    	<td valign="middle" align="left">
                        <b>Departure Date</b>
                        </td>
                        <td valign="middle" align="left">
                        <input type="text" id="departure" name="departure"> <img src="images/cal_icon.gif" name="trigger2" align="absmiddle" id="trigger2" style="cursor: pointer;"/>                        </td>
                    </tr>
                    <tr>
                    	<td valign="middle" align="left">
                        <b>Rooms</b>
                        </td>
                        <td valign="middle" align="left">
                        <select name="rooms">
                        <option value="Any" selected>Any</option>
                        <option value="Studio">Studio</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="3">4</option>
                        </select>
                        </td>
                    </tr>
                    
                    <tr>
                    	<td valign="middle" align="left">
                        <b>Price [USD] from</b>
                        </td>
                        <td valign="middle" align="left">
                        $<input type="text" name="fromprice" size="7" value="0"> <b>to</b> $<input type="text" name="toprice" value="500" size="7">
                        </td>
                    </tr>
                    
                    <tr>
                    	<td valign="middle" align="left">
      
                        </td>
                        <td valign="middle" align="left"><br>
                        <input type="submit" value="Search"><br /><br />
                        <a href="advanced_search.php"><img src="images/advanced-search.jpg" border="0"/></a>
                        </td>
                    </tr>
                </table>
                </form>
                
                <script type="text/javascript">
				Calendar.setup
				(
					{
						inputField : "arrival", // ID of the input field
						ifFormat : "%m/%d/%y", // the date format
						button: "trigger" // ID of the button
					}
				);
				
				Calendar.setup
				(
					{
						inputField : "departure", // ID of the input field
						ifFormat : "%m/%d/%y", // the date format
						button : "trigger2" // ID of the button
					}
				);
				</script>
             
                
                <form action="search_code.php" method="get">
                
                <table border="0">
                <tr>
                	<td>
                <b>Search by code </b></td><td><input size="4" type="text" name="search_code" /></td><td><input type="submit" value="Search" /></td>
                </tr>
                </table>
                
               	<br />
                
                </form>
                
                
                
                
                </div>
            </td>
        </tr>
        
        <tr>
        	<td align="left"><br />
            	<?php display_hot_offers($link); ?>
            </td>
        </tr>
        </table>
    </td>
    <td valign="top" width="450" align="left">


<?php
}




function end_content()
{
?>

</td>
</tr>
</table>

<?php
}

function display_footer()
{

?>



</td>
</tr>
</table>

</td>
  	<TD class="background_repeat">&nbsp;&nbsp;</TD>
    </tr></table>

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td class="footer_bar">
    Copyright © <?php echo date("Y", time()); ?> All Star Kiev Apartments. All Rights Reserved.
    </td>
</tr>
</table>
</center>
<?php
}

function display_menu($page)
{
?>

<ul id="menu">
<li><a href="index.php" target="_self" title="home" <?php if($page==1){ echo " class='current'"; }?>>home</a></li>
<li><a href="properties.php" target="_self" title="all apartments" <?php if($page==2){ echo " class='current'"; }?>>all apartments</a></li>
<li><a href="howtobook.php" target="_self" title="how to book" <?php if($page==3){ echo " class='current'"; }?>>how to book</a></li>
<li><a href="guestservices.php" target="_self" title="guest services" <?php if($page==4){ echo " class='current'"; }?>>guest services</a></li>
<li><a href="faq.php" target="_self" title="faq" <?php if($page==5){ echo " class='current'"; }?>>faq</a></li>
<li><a href="contactus.php" target="_self" title="contact us" <?php if($page==6){ echo " class='current'"; }?>>contact us</a></li>
</ul>

<?php
}


function display_menu2($page)
{
?>

<ul id="menu">
<li><a href="../index.php" target="_self" title="home" <?php if($page==1){ echo " class='current'"; }?>>home</a></li>
<li><a href="../properties.php" target="_self" title="all apartments" <?php if($page==2){ echo " class='current'"; }?>>all apartments</a></li>
<li><a href="../howtobook.php" target="_self" title="how to book" <?php if($page==3){ echo " class='current'"; }?>>how to book</a></li>
<li><a href="../guestservices.php" target="_self" title="guest services" <?php if($page==4){ echo " class='current'"; }?>>guest services</a></li>
<li><a href="../faq.php" target="_self" title="faq" <?php if($page==5){ echo " class='current'"; }?>>faq</a></li>
<li><a href="../contactus.php" target="_self" title="contact us" <?php if($page==6){ echo " class='current'"; }?>>contact us</a></li>
</ul>

<?php
}



function display_hot_offers($link)
{
?>

<h1>Long-term Hot Offers</h1>

<?php

$query = "SELECT * FROM hot_offers";
$result = mysql_query($query,$link) or die("Error: Could not retrieve hot offers." . mysql_error());

while($data = mysql_fetch_array($result))
{
	$query = "SELECT * FROM listings WHERE id=" . $data['listing_id'];
	$result2 = mysql_query($query,$link) or die("Error: could not get listing name. must have been removed. please add this function." . mysql_error());
		
	$data2 = mysql_fetch_array($result2);

	echo "<table width='100%' style='border: 1px solid #999999' border='0'><tr><td width='100'>";
	echo "<a href='view_listing.php?id=" . $data2['id']. "&hotoffer=1'>";
	echo "<img width='150' src='uploads/".$data2['mainimage'] . "' border='0'></a>";
	
	echo "</td>";
	echo "<td width='10'>&nbsp;</td><td align='left' valign='top'>";
	
	echo "<a href='view_listing.php?id=" . $data2['id']. "&hotoffer=1'>" . $data2['address']. "</a><br>";
	
	echo "<br>";
	echo "<b>Rooms: </b>" . $data2['numbeds'] . "<br>";
	echo "<b>Price: </b> <span class='line_through'>$";



			echo $data2['price1'];
	
	
	echo "</span>";
	
	echo "&nbsp;<h2>$" . $data['new_price'] . "</h2>";
	echo "</td></tr></table><br>";
}

?>

<?php
}

function randomFileName() { 

    $chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
    srand((double)microtime()*1000000); 
    $i = 0; 
    $pass = '' ; 

    while ($i <= 24)
	{ 
        $num = rand() % 33; 
        $tmp = substr($chars, $num, 1); 
        $pass = $pass . $tmp; 
        $i++;
    } 

    return $pass; 
}

function google_tracker()
{
?>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-3286161-19");
pageTracker._trackPageview();
} catch(err) {}</script>


<?

}
function draw_divider()
{
	echo "<center><img src='images/divider.gif'><br></center>";
}

function exchange_rate($link)
{
	$query = "SELECT * FROM dollars_to_uah WHERE id=1";
	$result = mysql_query($query,$link) or die("Error: Could not get exchange rate.<br><br>" . mysql_error());
	
	$data = mysql_fetch_array($result);
	
	return $data['dollars_to_uah'];
}


?>           
               