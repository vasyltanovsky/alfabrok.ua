var imDownPraceObj = new indexBan('#linksListBan', '#positionListBan', '?action=hot_price');
imDownPraceObj.clickCatBottom($("#linksListBan #linkBan-home"));
	$('#linksListBan span').click( function() {
		imDownPraceObj.clickCatBottom(this);
	});
// JavaScript Document
$(document).ready( function() {

	/*	SLIDE PHOTO*/
	$('#Flat').cycle( {
		fx : 'fade',
		speed : 4000,
		timeout : 2000
	});
	$('#Commercial').cycle( {
		fx : 'fade',
		speed : 4000,
		timeout : 6000
	});
	$('#Home').cycle( {
		fx : 'fade',
		speed : 4000,
		timeout : 8000
	});
	$('#Buildings').cycle( {
		fx : 'fade',
		speed : 4000,
		timeout : 4000
	});
	$('#Land').cycle( {
		fx : 'fade',
		speed : 4000,
		timeout : 5000
	});
	/* SLIDE PHOTO */

	/*	*/
	indexLinkHideTr();
	/* index im. banner down price */
	imDownPraceObj.clickCatBottom($("#linksListBan #linkBan-home"));

	$('#linksListBan span').click( function() {
		//alert($(this).text() + '' + $(this).attr('rel'));
			imDownPraceObj.clickCatBottom(this);
		});
});
/*yandex*/
$( function() {
	var icons = {
		header : "ui-icon-ymap-arrow-e",
		headerSelected : "ui-icon-ymap-arrow-s"
	};
	$("#accYMapSearchTypeIm").accordion( {
		icons : false,
		autoHeight : false,
		active : false,
		navigation : false,
		collapsible : true
	});
});