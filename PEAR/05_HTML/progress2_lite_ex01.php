<html>
<body>
<?php
require_once 'HTML/Progress2_Lite.php';

function imageConvert()
{
        sleep(1);
}
$options = array(
        'position'      =>      'absolute',
        'left'  =>      100,
        'top'   =>      50,
        'width' =>      300,
        'height'        =>      30,
        'padding'       =>      5,
        'min'   =>      0,
        'max'   =>      10
);
$progress = new HTML_Progress2_Lite($options);
$progress->addLabel('text', 'text1', 'Converting images...');
$progress->addLabel('percent','step1');
$progress->setDirection('right');
$progress->setBarAttributes(array('background-color' => '#ff0000', 'color' => '#00ff00'));
$progress->display();
for($i=1; $i<=10; $i++) {
    $progress->moveStep($i);
    imageConvert();
}
$progress->hide();
?>
</body>
</html>
