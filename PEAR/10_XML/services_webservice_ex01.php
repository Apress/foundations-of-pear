<?php

/* Exposing a very simple web service */

require_once 'Services/Webservice.php';

class TimeWebService extends Services_WebService
{
	
	/**
	 * Gets an important time in history
	 * 
	 * @return string
	 */
	public function getTime()
	{
		return 'August 29, 2029 02:14:00 EST';
	}	

}

$options = array (
	'uri' => 'timeWebService',
	'encoding' => SOAP_ENCODED,
	'soap_version' => SOAP_1_2
	);

$timeWS = new TimeWebService('TimeWebService', 'My description', $options);

$timeWS->handle();

?>
