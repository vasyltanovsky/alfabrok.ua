function OnSuccessForm(callbackArgs){
	$('#errOutput').hide();
	$('#errOutputGood').text('Данные сохранены.').show();
}
function OnSuccessDataForm(callbackArgs){
	if (callbackArgs) {
		if(callbackArgs.newActionID) {
			$("#tabs-2").show();
			//$("#WikiForm input:hidden[name=id]").val("" + callbackArgs.newActionID + "");
			$("#article_wiki_id").val("" + callbackArgs.newActionID + "");
			//$("#NewsForm input:hidden[name=news_id]").val("" + callbackArgs.newActionID + "");
		}
	}
	$('#errOutput').hide();
	$('#errOutputGood').text('Данные сохранены.').show();
}

function TAddarticle(cont, action) {
	jQuery("#t-page-inner").load("/dmn/t-ajax.php?zone=dmn&cont=" + cont + "&action=" + action + "&dataType=html&wiki_id=" + $("#article_wiki_id").val());
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
