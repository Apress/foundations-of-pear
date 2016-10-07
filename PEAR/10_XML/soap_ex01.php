<?php

/* Calling a SOAP method.*/

require_once 'SOAP/Client.php';

/* This is the automatically-generated WSDL file from the
 * Services_Webservice example...
 */
$wsdl = new SOAP_WSDL('http://localhost/~User1/PEAR/10_XML/services_webservice_ex01.php?wsdl');

$proxy = $wsdl->getProxy();

print ($proxy->getTime());
?>
