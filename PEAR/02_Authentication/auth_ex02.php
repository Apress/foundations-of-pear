<?php
/* Auth Example 2 */
require_once "Auth.php";

function showLogin() {
	/* This HTML can be anything you want to show for a
	 * login.
	 */
	print "<form method=\"post\" action=\"auth_ex02.php\">";
	print "Username:&nbsp;&nbsp;";
	print "<input type=\"text\" name=\"username\"/><br/>";
	print "Password:&nbsp;&nbsp;";
	print "<input type=\"password\" name=\"password\"/><br/>";
	print "<input type=\"submit\"/>";
	print "</form>";
}

/* Build the options used by the SOAP storage 
 * container.
 */
$soapOptions = array(
	'endpoint'=>'http://localhost/~user1/PEAR/02_Authentication/authws/authws.php',
	'namespace'=>'urn:AuthWebService',
	'method'=>'authenticate',
	'encoding'=>'utf8',
	'usernamefield'=>'username',
	'passwordfield'=>'password',
	'trace'=>'true',
	'matchpasswords'=> false
);

$a = new Auth('SOAP', $soapOptions, 'showLogin');
$a->start();

if ($a->checkAuth()) {
	/* Put some action here that is appropriate for logging in */
	echo "You're in!";
} else {
	echo "You are not logged in!";
}
?>
