<?php
/* Convering to Roman Numbers  */

require_once 'Numbers/Roman.php';
/* Getting fancy with turning years into Roman numerals. */
printf("Copyright (c) %s\n", 
	Numbers_Roman::toNumeral(2006, true, false));

?>
