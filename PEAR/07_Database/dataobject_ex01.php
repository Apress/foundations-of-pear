<?php
include_once('DB/DataObject.php' );

$options = &PEAR::getStaticProperty('DB_DataObject','options');

$options = array(
        'database' => 'mysql://apress:apress@localhost/apress',
        'schema_location' => 'C:/xampp/htdocs/Apress/DataObjects/',
        'class_location' => 'C:/xampp/htdocs/Apress/DataObjects/',
        'require_prefix' => 'DataObjects/',
        'class_prefix' => 'DataObjects_',
);

$movies = DB_DataObject::factory('MustSee');

$movies->selectAdd();
$movies->selectAdd('ms_rank');
$movies->selectAdd('ms_name');
$movies->whereAdd("ms_name LIKE 'S%'");
$movies->orderBy('ms_rank');
$movies->find();

while($movies->fetch())
{
    echo $movies->ms_rank . ' - ' . $movies->ms_name . '<br>';
}
?>
