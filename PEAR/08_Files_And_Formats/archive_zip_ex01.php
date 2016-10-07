<?php
/* Creating a new ZIP file. */

require_once 'Archive/Zip.php';

$zipfile = new Archive_Zip('/tmp/my_archive.zip');

$files = array('/tmp/file1.txt', '/tmp/file2.txt', '/tmp/file3.txt');

$zipfile->add($files);

?>
