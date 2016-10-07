<?php

/* Reading the lines in a file. */

require_once 'File.php';

$file = "/tmp/myfile.txt";

while($line = File::readLine($file)) {
	print $line . "\n";
}

?>
