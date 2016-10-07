<?php

/* A test for connecting to the database and making sure that 
 * we are in good shape.
 */

//require_once 'DB.php';
//
//$db =& DB::connect('mysql://calendar:secret@localhost/calendar');
//if (PEAR::isError($db)) {
//    die($db->getMessage());
//}
//
//	$statement = $db->prepare('SELECT DAYOFMONTH(start_date) AS day, start_date, end_date, description, user_id FROM appointments WHERE user_id = ? AND MONTH(start_date) = ?');
//	$db->setFetchMode(DB_FETCHMODE_ASSOC);
//	
//	$data = array('user1', 5);
//	
//$result = $db->execute($statement, $data);
//
//while ($result->fetchInto($row)) {
//    print_r($row['day']);
//    print "<br/>";
//}
//
//$db->freePrepared($statement);
//
//$db->disconnect();

include 'dataobjects.inc.php';

require_once 'DB/DataObject.php';
require_once 'DataObjects/Appointments.php';
    // and this goes on your display code 
    
    // create a new person class..
    $appt = DB_DataObject::Factory('appointments');
    
    // DB_DataObject::debugLevel(5);
    
   	if (PEAR::isError($appt)) {
	    die($appt->getMessage());
	}
    
    // get the person using the primary key.
    /*
    $appt->start_date = '2006-11-30 11:00:00';
    $appt->end_date = '2006-11-30 12:00:00';
    $appt->user_id = 'moo@example.com';
    $appt->is_allday = '0';
    $appt->description = 'This is from the thing';
    */
    $appt->get(17);
    //  DB_DataObjects is designed to make print_r useable to debug your applications.
    print "'" . $appt->user_id . "'";


?>
