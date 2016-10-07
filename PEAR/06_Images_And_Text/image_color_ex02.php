<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Displaying the RGB value of a color</title>
<style type="text/css">
table.swatch {width:200px;border-style:solid;border-width:1px}
</style>
</head>
<body>
<?php
$colorList = array('aliceblue', 'antiquewhite', 'aqua', 'aquamarine', 'azure', 'beige', 'bisque', 'black', 'blanchedalmond', 'blue', 'blueviolet', 'brown', 'burlywood', 'cadetblue', 'chartreuse', 'chocolate', 'coral', 'cornflowerblue', 'cornsilk', 'crimson', 'cyan', 'darkblue', 'darkcyan', 'darkgoldenrod', 'darkgray', 'darkgreen', 'darkkhaki', 'darkmagenta', 'darkolivegreen', 'darkorange', 'darkorchid', 'darkred', 'darksalmon', 'darkseagreen', 'darkslateblue', 'darkslategray', 'darkturquoise', 'darkviolet', 'deeppink', 'deepskyblue', 'dimgray', 'dodgerblue', 'firebrick', 'floralwhite', 'forestgreen', 'fuchsia', 'gainsboro', 'ghostwhite', 'gold', 'goldenrod', 'gray', 'green', 'greenyellow', 'honeydew', 'hotpink', 'indianred', 'indigo', 'ivory', 'khaki', 'lavender', 'lavenderblush', 'lawngreen', 'lemonchiffon', 'lightblue', 'lightcoral', 'lightcyan', 'lightgoldenrodyellow', 'lightgreen', 'lightgrey', 'lightpink', 'lightsalmon', 'lightseagreen', 'lightskyblue', 'lightslategray', 'lightsteelblue', 'lightyellow', 'lime', 'limegreen', 'linen', 'magenta', 'maroon', 'mediumaquamarine', 'mediumblue', 'mediumorchid', 'mediumpurple', 'mediumseagreen', 'mediumslateblue', 'mediumspringgreen', 'mediumturquoise', 'mediumvioletred', 'midnightblue', 'mintcream', 'mistyrose', 'moccasin', 'navajowhite', 'navy', 'oldlace', 'olive', 'olivedrab', 'orange', 'orangered', 'orchid', 'palegoldenrod', 'palegreen', 'paleturquoise', 'palevioletred', 'papayawhip', 'peachpuff', 'peru', 'pink', 'plum', 'powderblue', 'purple', 'red', 'rosybrown', 'royalblue', 'saddlebrown', 'salmon', 'sandybrown', 'seagreen', 'seashell', 'sienna', 'silver', 'skyblue', 'slateblue', 'slategray', 'snow', 'springgreen', 'steelblue', 'tan', 'teal', 'thistle', 'tomato', 'turquoise', 'violet', 'wheat', 'white', 'whitesmoke', 'yellow', 'yellowgreen');

$cString = '';

foreach ($colorList as $color) {
	if ((isset($_POST['submit'])) && 
		(isset($_POST['color1'])) && 
		($_POST['color1'] == $color)) {
		$cString .= "<option value='$color' selected>$color</option>\n";		
	} else {
	    $cString .= "<option value='$color'>$color</option>\n";	
	}
}
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<p>Select a color:  <select name="color1"><?php echo $cString; ?></select></p>
<p><input type="submit" name="submit" value="Show RGB values"></p>
</form>
<?php
if (isset($_POST['submit'])) {
    require_once("Image/Color.php");
    $c = new Image_Color;
    $rgbArray = $c->color2RGB($_POST['color1']);
    
    print sprintf("<p><b>Color is:  </b> rgb(%s, %s, %s)</p>", 
    	$rgbArray[0], 
    	$rgbArray[1], 
    	$rgbArray[2]);
    print sprintf("<table class=\"swatch\"><tr><td style=\"background-color:rgb(%s,%s,%s)\">", 
    	$rgbArray[0], 
    	$rgbArray[1], 
    	$rgbArray[2]);
    print "&nbsp;</td></tr></table>";

}
?>
</body>
</html>
