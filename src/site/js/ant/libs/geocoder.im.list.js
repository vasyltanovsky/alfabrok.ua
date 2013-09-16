//$("#loading").ajaxStart(function(){
//$(this).show();});
//$('#DivRequest').load('template.load.php?print=list_page');
//$("#loading").ajaxComplete(function(){
//$(this).hide();});
 
 function GetYMapsGeoPointer(value) {
		var geocoder = new YMaps.Geocoder(value, {results: 1});
		// Ñîçäàíèå îáðàáîò÷èêà äëÿ óñïåøíîãî çàâåðøåíèÿ ãåîêîäèðîâàíèÿ
		YMaps.Events.observe(geocoder, geocoder.Events.Load, function () {
			// Åñëè îáúåêò áûë íàéäåí, òî äîáàâëÿåì åãî íà êàðòó
			// è öåíòðèðóåì êàðòó ïî îáëàñòè îáçîðà íàéäåííîãî îáúåêòà
			if (this.length()) {
				geoResult = this.get(0);
				//alert(this.get(0).getGeoPoint());
				document.write(this.get(0).getGeoPoint());
			} else return false; 
		});
		// Ïðîöåññ ãåîêîäèðîâàíèÿ çàâåðøåí íåóäà÷íî
		YMaps.Events.observe(geocoder, geocoder.Events.Fault, function (geocoder, error) {
			return false;
					//alert("Произошла ошибка: " + error);
		})
}

 /**
  * oLoading
  * @param {type} param 
  */
  function oLoading(divId) {
  	this.divId = divId;
  }
	oLoading.prototype.start = function (){
	 	$(this.divId).show();
	} 
	oLoading.prototype.complete = function (){
//		alert(this.divId + 'hide');
	 	$(this.divId).hide();
	}		
/**
 * StrReplase
 * var k = new Array
	k['tyt'] = '-------';
	k['tam'] = '00000000000000';
	var a = StrReplase('privet #tyt# ili ny #tam#', k);
	alert(a);
 * @param {type} str, arr 
 */
 function StrReplase(str, arr) {
 	for (var key in arr) {
 		var val = arr [key];
 		str = str.replace('#' + key + '#', val);
 	}
 	return str;
 }
/*
 * 
 */
 function ElementGeocoder(id, lng, lat) {
	this._id = id;
	this._lng = lng;
	this._lat = lat;
}


/*
 * 
 */
function GeocoderImList() {
	this.arrGeocoderImList = Array();
	this.countImList = 0;
	this.imDataSCount = null;
	this.isDone = false;
	this.isSale = false;
	this.isRent = false;
}

	/**
	 * setElementGeocoder
	 * @param {int} id, {string} getGeoPointLng, {string} getGeoPointLat  
	 * @return void
	 */
	GeocoderImList.prototype.setElementGeocoder = function (id, getGeoPointLng, getGeoPointLat ){
		if(this.arrGeocoderImList[getGeoPointLng+''+getGeoPointLat]) {
			this.arrGeocoderImList[getGeoPointLng+''+getGeoPointLat][this.arrGeocoderImList[getGeoPointLng+''+getGeoPointLat].length] = new ElementGeocoder(id, getGeoPointLng, getGeoPointLat);
		} 
		else {
			this.arrGeocoderImList[getGeoPointLng+''+getGeoPointLat] = Array();
			this.arrGeocoderImList[getGeoPointLng+''+getGeoPointLat][0] = new ElementGeocoder(id, getGeoPointLng, getGeoPointLat);
		}
		this.countImList++;
		return;
	}
	/**
	 * getCountElementGeocoder
	 * @param {string} i 
	 * @return {integer} lenght
	 */
	GeocoderImList.prototype.getCountElementGeocoder = function(i) {
		return this.arrGeocoderImList[i].length;
	}
	/**
	 * cleanGeocoderImList
	 * @return void
	 */
	GeocoderImList.prototype.cleanGeocoderImList = function() {
		this.arrGeocoderImList = Array();
		this.countImList = 0;
		this.imDataSCount = null;
		this.isDone = false;
		this.isSale = false;
		this.isRent = false;
		return;
	}
	 /**
		 * getLinkToPanorama
		 * формирование линка Панорамы и замена в шаблоне
		 * @param templateIm, lng, lat, adress
		 * @return string
		 */
	GeocoderImList.prototype.getLinkToPanorama = function(templateIm, lng, lat, adress ) {
		var linkPanorama = "http://maps.yandex.ru/?text=" + adress +" &ol=stv&oll=" + lng + "%2C" + lat +"&ll=" + lng + "%2C" + lat + "&l=map%2Cstv";
		return templateIm.replace('hrefToPanorama', linkPanorama); 
	}
	/**
	 * getImAdtess
	 * фомирование адресса недвижимости
	 * @param ImDataS, i
	 * @return string
	 */
	GeocoderImList.prototype.getImAdtess = function(ImDataS, i ) {
		return (imDataS[i]['im_city_name'] != "" ? (imDataS[i]['im_city_name'] == "0Киев" ? "Киев" : imDataS[i]['im_city_name']) + ", " : "") + ( imDataS[i]['im_area_name'] != "" ? imDataS[i]['im_area_name'] + ", " : "") + ( imDataS[i]['im_adress_name'] != "" ? imDataS[i]['im_adress_name'] + ", " : "") + ( imDataS[i]['im_adress_house'] != "" ? imDataS[i]['im_adress_house'] + ", " : "") ;
	}	
	/**
	 * getPlacemarkTemplate
	 * @param template, ElementGeocoderId, ImDataS
	 * @return string
	 */
	GeocoderImList.prototype.getPlacemarkTemplate = function(template, ElementGeocoderId, ImDataS, searchParam) {
		this.getRentSale(searchParam);
		var ret = "";
		if(this.arrGeocoderImList[ElementGeocoderId].length == 1) {
			if(this.isSale) {
				if(ImDataS[this.arrGeocoderImList[ElementGeocoderId][0]._id]['tempSale'])
					ret += this.getLinkToPanorama(ImDataS[this.arrGeocoderImList[ElementGeocoderId][0]._id]['tempSale'], this.arrGeocoderImList[ElementGeocoderId][0]._lng, this.arrGeocoderImList[ElementGeocoderId][0]._lat, this.getImAdtess(ImDataS, this.arrGeocoderImList[ElementGeocoderId][0]._id));
			}
			if(this.isRent) {
				if(ImDataS[this.arrGeocoderImList[ElementGeocoderId][0]._id]['tempRent'])
					ret += this.getLinkToPanorama(ImDataS[this.arrGeocoderImList[ElementGeocoderId][0]._id]['tempRent'], this.arrGeocoderImList[ElementGeocoderId][0]._lng, this.arrGeocoderImList[ElementGeocoderId][0]._lat, this.getImAdtess(ImDataS, this.arrGeocoderImList[ElementGeocoderId][0]._id));
			}
			return ret;
		}
		if(this.arrGeocoderImList[ElementGeocoderId].length > 1) {
			var data = new Array();
			var ret = '';
			var aler = '';
			data['data'] = '';
			aler += "isSale=" + this.isSale + ";isRent=" + this.isRent + ";" + "lenght=" + this.arrGeocoderImList[ElementGeocoderId].length + ";";
			//alert(this.arrGeocoderImList[ElementGeocoderId].length + 'lenght' + this.isSale + 'isSale' + this.isRent + 'isRent');
			for(var i = 0; i<this.arrGeocoderImList[ElementGeocoderId].length; i++) {
				if((this.isSale == true) && (ImDataS[this.arrGeocoderImList[ElementGeocoderId][i]._id]['tempSale']))  {	
					aler += 'sale' + ";imCode=" + ImDataS[this.arrGeocoderImList[ElementGeocoderId][i]._id]['im_code'];
					//alert('sale' + ImDataS[this.arrGeocoderImList[ElementGeocoderId][i]._id]['tempRent'] + ImDataS[this.arrGeocoderImList[ElementGeocoderId][i]._id]['im_code']);
					ret += this.getLinkToPanorama(ImDataS[this.arrGeocoderImList[ElementGeocoderId][i]._id]['tempSale'], this.arrGeocoderImList[ElementGeocoderId][i]._lng, this.arrGeocoderImList[ElementGeocoderId][i]._lat, this.getImAdtess(ImDataS, this.arrGeocoderImList[ElementGeocoderId][i]._id));
				}
				if((this.isRent == true) && (ImDataS[this.arrGeocoderImList[ElementGeocoderId][i]._id]['tempRent']))  {
					aler += 'rent' + ";imCode=" + ImDataS[this.arrGeocoderImList[ElementGeocoderId][i]._id]['im_code'];
					//alert('rent' + ImDataS[this.arrGeocoderImList[ElementGeocoderId][i]._id]['tempRent'] + ImDataS[this.arrGeocoderImList[ElementGeocoderId][i]._id]['im_code']);
					ret += this.getLinkToPanorama(ImDataS[this.arrGeocoderImList[ElementGeocoderId][i]._id]['tempRent'], this.arrGeocoderImList[ElementGeocoderId][i]._lng, this.arrGeocoderImList[ElementGeocoderId][i]._lat, this.getImAdtess(ImDataS, this.arrGeocoderImList[ElementGeocoderId][i]._id));
				}
				//заканчиваем обход объектов недвижимости, если их количество больше 7, поскольку страшно тормозин браурзер
				//if(i == 7) {
//					data['data'] += ret;
//					return StrReplase(template['group'], data);
//				}
				//alert(ImDataS[this.arrGeocoderImList[ElementGeocoderId][i]._id]['tempSale'] + '' ImDataS[this.arrGeocoderImList[ElementGeocoderId][0]._id]['tempRent']);
				//alert(aler);
			}
			data['data'] += ret;
			data['count'] = this.arrGeocoderImList[ElementGeocoderId].length;
			return StrReplase(template['group'], data);
		}
		return;
	}	
	
	GeocoderImList.prototype.getRentSale = function(searchParam) {
		for(var i=0; i<searchParam.length; i++) {
			for(var key in searchParam[i]) {
				if(key == 'im_is_sale') {
					this.isSale = true;
				}
				if(key == 'im_is_rent') {
					this.isRent = true;
				}
			}
		}
		return;
	}	
	/**
	 * setIsDone
	 * @param {string} i 
	 * @return void
	 */
	GeocoderImList.prototype.setIsDone = function(i) {
		if(i == this.imDataSCount) {
			this.isDone = true;
		}
		return;
	}	
		