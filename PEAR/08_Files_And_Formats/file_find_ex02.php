<?php
/* Displaying the entire contents of a directory */

require_once 'File/Find.php';

/* This example will recursively search through an entire
 * directory and find all of the files/directories contained
 * in the directory.
 */
 
list($directories, $files) = File_Find::maptree('/tmp');

foreach ($directories as $directory) {
	printf("Found directory:  '%s'\n", $directory);
}

foreach ($files as $file) {
	printf("Found file:  '%s'\n", $file);
}

?>
