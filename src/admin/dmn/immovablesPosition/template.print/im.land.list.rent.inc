<!-- 
imData
TemplateImList
dictionaries
CMSImagesNum  
CMSImages 
ImPQStatistic 
ImTasks 
ImPropData
ImPropArrData
rieltorsData
-->
<?php
include_once("gallery.list.php"); 
CreateGalleryHeader();
if ( $imData != 0) :?>
<table cellspacing="0" cellpadding="0" border="0" class="table-list">
	<tr class="headings">
		<td width="10"></td>
		<td class="TdLeftBorder"><a class="STHNactive" href="javascript:setSortTable('im_code');">Код:</a></td>
		<td class="TdLisImImage">Изображение</td>
		<td>Риэлтор</td>
		<td>Адрес/<br> Описание/<br> Задача </td>
		<td>Цена за месяц ($)</td>
		<td>Цена за день ($)</td>
		<td>Площадь<br>общая</td>
		<td>Дата внесения</td>
		<td>Аренда/ Продажа/ Топ</td>
		<td>Отображать</td>
		<td>Просмотров</td>
	</tr>
	<?php foreach ($imData as $key => $value) :?>		
		<tr id="im-item-<?php echo $value["im_id"];?>" class="im-item-position cursor-pointer <?php echo ((empty($value["susr_id"]) && !empty($value["operator_id"])) ? "no-isset-susr" : "" );?> <?php echo ($value["im_is_special"] != 0 ? "im_is_special" : "");?>">
			<td class="td-radio-bottom"><input type="radio" name="im_id" value="<?php echo $value["im_id"];?>"></td>
			<td class="TdLeftBorder im-item-noclick" onclick="window.open('http://alfabrok.ua/<?php echo $value["im_code"];?>');"><a onclick='return false;' href='http://alfabrok.ua/<?php echo $value["im_code"];?>'><?php echo $value["im_code"];?></a></td>
			<td class="TdLisImImage"><?php DrawGallery($value["im_id"], $value["im_photo"])?></td>
			<td class="">
				<?php
					$log_select = new mysql_select("immovables_logs");
					$log_select->select_table_query("select * from immovables_logs where im_id={$value["im_id"]} and field='susr_id' order by change_date limit 4");
					if (count($log_select->table) == 0)
					{
						echo ($value["susr_id"] ? ($rieltorsData->buld_table[$value["susr_id"]]["photo"] ? "<img width=\"80\" title=\"" . $rieltorsData->buld_table[$value["susr_id"]]["fio"] . "\" src=\"../../files/images/realtor/" .$rieltorsData->buld_table[$value["susr_id"]]["photo"]. "\"/>" : $rieltorsData->buld_table[$value["susr_id"]]["fio"] ) : "<small>не выбран</small>");
					}
					else
					{
						$num = 0;
						foreach($log_select->table as $logRow)
						{
							$num++;
							$current_style = "";
							if ($num == count($log_select->table))
							{
								$current_style = "font-weight:bold;border:solid 2px #55FF55;width:auto;"; 
							}
							echo "<div style='$current_style'>";
							echo "<span title='".$rieltorsData->buld_table[$logRow['changed_by']][fio]."'>".($logRow["new_value"] ? ($rieltorsData->buld_table[$logRow["new_value"]]["photo"] ? "<img width=\"80\" title=\"" . $rieltorsData->buld_table[$logRow["new_value"]]["fio"] . "\" src=\"../../files/images/realtor/" .$rieltorsData->buld_table[$logRow["new_value"]]["photo"]. "\"/>" : $rieltorsData->buld_table[$logRow["new_value"]]["fio"] ) : "<small>не выбран</small>")."</span>";
							echo "<br/>";
							echo "<span style='font-size:75%'>".$logRow[change_date]."</span>";
							echo "</div>";
						}
					}
				?>
			</td>
			<td>
				<?php echo $dictionaries->buld_table[$value["im_city_id"]]["dict_name"];?>, <?php echo $dictionaries->buld_table[$value["im_area_id"]]["dict_name"];?>, <?php echo $dictionaries->buld_table[$value["im_adress_id"]]["dict_name"];?>, <?php echo $value["im_adress_house"];?>
				<br/><small><?php echo $value["im_title"];?></small> <br /><small><?php echo ($ImTasks->buld_table[$value["im_code"]] ? "<b><a style=\"\" target=\"_blank\" href=\"../../dmn/imtask/index.php?action=gettask&t_id={$ImTasks->buld_table[$value["im_code"]][t_id]}\">{$ImTasks->buld_table[$value["im_code"]][t_title]}</a>" : "");?></small> 
				<?php if($value["user_tel"]): ?>
					<div class="im-user-tel"><?php echo $value["user_tel"];?></div>
				<?php endif; ?>			
				<?php if($value["user_notes"]): ?>
					<div class="im-user-notes"><?php echo $value["user_notes"];?></div>
				<?php endif; ?>
				<br/>
				<?php DrawSummaryPopup($value["im_id"]);?>
			</td>
			<td style="white-space:nowrap;"><?php echo Discharge::GetDisValue($value['im_prace_manth']*$_COOKIE['exchange_USD'], 4);?>
				<br/>(<?php echo Discharge::GetDisValue($value['im_prace_manth'], 4, "$")?>)</td>
			<td style="white-space:nowrap;"><?php echo Discharge::GetDisValue($value['im_prace_day']*$_COOKIE['exchange_USD'], 4);?>
				<br/>(<?php echo Discharge::GetDisValue($value['im_prace_day'], 4, "$")?>)</td>
			<td><?php echo $value["im_space"];?></td>
			<td><?php echo class_date::GetPeapleDateView($value["im_date_add"]);?></td>
			<td><?php echo $CMSImagesNum[$value["im_is_rent"]];?> <?php echo $CMSImagesNum[$value["im_is_sale"]];?> <?php echo $CMSImagesNum[$value["im_is_hot"]];?></td>
			<td><?php echo $CMSImages[$value["hide"]];?></td>
			<td><?php echo $ImPQStatistic->buld_table[$value["im_id"]]["wiev_count"];?></td>
		</tr>
	<?php endforeach;?>
</table>
<?php 
//echo "<pre>";
//print_r($value);
//echo "</pre>";
?>

<?php else : ?>
<div class="error-list">По Вашему запросу ничего не найдено!</div>
<?php endif; ?>