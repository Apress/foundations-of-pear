<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Password Example</title>
<style>
    li {
        font-style: italic;
    }
</style>
</head>
<body>
<?php
// require the Text_Password package to be included in the page
require_once "Text/Password.php";
?>
<p>
<strong>Here is a pronounceable password, defaulting to 10 characters:</strong>
<br />
<em><?php echo Text_Password::create(); ?></em>
</p>
<p>
<strong>Here are 5 unpronounceable passwords, with a 
  length of 15 characters each:</strong>
<br />
<ul>
<?php
    $passwords = Text_Password::createMultiple(5, 15, 'unpronounceable');
    foreach ($passwords as $password) {
    ?>
    <li><?php echo $password; ?></li>
    <?php
    }
?>
</ul>
</p>
</body>
</html>
