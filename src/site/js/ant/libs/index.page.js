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