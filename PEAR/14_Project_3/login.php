<?php

require_once 'Auth.php';
require_once 'HTML/Form.php';

function showLogin() {
    /* Use the HTML_Form class to show our login form
     */
    print "<html><head></head><body>";
	$form = new HTML_Form(htmlspecialchars($_SERVER['PHP_SELF']), 'post');
	$form->addText('username', 'Username:');
	$form->addPasswordOne('password', 'Password:');
	$form->addSubmit('submit', 'Login');
	$form->display();
	print "You are not currently logged in!";
	print "</body></html>";
}

/* Set up custom options here, as we are not using the default 
 * schema for database authentication.  Create script for our
 * table is:
 * 
 * CREATE TABLE users (
 * 	user_id VARCHAR(255) NOT NULL, 
 * 	password VARCHAR(1024) NOT NULL
 * 	);
 * 
 * NOTE:  Make sure to update the DSN to be the correct one for your
 * environment...
 * 
 */
$options = array (
	'dsn' => 'mysql://calendar:secret@localhost/calendar',
	'table' => 'users',
	'usernamecol' => 'user_id',
	'passwordcol' => 'password',
	'crypttype' => 'md5'
);

$a = new Auth("DB", $options, 'showLogin');
$a->start();

if ($a->checkAuth()) {
    header('location:calendar.php');
}

?>
  

