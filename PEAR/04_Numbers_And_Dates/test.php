<?php
/* This is a garbage file used to test a couple 
 * different outputs to make sure the API documetation
 * is correct.
 */

require_once 'Date.php';

$date = new Date('2006-02-10 13:00:00');

printf("Year is:  '%s'\n", $date->getYear());

$date->setDay(31);
printf("%s\n", $date->getDate(DATE_FORMAT_ISO));

$date->setHour(95);
printf("%s\n", $date->getDate(DATE_FORMAT_ISO));

?>
