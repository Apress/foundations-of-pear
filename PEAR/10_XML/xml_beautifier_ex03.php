<?php
/* Formatting XML with options */

require_once 'XML/Beautifier.php';

$options = array (
	'indent' => '  ' , /* Only indent each element 2 spaces */
	'normalizeComments' => 'true' , /* Combine comments into one line */
	'maxCommentLine' => 50 , /* Maximum length of a comment line */
	'multiLineTags' => false , /* Tags are not muli-line */
	);

$beautifier = new XML_Beautifier($options);
	
$result = $beautifier->formatFile('samples/ugly.xml', 'samples/pretty.xml');

if (PEAR::isError($result)) {
	printf("An error has occured:  \"%s\"\n", $result->getMessage());
	exit(1);
}

print "All done!\n";

?>
