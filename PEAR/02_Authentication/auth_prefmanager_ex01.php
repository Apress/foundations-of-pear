<?php

/* Auth_PrefManager Example 1 */
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
/* Use these just to set some values */
$prefManager->setPref($username, 'nickname', 'Really cool user guy');
$prefManager->setDefaultPref('city', 'Deshler');
?>
<h1>Welcome, 
<?php echo $prefManager->getPref($username, 'nickname');?> 
of <?php echo $prefManager->getPref($username, 'city', true);?></h1>



