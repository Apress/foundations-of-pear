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

$movies->ms_rank = 11;
$movies->ms_name = "Star Wars";
$movies->ms_year = 1977;

$movies->insert();
?>
