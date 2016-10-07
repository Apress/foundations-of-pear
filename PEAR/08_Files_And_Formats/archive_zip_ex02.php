<?php
/*  Listing the contents of a zip file */
require_once 'Archive/Zip.php';

$zipfile = new Archive_Zip('/tmp/my_archive.zip');

$fileInfo = $zipfile->listContent();

foreach ($fileInfo as $file)
{
	printf("Found file:  '%s'.\n", $file['filename']);
}

?>
