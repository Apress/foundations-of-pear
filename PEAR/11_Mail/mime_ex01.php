<?php
require_once('Mail.php');
require_once('Mail/Mime.php');
$textMessage = 'PEAR makes sending e-mail a pleasure. If your e-mail could view HTML, this e-mail would be a lot more interesting!';

$htmlMessage = '<html><body><p><img src="pear.gif" width="113" height="55" /></p><p><strong>PEAR</strong> makes sending e-mail a pleasure.</p></body></html>';

$crlf = "\n";
$mimeMail = new Mail_mime($crlf);

$mimeMail->setFrom('allan@lodestone.co.za');
$mimeMail->setSubject('PEAR Mail... MIME Style!');
$mimeMail->addHTMLImage('pear.gif','image/gif');
$mimeMail->setTXTBody($textMessage);
$mimeMail->setHTMLBody($htmlMessage);
$params['host'] = 'localhost';
$params['port'] = 2525;

$mail =& Mail::factory('smtp', $params);
$body = $mimeMail->get();
$headers = $mimeMail->headers();

$mail->send('allan_kent@gmail.com', $headers, $body);
?>
