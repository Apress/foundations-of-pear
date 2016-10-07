<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Password Example</title>
</head>
<body>
<?php
// require the Text_Password package to be included in the page
require_once "Text/Password.php";
// Create an array of usernames
$usernames = array("allan", "nathan", "wendy");
?>
<p>
<strong>Here are our usernames and their corresponding passwords:</strong>
<br />
<table>
<tr><th>Username</th><th>Reversed</th><th>ROT13</th><th>Shuffled</th></tr>
<?php
    // Return three arrays of the usernames encoded in different ways
    $passwordsRev = Text_Password::createMultipleFromLogin($usernames, 'reverse');
    $passwordsROT13 = Text_Password::createMultipleFromLogin($usernames, 'rot13');
    $passwordsShuffle = 
    Text_Password::createMultipleFromLogin($usernames, 'shuffle');
    for ($i = 0; $i < count($usernames); $i++) {
    ?>
    <tr>
        <td><?php echo $usernames[$i]; ?></td>
        <td><?php echo $passwordsRev[$i]; ?></td>
        <td><?php echo $passwordsROT13[$i]; ?></td>
        <td><?php echo $passwordsShuffle[$i]; ?></td>
    </tr>
    <?php
    }
?>
</table>
</p>

</body>
</html>
