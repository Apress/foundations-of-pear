<?php
/**
 * TODO:  The description of the Contact class goes here.
 */
 
require_once 'ContactAddress.php';
require_once 'Contact_Vcard_Parse.php';
require_once 'Contact_Vcard_Build.php';
require_once 'File.php';

/**
 * The Contact holds information about a person in our
 * addressbook.  It has methods that hide the saving and 
 * retreiving details from the web pages so it can be later
 * swapped out with a different method, if need be, without
 * causing changes in the pages.
 * 
 */
class Contact 
{
	/**
	 * The given (first) name of the contact
	 * @var	string
	 * @access 	private
	 */
	var $_givenName = '';
	
	/**
	 * The family (last) name of the contact
	 * @var	string
	 * @access	private
	 */
	var $_familyName = '';
	
	/**
	 * The birthday of the contact
	 * @var	string
	 * @access	private
	 */
	var $_birthday = '';
	
	/**
	 * The address of the contact
	 * @var	ContactAddress
	 * @access	private
	 */
	var $_address = null;
	
	/**
	 * The e-mail address of the contact
	 * @var	string
	 * @access	private
	 */
	var $_emailAddress = '';
	
	/**
	 * The telephone number for the contact
	 * @var	string
	 * @access	private
	 */
	var $_telephoneNumber = '';
	
	/**
	 * A note that is associated with the contact.
	 * @var	string
	 * @access	private
	 */
	var $_note = '';	
	
	/**
	 * Returns the given (first) name of the contact.
	 * @return	string	Given name of conact
	 */
	public function getGivenName() 
	{
		return $this->_givenName;
	}
	
	/**
	 * Sets the given (first) name of the contact.
	 * @param	string	$given	Given (first) name of contact.
	 */
	public function setGivenName($given) 
	{
		$this->_givenName = $given;
	}
	
	/**
	 * Returns the family (last) name of the contact.
	 * @return	string	First name of contact
	 */
	public function getFamilyName() 
	{
		return $this->_familyName;
	}
	
	/**
	 * Sets the family (last) name of the contact.
	 * @return	string	$familyName	Family name of contact
	 */
	public function setFamilyName($familyName) 
	{
		$this->_familyName = $familyName;
	}
	
	/**
	 * Returns the contact's birthday.
	 * @return	string	Birthday of contact.
	 */
	public function getBirthday() 
	{
		return $this->_birthday;
	}
	
	/**
	 * Sets the contact's birthday
	 * @param	string	$birthday	Contact's birthday
	 */
	public function setBirthday($birthday) 
	{
		$this->_birthday = $birthday;
	}
	
	/**
	 * Returns the contact's address
	 * @return	ContactAddress	Address of contact.
	 */
	public function getAddress() 
	{
		return $this->_address;
	}
	
	/**
	 * Sets the contact's address
	 * @param	ContactAddress	$address	Address of contact.
	 */
	public function setAddress($address) 
	{
		$this->_address = $address;
	}
	
	/**
	 * Returns the contact's e-mail address
	 * @return	string	E-mail address of contact.
	 */
	public function getEmailAddress() 
	{
		return $this->_emailAddress;
	}
	
	/**
	 * Sets the contact's e-mail address.
	 * @param	string	$email	E-mail address of contact.
	 */
	public function setEmailAddress($email) 
	{
		$this->_emailAddress = $email;
	}
	
	/**
	 * Returns the telephone number of the contact
	 * @return	string	Telephone number.
	 */
	public function getTelephoneNumber() 
	{
		return $this->_telephoneNumber;
	}
	
	/**
	 * Sets the telephone number of the contact
	 * @param	string	$phoneNumber	Telephone number
	 */
	public function setTelephoneNumber($phoneNumber) 
	{
		$this->_telephoneNumber = $phoneNumber;
	}
	
	/**
	 * Returns a note associated with the contact
	 * @return	string	Note
	 */
	public function getNote() 
	{
		return $this->_note;
	}
	
	/**
	 * Sets a note associated with the contact
	 * @param	string	$note	Note text
	 */
	public function setNote($note) 
	{
		$this->_note = $note;
	}
	
	/**
	 * Saves the contact using the persistence method.
	 */
	public function save()
	{
		/* The method form has been posted back to itself, so
		 * build the contact card, save it, and tell the user.
		 */
		$card = new Contact_Vcard_Build();
	
		try
		{
			$card->setFormattedName(
				AddressbookUtils::buildFormattedName(
					$this->_givenName, 
					$this->_familyName)
				);
			$card->setName($this->_familyName, $this->_givenName, '', '', '');
			$card->setBirthday($this->_birthday);
			$card->addEmail($this->_emailAddress);
			$card->addParam('TYPE', 'HOME');
			
			if (isset($this->_address))
			{
				$card->addAddress(
					$this->_address->_address1, 
					'', /* An extended address that we won't use in this application */ 
					$this->_address->_address2, 
					$this->_address->_city, 
					$this->_address->_state, 
					$this->_address->_postalCode, 
					$this->_address->_country);				
			}

			$card->addParam('TYPE', 'HOME');
			
			$card->addTelephone($this->_telephoneNumber);
			
			$card->addParam('TYPE', 'HOME');
			
			$text = $card->fetch();
			
			/* TODO:  See if this already exists */
			$config = AddressbookConfig::singleton();
			$fileName = $config->getDataPath() . "/" . AddressbookUtils::buildVcardName($this->_givenName, $this->_familyName);
			File::write($fileName, $text);			
		}
		catch (Exception $e)
		{
			printf("An error occurred while trying to save contact:  %s", $e->getMessage());
		}
	}
	
	/**
	 * Loads the contact associated with the given ID using the persistence
	 * method
	 * @param	string	$id	An identifier that uniquely identitifies the
	 * 						Contact.
	 *  
	 * @return	Contact	New Contact object that matches the given ID
	 */
	public static function getContact($id) 
	{
		$config = AddressbookConfig::singleton();
		$dataDir = $config->getDataPath();
	
		$contact = new Contact();
		$fileName = $dataDir . '/' . $id;
		if (file_exists($fileName)) {
			
			try {
				
				$card = new Contact_Vcard_Parse();
				$content = $card->fromFile($fileName);
				
				$contact->setGivenName($content[0]["N"][0]["value"][1][0]);
				$contact->setFamilyName($content[0]["N"][0]["value"][0][0]);
				$contact->setEmailAddress($content[0]["EMAIL"][0]["value"][0][0]);
				$contact->setTelephoneNumber($content[0]["TEL"][0]["value"][0][0]);
				$contact->setBirthday($content[0]["BDAY"][0]["value"][0][0]);
				
				$address = new ContactAddress();
				$address->setAddress1($content[0]["ADR"][0]["value"][0][0]);
				$address->setAddress2($content[0]["ADR"][0]["value"][2][0]);
				$address->setCity($content[0]["ADR"][0]["value"][3][0]);
				$address->setState($content[0]["ADR"][0]["value"][4][0]);
				$address->setPostalCode($content[0]["ADR"][0]["value"][5][0]);
				$address->setCountry($content[0]["ADR"][0]["value"][6][0]);
				
				$contact->setAddress($address);
				
				return $contact;
				
			} catch (exception $e) {
				/* Log the error message out to the log. */
				$logger->err("An error occurred while attempting to get the contact data: {$e->getMessage()}");
			}
			
		} else {
			/* The file does not exist... */
			printError("The specified contact cannot be found!");
		}
	
	}
}

?>
