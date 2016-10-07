<?php
require_once('HTML/Crypt.php');
$crypt = new HTML_Crypt('allan@mediafrenzy.co.za'); 
$crypt->addMailTo();
$crypt->output();
?>
