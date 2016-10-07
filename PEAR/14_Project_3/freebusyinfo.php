<?php

require_once 'DB.php';

if (isset($_GET['start']) && isset($_GET['end'])) {

	/* This script checks to see if a given time spot for a given user is 
	 * already taken.  It exposes the results as a web service that can
	 * be consumed by other applications. 
	 * 
	 * TODO:  Make sure to update your DSN
	 * 
	 */
	$db =& DB::connect('mysql://calendar:secret@localhost/calendar');
	
	if (PEAR::isError($db)) {
	    die($db->getMessage());
	}
	
	try {
		
		$start_date = $_GET['start'];
		$end_date = $_GET['end'];
	
		// Once you have a valid DB object named $db...
		$statement = $db->prepare('select count(appointmentid) from appointments ' .
				'where (? <= start_date AND ? >= end_date) ' . 
				' OR (? >= start_date AND ? < end_date AND ? >= end_date) ' . 
		 		' OR (? < start_date AND ? > start_date AND ? <= end_date)');
		
		$data = array($start_date, $end_date, 
			$start_date, $start_date, $end_date, 
			$start_date, $end_date, $end_date);
		
		$result = $db->execute($statement, $data);
		
		if (PEAR::isError($result)) {
		    die($result->getMessage());
		}
		
		/* Check the result to see what we have now */
		
		$result->fetchInto($row);
		
		if ($row[0] > 0) {
			print "<span style=\"color:red\">You are <b>busy</b> during this time!</span>";
		} else {
			print "You are <b>free</b> during this time!";
		}
		
		$db->freePrepared($statement);
		
	} catch (Exception $e) {
		/* TODO:  Print the error out here */
	}
	
	$db->disconnect();
}

?>
