<?php

// *** Include the class
include ("resize-class.php");

// *** 1) Initialise / load image
$resizeObj = new resize ( 'sample.jpg' );

// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
$resizeObj->resizeImage ( 200, 200, 'crop' );

// *** 3) Save image
$resizeObj->saveImage ( 'sample-resized.jpg', 100 );

?>
