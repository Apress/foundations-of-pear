<?php

/* Making replacements in a list of directories. */

include 'File/SearchReplace.php';

$files = array ();

$directories = array (
	"/tmp/mydir1/",
	"/tmp/mydir2/"
);
                
$search = new File_SearchReplace( "[servername]", "example.com", $files, $directories, true) ;
$search -> doSearch() ;

?>
