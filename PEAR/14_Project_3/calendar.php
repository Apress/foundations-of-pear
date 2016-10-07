<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Web Calendar Application - Main Calendar</title>
<style type="text/css">
	.holiday { color:gray;font-size:smaller }
	td.day { height:100px;vertical-align:top;padding-left:0.5em; }
	td.head { font-weight:bold; }
	td.weekend { width:10%; background-color:lightyellow; }
	td.weekday { width:14%; }
	td.weekend,td.weekday,td.appt,td.allday { border-style:solid;border-width:1px;border-color:gray; }
	td.appt { font-size:smaller; background-color:lightblue;padding-left:0.5em; }
	td.allday { font-size:smaller;background-color:lightgreen;padding-left:0.5em;height:4em; }
	body { font-family:sans-serif;font-size:small; }
</style>
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php

require_once 'Auth.php';
require_once 'DB.php';
require_once 'Date.php';
require_once 'Date/Holidays.php';
require_once 'HTML/Form.php';

function displayLoginMessage()
{
	print "To see your appointments you need to log in!  " .
			"You can do that <a href=\"login.php\">here</a>.";
}

function drawAppointment($row) 
{
	if (! $row['is_allday']) {
		print("<td class=\"appt\">");
		$sd = new Date($row['start_date']);
		$ed = new Date($row['end_date']);
		print "<b>" . $sd->format("%I:%M %p") . "&nbsp;-&nbsp;" . 
			$ed->format("%I:%M %p") . "</b>&nbsp;" . $row['description'];
	} else {
		print("<td class=\"allday\">");
		print $row['description'] . "&nbsp;<b>(All day)</b>";
	}

}

/* Check to see if the user is authenticated.  If they are not, draw
 * a nice link so they can go get themselves logged in.
 * 
 * TODO:  Make sure to update the DSN!
 * 
 */
 
$authOptions = array (
	'dsn' => 'mysql://calendar:secret@localhost/calendar',
	'table' => 'users',
	'usernamecol' => 'user_id',
	'passwordcol' => 'password',
	'crypttype' => 'md5'
);

$a = new Auth("DB", $authOptions, 'displayLoginMessage');
$a->start();

// if ($a->checkAuth()) {
if (true) {
	
	/* If the form has been posted back on itself, grab the dates 
	 * out of the drop-down boxes.  Otherwise, just use the current
	 * month.
	 */
	 
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$date = new Date();
		$date->setDay('1');
		$date->setMonth($_POST['month']);
		$date->setYear($_POST['year']);
	} else {
		$date = new Date();
		$date->setDay('1');
	} 
	
	print "<h1>" . $date->format("%B %Y") . " Calendar</h1>";
	
	$form = new HTML_Form(htmlspecialchars($_SERVER['PHP_SELF']), 'post');
	print $form->returnStart();
	$months = array (
		'01' => 'January',
		'02' => 'February',
		'03' => 'March',
		'04' => 'April',
		'05' => 'May',
		'06' => 'June',
		'07' => 'July',
		'08' => 'August',
		'09' => 'September',
		'10' => 'October',
		'11' => 'November',
		'12' => 'December'
	);
	$years = array (
		'2006' => '2006', 
		'2007' => '2007', 
		'2008' => '2008', 
		'2009' => '2009', 
		'2010' => '2010'
	);
	print "Go to:&nbsp;&nbsp;";
	print $form->returnSelect('month', $months, $date->format('%m'), 1, '', 
		false, "onchange=\"document.forms[0].submit();\"");
	print $form->returnSelect('year', $years, $date->format('%Y'), 1, '', 
		false, "onchange=\"document.forms[0].submit();\"");
	print $form->returnEnd();
	print "<br/>";
	print "<table id=\"calendar\" summary=\"calendar\" " .
			"style=\"width:100%;border-style:solid;border-width:1px\">";
	print "<tr>";
	print "<td class=\"weekend head\">Sunday</td>";
	print "<td class=\"weekday head\">Monday</td>";
	print "<td class=\"weekday head\">Tuesday</td>";
	print "<td class=\"weekday head\">Wednesday</td>";
	print "<td class=\"weekday head\">Thursday</td>";
	print "<td class=\"weekday head\">Friday</td>";
	print "<td class=\"weekend head\">Saturday</td>";
	print "</tr>";
	print "";
	
	$holidays = &Date_Holidays::factory('USA', $date->format('%Y'), 'en_EN');
	
	$numWeeks = $date->getWeeksInMonth();
	$startDow = $date->getDayOfWeek();
	
	/* TODO:  Update the DSN */
	$db =& DB::connect('mysql://calendar:secret@localhost/calendar');
	if (PEAR::isError($db)) {
	    die($db->getMessage());
	}
	
	try {
	
		$statement = 
			$db->prepare('SELECT DAYOFMONTH(start_date) AS day, ' .
					'start_date, end_date, description, user_id, ' .
					'is_allday FROM appointments WHERE user_id = ? ' .
					'AND MONTH(start_date) = ? AND YEAR(start_date) = ? ' .
					'ORDER BY start_date ASC');
				
		$db->setFetchMode(DB_FETCHMODE_ASSOC);
		
		$data = array($a->getUsername(), $date->getMonth(), $date->getYear());
		/* Now we have a list of all of our appointments */
		$appointments = $db->execute($statement, $data);
		
		$appointments->fetchInto($row);
				
		for ($pad = 0; $pad < $startDow; $pad++) {
			if ($pad == 0 || $pad == 6) {
				if ($pad == 0 ) {
					print '<tr><td class="weekend day">&nbsp;</td>';
				} else {
					print '<td class="weekend day">&nbsp;</td>';	
				}			
			}
			else
			{
				print '<td class="weekday day">&nbsp;</td>';
			}		
		}
		
		/* Now we should be at the first day */	
			
		$daysInMonth = $date->getDaysInMonth();
		for ($day = 0; $day < $daysInMonth; $day++) {
			printf("<td class=\"%s\">", 
				($date->getDayOfWeek() == 6 || $date->getDayOfWeek() == 0) ? 
					"weekend day" : "weekday day");
			print $date->format("%e");
			/* Is it a holiday? */
			if ($holidays->isHoliday($date)) {
				$holiday = $holidays->getHolidayForDate($date);
				print "<span class=\"holiday\">&nbsp;&nbsp;(" . $holiday->getTitle() . ")</span>";
			}
			print "<br/>";
			
			/* Is there anything for this day in the appointment database? */
			if ($row['day'] == $date->getDay()) {
				print "<table width=\"95%\"><tr>";
				/* If there is something that matches, display it and 
				 * keep going until something doesn't match anymore
				 */
				drawAppointment($row);
				/* Now get the next one to make sure that it may match */
				while (($appointments->fetchInto($row)) && ($row['day'] == $date->getDay()))
				{
					print "</td></tr><tr>";
					drawAppointment($row);
				}
				print "</td></tr></table>";
			}
			
			/* Close out the day's cell */
			print("</td>");
			if ($date->getDayOfWeek() == 6) print "</tr><tr>";
			$date = $date->getNextDay();
		}
					
		for ($day = $date->getDayOfWeek(); $day < 7; $day++) {
			if ($day == 0 || $day == 6) {
				print '<td class="weekend day">&nbsp;</td>';
			} else {
				print '<td class="weekday day">&nbsp;</td>';	
			}	
		}
		
	print "</table>";
		
	} catch (Exception $e) {
		/* Print the details of the exception out to the screen for now */
		print $e->getMessage();
	}
	$db->freePrepared($statement);
	$db->disconnect();
}
 
?>

</body>
</html>