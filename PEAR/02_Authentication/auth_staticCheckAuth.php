<?php

require_once 'Auth.php';

function showLogin() {
	/* This HTML can be anything you want to show for a
	 * login.
	 */
	print "<form method=\"post\" action=\"auth_staticCheckAuth.php\">";
	print "Username:&nbsp;&nbsp;";
	print "<input type=\"text\" name=\"username\"/><br/>";
	print "Password:&nbsp;&nbsp;";
	print "<input type=\"password\" name=\"password\"/><br/>";
	print "<input type=\"submit\"/>";
	print "</form>";
}

/* A simple example of using staticCheckAuth();
 */

showLogin();

$options = array (
	'file' => '/Users/User1/Sites/02_Authentication/mypasswd',
	);

if (Auth::staticCheckAuth($options)) {
	print "Logged in!";
} else {
	print "Not logged in!";
}

?>
