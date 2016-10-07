<?php
require_once 'HTML/Javascript.php';
$javascript = new HTML_Javascript();
$javascript->setOutputMode(HTML_JAVASCRIPT_OUTPUT_RETURN);
$js = $javascript->startScript();
$js .= $javascript->write('<html><body>Welcome ');
$js .= $javascript->alert('Please tell us who you are...');
$js .= $javascript->prompt('What is your name?','clientname');
$js .= $javascript->write('clientname',true);
$js .= $javascript->write('</body></html>');
$js .= $javascript->endScript();
echo $js;
?>
