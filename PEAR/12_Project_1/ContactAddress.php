<?php

/**
 * ContactAddress is used by the Contact class to store the 
 * address information.  The largest benefit of breaking the
 * address part out to a different class is the ability to
 * add more than one in the future with a lot less effort.
 */
class ContactAddress {
	
	/**
	 * Type of address
	 * @var string
	 * @access private
	 */
	var $_addressType;
	/**
	 * First line of the address record
	 * @var string
	 * @access private
	 */
	var $_address1;
	/**
	 * Second line of the address record
	 * @var string
	 * @access private
	 */
	var $_address2;
	/**
	 * Name of the city in the address
	 * @var string
	 * @access private
	 */
	var $_city;
	/**
	 * Name of the state/province in the address
	 * @var string
	 * @access private
	 */
	var $_state;
	/**
	 * Postal code
	 * @var string
	 * @access private
	 */
	var $_postalCode;
	/**
	 * Name of the country in the address
	 * @var string
	 * @access private
	 */
	var $_country;
	
	/**
	 * Returns the address type.  This is for future use,
	 * enabling more than one address to be stored for
	 * each contact (work, home, etc.)
	 * @return	string	Type of adddress.  Possible values could be 'home', 'work'
	 */
	public function getAddressType()
	{
		return $this->_addressType;
	}
	
	/**
	 * Sets the address type
	 * @param	string	$addressType	Type of address
	 */
	public function setAddressType($addressType)
	{
		$this->_addressType();
	}
	
	/**
	 * Returns the first line of the address
	 * @return	string	First line of address
	 */
	public function getAddress1() {
		return $this->_address1;
	}
	
	/**
	 * Sets the first line of the address
	 * @param	string	$address1	First line of address
	 */
	public function setAddress1($address1) {
		$this->_address1 = $address1;
	}
	
	/**
	 * Returns the second line of the address
	 * @return	string	Second line
	 */
	public function getAddress2() {
		return $this->_address2;
	}
	
	/**
	 * Sets the second line of the address
	 * @param	string	$address2	Second line of address
	 */
	public function setAddress2($address2) {
		$this->_address2 = $address2;
	}
	
	/**
	 * Returns the city
	 * @return	string	Name of the city
	 */
	public function getCity() {
		return $this->_city;
	}
	
	/**
	 * Sets the address city
	 * @param	string	$city	City name
	 */
	public function setCity($city) {
		$this->_city = $city;
	}
	
	/**
	 * Returns the state (or province) of the address
	 * @return	string	Name of the city or province
	 */
	public function getState() {
		return $this->_state;
	}
	
	/**
	 * Sets the state (or province part of the address)
	 * @param	string	$state	Name of state or province
	 */
	public function setState($state) {
		$this->_state = $state;
	}
	
	/**
	 * Returns the postal code 
	 * @return	string	Postal code
	 */
	public function getPostalCode() {
		return $this->_postalCode;
	}
	
	/**
	 * Sets the postal code
	 * @param	string	$postalCode	Postal code
	 */
	public function setPostalCode($postalCode) {
		$this->_postalCode = $postalCode;
	}
	
	/**
	 * Returns the name of the country.
	 * @return	string	Name of the country in the address
	 */
	public function getCountry() {
		return $this->_country;
	}
	
	/**
	 * Sets the name of the country.
	 * @param	string	$country	Name of the country in the address
	 */
	public function setCountry($country) {
		$this->_country = $country;
	}
}

?>
