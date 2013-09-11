<script type="text/javascript">
	$(document).ready(function(){
		$('#DivRequestPhotoList').load('template.load.php?print=list_img&im_id=<?php echo $_POST['im_id']?>');

		$('#showAddImg').bind("click", function(){
			$('#FormAddImgIm').show();
		});

/***************************************************/
		var optionsAddImg = { 
					target: "#DivRequestImg",
					url:'template.data.retention.php',
					beforeSubmit: showRequest,
					success: afterAjax
				  };					   
		//  запуск аякса для добавления   
		$('#submitImg').bind("click", function(){
			  $('#FormAddImgIm').ajaxSubmit(optionsAddImg); 
				return false;
		});
		function afterAjax(responseText, statusText)
		{
			$.prompt('Изображения добавлено.');
			$('#DivRequestPhotoList').load('template.load.php?print=list_img&im_id=<?php echo $_POST['im_id']?>');
			return true;
		}
		function showRequest(formData, jqForm, options) { 
			var queryString = $.param(formData); 
			
			var value = $("#images").fieldValue();
			if(value[0] == '')
			{
				$.prompt('Выберите изображение для загрузки!');
				return false; 
			}
			else return true; 
		} 
/***************************************************/

/***************************************************/		
		//  опции для назначения главным изобр. 
			var optionsIndexPhoto = { 
				target: "#DivRequestImg",
				beforeSubmit: valideIndexPhoto,
				url:'template.data.retention.php',
				success: afterIndex
			};
		//  запуск аякса для редактирования
			$('#submitIndexPhoto').bind("click", function(){
				$('#FormListImg').ajaxSubmit(optionsIndexPhoto); 
				return false;
			});
/***************************************************/						  

/***************************************************/				
		//  опции для удаления пункта
			var optionsDellPhoto = { 
				target: "#DivRequestImg",
				beforeSubmit: valideDellPhoto
				//url:'template.event.hadler.php'
			};
		//  запуск аякса для удаления
			$('#submitDellPhoto').bind("click", function(){
			  	$('#FormListImg').ajaxSubmit(optionsDellPhoto); 
				return false;
		  	});
				$('#submitDellOk').bind("click", function(){
				  	$('#FormListImg').ajaxSubmit(optionsDellPhotoOk); 
					return false;
			  	});
				$('#submitDellOff').bind("click", function(){
				  	$('#divSubmitDell').hide();	 
					return false;
			  	});
	});

/************/		
	//	функция проверки выбран ли пункт для назначения главным изобр. 
	function valideIndexPhoto(formData, jqForm, options)
	{
		var queryString = $.param(formData); 
		var ImPropId = queryString.search('im_photo_id');
		if(ImPropId == -1) {
			$.prompt('Не выбрано изображение для назначения главным!');
			return false;
		}
		else return true; 
	}

/************/	
	//	функция проверки выбран ли пункт для удаления
	function valideDellPhoto(formData, jqForm, options)
	{
		var queryString = $.param(formData); 
		var ImPropId = queryString.search('im_photo_id');
		if(ImPropId == -1) {
			$.prompt('Не выбрано изображение для удаления!');
			return false;
		} 
		else {
			$.prompt('Вы действительно хотите удалить изображеие?',{ callback: mycallbackformPhoto, buttons: { Ok: 'dell', Отмена: false  } });
			return false;
		}
	}
	//функция отменяет либо производит удаление позиции
	function mycallbackformPhoto(v,m,f){
		if(v == 'dell')
		{
			var optionsDellPhotoOk = { 
				target: "#DivRequestImg",
				success: afterDellImage,
				url:'template.dell.item.img.php'
			};
			$('#FormListImg').ajaxSubmit(optionsDellPhotoOk); 
			return true;
		} else return false;
	}

/************/

	function afterDellImage()
	{
		$('#DivRequestPhotoList').load('template.load.php?print=list_img&im_id=<?php echo $_POST['im_id']?>');
		$.prompt('Изображение удалено.');
		return true;
	}
	function afterDellall()
	{
		$('#DivRequestPhotoList').load('template.load.php?print=list_img&im_id=<?php echo $_POST['im_id']?>');
		$.prompt('Изображения удалены.');
		return true;
	}
	
	function afterIndex()
	{
		$('#DivRequestPhotoList').load('template.load.php?print=list_img&im_id=<?php echo $_POST['im_id']?>');
		$.prompt('Изминение сохранено.');
		return true;
	}
	
	
	$('#submitAllDell').live('click', function() {
		$.prompt('Вы действительно хотите удалить изображеие?',{ callback: dellall, buttons: { Ok: 'dell', Отмена: false  } });	
	});
	
	function dellall(v){
		if(v == 'dell')
		{
			$.ajax({
				type: "POST",
				data: ({im_id : <?php echo $_POST['im_id']?>}),	
				url: "template.dell.all.img.php",
				dataType: "json",
				success: afterDellall					 	
			})
		} else return false;
	}
</script>

<div id="DivRequestImg"></div>
<div class="eventForm"> <a href="#" title="Добавить изображение" id="showAddImg"><img src="../utils/images/submit/submitAdd.png" width="28" height="24" /></a> <a href="#" title="Удалить изображение" id="submitDellPhoto">
<img src="../utils/images/submit/submitDell.png" width="28" height="24" /></a> 
<a href="#" title="Назначить главным изображением" id="submitIndexPhoto"><img src="../utils/images/submit/submitIndex.png" width="28" height="24" /></a> 
<a href="#" title="Удалить все фотографии" id="submitAllDell"><img src="../utils/images/submit/submitalldel.png" width="28" height="24" /></a>
<a href="/dmn/immovablesPosition/template.data.retention.php?action=getArchive&im_id=<?php echo $_POST['im_id'];?>" title="Скачать все фото (Архив)" id=""><img src="../utils/images/submit/submitArchive.png" width="28" height="24" /></a> 
</div>
<!--/dmn/immovablesPosition/template.data.retention.php?action=getArchive&im_id=<?php echo $_POST['im_id'];?>-->
<form  id="FormAddImgIm" action="" method="post" style="display:none">
  <fieldset>
    <b>Добавление изображения</b><br>
    <label>Изображение</label>
    <input type="file" name="images" id="images" />
    <br />
    <br />
    <label class='zpFormLabel'>Тип фото</label>
    <select class="zpFormRequired" name="im_photo_type">
      <option value="4c5a97c04ffa1">Фото недвижимости</option>
      <option value="4c5a97cea179d">План недвижимости</option>
    </select>
    <br />
    <br />
    <input type="hidden" name="im_id" value="<?php echo $_POST['im_id'];?>" />
    <input type="hidden" name="retention" value="add_img" />
    <input id="submitImg" value="Добавить" name="Submit" onClick="" type="submit" class="button" />
  </fieldset>
</form>
<form  id="FormListImg" action="" method="post">
  <div id="DivRequestPhotoList"></div>
  <input type="hidden" name="im_id" value="<?php echo $_POST['im_id'];?>" />
  <input type="hidden" name="retention" value="ImIndexPhoto" />
</form>
