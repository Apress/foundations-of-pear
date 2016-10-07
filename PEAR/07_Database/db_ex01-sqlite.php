<?php
require_once 'DB.php';

$dataSource = array(
    'phptype'  => 'sqlite',
    'database' => 'apress.db',
    'mode'     => '0666'
);

$dataOptions = array(
);

$database =&DB::connect($dataSource, $dataOptions);
if (PEAR::isError($database)) {
    die($database->getMessage());
}

$dataResult = &$database->query('SELECT * FROM mustsee ORDER BY ms_rank');

while ($dataRow = &$dataResult->fetchRow()) {
     echo $dataRow[2] . "<br>\n";
}
$database->disconnect();
?>
