// JavaScript Document
$(document).ready(function() { 
	/*	добавление в стравнени*/
	$(".comparing-objects-link").click(function () {
		comparisonAddItem($(this).attr("id").replace(/comparing-item-/g, ""));
		return false;
	});
	$(".comparing-objects-link-remove").click(function () {
		comparisonRemoveItem($(this).attr("id").replace(/comparing-item-/g, ""));
		return false;
	});
});
function comparisonAddItem(im_id) {
	$.ajax({
    	type: "GET",
        success: function (data) {
			return false;
        },
        url: "/ru/immovables/comparingadditem?im_id=" + im_id
	});
}
function comparisonRemoveItem(im_id) {
	$.ajax({
    	type: "GET",
        success: function (data) {
			return false;
        },
        url: "/ru/immovables/comparingremoveitem?im_id=" + im_id
	});
}


