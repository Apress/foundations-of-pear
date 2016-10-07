<?php
/* Formatting an XML string */

require_once 'XML/Beautifier.php';

$xml = "<root><elements><element1/></elements></root>";

$beautifier = new XML_Beautifier();

$result = $beautifier->formatString($xml);

print($result);

?>
