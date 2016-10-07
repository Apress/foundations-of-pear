<?php
/* Determining if a day is a holiday */

require_once 'Date/Holidays.php';

$holidays = &Date_Holidays::factory('Christian', 2008, 'en_EN');
if (Date_Holidays::isError($holidays)) {
    die('Factory was unable to produce driver-object');
}

$date = new Date('2008-12-25');

if ($holidays->isHoliday($date)) {
	echo $date->format('%D is a holiday!%n');
} else {
	echo $date->format('%D is NOT a holiday!%n');
}

?>
