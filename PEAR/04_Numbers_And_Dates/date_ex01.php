<?php
/* Converting a UTC date to a timezone */

require_once 'Date.php';

$date = new Date('2006-04-10 13:00:00');
$date->toUTC();
/* This will print the date out, which is now a UTC date */
echo $date->getDate(DATE_FORMAT_ISO) . "\n";

$cst = new Date_Timezone('CST');

/* Now convert the date to the new timezone. */
$date->convertTZ($cst);
/* This will print that date again, this time in CST (UTC -6) */
echo $date->getDate(DATE_FORMAT_ISO) . "\n";

/* This will print the same date, but in a more friendly
 * format.  The date will look like: Monday, April 4 2006 at 07:00 am.
 */
echo $date->format("%A, %B %e %Y at %I:%M %p%n");

$otherDate = new Date('1997-08-27 02:14:00');
print $otherDate->getTime();

?>
