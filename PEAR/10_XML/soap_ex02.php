<?php
/* Implementing a SOAP server with PEAR::SOAP */

require_once 'SOAP/Server.php';
require_once 'SOAP/Disco.php';

/**
 * A web service example class that provides a method of
 * looking up phone numbers by a person's last and first
 * names.
 */
class PhonebookWebService
{
	
	/**
	 * A map that is used to for the methods and variables.
	 * @access private
	 */
	var $__dispatch_map = array();
	
	/**
	 * Constructor.
	 */
	function PhonebookWebService()
	{
		$this->__dispatch_map['lookup'] = array (
				'in' => array (
						'lastName' => 'string',
						'firstName' => 'string',
					),
				'out' => array (
						'result' => 'string'
					)	
			);
	}
	
	/**
	 * Method exposed as a web service method to get phone
	 * numbers given a last and first name.
	 * @param string $lastName Last (family) name of person
	 * @param string	$firstName First (given) name of person
	 */
	function lookup($lastName, $firstName)
	{
		/* Here this function is just mocking up some data
		 * to make sure that the call to the service is functional,
		 * but of course in real life this will be replaced by a
		 * call to a data store to retreive the information.
		 */
		if ($lastName == "Five" && $firstName = "Johnny") {
			return "(555) 555-5555";
		} else {
			return "(111) 111-1111";
		}
			
	}
}

/* This is the code for creating the SOAP server and
 * responding to the SOAP request.
 */

$soapServer = new SOAP_Server();

$webService = new PhonebookWebService();

$soapServer->addObjectMap($webService, 'urn:PhonebookWebService');

if (isset($_SERVER['REQUEST_METHOD']) && 
	$_SERVER['REQUEST_METHOD'] == 'POST') {
		
	$soapServer->service($HTTP_RAW_POST_DATA);
	
} else {
	
	/* If the client is not posting SOAP data, then the server
	 * can expose the WSDL or DISCO so the client knows how to
	 * properly call the server.
	 */
	
	$disco = new SOAP_DISCO_Server($soapServer, 'PhonebookWebService');
	
	header("Content-type: text/txt");
	if (isset($_SERVER['QUERY_STRING']) &&
		strcasecmp($_SERVER['QUERY_STRING'], "wsdl") == 0) {	
		
		echo $disco->getWSDL();
		
	} else {	
		
		echo $disco->getDISCO();
		
	}
}

?>
