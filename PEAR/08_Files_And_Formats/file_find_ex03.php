<?php
/* Searching for a directory */

require_once 'File/Find.php';

$results = File_Find::search('*/mydir', '/tmp', 'shell', 'false', 'directories');

foreach ($results as $result) {
	printf("Found directory:  '%s'\n", $result);
}

?>
