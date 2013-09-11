<?php
define ( 'DOC_ROOT', $_SERVER ['DOCUMENT_ROOT'] . "/" );
unlink ( sprintf ( DOC_ROOT . "/files/images/immovables/%s", $_GET ["im_photo"] ) );
unlink ( sprintf ( DOC_ROOT . "/files/images/immovables/st_%s", $_GET ["im_photo"] ) );
unlink ( sprintf ( DOC_ROOT . "/files/images/immovables/s_%s", $_GET ["im_photo"] ) );
echo "delete";
?>