<?php
	require_once '../../config/config.php';
// ?????????? SoftTime FrameWork
		require_once DOC_ROOT . '/config/class.config.php';
session_start();

	if (count($_FILES)) {
        // Handle degraded form uploads here.  Degraded form uploads are POSTed to index.php.  SWFUpload uploads
		// are POSTed to upload.php
	}

// ???????? ????????? ????????
require_once ("../utils/top.php");
?>


</head>
<body>
<link href="/js/SWFUpload/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/SWFUpload/swfupload/swfupload.js"></script>
<script type="text/javascript" src="/js/SWFUpload/js/swfupload.queue.js"></script>
<script type="text/javascript" src="/js/SWFUpload/js/fileprogress.js"></script>
<script type="text/javascript" src="/js/SWFUpload/js/handlers.js"></script>

<script type="text/javascript">
var upload1;
window.onload = function() {
	upload1 = new SWFUpload({
		// Backend Settings
		upload_url: "upload.php",
		post_params: {"PHPSESSID" : "<?php echo session_id(); ?>", "im_id" : 1 },

		// File Upload Settings
		file_size_limit : "102400",	// 100MB
		file_types : "*.*",
		file_types_description : "All Files",
		file_upload_limit : "10",
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
		upload_complete_handler : uploadComplete,

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
		debug: true
	});
 }
</script>

<?php echo $_SERVER["HTTP_HOST"]?>
<div id="content">
	<h2>Multi-Instance Demo</h2>
	<form id="form1" action="index.php" method="post" enctype="multipart/form-data">
		<p>This page demonstrates how multiple instances of SWFUpload can be loaded on the same page.
			It also demonstrates the use of the graceful degradation plugin and the queue plugin.</p>
		<table>
			<tr valign="top">
				<td>
					<div>
						<div class="fieldset flash" id="fsUploadProgress1">
							<span class="legend">Large File Upload Site</span>
						</div>
						<div style="padding-left: 5px;">
							<span id="spanButtonPlaceholder1"></span>
							<input id="btnCancel1" type="button" value="Cancel Uploads" onclick="cancelQueue(upload1);" disabled="disabled" style="margin-left: 2px; height: 22px; font-size: 8pt;" />
							<br />
						</div>
					</div>
				</td>
				<td>
					<div>
						<div class="fieldset flash" id="fsUploadProgress2">
							<span class="legend">Small File Upload Site</span>
						</div>
						<div style="padding-left: 5px;">
							<span id="spanButtonPlaceholder2"></span>
							<input id="btnCancel2" type="button" value="Cancel Uploads" onclick="cancelQueue(upload2);" disabled="disabled" style="margin-left: 2px; height: 22px; font-size: 8pt;" />
							<br />
						</div>
					</div>
				</td>
			</tr>
		</table>
	</form>
</div>
</body>
</html>
