<?php
require_once('DB.php');
require_once('Auth.php');
require_once('Auth/PrefManager.php');
require_once('Config.php');
$config = new Config();
$root = & $config->parseConfig('c:/xampp/forum.config.xml', 'xml');
$settings = $root->toArray();
$dsn = $settings['root']['conf']['DB']['type'] . '://' 
         . $settings['root']['conf']['DB']['user'] . ':' 
         . $settings['root']['conf']['DB']['pass'] . '@' 
         . $settings['root']['conf']['DB']['host']  . '/' 
         . $settings['root']['conf']['DB']['database'];
$DBoptions = array(
    'debug'       => 2,
    'portability' => DB_PORTABILITY_ALL,
);
$db = & DB::connect($dsn, $DBoptions);
if (PEAR::isError($db)) {
    die($db->getMessage());
}
$Authoptions = array(
    'dsn' => $dsn,
    'table' => 'member',
    'usernamecol' => 'member_id',
    'passwordcol' => 'member_password'
);
$auth = new Auth('DB', $Authoptions);
$Prefoptions = array('serialize' => true);
$prefmanager = new Auth_PrefManager($dsn, $Prefoptions);
?>
