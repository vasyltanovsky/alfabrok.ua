<!-- /TinyMCE -->

<script type="text/javascript">
	$(document).ready(function(){
		$('#DivRequestPhotoList ul').load('template.load.php?print=list_img&im_id=<?php echo $_POST['im_id']?>');
		$('#showAddImg').bind("click", function(){
			$('#form-upload-files').toggle();
		});
                
                $("#sortable").sortable({
                    stop: function(event, ui) { 
			var result = $('#sortable').sortable('toArray');
                         $.ajax({
                            type: "POST",
                            url: 'template.edit/sort.image.php',
                            data: { sort : result },
                            dataType: "json",
                            success: function (data) {
                               return false;
                            }
                        })    
                    }
                });
		/***************************************************/		
		//  опции для назначения plan изобр. 
			var optionsPlanPhoto = { 
				target: "#DivRequestImg",
				beforeSubmit: validePlanPhoto,
				url:'template.data.retention.php',
				success: afterIndex
			};
		//  запуск аякса для редактирования
			$('#submitPlan').bind("click", function(){
				$('#FormListImg_retention').val('ImPlanPhoto'); 
				$('#FormListImg').ajaxSubmit(optionsPlanPhoto); 
				return false;
			});
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
				$('#FormListImg_retention').val('ImIndexPhoto'); 
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
	function valideIndexPhoto(formData, jqForm, options) {
		var queryString = $.param(formData); 
		var ImPropId = queryString.search('im_photo_id');
		if(ImPropId == -1) {
			$.prompt('Не выбрано изображение для назначения главным!');
			return false;
		}
		else { 
			return true; 
		}
	}

	/************/		
	//	функция проверки выбран ли пункт для назначения plan изобр. 
	function validePlanPhoto(formData, jqForm, options) {
		var queryString = $.param(formData); 
		var ImPropId = queryString.search('im_photo_id');
		if(ImPropId == -1) {
			$.prompt('Не выбрано изображение для назначения планом!');
			return false;
		}
		else { 
			return true; 
		}
	}

	
	/************/	
	//	функция проверки выбран ли пункт для удаления
	function valideDellPhoto(formData, jqForm, options) {
		var queryString = $.param(formData); 
		var ImPropId = queryString.search('im_photo_id');
		if(ImPropId == -1) {
			$.prompt('Не выбрано изображение для удаления!');
			return false;
		} 
		else {
			$.prompt('Вы действительно хотите удалить изображение?',{ callback: mycallbackformPhoto, buttons: { Ok: 'dell', Отмена: false  } });
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
	function afterDellImage() {
		$('#DivRequestPhotoList').load('template.load.php?print=list_img&im_id=<?php echo $_POST['im_id']?>');
		//$.prompt('Изображение удалено.');
		return true;
	}
	function afterDellall() {
		$('#DivRequestPhotoList').load('template.load.php?print=list_img&im_id=<?php echo $_POST['im_id']?>');
		//$.prompt('Изображения удалены.');
		return true;
	}
	
	function afterIndex() {
		$('#DivRequestPhotoList').load('template.load.php?print=list_img&im_id=<?php echo $_POST['im_id']?>');
		$.prompt('Изминение сохранено.');
		return true;
	}
	
	$('#submitAllDell').live('click', function() {
		$.prompt('Вы действительно хотите удалить изображеие?',{ callback: dellall, buttons: { Ok: 'dell', Отмена: false  } });	
	});
	
	function dellall(v) {
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

<script type="text/javascript">
var upload1;
$(document).ready(function(){
	upload1 = new SWFUpload({
		// Backend Settings
		upload_url: "template.data.retention.php",
		post_params: {"PHPSESSID" : "<?php echo session_id(); ?>", "im_id" : <?php echo $_POST["im_id"]?>, "retention" : "add_img", "im_photo_type" : "4c5a97c04ffa1" },

		// File Upload Settings
		file_size_limit : "102400",	// 100MB
		file_types : "*.*",
		file_types_description : "All Files",
		file_upload_limit : "100",
		file_queue_limit : "0",

		// Event Handler Settings (all my handlers are in the Handler.js file)
		file_dialog_start_handler : fileDialogStart,
		file_queued_handler : fileQueued,
		file_queue_error_handler : fileQueueError,
		file_dialog_complete_handler : fileDialogComplete,
		upload_start_handler : uploadStart,
		upload_progress_handler : uploadProgress,
		upload_error_handler : uploadError,
		upload_success_handler : uploadSuccess,
		upload_complete_handler : function() {
			$('#DivRequestPhotoList').load('template.load.php?print=list_img&im_id=<?php echo $_POST['im_id']?>');
		},

		// Button Settings
		button_image_url : "/js/SWFUpload/XPButtonUploadText_61x22.png",
		button_placeholder_id : "spanButtonPlaceholder1",
		button_width: 61,
		button_height: 22,
		
		// Flash Settings
		flash_url : "/js/SWFUpload/swfupload/swfupload.swf",
		

		custom_settings : {
			progressTarget : "fsUploadProgress1",
			cancelButtonId : "btnCancel1"
		},
		
		// Debug Settings
		debug: false
	});
 });
</script>

<div id="DivRequestImg"></div>
<div class="imagesEventForm "> 
	<a href="#" title="Добавить изображение" id="showAddImg">Добавить</a> 
    <a href="#" title="Удалить изображение" id="submitDellPhoto">Удалить</a> 
	<a href="#" title="Назначить главным изображением" id="submitIndexPhoto">Назначить главным</a> 
	<a href="#" title="Назначить планом объекта" id="submitPlan">Назначить планом</a> 
	<a href="#" title="Удалить все фотографии" id="submitAllDell">Удалить все</a>
	<a href="/dmn/immovablesPosition/template.data.retention.php?action=getArchive&im_id=<?php echo $_POST['im_id'];?>" title="Скачать (Архив)" id="">Скачать архивом</a>
    <a href="/dmn/immovablesPosition/template.data.retention.php?action=getWithoutMark&im_id=<?php echo $_POST['im_id'];?>" title="Скачать фото без логотипа (Архив)" id="">Скачать архивом без лого</a> 
	<div class="clear"></div>
</div>

<form id="form-upload-files" style="display:none;" action="" method="post" enctype="multipart/form-data">
<table>
    <tr valign="top">
	    <td colspan="2">
	      	<div>
	        	<div class="fieldset flash" id="fsUploadProgress1"> <span class="legend">Загрузка изображений</span> </div>
	          	<div style="padding-left: 5px;"> <span id="spanButtonPlaceholder1"></span>
	            	<input id="btnCancel1" type="button" value="Cancel Uploads" onclick="cancelQueue(upload1);" disabled="disabled" style="margin-left: 2px; height: 22px; font-size: 8pt;" />
	            	<br />
	          	</div>
	        </div>
		</td>
	</tr>	
</table>
</form>
<style>
    #sortable li {display:inline-block;}
</style>
<form  id="FormListImg" action="" method="post">
  <div id="DivRequestPhotoList">
      <ul id="sortable">
          
      </ul>      
  </div>
  <input type="hidden" name="im_id" value="<?php echo $_POST['im_id'];?>" />
  <input type="hidden" id="FormListImg_retention" name="retention" value="ImIndexPhoto" />
</form>
