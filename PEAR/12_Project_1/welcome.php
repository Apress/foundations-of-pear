<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- $Id: welcome.php 63 2006-11-08 03:09:04Z nathan $$ -->
<head>
<title>Address Book - Welcome!</title>
</head>
<body>
<h1>Welcome!</h1>
<p>Here is a list of your contacts.  Click on the name of
the contact to view the details</p>
<?php

/* The Welcome page is going to display the names
 * found in the data directory.
 */
require_once 'AddressbookConfig.php';
require_once 'File/Find.php';

$config = AddressbookConfig::singleton();
$dataDir = $config->getDataPath();

/* First, make sure the data dir exists */

if (file_exists($dataDir)) {
	
	/* Use File:Find to get the file names from the data dir */
	
	$results = File_Find::glob('/^.*\.vcf/', $dataDir, 'perl');
	
	if ($results) {
		
		foreach($results as $result) {
			/* Format the result.  Since we control the upload process,
			 * We know that each name is stored Lastname_Firstname.vcf.
			 * We'll re-format that to display nicely on the window
			 */
			$displayString = preg_replace('/([A-Za-z]+)_([A-Za-z]+)\.vcf/', 
				"\\1, \\2", $result);
			printf("<a href=\"viewcontact.php?contact=%s\">%s</a><br/>", 
				$result, $displayString);
		}
		
	} else {
		print "<b>No contacts found!</b>";
	}
		
} else {
	/* The configured data directory does not exist, so nicely
	 * tell the user
	 */
	print "<span style=\"color:red\">Error:  Directory $dataDir does not exist!</span>";
}

?>
<hr/>
<table width="100%">
<tr>
<td><a href="newcontact.php">Add New Contact</a></td>
</tr>
</table>
</body>
</html>