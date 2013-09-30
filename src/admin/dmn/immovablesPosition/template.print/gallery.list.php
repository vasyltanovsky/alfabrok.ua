<?php
function CreateGalleryHeader()
{
?>
<script>
function stopPropagation(e)
{
	if (!e)
	      e = window.event;
	if (!e)
		return;
	    //IE9 & Other Browsers
	    if (e.stopPropagation) {
	      e.stopPropagation();
	    }
	    //IE8 and Lower
	    else {
	      e.cancelBubble = true;
	    }
};

function showSummary(summary)
{
	if ($("#summaryPopup").length == 0)
	{
		$(document.body).append("<div id='summaryPopup'></div>");
	}
	$("#summaryPopup").html(summary).dialog({ width: 900 });
};

hs.graphicsDir = '/js/highslide/graphics/';
hs.align = 'center';
hs.transitions = ['expand', 'crossfade'];
hs.fadeInOut = true;
hs.dimmingOpacity = 0.8;
hs.outlineType = 'rounded-white';
hs.captionEval = 'this.thumb.alt';
hs.marginBottom = 105; // make room for the thumbstrip and the controls
hs.numberPosition = 'caption';

hs.addSlideshow({
        interval: 5000,
        repeat: true,
        useControls: true,
        overlayOptions: {
            className: 'text-controls',
            position: 'bottom center',
            relativeTo: 'viewport',
            offsetY: -60
        },
        thumbstrip: {
            position: 'bottom center',
            mode: 'horizontal',
            relativeTo: 'viewport'
        }
    });
</script>
<?php
}

function DrawGallery($im_id, $im_photo)
{
	global $images_root;
	$ImPhotos = new mysql_select ( 'immovables_photos', " where im_id=".$im_id ); 
	$photos = $ImPhotos->select_table ('im_photo_id');
	?>
				<script>
		        	var options<?php echo $im_id;?> = {
	    	        		slideshowGroup: 'group<?php echo $im_id;?>'
	        		};
				</script>
				<div class="highslide-gallery">
					<a onclick="stopPropagation(event);return hs.expand(this, options<?php echo $im_id;?>);" href="<?php echo $images_root; ?>/files/images/immovables/<?php echo $im_photo;?>"><img src="<?php echo $images_root; ?>/files/images/immovables/si_<?php echo $im_photo;?>" width="120"/></a>
					<div style='display:none;'>
					<?php foreach($photos as $imKey => $imValue) :
							if($imValue["im_photo_id"].".".$imValue["im_file_type"] != $im_photo):
					?>
						<a class="highslide" href="<?php echo $images_root; ?>/files/images/immovables/<?php echo $imValue["im_photo_id"];?>.<?php echo $imValue["im_file_type"];?>" onclick="return hs.expand(this, options<?php echo $im_id;?>)" ><img src="<?php echo $images_root; ?>/files/images/immovables/si_<?php echo $imValue["im_photo_id"];?>.<?php echo $imValue["im_file_type"];?>"/></a>
					<?php
					endif; 
					endforeach; ?>
					</div>
				</div>
	<?php
}
function DrawSummaryPopup($im_id)
{
	global $images_root;
	$ImSuQClass = new mysql_select("immovables_summary");
	$active_text_id = $ImSuQClass -> select_table_id("WHERE lang_id = '4c5d58cd3898c' AND im_id = {$im_id}");
	?>
		<img width="22" src="<?php echo $images_root; ?>/files/images/submit/submitSubscription.png" onclick="stopPropagation(event);showSummary('<?php echo htmlspecialchars(str_replace("”", "&#8221;", str_replace("\"", "&#8221;", str_replace("'", "&#39;", str_replace("\n", "", str_replace("\r", "", $active_text_id["im_su_text"]))))));?>');return false;"></img>
	<?php 
}

function DrawRieltorsHistory($im_id, $susr_id)
{
	global $rieltorsData;
	$log_select = new mysql_select("immovables_logs");
	$log_select->select_table_query("select * from (select * from immovables_logs  where im_id={$im_id} and field='susr_id' order by change_date desc limit 4) i order by change_date", "im_id");
	if (count($log_select->table) == 0)
	{
		echo ($susr_id ? ($rieltorsData->buld_table[$susr_id]["photo"] ? "<img width=\"80\" title=\"" . $rieltorsData->buld_table[$susr_id]["fio"] . "\" src=\"../../files/images/realtor/" .$rieltorsData->buld_table[$susr_id]["photo"]. "\"/>" : $rieltorsData->buld_table[$susr_id]["fio"] ) : "<small>не выбран</small>");
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
}
?>