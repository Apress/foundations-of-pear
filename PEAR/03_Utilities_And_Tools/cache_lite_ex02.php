<?php

require_once 'Cache/Lite.php';

/* Setting a couple options.  The cache files
 * will be written to the /tmp directory, and
 * the data inside the files will be good for
 * 60 seconds.  Obviously, you'll want a longer
 * amount of time but the short increment helps testing.
 */
$cacheOptions = array(
	'cacheDir' => '/tmp/',
	'lifeTime' => '60',
	'pearErrorMode' => CACHE_LITE_ERROR_DIE
	);
	
$cache = new Cache_Lite($cacheOptions);

if (! ($data = $cache->get('cache_lite_ex02.php')))
{
	/* The data is not cached, so we have to go get it
	 * from the source.  For this example, the source
	 * is a web service somewhere.  For right now the details
	 * are unimportant.  See the SOAP chapter for details.
	 */ 
	$client = new SoapClient("http://www.example.com/echo.wsdl");

	try
	{
		$data = $client->echoMessage("Hello from Mars!");
		$cache->save($data);
	} catch (SoapFault $fault) {
		print $fault;
	}
}

echo $data;

?>
