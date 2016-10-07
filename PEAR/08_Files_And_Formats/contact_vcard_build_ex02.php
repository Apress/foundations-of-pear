<?php
/* Building a vcard and saving it to a file. */

require_once 'Contact_Vcard_Build.php';

$card = new Contact_Vcard_Build();
$card->setFormattedName('John Q. User');
$card->setName('User', 'John', 'Q.', 'Mr.', 'Jr.');
$card->addEmail('john.user@example.com');
$card->addParam('TYPE', 'WORK');

$card->addAddress('P.O. Box 111', '', '', 'Anytown', 'NE', '55555', 'US');
$card->addParam('TYPE', 'WORK');

/* Now save the text that we've just created to a 
 * file
 */
$file = 'JohnQUser.vcf';

if ($cardFile = fopen($file, 'w')) {
	fwrite($cardFile, $card->fetch());
	fclose($cardFile);
}


?>
