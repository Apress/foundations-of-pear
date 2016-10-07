<head>
<title>DB_Table - form input example</title>
</head>
<body>
<?php
require_once 'DB.php';
require_once 'DB/Table.php';
require_once 'mustsee.php';

$dataSource = "mysql://apress:apress@localhost/apress";
if (DB::isError($connection = DB::connect($dataSource))){
    die (DB::errorMessage($connection));
}

$mustsee = &new mustsee($connection, 'mustsee', 'safe');

$columns = array('ms_rank','ms_name','ms_year');
$form = &$mustsee->getForm($columns,null,null,true);

$form->addElement('submit', 'submit', 'Add');

$form->display();
?>
</body>
</html>
