<?php

	$client = new SoapClient("auth.wsdl");

	try
	{
		if (($client->authenticate("myuser", "secret")) == "secret")
		{
			print "logged in!";
		}
		else
		{
			print "not logged in!";
		}

	} catch (SoapFault $fault) {

		print $fault;
	}

?>
