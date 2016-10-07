<?php
/* Writing to a new XML file */

require_once 'Config.php';

$settings =& new Config_Container('section', 'MyConfig');
$settings_WebServices =& $settings->createSection('WebServices');
$settings_WebServices->createDirective('url', 'http://www.example.com/ws');
$settings_WebServices->createDirective('user', 'myuser');
$settings_WebServices->createDirective('password', 'secret');

$config = new Config();
$config->setRoot($settings);

$config->writeConfig('/tmp/newconfig.xml', 'XML');

/* The written file looks like this:
<?xml version="1.0" encoding="ISO-8859-1"?>
<MyConfig>
  <WebServices>
    <url>http://www.example.com/ws</url>
    <user>myuser</user>
    <password>secret</password>
  </WebServices>
</MyConfig>
 
 */

?>
