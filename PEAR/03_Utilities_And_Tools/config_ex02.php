<?php
/* Reading an XML configuration file */

/* XML file looks like this:
<?xml version="1.0"?>
<database>
   <dsn>mysql://user:password@servername/dbname</dsn>
</database>
 */

require_once 'Config.php';

$config = new Config();
/* This part looks the same as the INI example,
 * with the difference of the filename and 'XML'
 * as the container type.
 */
$configRoot = $config->parseConfig('/tmp/myconfig.xml', 'XML');
$settings = $configRoot->toArray();

echo $settings['root']['database']['dsn'];

?>
