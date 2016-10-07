<?php

/* This example provides the barest of examples of 
 * generating a quick SOAP server.  I wrote the WSDL first, then
 * wrote this simple server to provide basic authentication
 * functionality.  It uses PHP 5 SOAP extensions, which must
 * be compiled in.  You can also use the SOAP PEAR module.
 */

function authenticate($username, $password) {
	/* This is just hard-coded to get the point across.  
	 * Ideally, you would have a database call or some other kind
	 * of authentication mechanism inside this function.
	 */
	if ($username == "myuser" && $password == "secret")
	{
		return $password;
	}
	else
	{
		/* The matchpasswords featurs is off, so the call is expecting
		 * a SOAP fault if the login is invalid.
		 */
		return new SoapFault("Server", "Error logging in!");
	}
}
/* Shut caching off, otherwise you might be wondering why your
 * changes aren't getting picked up.
 */
ini_set("soap.wsdl_cache_enabled", "0");
$server = new SoapServer("auth.wsdl");
$server->addFunction("authenticate");
$server->handle();
?>


