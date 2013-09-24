function OnSuccessForm(callbackArgs){
	$('#errOutput').hide();
	$('#errOutputGood').text('Данные сохранены.').show();
}
function OnSuccessStoresForm(callbackArgs){
	if (callbackArgs) {
		if(callbackArgs.newActionID) {
			$('#block-tickets').load('/dmn/t-ajax.php?zone=dmn&cont=DMN_GoodsAction&action=getTickets&dataType=html&id=' + callbackArgs.newActionID);
			$("#li-tabs-4").show();
		}
	}
	$('#errOutput').hide();
	$('#errOutputGood').text('Данные сохранены.').show();
}

function OnSuccessTicketForm(){
	$('#errOutput').hide();
	$('#errOutputGood').text('Данные сохранены.').show();
}


function SaveImage (cont, action) {
	var optionsImage = { 
		target: "#place-image",	
		url: "/dmn/t-ajax.php?zone=dmn&cont=" + cont + "&action=" + action + "&dataType=html",
		success: sucessGAImage
	};	
	jQuery('#ga-imageForm').ajaxSubmit(optionsImage); 
	return false;
}
function sucessGAImage( data ) {
	$('#errOutput').hide();
	$('#errOutputGood').show();
	$('#errOutputGood').text('Данные сохранены.');
	return false;
}
