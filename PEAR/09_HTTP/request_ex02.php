<?php
require_once "PEAR.php";
require_once "HTTP/Request.php";
$request =& new HTTP_Request('http://www.google.com/');
/* Make sure to change the proxy IP address to one in your network.  */
$request->setProxy('172.16.24.253',8080);
$request->sendRequest(false);
$headers = $request->getResponseHeader();
 if (PEAR::isError($headers)) {
     echo "Error: " . $headers->getMessage();
 } else {
     echo "<pre>";
     print_r($headers);
     echo "</pre>";
 }
?>
