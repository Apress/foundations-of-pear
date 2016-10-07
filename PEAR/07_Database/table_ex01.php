<?php
require_once 'DB.php';
require_once 'DB/Table.php';
require_once 'actors.php';

$dataSource = "mysql://apress:apress@localhost/apress";
if (DB::isError($connection = DB::connect($dataSource))){
    die (DB::errorMessage($connection));
}
$actor = &new actors($connection, 'actors', 'safe');

$rowID = $actor->nextID();
$insertData = array(
        'act_id'        => $rowID,
        'act_name'      => 'Uma Thurman'
);
$insertResult = $actor->insert($insertData);

$rowID = $actor->nextID();
$insertData = array(
        'act_id'        => $rowID,
        'act_name'      => 'Morgan Freeman'
);
$insertResult = $actor->insert($insertData);
?>
