
 /**
  * oLoading
  * @param {type} param 
  */
  function yFunctional(divId) {
  	this.divId = divId;
  }
	yFunctional.prototype.showFullScreen = function (){
		var wSize = alertSize();
		tIndexProp[1] = $('#DivYMapPage').css('height');
		var YStyle = [wSize[0] - 270, wSize[1] -50];
		$('#DivYMapPage').addClass("DivYMapPageFull");
		$('#TableIndexPage').addClass("TableIndexPagefull");
		$('#indexYMap').css('width', wSize[0] - 370);
		$('#indexYMap').css('height', wSize[1] -60);
		$('a.hideFullScreen').show();
		$('a.showFullScreen').hide();
	}		
	yFunctional.prototype.hideFullScreen = function (){
		$('#DivYMapPage').removeClass("DivYMapPageFull");
		$('#TableIndexPage').removeClass("TableIndexPagefull");
		$('#indexYMap').css('width', 700);
		$('#indexYMap').css('height', 600);
		$('a.hideFullScreen').hide();
		$('a.showFullScreen').show();
	}
	yFunctional.prototype.showHelp = function (){
		$('#hideHelp').show();
		$('#YHelp').show();
		$('#showHelp').hide();
	} 
	yFunctional.prototype.hideHelp = function (){
		$('#showHelp').show();
		$('#YHelp').hide();
		$('#hideHelp').hide();
	}	
	
	yFunctional.prototype.showOneFullScreen = function (){
		$("html:not(:animated),body:not(:animated)").animate({ scrollTop:0 }, 500 );
		var wSize = alertSize();
		var YStyle = [wSize[0] - 270, wSize[1] -50];
		$('#divYScreen').addClass("DivYMapPageFull");
		$('#YMapsID').css('width', wSize[0] - 60);
		$('#YMapsID').css('height', wSize[1] -50);
		$('#YMapsID').addClass("mapOneFull");
		$('#aShowPanorama').addClass("mapOneFullPanorama");
		$('#hideFullOneMap').show();
		
		$('.TableOneImmovableInfo').hide();
		$('#tabs').hide();
		$('#DivFooter').hide();
	}		
	yFunctional.prototype.hideOneFullScreen = function (){
		$('#divYScreen').removeClass("DivYMapPageFull");
		$('#TableIndexPage').removeClass("TableIndexPagefull");
		$('#YMapsID').css('width', 500);
		$('#YMapsID').css('height', 400);
		$('#YMapsID').removeClass("mapOneFull");
		$('#aShowPanorama').removeClass("mapOneFullPanorama");
		$('#hideFullOneMap').hide();
	
		$('.TableOneImmovableInfo').show();
		$('#tabs').show();
		$('#DivFooter').show();
	}
	
	

	