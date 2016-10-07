<?php
session_start();
require_once('connect.php');
require_once 'HTML/QuickForm.php';
require_once 'Text/CAPTCHA.php';
require_once 'Text/Password.php';
require_once 'Mail.php';
require_once 'Mail/mime.php';
$form = new HTML_QuickForm('registerform', 'post', $_SERVER['REQUEST_URI']);
if ($form->isSubmitted()) {
            if ($form->validate()) {
                     $data = $form->getSubmitValues();
                     if (isset($_POST['CAPTCHA']) && 
                            isset($_SESSION['secretCAPTCHA']) 
                            && strlen($_POST['CAPTCHA']) > 0 
                            && strlen($_SESSION['secretCAPTCHA']) > 0 
                            && $_POST['CAPTCHA'] == $_SESSION['secretCAPTCHA']) {
                    unlink('captcha_tmp/'.md5($_SESSION['secretCAPTCHA']) . '.jpg');
                    $password = Text_Password::create();
                    $sql = "INSERT INTO member (member_id, member_password)
                    VALUES ('" . $db->escapeSimple($data['email']) 
                    . "', '" . md5($password) . "')";
                    $db->query($sql);
                    $username = htmlspecialchars($db->escapeSimple($data['email']));
                    $prefmanager->setPref
                    ($username, 'name', $db->escapeSimple($data['name']));
                    $prefmanager->setPref($username, 'level', '1');
                    $text = <<<EOD
                    Welcome to the forums {$data['name']}
                    You can log in using the username {$data['email']} and 
                    the password $password
EOD;
                    $html = '<html><body><p>Welcome to the forums '.$data['name']
                    .'</p><p>You can log in using the username '
                    .$data['email'].' and the password '
                    .$password.'</p></body></html>';
                    $crlf = "\n";
                    $hdrs = array(
                    'From'    => 'admin@apressforum.com',
                    'Subject' => 'Your new forum username and password'
             );
                    $mime = new Mail_mime($crlf);
                    $mime->setTXTBody($text);
                    $mime->setHTMLBody($html);
                    $body = $mime->get();
                    $hdrs = $mime->headers($hdrs);
                    $mail =& Mail::factory('smtp');
                    $mail->send($data['email'], $hdrs, $body);
                    header('Location: member.php');
                } else {
                    $message = "Oops, the code you entered did not match the one in the image.  Please try again";
                }
        }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
            "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?php echo $settings['root']['conf']['Forum']['title']; ?></title>
<link rel="stylesheet" type="text/css" href="forum.css">
</head>
<body>
<h1><a href="index.php">
<?php echo $settings['root']['conf']['Forum']['heading']; ?></a></h1>
<h2>New member Registration</h2>
<p><a href="member.php">Return to login page</a></p>
<?php
            if (isset($message)) {
                        echo "<p><strong>" . $message . "</strong></p>";
            }
    $options = array(
            'font_size' => 32,
        'font_path' => './',
        'font_file' => 'arial.ttf'
    );
    $formCAPTCHA = Text_CAPTCHA::factory('Image');
   $result = $formCAPTCHA->init(300, 120, null, $options);
            $_SESSION['secretCAPTCHA'] = $formCAPTCHA->getPhrase();
            $imageCAPTCHA = $formCAPTCHA->getCAPTCHAAsJPEG();
            file_put_contents
            ('captcha_tmp/'.md5($formCAPTCHA->getPhrase()) . '.jpg', $imageCAPTCHA);
            $form->addElement('text','name', 'Name:');
            $form->addElement('text', 'email', 'Email Address:');
            $form->addElement('image', 'CAPTCHAimg', 
                         'captcha_tmp/'.md5($formCAPTCHA->getPhrase()).'.jpg');
            $form->addElement('text', 'CAPTCHA', 'Registration code:');
            $form->addElement('submit', null, 'Submit');
            $form->applyFilter('name', 'trim');
            $form->applyFilter('email', 'trim');
            $form->addRule('name', 'Please provide your name', 'required', null, 
                         'client');
            $form->addRule('email', 'Please provide an email address', 'required', 
                         null, 'client');
            $form->addRule('email', 'Please enter a valid email address', 'email', 
                         null, 'client');
            $form->addRule('CAPTCHA','Please enter the code in the image', 
                         'required', null, 'client');
?>
<p>
<?php
            $form->display();
?>
</p>
</body>
</html>
