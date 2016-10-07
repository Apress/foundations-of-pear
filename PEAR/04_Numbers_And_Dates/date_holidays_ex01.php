<?php
/* Determining the date of a US holiday */

require_once 'Date/Holidays.php';

$holidays = &Date_Holidays::factory('USA', 2007, 'en_EN');
if (Date_Holidays::isError($holidays)) {
    die('Factory was unable to produce driver-object');
}

$mlkDay = &$holidays->getHoliday('mlkDay', 'en_EN');
$date = $mlkDay->getDate();

echo $date->format("In %Y, Martin Luther King Day is on %B %d.%n");

$independenceDay = &$holidays->getHoliday('independenceDay', 'en_EN');
$idDate = $independenceDay->getDate();
echo $idDate->format("In %Y, Independance Day is on a %A.%n");

?>
