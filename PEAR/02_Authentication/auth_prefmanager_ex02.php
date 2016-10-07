<?php
/* Auth_PrefManager Example 2 */
require_once 'Auth/PrefManager.php';

/* SQL that must be run to create the preference table in
 * the database.
 * CREATE TABLE preferences (
   `user_id` varchar( 255 ) NOT NULL default '',
   `pref_id` varchar( 32 ) NOT NULL default '',
   `pref_value` longtext NOT NULL ,
    PRIMARY KEY ( `user_id` , `pref_id` ));
 */
$dsn = 'mysql://web:secret@localhost/auth';
$options = array ('serialize' => true);
$prefManager = new Auth_PrefManager($dsn, $options);
$username = 'myuser1';
?>

<form action="<?= htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
What is your favorite color?&nbsp;&nbsp;
<input type="text" name="favcolor" 
value="<?= htmlspecialchars($_POST['favcolor'])?>"/><br/>
<input type="submit"/>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$prefManager->setPref($username, 'color', $_POST['favcolor']);
	echo "Successfully saved preference: " . 
		$prefManager->getPref($username, 'color');
}
?>
