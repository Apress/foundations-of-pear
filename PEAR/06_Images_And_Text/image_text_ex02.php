<?php
require_once 'Image/Text.php';

$options = array (
	'cx' => 200,
	'cy' => 100,
	'canvas' => array (
		'width' => 400,
		'height' => 200
	),
	'width' => 200,
	'height' => 100,
	'color' => '#fffff0',
	'line_spacing' => 1,
	'max_lines' => 100,
	'antialias' => true,
	'font_file' => './Chalkboard.ttf',
	'font_size' => 12,
	'halign' => 'center',
	'valign' => 'center'
);

$text = "That's no moon.  That's a space station!";

$itext = new Image_Text($text, $options);
$itext->init();
$itext->render();
$itext->save('/tmp/file.png');
?>
