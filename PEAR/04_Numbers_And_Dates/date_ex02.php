<?php
/* Adding Dates and Times. */

require_once 'Date.php';
require_once 'Date/Span.php';

$date = new Date('2006-04-05');
$date->setTZbyID('CST');
echo $date->format("Original date:  %A, %B %e %Y %n");

/* Now add three days to the current day */
$span = new Date_Span();
$span->setFromDays(3);

$date->addSpan($span);
echo $date->format("Three days later:  %A, %B %e %Y %n");

/* Now find the next business day */
$nextBusinessDate = $date->getNextWeekday();
echo $nextBusinessDate->format("The next weekday:  %A, %B %e %Y %n");
?>
