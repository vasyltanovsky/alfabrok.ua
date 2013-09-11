 //<![CDATA[

 // If you don't want to put nonstandard properties in your stylesheet, here's yet
 // another means of activating the script. This assumes that you have at least one
 // stylesheet included already in the document above this script.
 // To activate, delete the CSS rules above and uncomment below (remove /* and */ ).


 if (document.all && /MSIE (5\.5|6)/.test(navigator.userAgent) &&
  document.styleSheets && document.styleSheets[0] && document.styleSheets[0].addRule)
 {
  document.styleSheets[0].addRule('*', 'behavior: url(iepngfix.htc)');
  // Feel free to add rules for specific elements only, as above.
  // You have to call this once for each selector, like so:
  //document.styleSheets[0].addRule('img', 'behavior: url(iepngfix.htc)');
  //document.styleSheets[0].addRule('div', 'behavior: url(iepngfix.htc)');
 }


 // Here's another script that disables all PNGs in IE when the page is printed.

 if (window.attachEvent  && /MSIE (5\.5|6)/.test(navigator.userAgent))
 {
  function printPNGFix(disable)
  {
   for (var  i = 0; i < document.all.length; i++)
   {
    var e = document.all[i];
    if (e.filters['DXImageTransform.Microsoft.AlphaImageLoader'] || e._png_print)
    {
     if (disable)
     {
      e._png_print = e.style.filter;
      e.style.filter = '';
     }
     else
     {
      e.style.filter = e._png_print;
      e._png_print = '';
     }
    }
   }
  };
  window.attachEvent('onbeforeprint',  function() { printPNGFix(1) });
  window.attachEvent('onafterprint',  function() { printPNGFix(0) });
 }

 //]]>