<?php

require_once 'Auth.php';
require_once 'AddressbookUtils.php';
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

/* See the AddressbookUtils class for details */
$a = AddressbookUtils::getAuth();
$a->start();

if ($a->checkAuth()) {
    header('location:welcome.php');
}

?>