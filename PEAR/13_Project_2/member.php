<?php
require_once('connect.php');
require_once 'HTML/QuickForm.php';
$auth->setShowLogin(false);
$auth->start();
if ($_POST['action'] != "login" && $auth->checkAuth()) {
    $auth->logout();
            header("Location: index.php");
} elseif ($_POST['action'] == 'login' && $auth->checkAuth()) {
            header("Location: index.php");
} else {
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
<h2>Member Login</h2>
<a href="index.php">Back to forum</a>
<p>
<?php
$form = new HTML_QuickForm('loginForm', 'post', $_SERVER['REQUEST_URI']);
$form->addElement('hidden', 'action', 'login');
$form->addElement('text', 'username', 'Login name:');
$form->addElement('password', 'password', 'Password:');
$form->addElement('submit', null, 'Submit');
$form->applyFilter('username', 'trim');
$form->applyFilter('password', 'trim');
$form->addRule('username', 'Please enter your username', 'required', null, 
    'client');
$form->display();
?>
</p>
<p>If you would like to register, <a href="register.php">click here</a></p>
</body>
</html>
<?php
}
?>
