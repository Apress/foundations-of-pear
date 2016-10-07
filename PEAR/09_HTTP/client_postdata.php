<?php
$data = serialize($_POST);
$fp = fopen('postdata.log','a');
fwrite($fp, $data);
fclose($fp);
?>
