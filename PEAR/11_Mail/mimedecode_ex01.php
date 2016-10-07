<?php
function extractBits($piece) {
        foreach($piece->parts as $part) {
                if ($part->ctype_primary == 'multipart') {
                        extractBits($part);
                } elseif ($part->ctype_primary == 'image') {
                        echo "<p>------- Found Image: " ~CCC
                        . $part->disposition . "------<br />";
                        $filename = $part->ctype_parameters['filename'];
                        if ($filename == '') $filename = ~CCC
                        $part->d_parameters['filename'];
                        if ($filename != '') {
                                $fp = fopen('export_' . $filename, 'w');
                                fwrite($fp, $part->body);
                                fclose($fp);
                                echo "Writing out export_" .$filename;
                        }
                        echo "</p>";
                }
        }
}
require_once 'Mail/mimeDecode.php';

$params['include_bodies'] = true;
$params['decode_bodies']  = true;
$params['decode_headers'] = true;
$mime_message = file_get_contents('mime_email.src');
$mimeDecode = new Mail_mimeDecode($mime_message);
$mimeStructure = $mimeDecode->decode($params);
extractBits($mimeStructure)
?>
