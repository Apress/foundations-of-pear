<?php
/* Reading an INI configuration file. */

/* INI file looks like this:
[MyConfig]
value=Hello
[MyDatabase]
dsn=mysql://user:password@servername/dbname
 */

require_once 'Config.php';

$config = new Config();

$configRoot = $config->parseConfig('/tmp/myconfig.ini', 'IniFile');
$settings = $configRoot->toArray();

/* 'root' is always the root configuration.  The 'MyConfig'
 * element is the section heading.
 */
echo $settings['root']['MyConfig']['value'];
echo $settings['root']['MyDatabase']['dsn'];

?>
