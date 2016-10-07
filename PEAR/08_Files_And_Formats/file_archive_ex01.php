<?php

/* Creating a .tgz file. */

require_once 'File/Archive.php';

/* The method name, extract, is a little confusing here.  
 * But think of it as the File_Archive class is extracting 
 * the files from the directory named here and placing them 
 * into the archive writer.
 */
 
File_Archive::extract(
	File_Archive::read('/tmp/sampledir'),
	File_Archive::toArchive(
		'/tmp/archive.tgz', 
		File_Archive::toFiles())
);

?>
