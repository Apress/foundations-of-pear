<?php

include 'dataobjects.inc.php';

require_once 'Auth.php';
require_once 'DataObjects/Appointments.php';
require_once 'DB/DataObject.php';
/* require_once 'DB.php'; */
require_once 'HTML/Form.php';

function displayLoginMessage()
{
	print "You need to log in!  You can do that <a href=\"login.php\">here</a>.";
}

/**
 * Validates the form's data.
 */
function validate() 
{
	/* Validate the date format and the date information here */
	
	return true;
}

/**
 * Processes the data in the form.
 */
function process($a) 
{
	
	/* Save the data to the database */		
	try {
	
	    $appt = DB_DataObject::Factory('appointments');
	    
	   	if (PEAR::isError($appt)) {
		    die($appt->getMessage());
		}
		
		if (isset($_POST['allday']) && $_POST['allday'] == 'on') {
			$appt->start_date = $_POST['date'] . ' 00:00:00'; 
			$appt->end_date = $_POST['date'] . ' 23:59:59';
			$appt->is_allday = 1;
		} else {
			$appt->start_date = $_POST['date'] . ' '. $_POST['start_time']; 
			$appt->end_date = $_POST['date'] . ' '. $_POST['end_time'];
			$appt->is_allday = 0;	
		}
		
		$appt->description = $_POST['description']; 
		$appt->user_id = $a->getUsername();
		
		/* Now that the object is populated, this will actually put 
		 * it into the database. */
		$id = $appt->insert();
		
		/* Not doing anything with the id here, but it could be logged.  See
		 * the Addressbook project for examples of logging!
		 */
		
	} catch (Exception $e) {
		print $e->getMessage();
	}
	
	header('location:calendar.php');
}

/**
 * Displays the form to the user
 */
function display() 
{
	
	print <<<END
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Web Calendar Application - Create/Edit Appointment</title>
<style type="text/css">
	body { font-family:sans-serif;font-size:small; }
</style>
<script language="javascript" type="text/javascript" src="ajax_server.php?client=all"></script>
<script language="javascript" type="text/javascript">
function updateSels(chk) {
	if (chk.checked) {
		document.getElementById('selStartTime').selectedIndex = 0;
		document.getElementById('selEndTime').selectedIndex = 0;
		document.getElementById('selStartTime').disabled = true;
		document.getElementById('selEndTime').disabled = true;
		updateFreeBusy();
	} else {
		document.getElementById('selStartTime').disabled = false;
		document.getElementById('selEndTime').disabled = false;
	}
}
function updateFreeBusy() {
	/* Get the values of the dates and send them along on the URL */
	var d = document.getElementById('txtDate').value;
	var st = document.getElementById('selStartTime').value;
	var et = document.getElementById('selEndTime').value;
	var fb = document.getElementById('chkAllDay').checked;
	if (fb) {
		var qry = encodeURI("?start=" + d + " 00:00:00&end=" + d + " 23:59:59");
	} else {
		var qry = encodeURI("?start=" + d + " " + st + "&end=" + d + " " + et);		
	}

	HTML_AJAX.replace('status', 'freebusyinfo.php' + qry);
	/* alert('freebusyinfo.php' + qry); */
	/* Check the result */
	var s = document.getElementById('status').innerHTML;
	
}
</script>
</head>
<body bgcolor="#FFFFFF" text="#000000" 
	onload="updateSels(document.getElementById('chkAllDay'))">
END;

	$times = array (
		'' => '', '24:00:00' => '12:00 AM', '00:30:00' => '12:30 AM',
		'01:00:00' => '1:00 AM', '01:30:00' => '1:30 AM', 
		'02:00:00' => '2:00 AM', '02:30:00' => '2:30 AM', 
		'03:00:00' => '3:00 AM', '03:30:00' => '3:30 AM',
		'04:00:00' => '4:00 AM', '04:30:00' => '4:30 AM', 
		'05:00:00' => '5:00 AM', '05:30:00' => '5:30 AM', 
		'06:00:00' => '6:00 AM', '06:30:00' => '6:30 AM', 
		'07:00:00' => '7:00 AM', '07:30:00' => '7:30 AM', 
		'08:00:00' => '8:00 AM', '08:30:00' => '8:30 AM', 
		'09:00:00' => '9:00 AM', '09:30:00' => '9:30 AM',
		'10:00:00' => '10:00 AM', '10:30:00' => '10:30 AM', 
		'11:00:00' => '11:00 AM', '11:30:00' => '11:30 AM', 
		'12:00:00' => '12:00 PM', '12:30:00' => '12:30 PM',
		'13:00:00' => '1:00 PM', '13:30:00' => '1:30 PM', 
		'14:00:00' => '2:00 PM', '14:30:00' => '2:30 PM', 
		'15:00:00' => '3:00 PM', '15:30:00' => '3:30 PM',
		'16:00:00' => '4:00 PM', '16:30:00' => '4:30 PM', 
		'17:00:00' => '5:00 PM', '17:30:00' => '5:30 PM', 
		'18:00:00' => '6:00 PM', '18:30:00' => '6:30 PM',
		'19:00:00' => '7:00 PM', '19:30:00' => '7:30 PM', 
		'20:00:00' => '8:00 PM', '20:30:00' => '8:30 PM', 
		'21:00:00' => '9:00 PM', '21:30:00' => '9:30 PM',
		'22:00:00' => '10:00 PM', '22:30:00' => '10:30 PM', 
		'23:00:00' => '11:00 PM', '23:30:00' => '11:30 PM'
		);
	
	$form = new HTML_Form(htmlspecialchars($_SERVER['PHP_SELF']), 'post');
	$form->addText('date', 'Appointment date:', null, 0, 0, "id=\"txtDate\"");
	$form->addCheckbox('allday', 'All day event:', false, "id=\"chkAllDay\" " .
			"onclick=\"javascript:updateSels(this)\"");
	$form->addSelect('start_time', 'Start time:', $times, null, 1, '', 
		false, "id=\"selStartTime\"");
	$form->addSelect('end_time', 'End time:', $times, null, 1, '', 
		false, "id=\"selEndTime\" onchange=\"updateFreeBusy();\"");
	$form->addText('description', 'Description:');
	$form->addSubmit('submit', 'Save appointment', "id=\"btnSubmit\"");
	$form->addReset('Reset');
	
	$form->display();
	
	print <<<END
<span style="font-style:italic;font-size:small;">Make sure to
format the date like 'YYYY-MM-DD' so your database recognizes it.  
You could always use the Date package to get the date 
and format it in the way that your database understands!</span><br/>
<div id="status"></div>
</body>
</html>
END;

}

/* Authenticate the user
 * 
 * TODO:  Make sure to update your DSN!  
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

if ($a->checkAuth()) {
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (validate()) {
			process($a);
		} else {
			display();
		}
	} else {
		display();	
	}
}

?>