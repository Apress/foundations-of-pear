<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Wiki to XHTML Example</title>
</head>
<body>
<p>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<textarea name="source" rows="10" cols="40">
<?php 
if (isset($_POST['source'])) {
    echo $_POST['source']; 
} else {
?>
**This text is bold**
||Table Cell 1||Table Cell 2||
<?php
}
?>
</textarea>
<br />
<input type="submit" value="Transform!">
</form>
</p>
<?php
if (isset($_POST['source']) && strlen($_POST['source']) > 0) {
?>
<hr />
<strong>Here are the XHTML results of your Wiki code:</strong>
<p>
<?php
    // The base Pear class is needed for error reporting
    require_once 'PEAR.php';
    // Require the Text_Wiki package to do the actual transforming
    require_once 'Text/Wiki.php';
	$wiki = & Text_Wiki::factory('Default',array('Strong','Bold','Emphasis','Italic','Underline'));

    $result = $wiki->transform($_POST['source']);

// display the transformed text

    if (PEAR::isError($result)) {
?>
<em>Sorry, there was a problem converting the text:</em>
<pre>
<?php var_dump($result); ?>
</pre>
<?php
    } else {
        echo '<pre>' . htmlentities($result) . '</pre>';
    }
?>
</p>
<?php
}
?>
</body>
</html>
