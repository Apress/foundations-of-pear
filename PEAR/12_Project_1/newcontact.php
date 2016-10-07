<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- $Id: newcontact.php 63 2006-11-08 03:09:04Z nathan $ -->
<head>
<title>Address Book - Create New Contact</title>
</head>
<body>

<?php

require_once 'AddressbookConfig.php';
require_once 'AddressbookUtils.php';
require_once 'Contact.php';
require_once 'HTML/Form.php';
	
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	/* The method form has been posted back to itself, so
	 * we build the contact and call the save() method.
	 */
	
	$contact = new Contact();
	
	$contact->setGivenName($_POST['fname']);
	$contact->setFamilyName($_POST['lname']);
	$contact->setBirthday($_POST['bday']);
	$contact->setEmailAddress($_POST['email']);
	$contact->setTelephoneNumber($_POST['phone_nbr']);
	
	$address = new ContactAddress();
	$address->setAddress1($_POST['address1']);
	$address->setAddress2($_POST['address2']);
	$address->setCity($_POST['city']);
	$address->setState($_POST['state']);
	$address->setPostalCode($_POST['postal_code']);
	$address->setCountry($_POST['country']);
	
	$contact->setAddress($address);
	
	$contact->save();
	
	print "<span style=\"font-weight:bold;color:blue;\">" .
			"Changes saved successfully!</span></p>"; 
	
} else {
	
	print("<h1>New contact</h1>");
	print("<p>Enter the information about the new contact below.</p>");
	
	/* This returns a static array so that it doesn't need to be created each
	 * time it is called.
	 */
	$states = AddressbookUtils::getStatesArray();
	
	$form = new HTML_Form(htmlspecialchars($_SERVER['PHP_SELF']), 'post');
	$form->addText("fname", "First name:");
	$form->addText("lname", "Last name:");
	$form->addText("bday", "Birthday:");
	$form->addText("phone_nbr", "Telephone number:");
	$form->addText("email", "E-mail address:");
	$form->addText("address1", "Address 1:");
	$form->addText("address2", "Address 2:");
	$form->addText("city", "City:");
	$form->addSelect("state", "State/Province:", $states);
	$form->addText("postal_code", "Postal Code:");
	$form->addText("country", "Country:");
	$form->addSubmit("submit", "Save contact");
	$form->addReset("Reset");
	
	$form->display();	
}
?>

<hr/>
<table width="100%">
<tr>
<td><a href="welcome.php">View All Contacts</a></td>
</tr>
</table>
</body>
</html>