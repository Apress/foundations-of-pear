<?php
/* Building a simple vCard */

require_once 'Contact_Vcard_Build.php';

/* Note:  The RFC for the vCard format can be located at:
 * http://www.ietf.org/rfc/rfc2426.txt
 */
 
$card = new Contact_Vcard_Build();

$card->setFormattedName('Joe User');
$card->setName('User', 'Joe', 'Q.', 'Mr.', '');
$card->addEmail('juser@example.com');
$card->addParam('TYPE', 'WORK');

$card->addAddress('P.O. Box 111', '', '', 'Anytown', 'NE', '55555', 'US');
$card->addParam('TYPE', 'WORK');

$text = $card->fetch();

/* Right now we will just print it out to the console */
printf("%s\n", $text);

?>
