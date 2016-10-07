<?php

/* Extracting a tar file */

require_once 'Archive/Tar.php';

$archive = new Archive_Tar('/tmp/my_archive.tar');

$archive->extract('/tmp/files');

?>
