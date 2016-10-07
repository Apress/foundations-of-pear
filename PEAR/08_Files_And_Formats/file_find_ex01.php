<?php
/* Searching for a file */

require_once 'File/Find.php';

/* The 'perl' option will use PCREs to find the
 * files.  This is very powerful, because it offers that ability
 * to use regular expressions as criteria instead of the more 
 * simple shell wildcard characters.
 */
$results = File_Find::glob('/file[0-2]\.txt/', '/tmp', 'perl');

foreach($results as $result) {
	printf("Found file: '%s'\n", $result);
}

?>
