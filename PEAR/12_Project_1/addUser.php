<?php

require_once 'AddressbookUtils.php';

$a = AddressbookUtils::getAuth();
$a->addUser('myuser', 'secret');
$a->addUser('user', 'password');

?>
