<?php
require_once('Mail.php');
$recipients = array('To' => 'allan@atplay.biz',
                    'Cc' => 'allan_kent@gmail.com');
$headers['From']    = 'allan@mediafrenzy.co.za';
$headers['To']      = 'allan@atplay.biz';
$headers['Subject'] = 'PEAR Mail send using SMTP!';

$body = 'Here is a plain text message that we are sending with the PEAR Mail class!';
$params['host'] = 'localhost';
$params['port'] = 2525;
$mail_object =& Mail::factory('smtp', $params);
$mail_object->send($recipients, $headers, $body);
?>
