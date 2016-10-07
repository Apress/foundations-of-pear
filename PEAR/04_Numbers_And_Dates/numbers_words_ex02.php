<?php
/* Converts currency to words */
require_once 'Numbers/Words.php';

printf("%s\n", Numbers_Words::toCurrency(1.50));
printf("%s\n", Numbers_Words::toCurrency(10.99));
printf("%s\n", Numbers_Words::toCurrency(100.20));
printf("%s\n", Numbers_Words::toCurrency(17999.99));

?>
