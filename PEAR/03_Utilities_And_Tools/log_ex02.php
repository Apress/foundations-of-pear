<?php
/* Logging messages to a file. */

require_once 'Log.php';

$logger = &Log::factory('file', '/tmp/myfile.log', 'MyLogger');

$mask = Log::MAX(PEAR_LOG_WARNING);

$logger->setMask($mask);

$logger->debug('This is a debug message.');
$logger->info('This is an info message.');
$logger->warning('This is a warning message.');
$logger->err('This is an error message.');	

?>
