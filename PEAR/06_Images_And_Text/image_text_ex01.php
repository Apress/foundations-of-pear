<?php
require_once 'Image/Text.php';

$options = array (
	'cx' => 200,
	'cy' => 100,
	'canvas' => array (
		'width' => 400,
		'height' => 200
	),
	'width' => 380,
	'height' => 180,
	'color' => '#fce88b',
	'line_spacing' => 1,
	'min_font_size' => 5,
	'max_font_size' => 20,
	'max_lines' => 100,
	'antialias' => true,
	// 'font_file' => 'arial.ttf'
	'font_file' => './Chalkboard.ttf'
);

$text = "PHP succeeds an older product, named PHP/FI. PHP/FI was created by Rasmus Lerdorf in 1995, initially as a simple set of Perl scripts for tracking accesses to his online resume. He named this set of scripts 'Personal Home Page Tools'. As more functionality was required, Rasmus wrote a much larger C implementation, which was able to communicate with databases, and enabled users to develop simple dynamic Web applications.";
// $text = "Test";

$itext = new Image_Text($text, $options);
$itext->init();
$itext->autoMeasurize();
$itext->render();
$itext->save('/tmp/file.png');
?>
