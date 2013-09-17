/* Author:
 */
function appJsLog(message) {
    $("<div>").text(message).prependTo("#log");
    $("#log").scrollTop(0);
}
function appJsError(message) {
}
var imDownPraceObj = new indexBan('#linksListBan', '#positionListBan', '?action=hot_price');
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
	$("body").click(function(e){			
			if($(e.target).attr("class") != "SearchFormLabelList" && $(e.target).attr("class") != "DivSearchPosition" 
				//&& $(e.target).attr("id") != "4c3eb33182810"
				&& $(e.target).parent().attr("class") != "DivSearchPosition" 
				&& $(e.target).parent().attr("class") != "SearchFormLabelList"
				&& $(e.target).parent().parent().attr("class") != "DivSearchPosition"
				&& $(e.target).parent().parent().parent().attr("class") != "DivSearchPosition"
				&& $(e.target).parent().parent().attr("class") != "SearchFormLabelList"	
				&& $(e.target).parent().parent().parent().parent().parent().attr("class") != "TableSearchFormTdStandartPropCat"		
				){
				$(".DivSearchPosition").hide();
				$(".TableSearchForm tbody tr:first-child td label span").addClass("ui-icon ui-icon-triangle-1-s");
			}
		});	
	/*	*/
	indexLinkHideTr();
	/* index im. banner down price */
	imDownPraceObj.clickCatBottom($("#linksListBan #linkBan-home"));

	$('#linksListBan span').click( function() {
		imDownPraceObj.clickCatBottom(this);
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
