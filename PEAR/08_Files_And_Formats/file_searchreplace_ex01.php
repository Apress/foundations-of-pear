<?php

/* Making replacements in a list of files. */

include 'File/SearchReplace.php';

$files = array ( 
	"/tmp/config.ini",
	"/tmp/config2.ini",
	"/tmp/config3.ini" 
);
                
$search = new File_SearchReplace( "[servername]", "example.com", $files) ;
$search -> doSearch() ;

?>
