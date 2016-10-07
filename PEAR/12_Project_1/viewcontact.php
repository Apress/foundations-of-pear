<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- $Id: viewcontact.php 63 2006-11-08 03:09:04Z nathan $ -->
<head>
<title>Address Book - View Contact</title>
<style type="text/css">
	td.label { text-align : right; font-weight: bold; }
	.error { color : red ; font-weight : bold; }
</style>
</head>
<body>
<?php

require_once 'AddressbookConfig.php';
require_once 'Contact.php';
require_once 'Log.php';
	
$config = AddressbookConfig::singleton();
$dataDir = $config->getDataPath();

$logger = &Log::factory('file', $config->getLogFilename(), 'AddressBook');
$mask = Log::MIN($logger->stringToPriority($config->getLogLevel()));
$logger->setMask($mask);

function printError($errMessage)
{
	print("<span class=\"error\">$errMessage</span>");
}


/* Look for the name of the card on the query string... */
$cardName = basename($_GET["contact"]);
/* Check the name of the card for any funny business */
if (preg_match("/(\.\.|\/)/", $cardName)) {
	
	printError(printf("Invalid name \"%s\"", $cardName));
	
} else {
	
	/* Now load the contact up and display the contents to
	 * the window.
	 */
	$fileName = $dataDir . '/' .$cardName;
	if (file_exists($fileName)) {
		
		try {
			
			$contact = 	Contact::getContact($cardName);
			
			printf("<h1>Details for %s %s</h1>", 
				$contact->getGivenName(), 
				$contact->getFamilyName());
		
			print("<table>");
			
			printf("<tr><td class=\"label\">Email address:</td><td>%s</td></tr>",
				$contact->getEmailAddress());
				
			printf("<tr><td class=\"label\">Telephone number:</td><td>%s</td></tr>",
				$contact->getTelephoneNumber());
				
			$address = $contact->getAddress();
				
			printf("<tr><td class=\"label\">Address 1:</td><td>%s</td></tr>",
				$address->getAddress1());
				
			printf("<tr><td class=\"label\">Address 2:</td><td>%s</td></tr>",
				$address->getAddress2());
				
			printf("<tr><td class=\"label\">City:</td><td>%s</td></tr>",
				$address->getCity());
				
			printf("<tr><td class=\"label\">State/Province:</td><td>%s</td></tr>",
				$address->getState());				

			printf("<tr><td class=\"label\">Postal Code:</td><td>%s</td></tr>",
				$address->getPostalCode());
			
			printf("<tr><td class=\"label\">Country:</td><td>%s</td></tr>",
				$address->getCountry());
			
			print("</table>");	
			
			/* Allow the user to download the VCard. */
			
			print("<br/><a href=\"downloadcontact.php?contact=$cardName\">Download contact</a>");
			
		} catch (exception $e) {
			/* Log the error message out to the log. */
			$logger->err("An error occurred while attempting to get the contact data: {$e->getMessage()}");
		}
		
	} else {
		/* The file does not exist... */
		printError("The specified contact cannot be found!");
	}
}
?>
<hr/>
<table width="100%">
<tr>
<td><a href="welcome.php">View All Contacts</a></td>
<td><a href="newcontact.php">Add New Contact</a></td>
</tr>
</table>
</body>
</html>
