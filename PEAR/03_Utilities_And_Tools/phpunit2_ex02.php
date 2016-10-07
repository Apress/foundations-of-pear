<?php
// Call ConfigTest::main() if this source file is executed directly.
if (!defined("PHPUnit2_MAIN_METHOD")) {
	define("PHPUnit2_MAIN_METHOD", "ConfigTest::main");
}

require_once "PHPUnit2/Framework/TestCase.php";
require_once "PHPUnit2/Framework/TestSuite.php";
require_once "Config.php";

class ConfigTest extends PHPUnit2_Framework_TestCase 
{

	public static function main() 
	{
		require_once "PHPUnit2/TextUI/TestRunner.php";

		$suite  = new PHPUnit2_Framework_TestSuite("ConfigTest");
		$result = PHPUnit2_TextUI_TestRunner::run($suite);
	}

	public function testConfig() 
	{	
		/* Take a look at the INI configuration example in the Config
		 * chapter for more about using Config.
		 */
		$config = new Config();
		$configRoot = $config->parseConfig('/tmp/myconfig.ini', 'IniFile');
		$settings = $configRoot->toArray();
		/* INI file looks like this:
			[MyConfig]
			value=Hello
			[MyDatabase]
			dsn=mysql://user:password@servername/dbname
		 */
		$this->assertContains(array('value'=>'Hello'), $settings['root'], 
			'Expected \'value\' in settings.');
	}
}

if (PHPUnit2_MAIN_METHOD == "ConfigTest::main") {
	ConfigTest::main();
}
?>