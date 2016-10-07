<?php

/* Comparing dates */

require_once 'Date.php';

$date = new Date('2006-02-10');
echo $date->format("Date is:  %D%n");
echo sprintf("The date is %s today.\n", 
	$date->isPast() ? "before" : "after");

/* Set the year to something in the future */
$date->setYear(2015);
echo $date->format("Date is:  %D%n");
echo sprintf("The date is %s today.\n", 
	$date->isPast() ? "before" : "after");

$now = new Date();

/* Compare the future date with now. */
$result = Date::compare($now, $date);
echo sprintf('Comparing $now with $date:  %s', $result) . "\n";

$result = Date::compare($date, $now);
echo sprintf('Comparing $date with $now:  %s', $result) . "\n";
?>
