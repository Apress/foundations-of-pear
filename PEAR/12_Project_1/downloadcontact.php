<?php

	require_once 'AddressbookConfig.php';
	require_once 'HTTP/Download.php';
	require_once 'Log.php';
		
	$config = AddressbookConfig::singleton();
	$dataDir = $config->getDataPath();

	$logger = &Log::factory('file', $config->getLogFilename(), 'AddressBook');
	$mask = Log::MIN($logger->stringToPriority($config->getLogLevel()));
	$logger->setMask($mask);

	/* Look for the name of the card on the query string... */
	$cardName = basename($_GET["contact"]);
	/* Check the name of the card for any funny business */
	if (preg_match("/(\.\.|\/)/", $cardName)) {
		
		$logger->err(sprintf("Invalid name \"%s\"", $cardName));
		
	} else {
		
		/* Now load the card up and display the contents to
		 * the window.  Note:  $dataDir here has to be a directory
		 * that your web server has access to read, otherwise this
		 * won't work!
		 */
		$fileName = $dataDir . '\\' .$cardName;
		
		$logger->info(sprintf("Trying to send file \"%s\"", $fileName));
		
		if (file_exists($fileName)) {
			
			$file = &new HTTP_Download();
			$result = $file->setFile($fileName, true);
			if (PEAR::isError($result)) {
				$logger->err(sprintf("An error occurred:  %s", $result->getMessage()));
			}
			$file->setContentDisposition(HTTP_DOWNLOAD_ATTACHMENT, $cardName);
			$file->guessContentType();
			$sendResult = $file->send();
			
			if (PEAR::isError($sendResult)) {
				$logger->err(sprintf("An error occurred while sending:  %s", $sendResult->getMessage()));
			} else {
				$logger->info(sprintf("Finished sending file \"%s\"", $fileName));	
			}
			
		} else {
			/* The file does not exist... */
			$logger->err("The specified contact cannot be found!");
		}
	}
?>