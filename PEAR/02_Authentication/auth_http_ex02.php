<?php
/* Auth_HTTP Example 2 */
require_once "Auth/HTTP.php";

$options = array( 
	'file'=> '/Users/User1/Sites/PEAR/02_Authentication/mypasswd',
	'authType'=>'basic'
	);

$a = new Auth_HTTP("File", $options);
$a->setRealm("Secret zone!");
$a->setCancelText("<h1>Access is forbidden!</h1>");
$a->start();

if ($a->getAuth())
{
	echo "Open, sesame!";
}
else
{
	echo "Not logged in!";
}

?>
