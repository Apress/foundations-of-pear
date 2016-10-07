<?php
/* Formatting an XML Document */

require_once 'XML/Beautifier.php';

$beautifier = new XML_Beautifier();

$result = $beautifier->formatFile('samples/ugly.xml', 'samples/pretty.xml');

if (PEAR::isError($result)) {
	printf("An error has occured:  \"%s\"\n", $result->getMessage());
	exit(1);
}

print "All done!\n";

?>
