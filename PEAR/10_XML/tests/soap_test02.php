<?php

/* This simple test uses the built-in PHP 5
 * SOAP extensions to automagically create a proxy and
 * call it.
 */

$client = new SoapClient('http://localhost/~User1/PEAR/10_XML/soap_ex02.php?wsdl');

try {
	
	printf("Johnny Five's number is \"%s\".<br/>", $client->lookup('Five', 'Johnny'));
	printf("Freddy Six's number is \"%s\".", $client->lookup('Six', 'Freddy'));
		
} catch (SoapFault $sf)  {
	print $sf;
}

?>
