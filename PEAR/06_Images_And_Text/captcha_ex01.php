<?php
    session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>CAPTCHA Example</title>
</head>
<body>
<?php
if (!isset($_POST['captcha'])) {
    // Form has not been submitted, display the form
    require_once 'Text/CAPTCHA.php';
    // These are the options for the CAPTCHA object.  The physical font file 
    // must exist
    $options = array(
        'font_size' => 32,
        'font_path' => './',
        'font_file' => 'arial.ttf'
    );
    $formCAPTCHA = Text_CAPTCHA::factory('Image');
    $result = $formCAPTCHA->init(300, 120, null, $options);
    if (PEAR::isError($result)) {
        echo 'Sorry, there was a problem generating the CAPTCHA Object';
        exit;
    }
    // Store the generated phrase in a session 
    // variable so that we can get to it later
    $_SESSION['secretCAPTCHA'] = $formCAPTCHA->getPhrase();

    $imageCAPTCHA = $formCAPTCHA->getCAPTCHAAsJPEG();
    if (PEAR::isError($imageCAPTCHA)) {
        echo 'Sorry, there was a problem generating the CAPTCHA Image';
        exit;
    }
    // We use an MD5 of the generated phrase as a unique filename
    file_put_contents(md5($formCAPTCHA->getPhrase()) . '.jpg', $imageCAPTCHA);
?>
<p>
Enter the phrase in the box below:
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<img src="<?php echo md5($formCAPTCHA->getPhrase()); ?>.jpg" width="300" 
   height="120" /><br />
<input type="text" name="captcha" /><br />
<input type="submit" value="Validate" />
</form>
</p>
<?php
} else {
    // Form has been submitted with a CAPTCHA value
    if (isset($_POST['captcha']) && isset($_SESSION['secretCAPTCHA']) &&
            strlen($_POST['captcha']) > 0 && strlen($_SESSION['secretCAPTCHA']) > 0 
            && $_POST['captcha'] == $_SESSION['secretCAPTCHA']) {
        echo "Congratualtions!";
        unlink(md5($_SESSION['secretCAPTCHA']) . '.jpg');
    } else {
        echo "Sorry, that is not correct.";
    }
}
?>
</body>
</html>
