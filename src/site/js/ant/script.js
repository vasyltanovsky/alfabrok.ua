/* Author:
 */
/* =============== functions.js ============ */
$(document).ready( function() {
	
	$('img').bind("contextmenu", function(e) {
		return false;
	});

	$('#search_top_field').focus( function() {
		if (this.value == this.defaultValue) {
			this.value = '';
		}
		/*if(this.value != this.defaultValue){  
			this.select();  
		}*/
	});
	$('#search_top_field').blur( function() {
		if (this.value == '')
			this.value = (this.defaultValue ? this.defaultValue : '');
	});

	$('#TUserEnterLogin').focus( function() {
		if (this.value == this.defaultValue) {
			this.value = '';
		}
		if (this.value != this.defaultValue) {
			this.select();
		}
	});
	$('#TUserEnterLogin').blur( function() {
		if (this.value == '')
			this.value = (this.defaultValue ? this.defaultValue : '');
	});
	$('#TUserEnterPass').focus( function() {
		if (this.value == this.defaultValue) {
			this.value = '';
		}
		if (this.value != this.defaultValue) {
			this.select();
		}
	});
	$('#TUserEnterPass').blur( function() {
		if (this.value == '')
			this.value = (this.defaultValue ? this.defaultValue : '');
	});
	var yFunc = new yFunctional("");
	$('#showFullOneMap').click( function() {
		yFunc.showOneFullScreen();
		map.redraw();
	});
	$('#hideFullOneMap').click( function() {
		yFunc.hideOneFullScreen();
		map.redraw();
	});
});
/* =============== im.post.get.js ============ */
$(document).ready( function() {
	$('#1immovables').bind("click", function() {
		location.href = "/immovables/flat/sale.html";
	});
	// var Ajaxload =
	// "/report_center.php?action=set_friend_im&im_id=29&name=alex&email=a.tsurkin@avtologistika.com";
		// $('#DivRequestQuery').load(Ajaxload);
	});
