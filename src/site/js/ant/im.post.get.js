/*
	массив слов версия языка
*/
var lang_array = new Array();;
	lang_array[1] = new Array();
	lang_array[1]['SendImToFriend_pre'] = 'Укажите имя друга:  <input type="text" class="DivPropmtMarginLeft" id="FriendName" name="FriendName" value="" /><br /><br />Укажите email друга: <input type="text" id="emailFriend" name="emailFriend" value="" /><input type="hidden" id="im_id" name="im_id" value="';
	lang_array[1]['SendImToFriend_post'] = '" />';
	lang_array[1]['SendImToFriendSendOk'] = 'Письмо отправлено!';
	lang_array[1]['SendImToFavoritesFalse'] = 'Для того, чтобы добавить недвижимость в избранное, Вам необходимо авторизоваться!';
	lang_array[1]['SendImToFavoritesOk'] = 'Добавлено!';

//реакция на правый клик мыши
	var isNS = (navigator.appName == "Netscape") ? 1 : 0;
	if(navigator.appName == "Netscape") 
     	document.captureEvents(Event.MOUSEDOWN||Event.MOUSEUP);
  	function mischandler(){
   		return false;
 	}
  	function mousehandler(e){
 		var myevent = (isNS) ? e : event;
 		var eventbutton = (isNS) ? myevent.which : myevent.button;
    	if((eventbutton==2)||(eventbutton==3)) 
			return false;
 	}
 	document.oncontextmenu = mischandler;
 	document.onmousedown = mousehandler;
 	document.onmouseup = mousehandler;
 
 
 /*
	Всплывающие окно для отправки недвижимости другу
*/
function SendImToFriend(im_id) {
	var lang_id = $.cookie("lang_id");
	var txt = lang_array[lang_id]['SendImToFriend_pre']+im_id+lang_array[lang_id]['SendImToFriend_post'];
	
	$.prompt(txt,{
		submit: SendImToFriendIsTrue,
		buttons: { Ok:true }
	});
};
/*
	Всплывающие окно для отправки недвижимости другу (проверочная функция формы)
*/
function SendImToFriendIsTrue(v,m,f){
	var FFriendName = $("#FriendName").fieldValue();
	var FemailFriend = $("#emailFriend").fieldValue();
	var Fim_id = $("#im_id").fieldValue();
	var lang_id = $.cookie("lang_id");
	var SendImToFriendSendOk = lang_array[lang_id]['SendImToFriendSendOk'];
	
	
	if(FFriendName == ""){
		$("#FriendName").css("border","solid #ff0000 1px");
		return false;
	}
	if(FemailFriend == ""){
		$("#emailFriend").css("border","solid #ff0000 1px");
		return false;
	}
	if(isValidEmailAddress(FemailFriend) == false)  {
		$("#emailFriend").css("border","solid #ff0000 1px");
		return false;
	}
	
	var Ajaxload = "http://admin.alfabrok.ua/report_center.php?action=set_friend_im&im_id="+Fim_id+"&name="+FFriendName+"&email="+FemailFriend; 
	//var Ajaxload = "/ru/report/sendtofriend?im_id="+Fim_id+"&name="+FFriendName+"&email="+FemailFriend; 
	$('#DivRequestQuery').load(Ajaxload);
	$.prompt(SendImToFriendSendOk);
	return true;
}
/*
	(проверка коррктности поля email)
*/
function isValidEmailAddress(emailAddress) {
	var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	return pattern.test(emailAddress);
}

/*
	
*/
function setStylePnumber(Fid,FValue) {
	$('#DivRequest').load('/ru/immovables/setCookie?key='+Fid+'&value='+FValue+'');
	$("#DivRequest").ajaxComplete(function(){
	  	//location.href = location.href.toLowerCase();});
		location.href = location.href;
	});
	return;
}
/*
	сортировавка недвижимости
*/
function setSortTable(FValue) {
	$('#DivRequest').load('/ru/immovables/setsorttable?key='+FValue+'');
	//alert('asd');
	$("#DivRequest").ajaxComplete(function(){
  		//location.href = location.href.toLowerCase();
		location.href = location.href;
	});
	return;
}
/*
	получение описания недвижимости
*/
function SetImLang (lang_id, im_id) {
	$('#DivSummaryTextId').load('/application/module/immovables/get.post.hadler.php?action=GetImSummary&im_id='+im_id+'&lang_id='+lang_id);
	$('#DivSummaryLang a').removeClass("AlinkSelected");
	$('#DivSummaryLang a').addClass("AlinkNoSelected"); 
	$('#'+lang_id).removeClass("AlinkNoSelected"); 
	$('#'+lang_id).addClass("AlinkSelected"); 
	return;
}
function SetImFavorites (im_id, user_id) {
	var lang_id = $.cookie("lang_id");
	if(user_id == 0) {
		$.prompt(lang_array[lang_id]['SendImToFavoritesFalse']);
	}
	else {
		$('#UserImFavoritesId').load('/application/module/immovables/get.post.hadler.php?action=SetImFavorites&im_id='+im_id+'&user_id='+user_id);
		$.prompt(lang_array[lang_id]['SendImToFavoritesOk']);
	}
	return;
}
