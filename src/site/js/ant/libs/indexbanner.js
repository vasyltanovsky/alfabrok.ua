//Объект обеспечивает функционал баннера задесь падают цены, горящие предложения
function indexBan(linkDivId, posDivId, link, rentSale, catalog) {
  	this.linkDivId = (linkDivId ? linkDivId : null);
  	this.posDivId = (posDivId ? posDivId : null);
  	this.link = (link ? link : '?action=hot_price');
  	this.rentSale = (rentSale ? rentSale : 'sale');
  	this.catalog = (catalog ? catalog : 'home');
  	this.arCatalog = new Array();
  	this.arCatalog['flat'] = null;
  	this.arCatalog['commercial'] = null;
  	this.arCatalog['home'] = null;
  	this.arCatalog['buildings'] = null;
  	this.arCatalog['land'] = null; 
  	this.some =null;
}
	indexBan.prototype.clickRadioBottom = function (){
	}
	/*	действие при клике по кнопке	*/
	indexBan.prototype.clickCatBottom = function ( btm ){
		this.setCatBottomActive( btm );
		this.searchSetPosition();
		if(!this.some) {
			this.setLinkIsset();
			this.some = true;
		}
		this.setLinkToAllPosition();
	}
	/*	указываем активный каталог недвижимости	*/
	indexBan.prototype.setCatBottomActive = function ( btm ){
		this.catalog = $(btm).attr('rel');
		$(this.linkDivId + " span").removeClass('AlinkActive');
		$(btm).addClass('AlinkActive');
	}
	/*	поиск недвиж. согласно выбранной категории	*/
	indexBan.prototype.searchSetPosition = function (){
		var count = $(this.posDivId +" div.DivListImBanIn" ).children().length;
		var pos = null;
		var indif = this.catalog + '/' + this.rentSale;
		for(var i=0; i< count;  i++ ) {
			if( i == 0 ) 
				var pos = $( this.posDivId ).children(" div.DivListImBanIn ");
			else
				pos = $( pos ).next();
			
			if( $( pos ).attr('rel') ) {
				//
				this.sortLinkForIsset($( pos ).attr('rel'));
				//
				if( indif.toString() == $( pos ).attr('rel').toString()) {
					$( '#' + $( pos ).attr('id') ).show( );	
				}
				else {
					$( '#' + $( pos ).attr('id') ).hide( );
				}
			}
		}
	}
	/*	показываем кнопки соответсвенно к существованию недвиж. */
	indexBan.prototype.setLinkIsset = function (){
		$(this.linkDivId + " span").hide();
		for(var key in this.arCatalog) {
			if(this.arCatalog[key]) 
				$("#linkBan-" + key).show();
		}
	}
	
	/*	?????????? ? ?????? ???????????? ?? ????????? ??????. */
	indexBan.prototype.sortLinkForIsset = function ( divRel ){
		var indif = divRel.substring(0, divRel.indexOf('/'));
		this.arCatalog[indif] = true;
	}
	/*	???????????? ?????? ??? ???????????? ???? ??????? */
	indexBan.prototype.setLinkToAllPosition = function ( ){
		$("a.DivListImBanAViewAll").attr( {href: "/s_immovables.html" + this.link + "&cat=" + this.catalog});
	}