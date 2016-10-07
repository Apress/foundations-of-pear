<?php
/**
 * Table Definition for appointments
 */
require_once 'DB/DataObject.php';

class DataObjects_Appointments extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'appointments';                    // table name
    public $appointmentid;                   // int(10)  not_null primary_key unsigned auto_increment
    public $start_date;                      // datetime(19)  not_null binary
    public $end_date;                        // datetime(19)  not_null binary
    public $description;                     // blob(65535)  not_null blob
    public $user_id;                         // string(255)  not_null
    public $is_allday;                       // int(1)  not_null

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Appointments',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
