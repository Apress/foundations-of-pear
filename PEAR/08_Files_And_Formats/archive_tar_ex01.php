<?php
/*  Creating a .tar file */

require_once 'Archive/Tar.php';

$archive = new Archive_Tar('/tmp/my_archive.tar');

$files = array('/tmp/file1.txt', '/tmp/file2.txt', '/tmp/file3.txt');

$archive->addModify($files, '', '');

?>
