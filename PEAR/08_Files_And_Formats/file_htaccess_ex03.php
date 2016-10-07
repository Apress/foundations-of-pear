<?php
/* Changing the properies on an .htaccess file */

/* First, load the file up. */
require_once 'File/Htaccess.php';

$htaccess = new File_HtAccess('.htaccess');
$result = $htaccess->load();

if (PEAR::isError($result)) {
    echo "An error occurred while trying to load the file\n";
} else {
	/* Now set some properties */
    $htaccess->setAuthName('My Secret Zone');
}

/* Then save the file.  */
$result = $htaccess->save();

if (PEAR::isError($result)) {
    echo "An error occurred while trying to save the file\n";
} else {
    // continue processing
}

?>
