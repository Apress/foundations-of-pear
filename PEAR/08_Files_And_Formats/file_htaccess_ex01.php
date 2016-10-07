<?php
/* Writing an .htaccess file */

require_once('File/HtAccess.php');

/* create a new .htaccess file with given parameters */

$options = array(
	'authname' => 'Private',
	'authtype' => 'Basic', 
	'authuserfile' => '/tmp/.htpasswd', 
	'authgroupfile' => '/tmp/.htgroup', 
	'require' => array ('group', 'users')
);

$htaccess = new File_HtAccess('.htaccess', $options);
$result = $htaccess->save();

if (PEAR::isError($result)) {
    echo "An error occurred while trying to save the file\n";
} else {
    // continue processing
}

?>
