<?php
/*
 * Created on Mar 31, 2006
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
require_once 'DB.php';

$dsn = 'mysql://web:secret@localhost/auth';
$options = array(
    'debug'       => 2,
    'portability' => DB_PORTABILITY_ALL,
);

$db =& DB::connect($dsn, $options);
if (PEAR::isError($db)) {
    die($db->getMessage());
}

// Proceed with getting some data...
$res =& $db->query('SELECT * FROM auth');

// Get each row of data on each iteration until
// there are no more rows
while ($res->fetchInto($row)) {
    // Assuming DB's default fetchmode is DB_FETCHMODE_ORDERED
    echo $row[0] . "\n";
}

$db->disconnect();
?>
