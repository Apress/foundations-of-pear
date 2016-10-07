<?php
/* Auth Example 2 */
require_once "Auth.php";

function showLogin() {
	/* This HTML can be anything you want to show for a
	 * login.
	 */
	print "<form method=\"post\" action=\"auth_ex03.php\">";
	print "Username:&nbsp;&nbsp;";
	print "<input type=\"text\" name=\"username\"/><br/>";
	print "Password:&nbsp;&nbsp;";
	print "<input type=\"password\" name=\"password\"/><br/>";
	print "<input type=\"submit\"/>";
	print "</form>";
}

/* Once the user has been authenticated on this page, you
 * can use the staticCheckAuth() method on other pages to 
 * make sure the user's login is still valid.
 * 
 * Example:
 * 
		if (Auth::staticCheckAuth($options)) {
			print "Logged in!";
		} else {
			print "Not logged in!";
		}
 */

$passwdFile = "/Users/Nathan/Sites/pear_projects/pear_ch02/mypasswd";

$a = new Auth("File", $passwdFile, 'showLogin');
$a->start();

if ($a->checkAuth()) {
	/* Put some action here that is appropriate for logging in */
	echo "You're in!";
} else {
	echo "You are not logged in!";
}
?>