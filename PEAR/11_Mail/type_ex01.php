<?php
require 'MIME/Type.php';

$mimetype = 'video/3gpp';
$mimeobject = new MIME_Type($mimetype);
object(MIME_Type)#1 (4) {
  ["media"]=>
  string(5) "video"
  ["subType"]=>
  string(4) "3gpp"
  ["parameters"]=>
  array(0) {
  }
  ["validMediaTypes"]=>
  array(7) {
    [0]=>
    string(4) "text"
    [1]=>
    string(5) "image"
    [2]=>
    string(5) "audio"
    [3]=>
    string(5) "video"
    [4]=>
    string(11) "application"
    [5]=>
    string(9) "multipart"
    [6]=>
    string(7) "message"
  }
}
if (in_array($mimeobject->media,$mimeobject->validMediaTypes)) {
             echo "media type is valid";
} else {
             echo "media type is not valid";
}
?>
