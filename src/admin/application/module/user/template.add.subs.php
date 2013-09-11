<?php 
		$ClUserData = new mysql_select($tbl_user_site);
		$UserData = $ClUserData -> select_table_id("WHERE user_id={$_COOKIE[user_id]}");
?>
<div id="Preloader"></div>
<div class="DivCenterPage">
	<h1 class="TitleStandartPage"><?php echo $pages->active_page['title'];?></h1>
	<div class="DivNavigation"><?php echo $pages->navigation_string_htaccess();?></div>
	<table class="TableStandartCenterPage" cellpadding="0" cellspacing="0">
		<tr>
			<td class="UserCabinetMenu"><?php echo $arWords['user_private_link'];?></td>
			<td class="UserTSCPTdCenter"><?php echo $pages->active_page['summary'];?>
            	<div id='FormAlertIsOk'><p><?php echo $arWords['user_add_subs_ok'];?></p></div>
            	
				<form id="SubsForm" name="SubsForm" enctype="application/x-www-form-urlencoded" 
					<div id="DivAddSubsFirstStep">
                        <div id="RadioImCatalogId">	
                        	<div style="padding: 0pt 0.7em;" class="ui-state-highlight ui-corner-all"> 
                                <p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-info"></span><?php echo $arWords['user_add_subs_select_cat'];?></p>
                            </div>
                            <input type="radio" name="im_catalog_id" id="4c3ec3ec5e9b5" value="4c3ec3ec5e9b5"/><label for="4c3ec3ec5e9b5"><?php echo $arWords['ImLinkFlat'];?></label><br />
                            <input type="radio" name="im_catalog_id" id="4c3ec3ec5e9b7" value="4c3ec3ec5e9b7"/><label for="4c3ec3ec5e9b7"><?php echo $arWords['ImLinkCommercial'];?></label><br />
                            <input type="radio" name="im_catalog_id" id="4c3ec51d537c0" value="4c3ec51d537c0"/><label for="4c3ec51d537c0"><?php echo $arWords['ImLinkHome'];?></label><br />
                            <input type="radio" name="im_catalog_id" id="4c3ec51d537c2" value="4c3ec51d537c2"/><label for="4c3ec51d537c2"><?php echo $arWords['ImLinkBuildings'];?></label><br />
                            <input type="radio" name="im_catalog_id" id="4c3ec51d537c3" value="4c3ec51d537c3"/><label for="4c3ec51d537c3"><?php echo $arWords['ImLinkLand'];?></label><br />
                        </div>
                        <div id="RadioImRS">
                           	<div style="padding: 0pt 0.7em;" class="ui-state-highlight ui-corner-all"> 
                                <p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-info"></span><?php echo $arWords['user_add_subs_select_type'];?></p>
                            </div>
                            <input type="checkbox" name="is_sale" id="is_sale" value="1"/><?php echo $arWords['ImSale'];?><br />
                            <input type="checkbox" name="is_rent" id="is_rent" value="1"/><label for="type_rent"><?php echo $arWords['ImRent'];?></label><br />
						</div>
                        <div class="clear"></div>
    	        	</div>
					<div id="DivAddSubsSecondStep">
					</div>
					<div id="DivRequerySubs"></div>
                    <input type="submit" class="ui-state-default ui-corner-all" id="SubsSbtIm" value="<?php echo $arWords['user_add_subs'];?>"/>
                </form>	
			</td>
		</tr>
	</table>
</div>
<script type="text/javascript">
$(function() {
	$('#SubsResult').hide();	   
	$('input:radio[name="im_catalog_id"]').click(function () {
		//	опции получения формы характеристик недв.
		var optionsRequeryForm = { 
			target: "#DivAddSubsSecondStep",
			beforeSubmit: ShowPreloader,
			url:'/application/module/user/template.add.subs.im.form.php',
			success: HidePreloader
		};
		$('#SubsForm').ajaxSubmit(optionsRequeryForm); 
		$('#SubsSbtIm').show();
	});
	
	//	опции для отправки данных для сохранения подписки 
	var optionsSubsSbt = { 
		target: "#DivRequerySubs",
		beforeSubmit: ShowPreloader,
		url:'/application/module/user/template.data.retention.php',
		success: SaveSubsOk
	};
	$('#SubsSbtIm').bind("click", function(){
	  	$('#SubsForm').ajaxSubmit(optionsSubsSbt); 
		return false;
	});
});
//	функция проверки выбран ли пункт для редактирования
function valideEdit(formData, jqForm, options)
{
	var queryString = $.param(formData); 
	//alert(queryString); 
}
function SaveSubsOk(responseText, statusText)  { 
	HidePreloader();	
	$('#FormAlertIsOk').show();
	$('#SubsForm').hide();
}
//alert('Статус ответа сервера: ' + statusText + '\n\nТекст ответа сервера: \n' + responseText + 
//'\n\nЦелевой элемент div обновиться этим текстом.'); 
</script>

	