<?php
/* Parsing a vCard file */

require_once 'Contact_Vcard_Parse.php';

$file = 'JohnQUser.vcf';
$card = new Contact_Vcard_Parse();

if (file_exists($file)) {
	
	$content = $card->fromFile($file);
	
	print_r($content);
	
	/* By examining the printed content, you will see that you 
	 * can get to the first name by typing:
	 */
	
	$firstName = $content[0]["FN"][0]["value"][0][0];
	
	printf("First name is:  \"%s\"\n", $firstName);	
}



?>
