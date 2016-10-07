<?php
/* Printing the contents of a tar file */

require_once 'Archive/Tar.php';

$archive = new Archive_Tar('/tmp/my_archive.tar');

$content = $archive->listContent();

foreach($content as $entry) {
	printf("Found file: \"%s\" of size %d\n", $entry["filename"], $entry["size"]);
}

?>
