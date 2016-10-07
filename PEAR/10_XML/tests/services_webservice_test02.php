<?php

/* This simple test uses the built-in PHP 5
 * SOAP extensions to automagically create a proxy and
 * call it.
 */
 
 $client = new SoapClient('http://localhost/~Nathan/pear_10/services_webservice_ex02.php?wsdl');
 
 try
 {
 	print ($client->getLocation('11111'));
 }
 catch (SoapFault $sf)
 {
 	print $sf;
 }

?>
