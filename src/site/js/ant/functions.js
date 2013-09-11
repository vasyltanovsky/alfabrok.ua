var lang_array = new Array();;
	lang_array[1] = new Array();
	lang_array[1]['SendImToFriend_pre'] = 'Имя друга:  <input type="text" class="DivPropmtMarginLeft" id="FriendName" name="FriendName" value="" /><br /><br />E-mail друга: <input type="text" id="emailFriend" name="emailFriend" value="" /><input type="hidden" id="im_id" name="im_id" value="';
	lang_array[1]['SendImToFriend_post'] = '" />';
	lang_array[1]['SendImToFriendSendOk'] = 'Письмо отправлено!';
	lang_array[1]['SendImToFavoritesFalse'] = 'Для добавления недвижимости в избранное, Вам необходимо авторизоваться!';
	lang_array[1]['SendImToFavoritesOk'] = 'Недвижимость добавлена!';
	
	lang_array[1]['AddImToDB'] = 'Для добавления недвижимости на сайт, Вам необходимо авторизоваться!';
function SetImLink(type_cat) {
	var value = $("#ImMenu :radio").fieldValue();
	var redirect_url = '/ru/';
	if (value != '')
		redirect_url = redirect_url + type_cat + '/' + value + '';
	else
		redirect_url = redirect_url + type_cat + '/sale';
	location.href = redirect_url;
}
function SetImLinkPage(page, type_cat) {
	var redirect_url = '/ru/' + page + '/' + type_cat + '';
	location.href = redirect_url;
}
/*
добавления указателя недвижимости в поля поиска по коду
*/
function setPointerCodeToSCField(pCode) {
	var valSTF = $('#search_top_field').val();
	var ret = '';
	if(!Number(valSTF) && valSTF != null) {
		for(var i= 0; i<valSTF.length; i++) {
			//alert(valSTF[i]);
			if(Number(valSTF[i]) || valSTF[i] == '0')
				ret += valSTF[i];
		}
		valSTF = ret;
		//valSTF = parseInt(ret);
	}
	var val = pCode + valSTF;
	$('#search_top_field').val(val);
	caretTo($('#search_top_field')[0], val.length);
	//alert(pCode);
	return;
}

caretTo = function (el, index) {
	if (el.setSelectionRange != null) {
		el.focus();
		el.setSelectionRange(index, index);
	} else if (el.createTextRange) {
		var range = el.createTextRange();
		range.moveStart("character", index);
		range.select();
	} 
};

function changePointerCodeToSCField( element ) {
	var valSTF = $(element).val();
	
	if(valSTF == "") 
		return;
	valSTF = valSTF.toUpperCase().replace(new RegExp("Л",'g'), 'K');
	valSTF = valSTF.toUpperCase().replace(new RegExp("R",'g'), 'K');
	valSTF = valSTF.toUpperCase().replace(new RegExp("К",'g'), 'K');
	valSTF = valSTF.toUpperCase().replace(new RegExp("С",'g'), 'C');
	valSTF = valSTF.toUpperCase().replace(new RegExp("C",'g'), 'C');
	valSTF = valSTF.toUpperCase().replace(new RegExp("H",'g'), 'H');
	valSTF = valSTF.toUpperCase().replace(new RegExp("Y",'g'), 'H');
	valSTF = valSTF.toUpperCase().replace(new RegExp("Н",'g'), 'H');
	valSTF = valSTF.toUpperCase().replace(new RegExp("Р",'g'), 'H');
	valSTF = valSTF.toUpperCase().replace(new RegExp("M",'g'), 'M');
	valSTF = valSTF.toUpperCase().replace(new RegExp("V",'g'), 'M');
	valSTF = valSTF.toUpperCase().replace(new RegExp("М",'g'), 'M');
	valSTF = valSTF.toUpperCase().replace(new RegExp("Ь",'g'), 'M');
	valSTF = valSTF.toUpperCase().replace(new RegExp("T",'g'), 'T');
	valSTF = valSTF.toUpperCase().replace(new RegExp("N",'g'), 'T');
	valSTF = valSTF.toUpperCase().replace(new RegExp("Т",'g'), 'T');
	valSTF = valSTF.toUpperCase().replace(new RegExp("Е",'g'), 'T');
	
	$(element).val(valSTF);
	return;
}

/*	??????????? ????????
*/
function getNameBrouser() {
 var ua = navigator.userAgent.toLowerCase();
 // ????????? Internet Explorer
 if (ua.indexOf("msie") != -1 && ua.indexOf("opera") == -1 && ua.indexOf("webtv") == -1) {
   return "msie"
 }
 // Opera
 if (ua.indexOf("opera") != -1) {
   return "opera"
 }
 // Gecko = Mozilla + Firefox + Netscape
 if (ua.indexOf("gecko") != -1) {
   return "gecko";
 }
 // Safari, ???????????? ? MAC OS
 if (ua.indexOf("safari") != -1) {
   return "safari";
 }
 // Konqueror, ???????????? ? UNIX-????????
 if (ua.indexOf("konqueror") != -1) {
   return "konqueror";
 }
 return "unknown";
}  
 
function ShowPreloaderM() {
	$('#PreloaderM').show();
}
function HidePreloaderM() {
	$('#PreloaderM').hide();
}

function ShowPreloader() {
	$('#Preloader').show();
}
function HidePreloader() {
	$('#Preloader').hide();
}
function DellSubsId(SubsId) {
	$('#DivRequestQuery').load('/application/module/user/template.data.retention.php?retention=dell_subs&us_id='+SubsId+'');
	$("#DivRequestQuery").ajaxComplete(function(){
  		window.location = location.href.toLowerCase(); 
	});
}
function AddImPosition() {
	var c_name = "user_id";
	c_start=document.cookie.indexOf(c_name + "=");
	if (c_start != -1) {
		window.location = "/user/2imadd.html";
	}
	else {
		window.location = "/addingobject.html";
	}
}
function alertSize() {
  var myWidth = 0, myHeight = 0;
  if( typeof( window.innerWidth ) == 'number' ) {
    //Non-IE
    myWidth = window.innerWidth;
    myHeight = window.innerHeight;
  } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
    //IE 6+ in 'standards compliant mode'
    myWidth = document.documentElement.clientWidth;
    myHeight = document.documentElement.clientHeight;
  } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
    //IE 4 compatible
    myWidth = document.body.clientWidth;
    myHeight = document.body.clientHeight;
  }
  //window.alert( 'Width = ' + myWidth );
  //window.alert( 'Height = ' + myHeight );
  return [ myWidth, myHeight ]
}

/* INDEX LINK	*/
	function indexLinkHideTr() {
		if( ($('#tableIndexOneClick tr.flat td.sale').text() == "" ) && ($('#tableIndexOneClick tr.flat td.rent').text() == "" ))
			$('#tableIndexOneClick tr.flat').hide();
		if( ($('#tableIndexOneClick tr.commercial td.sale').text() == "" ) && ($('#tableIndexOneClick tr.commercial td.rent').text() == "" ))
			$('#tableIndexOneClick tr.commercial').hide();
		if( ($('#tableIndexOneClick tr.home td.sale').text() == "" ) && ($('#tableIndexOneClick tr.home td.rent').text() == "" ))
			$('#tableIndexOneClick tr.home').hide();
		if( ($('#tableIndexOneClick tr.buildings td.sale').text() == "" ) && ($('#tableIndexOneClick tr.buildings td.rent').text() == "" ))
			$('#tableIndexOneClick tr.buildings').hide();
		if( ($('#tableIndexOneClick tr.land td.sale').text() == "" ) && ($('#tableIndexOneClick tr.land td.rent').text() == "" ))
			$('#tableIndexOneClick tr.land').hide();	
	}
	
			
	