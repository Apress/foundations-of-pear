<?php
/* Auth_HTTP Example 1 */
require_once "Auth/HTTP.php";

$options = array('dsn'=>'mysql://web:secret@localhost/auth', 
'table'=>'auth', 
'usernamecol'=>'username', 
'passwordcol'=>'password',
'cryptType'=>'MD5');

$a = new Auth_HTTP("DB", $options);
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
