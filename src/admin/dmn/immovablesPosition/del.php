<?php
$zip = new ZipArchive();

if ($zip->open("archive.zip", ZipArchive::CREATE) !== true) {
	die ("Could not open archive");
}

$iterator = new RecursiveDirectoryIterator('test/');
foreach ($iterator as $key => $value) {
	$path = pathinfo($value);
	if ($path['basename'] == '.' || $path['basename'] == '..') continue;

	$zip->addFile(realpath($key), $key);
}

$zip->close();
