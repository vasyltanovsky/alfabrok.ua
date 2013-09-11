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
	$ImPhotos = new mysql_select ( 'immovables_photos', " where im_id=".$im_id ); 
	$photos = $ImPhotos->select_table ('im_photo_id');
	?>
				<script>
		        	var options<?php echo $im_id;?> = {
	    	        		slideshowGroup: 'group<?php echo $im_id;?>'
	        		};
				</script>
				<div class="highslide-gallery">
					<a onclick="stopPropagation(event);return hs.expand(this, options<?php echo $im_id;?>);" href="/files/images/immovables/<?php echo $im_photo;?>"><img src="/files/images/immovables/si_<?php echo $im_photo;?>" width="120"/></a>
					<div style='display:none;'>
					<?php foreach($photos as $imKey => $imValue) :
							if($imValue["im_photo_id"].".".$imValue["im_file_type"] != $im_photo):
					?>
						<a class="highslide" href="/files/images/immovables/<?php echo $imValue["im_photo_id"];?>.<?php echo $imValue["im_file_type"];?>" onclick="return hs.expand(this, options<?php echo $im_id;?>)" ><img src="/files/images/immovables/si_<?php echo $imValue["im_photo_id"];?>.<?php echo $imValue["im_file_type"];?>"/></a>
					<?php
					endif; 
					endforeach; ?>
					</div>
				</div>
	<?php
}
function DrawSummaryPopup($im_id)
{
	$ImSuQClass = new mysql_select("immovables_summary");
	$active_text_id = $ImSuQClass -> select_table_id("WHERE lang_id = '4c5d58cd3898c' AND im_id = {$im_id}");
	?>
		<img width="22" src="/files/images/submit/submitSubscription.png" onclick="stopPropagation(event);showSummary('<?php echo htmlspecialchars(str_replace("”", "&#8221;", str_replace("\"", "&#8221;", str_replace("'", "&#39;", str_replace("\n", "", str_replace("\r", "", $active_text_id["im_su_text"]))))));?>');return false;"></img>
	<?php 
}
?>