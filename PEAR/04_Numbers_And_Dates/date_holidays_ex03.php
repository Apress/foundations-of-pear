<?php

/* Getting the holidays between two dates. */

require_once 'Date/Holidays.php'; 

$holidays = &Date_Holidays::factory('USA');
if (Date_Holidays::isError($holidays)) {
    die('Factory was unable to produce driver-object');
}
$holidays->setLocale('en_EN');

$dates = $holidays->getHolidaysForDatespan('2006-04-01', '2006-08-01');
$limit = count($dates);

echo "Looking for holidays between '2006-04-01' and '2006-08-01':\n";

for ($i = 0; $i < $limit; $i++) {
	
	$date = $dates[$i]->getDate();
	
	printf("\t\"%s\" is on %s\n", 
		$dates[$i]->getTitle(), 
		$date->format("%B %d"));
}

?>
