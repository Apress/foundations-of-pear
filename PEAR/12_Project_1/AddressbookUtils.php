<?php

require_once 'Auth.php';

/**
  * AddressbookUtils contains a few utility functions used in the address
  * book application
  */
class AddressbookUtils
{
	
	/**
	 * An array containing all of the states that will be displayed
	 * in the list controls on the site.
	 * @access private
	 */
	private static $states = array (
		'AK' => 'AK', 'AL' => 'AL', 'AR' => 'AR', 'AZ' => 'AZ', 'CA' => 'CA',
		'CO' => 'CO', 'CT' => 'CT', 'DC' => 'DC', 'DE' => 'DE', 'FL' => 'FL',
		'GA' => 'GA', 'IA' => 'IA', 'ID' => 'ID', 'IL' => 'IL', 'IN' => 'IN',
		'KS' => 'KS', 'KY' => 'KY', 'LA' => 'LA', 'MA' => 'MA', 'MD' => 'MD',
		'ME' => 'ME', 'MI' => 'MI', 'MN' => 'MN', 'MO' => 'MO', 'MS' => 'MS',
		'MT' => 'MT', 'NC' => 'NC', 'ND' => 'ND', 'NE' => 'NE', 'NH' => 'NH',
		'NJ' => 'NJ', 'NM' => 'NM', 'NV' => 'NV', 'NY' => 'NY', 'OH' => 'OH',
		'OK' => 'OK', 'OR' => 'OR', 'PA' => 'PA', 'RI' => 'RI', 'SC' => 'SC',
		'SD' => 'SD', 'TN' => 'TN', 'TX' => 'TX', 'UT' => 'UT', 'VA' => 'VA',
		'VT' => 'VT', 'WA' => 'WA', 'WI' => 'WI', 'WV' => 'WV', 'WY' => 'WY'
		);
	
	/**
	 * Returns a formatted name for the contact 
	 * @param	string	$given	The given (first) name of the contact.
	 * @param	string	$family	The family (last) name of the contact.
	 */
	public function buildFormattedName($given, $family)
	{
		return sprintf("%s %s", $given, $family);
	}
	
	/**
	 * Returns the name of the vCard based on the name attributes
	 * of the contact.  This will help ensure that the file is
	 * named consistently and that each name can be forced to be 
	 * unique.
	 * @param	string	$given	The given (first) name of the contact.
	 * @param	string	$family	The family (last) name of the contact. 
	 */
	public function buildVcardName($given, $family)
	{
		return sprintf("%s_%s.vcf", $family, $given);
	}
	
	/**
	 * Returns the array containing the US states for the select
	 * boxes in the application.
	 * @return	array	An array containing the 50 US states.
	 */
	public static function getStatesArray()
	{
		return self::$states;
	}
	
	/**
	 * Returns an Auth object that can be used for the site's
	 * authentication
	 * @return	Auth	An Auth object.
	 */
	public static function getAuth() {
        // TODO:  Make sure to change this to the proper directory!
        $passwdFile = "C:\\Application\\mypasswd";
		$a = new Auth("file", $passwdFile, 'showLogin');
		return $a;
	}
	
	public static function printLoginMessage()
	{
		print "<span class=\"error\">Your session has expired or " .
				"you are not logged in. &nbsp;Click " .
				"<a href=\"login.php\">here</a> to log in.</span>";
	}
}

?>
