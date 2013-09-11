function changePointerCodeToSCField( element ) {
	var valSTF = $(element).val();
	
	if(valSTF == "") 
		return;
	valSTF = valSTF.toUpperCase().replace(new RegExp("Л",'g'), 'K');
	valSTF = valSTF.toUpperCase().replace(new RegExp("R",'g'), 'K');
	valSTF = valSTF.toUpperCase().replace(new RegExp("К",'g'), 'K');
	valSTF = valSTF.toUpperCase().replace(new RegExp("С",'g'), 'C');
	valSTF = valSTF.toUpperCase().replace(new RegExp("C",'g'), 'C');
	valSTF = valSTF.toUpperCase().replace(new RegExp("H",'g'), 'H');
	valSTF = valSTF.toUpperCase().replace(new RegExp("Y",'g'), 'H');
	valSTF = valSTF.toUpperCase().replace(new RegExp("Н",'g'), 'H');
	valSTF = valSTF.toUpperCase().replace(new RegExp("Р",'g'), 'H');
	valSTF = valSTF.toUpperCase().replace(new RegExp("M",'g'), 'M');
	valSTF = valSTF.toUpperCase().replace(new RegExp("V",'g'), 'M');
	valSTF = valSTF.toUpperCase().replace(new RegExp("М",'g'), 'M');
	valSTF = valSTF.toUpperCase().replace(new RegExp("Ь",'g'), 'M');
	valSTF = valSTF.toUpperCase().replace(new RegExp("T",'g'), 'T');
	valSTF = valSTF.toUpperCase().replace(new RegExp("N",'g'), 'T');
	valSTF = valSTF.toUpperCase().replace(new RegExp("Т",'g'), 'T');
	valSTF = valSTF.toUpperCase().replace(new RegExp("Е",'g'), 'T');
	
	$(element).val(valSTF);
	return;
}