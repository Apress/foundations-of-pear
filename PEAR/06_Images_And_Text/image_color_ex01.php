<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Color Example</title>
</head>
<body>
<?php
$colorList = array('aliceblue', 'antiquewhite', 'aqua', 'aquamarine', 'azure', 'beige', 'bisque', 'black', 'blanchedalmond', 'blue', 'blueviolet', 'brown', 'burlywood', 'cadetblue', 'chartreuse', 'chocolate', 'coral', 'cornflowerblue', 'cornsilk', 'crimson', 'cyan', 'darkblue', 'darkcyan', 'darkgoldenrod', 'darkgray', 'darkgreen', 'darkkhaki', 'darkmagenta', 'darkolivegreen', 'darkorange', 'darkorchid', 'darkred', 'darksalmon', 'darkseagreen', 'darkslateblue', 'darkslategray', 'darkturquoise', 'darkviolet', 'deeppink', 'deepskyblue', 'dimgray', 'dodgerblue', 'firebrick', 'floralwhite', 'forestgreen', 'fuchsia', 'gainsboro', 'ghostwhite', 'gold', 'goldenrod', 'gray', 'green', 'greenyellow', 'honeydew', 'hotpink', 'indianred', 'indigo', 'ivory', 'khaki', 'lavender', 'lavenderblush', 'lawngreen', 'lemonchiffon', 'lightblue', 'lightcoral', 'lightcyan', 'lightgoldenrodyellow', 'lightgreen', 'lightgrey', 'lightpink', 'lightsalmon', 'lightseagreen', 'lightskyblue', 'lightslategray', 'lightsteelblue', 'lightyellow', 'lime', 'limegreen', 'linen', 'magenta', 'maroon', 'mediumaquamarine', 'mediumblue', 'mediumorchid', 'mediumpurple', 'mediumseagreen', 'mediumslateblue', 'mediumspringgreen', 'mediumturquoise', 'mediumvioletred', 'midnightblue', 'mintcream', 'mistyrose', 'moccasin', 'navajowhite', 'navy', 'oldlace', 'olive', 'olivedrab', 'orange', 'orangered', 'orchid', 'palegoldenrod', 'palegreen', 'paleturquoise', 'palevioletred', 'papayawhip', 'peachpuff', 'peru', 'pink', 'plum', 'powderblue', 'purple', 'red', 'rosybrown', 'royalblue', 'saddlebrown', 'salmon', 'sandybrown', 'seagreen', 'seashell', 'sienna', 'silver', 'skyblue', 'slateblue', 'slategray', 'snow', 'springgreen', 'steelblue', 'tan', 'teal', 'thistle', 'tomato', 'turquoise', 'violet', 'wheat', 'white', 'whitesmoke', 'yellow', 'yellowgreen');

$cString = '';

foreach ($colorList as $color) {
    $cString .= "<option value='$color'>$color</option>\n";
}  
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<p>Color start: <select name="cStart"><?php echo $cString; ?></select></p>
<p>Color end: <select name="cEnd"><?php echo $cString; ?></select></p>
<p>Steps: <select name="cSteps">
<?php
for ($i = 1; $i <= 10; $i++) {
    echo "<option value='$i'>$i</option>\n";
}
?>
</select></p>
<p><input type="submit" name="submit" value="Build Steps"></p>
</form>
<?php
if (isset($_POST['submit'])) {
    require_once("Image/Color.php");
    $c = new Image_Color;
    $hexStart = $c->rgb2hex($c->namedColor2RGB($_POST['cStart']));
    $hexEnd = $c->rgb2hex($c->namedColor2RGB($_POST['cEnd']));
    $c->setColors($hexStart, $hexEnd);
    
    $nRange = $c->getRange($_POST['cSteps']);

    $c->setWebSafe(true);
    
    $wRange = $c->getRange($_POST['cSteps']);
?>
<table border="0">
<tr>
    <th></th>
    <th>Standard</th>
    <th>Websafe</th>
</tr>
<tr>
    <td>Start Color</td>
    <td bgcolor="#<?php echo $hexStart; ?>">#<?php echo $hexStart; ?></td>
    <td bgcolor="#<?php echo $hexStart; ?>">#<?php echo $hexStart; ?></td>
</tr>
<?php
for ($i = 0; $i < count($nRange); $i++) {
?>
<tr>
    <td></td>
    <td bgcolor="#<?php echo $nRange[$i]; ?>">#<?php echo $nRange[$i]; ?></td>
    <td bgcolor="#<?php echo $wRange[$i]; ?>">#<?php echo $wRange[$i]; ?></td>
</tr>
<?php
}
?>
<tr>
    <td>End Color</td>
    <td bgcolor="#<?php echo $hexEnd; ?>">#<?php echo $hexEnd; ?></td>
    <td bgcolor="#<?php echo $hexEnd; ?>">#<?php echo $hexEnd; ?></td>
</tr>
</table>
<?php
}
?>
</body>
</html>

