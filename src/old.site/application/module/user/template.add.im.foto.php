<?php
if(!isset($_COOKIE[user_id])) 
		$_COOKIE[user_id] = 0;
# 
		$ClUserIm = new mysql_select($tbl_im);
		$active_id = $ClUserIm -> select_table_id("WHERE im_user_id = {$_COOKIE[user_id]} ORDER BY im_id DESC LIMIT 1");
		if(empty($active_id)) die("Error system.(");
		

		
		
		$error_img = '';
	#	
		if (isset($_POST['retention'])) {
			if (empty($_FILES['images']['name'])) {
				$error_img = "$.prompt('{$arWords['im_add_im_err_no_add_img']}');";
			}
			else {
				
				$fileDir = 'files/images/immovables/';
				$ImgProp['ImgW'] = 65;
				$ImgProp['ImgH'] = 65;
				$ImgPropIndex['ImgW'] = 190;
				$ImgPropIndex['ImgH'] = 190;
				$ImgPropPR['ImgW'] = 285;
				$ImgPropPR['ImgH'] = 285;
				$ImgPropSt['ImgW'] = 140;
				$ImgPropSt['ImgH'] = 140;
				$photoId = uniqid();
				
				$extension = pathinfo($_FILES['images']['name']);
				$extension = strtolower($extension['extension']);
				$fileName = strtolower($photoId.".".$extension);
		
				if(copy($_FILES['images']['tmp_name'], $fileDir.''.$fileName)) {
					#Формируем малое изображение
						$resizeObj = new resize($fileDir."".$fileName);
						$resizeObj -> resizeImage($ImgProp['ImgW'], $ImgProp['ImgH'], 'crop');
						$resizeObj -> saveImage($fileDir.'s_'.$fileName, 100);
						$resizeObj -> resizeImage($ImgPropIndex['ImgW'], $ImgPropIndex['ImgH'], 'crop');
						$resizeObj -> saveImage($fileDir.'si_'.$fileName, 100);
						$resizeObj -> resizeImage($ImgPropSt['ImgW'], $ImgPropSt['ImgH'], 'crop');
						$resizeObj -> saveImage($fileDir.'st_'.$fileName, 100);
						$resizeObj -> resizeImage($ImgPropPR['ImgW'], true, 'auto');
						$resizeObj -> saveImage($fileDir.'pr_'.$fileName, 100);
						
					#
						$query = "INSERT INTO {$tbl_im_ph} (`im_photo_id`, `im_photo_type`, `im_id`, `im_photo_order`, `im_file_type`) VALUES
														 	('{$photoId}', '{$_POST[im_photo_type]}', {$active_id[im_id]}, NULL, '{$extension}');";
						if(!mysql_query($query))  throw new ExceptionMySQL(mysql_error(), $query, "ERROR INSERT IM PHOTO");
					#наложение логотипа
						$ImageBigSize = @getimagesize($fileDir.$fileName);
						$ClassApplyignImage = new applying_image();
						$ClassApplyignImage -> prepare_image($fileDir."st_".$fileName, $fileDir."st_".$fileName, "files/images/bg/imposition-140.png", $ImgPropSt['ImgW'], $ImgPropSt['ImgH'], 70,70);
						$ClassApplyignImageVoid = $ClassApplyignImage -> prepare_image($fileDir.$fileName, $fileDir.$fileName, "files/images/bg/alfabrok.logo.big.png", $ImageBigSize[0], $ImageBigSize[1], 180, 150);
						$ClassApplyignImageVoid = $ClassApplyignImage -> prepare_image($fileDir.$fileName, $fileDir.$fileName, "files/images/bg/logo_full_btm.png", $ImageBigSize[0], $ImageBigSize[1], $ImageBigSize[0]/2-$ImageBigSize[0]+355, $ImageBigSize[1]/2-$ImageBigSize[1]+40);
						$ClassApplyignImage -> prepare_image($fileDir."si_".$fileName, $fileDir."si_".$fileName, "files/images/bg/imposition-190.png", $ImgPropIndex['ImgW'], $ImgPropIndex['ImgH'], 95, 95);
						if($_POST['im_photo_type'] =='4c5a97c04ffa1') {
							$ClassApplyignImage -> prepare_image($fileDir.'s_'.$fileName, $fileDir."s_".$fileName, "files/images/bg/imposition-65.png", $ImgProp['ImgW'], $ImgProp['ImgH'], 32.5, 32.5);
						}
				}
				else {
					die("ERROR (copy image files/images/immovables)");
				}
				
				$error_img = "$.prompt('{$arWords['im_add_im_err_add_img']}');";
			}
		}
		
#объявляем класс словаря
		$dictionaries = new dictionaries();
		#формируем массив имени словарей
		$dct_list 	=	$dictionaries->buid_dictionaries_list($tbl_list_dictionaries, "ORDER BY ld_name ASC");
		#формируем массив значений словарей
		$dct		=	 $dictionaries->buid_dictionaries($tbl_dictionaries,
									 	 				 "WHERE lang_id = {$_COOKIE[lang_id]}",
														 "ORDER BY dict_name ASC");

		$dictionaries->do_dictionaries(66);
		$type_photo	 = $dictionaries->my_dct;
		
	#	функция формирует списов возможный родителей, справочник меню
		function sel_parent_standart($arr, $sel = 'NULL', $name_id = 'sc_id', $echo_id = 'menu_words')
		{
			$str = NULL;
			for($i=0; $i<count($arr); $i++)
			{
				$selecteOption = NULL;
				if($sel)
				{
					if($sel == $arr[$i][$name_id]) 
					$selecteOption = "selected=\"selected\"";
				}
				
				$str .= "<option {$selecteOption} value=\"{$arr[$i][$name_id]}\">{$arr[$i][$echo_id]}</option>";
				
			}
			return $str;
		}
?>
	<script type="text/javascript">
	$(document).ready(function(){
		<?php echo $error_img;?>
		$('#DivRequestPhotoList').load('/application/module/user/template.load.img.php?im_id=<?php echo $active_id['im_id']?>');

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
		//$('#submitImg').bind("click", function(){
		//	  $('#FormAddImgIm').ajaxSubmit(optionsAddImg); 
		//		return false;
		//});
		function afterAjax(responseText, statusText)
		{
			$.prompt('Изображения добавлено.');
			$('#DivRequestPhotoList').load('/application/module/user/template.load.img.php?im_id=<?php echo $active_id['im_id']?>');
			return true;
		}
		function showRequest(formData, jqForm, options) { 
			var value = $("#FormAddImgIm :images").fieldValue();
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
				url:'/application/module/user/template.data.retention.php',
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
		$('#DivRequestPhotoList').load('template.load.img.php?im_id=<?php echo $_POST['im_id']?>');
		$.prompt('Изображение удалено.');
		return true;
	}
	
	
	function afterIndex()
	{
		$('#DivRequestPhotoList').load('template.load.img.php?im_id=<?php echo $_POST['im_id']?>');
		$.prompt('Изминение сохранено.');
		return true;
	}
	
</script>
	
<div class="DivCenterPage">
	<h1 class="TitleStandartPage"><?php echo $pages->active_page['title'];?></h1>
	<div class="DivNavigation"><?php echo $pages->navigation_string_htaccess();?></div>
	<table class="TableStandartCenterPage" cellpadding="0" cellspacing="0">
		<tr>
			<?php if($PHP_SELF == "user")  { ?>
			<td class="UserCabinetMenu"><?php echo $arWords['user_private_link'];?></td>
			<?php } ?>
			<td class="UserTSCPTdCenter"><?php echo $pages->active_page['summary'];?>
			
			<div class="DivAddImUser">
				<div class="DivAddImNActive"><p><?php echo $arWords['add_im_user_step_1'];?></p></div>
				<div class="DivAddImNActive"><p><?php echo $arWords['add_im_user_step_2'];?></p></div>
				<div class="DivAddImActive"><p><?php echo $arWords['add_im_user_step_3'];?></p></div>
				<div class="DivAddImNActive"><p><?php echo $arWords['add_im_user_step_4'];?></p></div>
			</div>	

			<div id="Preloader" style="display: none;"></div>
			<div id="DivEchoResult" style="padding: 0pt 0.7em; display: block; display:none;" class="ui-state-error ui-corner-all"> 
				<p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-alert"></span> 
				<strong><?php echo $arWords['user_add_im_ad_ok'];?></strong></p>
			</div>
				
			<div id="DivRequeryPropIm"></div>
			<div>
					<div id="DivRequestImg"></div>
				    <div class="eventForm">
				       	<a href="#" class="UAddSome" id="showAddImg" style="-moz-border-radius: 4px 4px 4px 4px;"><span class="ui-icon ui-icon-image"></span><?php echo $arWords['im_add_im_btm_add_img'];?></a>
				       	<a href="#" class="UAddSome" id="submitIndexPhoto" style="-moz-border-radius: 4px 4px 4px 4px;"><span class="ui-icon ui-icon-star"></span><?php echo $arWords['im_add_im_btm_imd_img'];?></a>
				       	<?php if($PHP_SELF == "user")  { ?>
				       	<a href="/user/2addimsum.html?=4c5d58cd3898c" class="UAddSomeImportant" id="" style="-moz-border-radius: 4px 4px 4px 4px;"><span class="ui-icon ui-icon-note"></span><?php echo $arWords['im_add_summary'];?></a>
				    	<?php } else { ?>
				    	<a href="/addingobject/2objaddimsum.html?=4c5d58cd3898c" class="UAddSomeImportant" id="" style="-moz-border-radius: 4px 4px 4px 4px;"><span class="ui-icon ui-icon-note"></span><?php echo $arWords['im_add_summary'];?></a>
				    	<?php }  ?>
				    </div>
				    
				    
                            
				   	<form  id="FormAddImgIm" action="" class="zpFormWinXP" method="post" style="display:none" enctype="multipart/form-data">   
							<div class="ui-state-highlight ui-corner-all" style="padding: 0pt 0.7em; margin:0 10px 10px 0"> 
	                    	     <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: 0.3em;"></span><?php echo $arWords['im_add_im_title'];?></p>
	                    	</div>
                    
							<table>
							<tr>
								<td><label><?php echo $arWords['im_add_im_img_label'];?></label></td>
								<td><input class="zpForm" type="file" name="images" /></td>
							</tr>
							<tr>
								<td><label class='zpFormLabel'><?php echo $arWords['im_add_im_img_type_label'];?></label></td>
								<td><select name="im_photo_type" class="zpFormRequired"><option value="4c5a97c04ffa1">Фото недвижимости</option><option value="4c5a97cea179d">План недвижимости</option></select></td>
							</tr>
							<tr>
								<td> <input id="submitImg" class="ui-state-default ui-corner-all" value="<?php echo $arWords['im_add_im_btm_submit'];?>" name="Submit" onClick="" type="submit" class="button" /></td>
								<td></td>
							</tr>
							</table>
							
					    	<input type="hidden" name="im_id" value="<?php echo $active_id['im_id'];?>" />
					        <input type="hidden" name="retention" value="add_img" />
					       
					</form>
					    
				    <form  id="FormListImg" action="" method="post">   
						<div id="DivRequestPhotoList"></div>	
						<input type="hidden" name="im_id" value="<?php echo $active_id['im_id'];?>" />
						<input type="hidden" name="retention" value="ImIndexPhoto" />
					</form>
			</div>
			</td>
		</tr>
	</table>
</div>
<div id="errOutput"></div>
