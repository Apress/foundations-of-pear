<?php
require_once "HTML/Form.php";

$form = new HTML_Form('05_formhandler.php');

$form->addText('name', 'Name:');
$form->addText('email', 'Email:');
$form->addSelect('industry', 'Industry:', array('adv' => 'Advertising','it' => 'Information Technology', 'web' => 'Web Development'), '', 1,'Please Select');
$form->addCheckbox('subscribe', 'Subscribe:', true);
$form->addSubmit("submit", "Submit");

$form->display();
?>
