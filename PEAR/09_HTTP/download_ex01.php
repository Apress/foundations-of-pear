<?php
require_once('HTTP/Download.php');
$download = new HTTP_Download();
$download->setFile('datafile.dat');
$download->setCache(false);
$download->setBufferSize(10000);
$download->setThrottleDelay(1);
$download->send();
?>
