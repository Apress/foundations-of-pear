 <?php

require_once 'Config.php';

/**
 * AddressbookConfig is a singleton that allows the address book
 * site to get configuration from an object that loads the configuration
 * only once.
 */
class AddressbookConfig
{
	
	private static $instance;
	/**
	 * An array that holds the settings for the configuration
	 * @var array
	 * @access private
	 */
	var $settings;
	
	/**
	 * Creates an instance of the AddressbookConfig class.
	 * @access private
	 */
	private function __construct()
	{
		/* Get the config from here */
		$config = new Config();
		$configRoot = $config->parseConfig('C:\\winnt\\profiles\\user1\\workspace\\PEAR\\project1\\site.ini', 'IniFile');
		if (isset($configRoot)) {
			$this->settings = $configRoot->toArray();			
		} else {
			throw Exception("Unable to load configuration.");
		}
	}
	
	/**
	 * Returns the instance of the singleton.
	 * @return	AddressbookConifg	Singleton instance of the class.
	 */
	public static function singleton()
	{
		if (!isset(self::$instance)) {
			$c = __CLASS__;
			self::$instance = new $c;
		}
		
		return self::$instance;
	}

	/**
	 * Returns the path where the data is stored.
	 * @return	string	Path on filesystem where data is stored
	 */	
	function getDataPath()
	{
		return $this->settings['root']['Directories']['data_dir'];
	}
	
	/**
	 * Returns the name of the file used for logging
	 * @return string	Name of log file.
	 */
	function getLogFilename()
	{
		return $this->settings['root']['Logging']['log_file'];
	}
	
	/**
	 * Returns the level of logging for the application
	 * @return	string	Logging level.
	 */
	function getLogLevel()
	{
		return $this->settings['root']['Logging']['log_level'];
	}
}
?>
