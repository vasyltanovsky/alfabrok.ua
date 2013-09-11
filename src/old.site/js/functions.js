var lang_array = new Array();;
	lang_array[1] = new Array();
	lang_array[1]['SendImToFriend_pre'] = 'Имя друга:  <input type="text" class="DivPropmtMarginLeft" id="FriendName" name="FriendName" value="" /><br /><br />E-mail друга: <input type="text" id="emailFriend" name="emailFriend" value="" /><input type="hidden" id="im_id" name="im_id" value="';
	lang_array[1]['SendImToFriend_post'] = '" />';
	lang_array[1]['SendImToFriendSendOk'] = 'Письмо отправлено!';
	lang_array[1]['SendImToFavoritesFalse'] = 'Для добавления недвижимости в избранное, Вам необходимо авторизоваться!';
	lang_array[1]['SendImToFavoritesOk'] = 'Недвижимость добавлена!';
	
	lang_array[1]['AddImToDB'] = 'Для добавления недвижимости на сайт, Вам необходимо авторизоваться!';
	
$(document).ready(function() { 
	$('img').bind("contextmenu", function(e){ return false; });					   
						   
	$('#search_top_field').focus(function() {  
		if (this.value == this.defaultValue){  
			this.value = '';  
		}  
		/*if(this.value != this.defaultValue){  
			this.select();  
		}*/ 
	}); 
	$('#search_top_field').blur(function() {
		if(this.value == '')
		this.value = (this.defaultValue ? this.defaultValue : '');
	});
						   
	 $('#TUserEnterLogin').focus(function() {  
         if (this.value == this.defaultValue){  
             this.value = '';  
         }  
         if(this.value != this.defaultValue){  
             this.select();  
         } 
	 });  
	$('#TUserEnterLogin').blur(function() {
		if(this.value == '')
			this.value = (this.defaultValue ? this.defaultValue : '');
	}); 
     $('#TUserEnterPass').focus(function() {  
         if (this.value == this.defaultValue){  
             this.value = '';  
         }  
         if(this.value != this.defaultValue){  
             this.select();  
         } 
	 });  
	$('#TUserEnterPass').blur(function() {
		if(this.value == '')
			this.value = (this.defaultValue ? this.defaultValue : '');
	});
	var yFunc = new yFunctional("");
	$('#showFullOneMap').click(function() {
		yFunc.showOneFullScreen();
		map.redraw();
	});
	$('#hideFullOneMap').click(function() {
		yFunc.hideOneFullScreen();
		map.redraw();
	});
 }); 
 
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

//Объект обеспечивает функционал баннера задесь падают цены, горящие предложения
function indexBan(linkDivId, posDivId, link, rentSale, catalog) {
  	this.linkDivId = (linkDivId ? linkDivId : null);
  	this.posDivId = (posDivId ? posDivId : null);
  	this.link = (link ? link : '?action=hot_price');
  	this.rentSale = (rentSale ? rentSale : 'sale');
  	this.catalog = (catalog ? catalog : 'home');
  	this.arCatalog = new Array();
  	this.arCatalog['flat'] = null;
  	this.arCatalog['commercial'] = null;
  	this.arCatalog['home'] = null;
  	this.arCatalog['buildings'] = null;
  	this.arCatalog['land'] = null; 
  	this.some =null;
}
	indexBan.prototype.clickRadioBottom = function (){
	}
	/*	действие при клике по кнопке	*/
	indexBan.prototype.clickCatBottom = function ( btm ){
		this.setCatBottomActive( btm );
		this.searchSetPosition();
		if(!this.some) {
			this.setLinkIsset();
			this.some = true;
		}
		this.setLinkToAllPosition();
	}
	/*	указываем активный каталог недвижимости	*/
	indexBan.prototype.setCatBottomActive = function ( btm ){
		this.catalog = $(btm).attr('rel');
		$(this.linkDivId + " span").removeClass('AlinkActive');
		$(btm).addClass('AlinkActive');
	}
	/*	поиск недвиж. согласно выбранной категории	*/
	indexBan.prototype.searchSetPosition = function (){
		var count = $(this.posDivId +" div.DivListImBanIn" ).children().length;
		var pos = null;
		var indif = this.catalog + '/' + this.rentSale;
		for(var i=0; i< count;  i++ ) {
			if( i == 0 ) 
				var pos = $( this.posDivId ).children(" div.DivListImBanIn ");
			else
				pos = $( pos ).next();
			
			if( $( pos ).attr('rel') ) {
				//
				this.sortLinkForIsset($( pos ).attr('rel'));
				//
				if( indif.toString() == $( pos ).attr('rel').toString()) {
					$( '#' + $( pos ).attr('id') ).show( );	
				}
				else {
					$( '#' + $( pos ).attr('id') ).hide( );
				}
			}
		}
	}
	/*	показываем кнопки соответсвенно к существованию недвиж. */
	indexBan.prototype.setLinkIsset = function (){
		$(this.linkDivId + " span").hide();
		for(var key in this.arCatalog) {
			if(this.arCatalog[key]) 
				$("#linkBan-" + key).show();
		}
	}
	/*	записываем в массив индификаторы по категории недвиж. */
	indexBan.prototype.sortLinkForIsset = function ( divRel ){
		var indif = divRel.substring(0, divRel.indexOf('/'));
		this.arCatalog[indif] = true;
	}
	/*	формирование ссылки для оттображение всех позиций */
	indexBan.prototype.setLinkToAllPosition = function ( ){
		$("a.DivListImBanAViewAll").attr( {href: "/s_immovables.html" + this.link + "&cat=" + this.catalog});
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
	
			
	