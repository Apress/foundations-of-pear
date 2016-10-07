<?php
/*  Logging to syslog */
require_once 'Log.php';

$logger = &Log::factory('syslog', 'LOG_LOCAL0', 'MyLogger');
$mask = Log::MASK(PEAR_LOG_NOTICE) | Log::MASK(PEAR_LOG_ERR);
$logger->setMask($mask);
$logger->notice('My notice message!');
$logger->err('My error message!');
$logger->warning('My warning message!');
$logger->alert('My alert message!');
?>
