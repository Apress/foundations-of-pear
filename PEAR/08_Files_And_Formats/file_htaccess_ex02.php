<?php
/* Reading the entries in an .htaccess file */

require_once 'File/Htaccess.php';

$htaccess = new File_HtAccess('.htaccess');
$result = $htaccess->load();

if (PEAR::isError($result)) {
    echo "An error occurred while trying to load the file\n";
} else {
    /* No error while loading the file, so it is okay
     * to get properties from the file.
     */
    printf("The authtype is: '%s'\n", $htaccess->getAuthType());
}

?>
