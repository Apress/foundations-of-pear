<!-- Put standard HTML here for the page, like the 
	DOCTYPE declaration, head, title, etc. -->
<?php

/* Auth Example 1 */
require_once "Auth.php";

/* This function will be called if the user needs to
 * be authenticated.
 */
function showLogin() {
	/* This HTML can be anything you want to show for a
	 * login.
	 */
	print "<form method=\"post\" action=\"auth_ex01.php\">";
	print "Username:&nbsp;&nbsp;";
	print "<input type=\"text\" name=\"username\"/><br/>";
	print "Password:&nbsp;&nbsp;";
	print "<input type=\"password\" name=\"password\"/><br/>";
	print "<input type=\"submit\"/>";
	print "</form>";
}
/* DSN is in form of driver://user:password@server/database
 * See the DB module for more information.
 */
$dsn = 'mysql://web:secret@localhost/auth';
$a = new Auth('DB', $dsn, 'showLogin');

$a->start();

if ($a->checkAuth()) {
	/* Put some action here that is appropriate for logging in */
	echo "You're in!";
} else {
	echo "You are not logged in!";
}
?>
<!-- Put HTML footer stuff here -->