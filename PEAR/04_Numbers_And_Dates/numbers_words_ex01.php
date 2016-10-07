<?php
/* Converting numbers to words */
require_once 'Numbers/Words.php';

/* Print a bunch of different numbers out to see what they
 * say...
 */
printf("%s\n", Numbers_Words::toWords(1));
printf("%s\n", Numbers_Words::toWords(10));
printf("%s\n", Numbers_Words::toWords(100));
printf("%s\n", Numbers_Words::toWords(1000));

printf("%s\n", Numbers_Words::toWords(1002));
printf("%s\n", Numbers_Words::toWords(1357));

?>
