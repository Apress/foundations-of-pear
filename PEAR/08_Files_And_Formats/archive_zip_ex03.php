<?php
/* Extracting files from a ZIP file */

require_once 'Archive/Zip.php';

$zipfile = new Archive_Zip('/tmp/my_archive.zip');

$options = array (
	'remove_all_path' => 'true',
	'add_path' => '/tmp/zipfiles/'
);

$zipfile->extract($options);

?>
