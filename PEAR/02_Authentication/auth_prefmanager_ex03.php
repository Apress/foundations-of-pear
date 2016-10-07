<?php
/* Auth_PrefManager Example 3 */
require_once 'Auth/HTTP.php';
require_once 'Auth/PrefManager.php';

$dsn = 'mysql://web:secret@localhost/auth';
/* Set up the options for the Auth_PerfManager */
$prefOptions = array ('serialize' => true);
/* Set up the options for Auth_HTTP */
$authOptions = array('dsn'=>$dsn, 
	'table'=>'auth', 
	'usernamecol'=>'username', 
	'passwordcol'=>'password',
	'cryptType'=>'MD5');

$prefManager = new Auth_PrefManager($dsn, $prefOptions);
$auth = new Auth_HTTP('DB', $authOptions);

$auth->setRealm('Site with Preferences');
$auth->setCancelText('<h1>Access is forbidden!</h1>');
$auth->start();

if ($auth->getAuth())
{
	/* The 'nickname' option is still in the database from
	 * running Example 1.  If you haven't run Example 1 you
	 * will need to populate this preference first! 
	 * The PHP_AUTH_USER variable has the name of the currently
	 * logged in user. */
	echo '<h1>Welcome, ' .
		$prefManager->getPref($_SERVER['PHP_AUTH_USER'], 'nickname') .
		'!</h1>';
}
else
{
	echo 'Not logged in!';
}
?>

