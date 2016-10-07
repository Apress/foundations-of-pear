<?php

/* Using web services */

require_once 'Services/Webservice.php';

/**
 * Web service class 
 */
class ClosestCheeseMarket extends Services_WebService
{
	
	/* The doc comments here are important!  The WSDL generator
	 * in the class uses the datatype given here to be know what
	 * type of parameter is being passed to the web service method.
	 */
	
	/**
	 * Returns the location of the nearest cheese market.
	 * @param string $j
	 * @return string
	 */
	public function getLocation($j)
	{
		$loc = '';
		
		switch ($j)
		{
			case '55555':
				$loc = "Rudolph's Taxidermy, Spark Plugs, and Cheese";
				break;
			case '11111':
				$loc = "Dick's U-Pull-It Car Parts and Cheddar";
				break;
			case '22222':
				$loc = "Ye Olde Cheez Shoppe und Radiators";
				break;
			default:
				$loc = "No cheese for you!";
				break;
		}
		
		return $loc;
	}
}

$options = array (
	'uri' => 'closestCheeseMarket',
	'encoding' => SOAP_ENCODED,
	'soap_version' => SOAP_1_2
	);

$ws = new ClosestCheeseMarket(
	'ClosestCheeseMarket', 
	'Returns the name of the cheese market in your postal code', 
	$options);
	
$ws->handle();


?>
