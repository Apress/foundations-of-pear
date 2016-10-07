<?php
/**
 * Table Definition for users
 */
require_once 'DB/DataObject.php';

class DataObjects_Users extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'users';                           // table name
    public $user_id;                         // string(255)  not_null primary_key
    public $password;                        // string(1024)  not_null

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Users',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
