<?php
/* Convert Roman Numerals to numbers */

require_once 'Numbers/Roman.php';

/* What was that Super Bowl, anyway? */

printf("Super Bowl XXXIV is number %s\n",
	Numbers_Roman::toNumber('XXXIV'));

?>
