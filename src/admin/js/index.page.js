var imDownPraceObj = new indexBan ('#linksListBan', '#positionListBan', '?action=hot_price');

// JavaScript Document
$(document).ready(function() {
	/*	SLIDE PHOTO*/ 
		$('#Flat').cycle({ 
			fx: 'fade',
			speed:    4000,
			timeout:  2000 
		});
		$('#Commercial').cycle({ 
			fx: 'fade',
			speed:    4000,
			timeout:  6000 
		});
		$('#Home').cycle({ 
			fx: 'fade',
			speed:    4000,
			timeout:  8000 
		});
		$('#Buildings').cycle({ 
			fx: 'fade',
			speed:    4000,
			timeout:  4000 
		});
		$('#Land').cycle({ 
			fx: 'fade',
			speed:    4000,
			timeout:  5000 
		});
	/*	SLIDE PHOTO*/ 
	
	/*	*/
	indexLinkHideTr();
	/*	index im. banner down price*/
	imDownPraceObj.clickCatBottom( $("#linksListBan #linkBan-home") );
	
	$('#linksListBan span').click( function() {
		//alert($(this).text() + '' + $(this).attr('rel'));
		imDownPraceObj.clickCatBottom(this);
	});	
});

//??????? ???????????? ??????? ?? ????????? ????????? ????????????
	function SetImLink(type_cat) {
		var value = $("#ImMenu :radio").fieldValue();
		var redirect_url = '/immovables/';
		if (value != '') redirect_url = redirect_url + type_cat + '/' + value +'.html';
		else redirect_url = redirect_url + type_cat + '/sale.html';
		location.href = redirect_url;
	}
	function SetImLinkPage(page, type_cat) {
		var redirect_url = '/immovables/'+page+'/'+type_cat+'.html';
		location.href = redirect_url;
	}
