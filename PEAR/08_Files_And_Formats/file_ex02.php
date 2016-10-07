<?php
/* Writing to a file */

require_once 'File.php';

$file = '/tmp/mynewfile.txt';

for ($i = 0; $i < 10; $i++) {
	File::writeLine($file, sprintf("%s", $i), FILE_MODE_APPEND);
}

?>
