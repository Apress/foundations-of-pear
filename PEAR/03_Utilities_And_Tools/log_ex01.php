<?php
/* Logging to the console. */

require_once 'Log.php';

$logger = &Log::factory('console', '', 'MyLogger');

/* Here are the list of possible logging levels:
 * 
 * PEAR_LOG_EMERG
 * PEAR_LOG_ALERT
 * PEAR_LOG_CRIT
 * PEAR_LOG_ERR
 * PEAR_LOG_WARNING
 * PEAR_LOG_NOTICE
 * PEAR_LOG_INFO
 * PEAR_LOG_DEBUG
 * PEAR_LOG_ALL
 * PEAR_LOG_NONE
 */

/* Now set a mask using MAX and see what happens */

$min = Log::MIN(PEAR_LOG_WARNING);
$logger->setMask($min);
$logger->debug('Debug message');
$logger->info('Info message');
$logger->notice('Notice message');
$logger->warning('Warning message');
$logger->err('Error message');
$logger->crit('Critical message');
$logger->alert('Alert message');
$logger->emerg('Emergency message');

/* Now set a mask using MIN and see what happens */

$max = Log::MAX(PEAR_LOG_NOTICE);
$logger->setMask($max);
$logger->debug('Debug message');
$logger->info('Info message');
$logger->notice('Notice message');
$logger->warning('Warning message');
$logger->err('Error message');
$logger->crit('Critical message');
$logger->alert('Alert message');
$logger->emerg('Emergency message');


?>
