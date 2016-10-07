<?php
/* Reading an entire a file at once. */

require_once 'File.php';

$file = "/tmp/myfile.txt";

$contents = File::readAll($file);

echo $contents;

?>
