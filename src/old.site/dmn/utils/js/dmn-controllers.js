function TShowPage(cont, action, param) {
	jQuery("#t-page-inner").load("/dmn/t-ajax.php?zone=dmn&cont=" + cont + "&action=" + action + "&dataType=html&" + param);
	jQuery("#t-page").show();
}

jQuery(document).ready( function($) {
	var at = "1";
	var adata = "1";
	/*	special code	*/
	jQuery("#special-code-button").click( function() {
		if (jQuery("#special-code").val() != "") {
			jQuery.ajax({
					url:'/t-ajax.php',
					dataType: 'json',
					data: {action: 'chechedSpecialCode', val: jQuery("#special-code").val()},
					success: sucessSpecialCode 
				});
		}
		return false;
	});
});

/*	special code	*/
function sucessSpecialCode(data, textStatus) {
	if(data.success)
		window.location = "/";
	else 
		alert("Special code not valid!");
}

function TAddSpecialCode(cont, action, param) {
	jQuery("#t-page-inner").load("/dmn/t-ajax.php?zone=dmn&cont=" + cont + "&action=" + action + "&dataType=html&" + param);
}

function TSaveSpecialCode(cont, action) {
	var optionsFormCodeImage = { 
		dataType: 'json',
		url: "/dmn/t-ajax.php?zone=dmn&cont=" + cont + "&action=" + action + "&dataType=",
		success: sucessCode,
		beforeSubmit: valideCode
	};	
	jQuery('#t-form').ajaxSubmit(optionsFormCodeImage); 
}
var k ="";
function sucessCode( data ) {
	sucessT( data );
	if(data.success == true) {
		jQuery('#t-page-form').html(""); 
		jQuery("#t-page-list-data").load("/dmn/t-ajax.php?zone=dmn&cont=" + data.conf + "&action=getList&dataType=html");
	}
	return true;
}
		
function valideCode(formData, jqForm, options) {
	return true;
}

function THideForm() {
	jQuery('#t-page-form').html("");
}
function sucessT( data ) {
	if(data.success == false)
		alert(data.error);
}

/*	banners	*/
function TDelete(cont, action, id, param) {
	jQuery("#t-page-inner").load("/dmn/t-ajax.php?zone=dmn&cont=" + cont + "&action=" + action + "&dataType=html&id=" + id + "&" + param);
}
function TDeleteImage(cont, action, id) {
	jQuery.ajax({
		url:"/dmn/t-ajax.php?zone=dmn&cont=" + cont + "&action=" + action + "&dataType=html&id=" + id,
		dataType: 'json',
		success: function( data ) {
			jQuery(".image-" + id).hide();
		}
	});
	jQuery(".image-" + id).hide();
	return false;
}
function TEdit(cont, action, id, param) {
	jQuery("#t-page-inner").load("/dmn/t-ajax.php?zone=dmn&cont=" + cont + "&action=" + action + "&dataType=html&id=" + id + "&" + param);
}

function TSearchForm (cont, action) {
	var optionsFormSearch = { 
		target: "#t-page-inner",	
		url: "/dmn/t-ajax.php?zone=dmn&cont=" + cont + "&action=" + action + "&dataType=html",
		beforeSubmit: valideSearchForm, 
		success: sucessSearchForm
	};	
	jQuery('#pageFormSearch').ajaxSubmit(optionsFormSearch); 
	return false;
}
function valideSearchForm(formData, jqForm, options) {
	var queryString = $.param(formData); 
	return true;
}
function sucessSearchForm( date ) {
	$("#loading").hide();
}
