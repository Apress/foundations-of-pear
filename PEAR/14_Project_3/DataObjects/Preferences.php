<?php
/**
 * Table Definition for preferences
 */
require_once 'DB/DataObject.php';

class DataObjects_Preferences extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'preferences';                     // table name
    public $user_id;                         // string(255)  not_null primary_key
    public $pref_id;                         // string(32)  not_null primary_key
    public $pref_value;                      // blob(-1)  not_null blob

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Preferences',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
