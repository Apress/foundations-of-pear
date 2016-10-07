<?php

require_once 'Auth.php';
require_once 'HTML/Form.php';
require_once 'Validate.php';

/**
 * Validates the form's data.
 */
function validate() 
{
	if (Validate::email($_POST['username'])) {
		return true;
	} else {
		// $errs = array('Please supply a valid e-mail address');
		return false;
	}
}

/**
 * Processes the data in the form.
 */
function process($a) 
{
	/* We first validate it to see if it is a valid e-mail address */
	
	$result = $a->addUser($_POST['username'], $_POST['password']);
	
	if (PEAR::isError($result)) {
		// $errs = array('Error!');
		return false;   
	} else {
		// $errs = array('User added successfully!'); 
		return true;
	}	
}

/**
 * Displays the form to the user
 */
function display() 
{
	print <<<END
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Web Calendar Application - Login</title>
<style type="text/css">
	body { font-family:sans-serif;font-size:small; }
</style>
</head>
<body bgcolor="#FFFFFF" text="#000000">
END;

	/* Set up custom options here, as we are not using the default 
	 * schema for database authentication.  Create script for our
	 * table is:
	 * 
	 * CREATE TABLE users (
	 * 	user_id VARCHAR(255) NOT NULL, 
	 * 	password VARCHAR(1024) NOT NULL
	 * 	);
	 */
	$form = new HTML_Form(htmlspecialchars($_SERVER['PHP_SELF']), 'post');
	$form->addText('username', "Login (email address):");
	$form->addPasswordOne('password', 'Password:');
	$form->addSubmit('submit', 'Register');
	$form->display();
	
	print <<<END
</body>
</html>
END;
}

/* Alternatively, use a class that returns the auth statically
 * or a class that returns the Auth options.  See the Addressbook
 * project for an example.
 * 
 * TODO:  Make sure to change your DSN here to be the 
 * appropriate one for you database.  See the DB chapter for more
 * information about DSNs.
 * 
 */

$authOptions = array (
	'dsn' => 'mysql://calendar:secret@localhost/calendar',
	'table' => 'users',
	'usernamecol' => 'user_id',
	'passwordcol' => 'password',
	'crypttype' => 'md5'
);

$a = new Auth('DB', $authOptions);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (validate()) {
		if (process($a))
		{
			print 'The user has been added!';			
		} else {
			print 'An error occured while processing the form!';
		}
		display();
	} else {
		print 'The form is invalid!';
		display();
	}
} else {
	display();	
}

?>

