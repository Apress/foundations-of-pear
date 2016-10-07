<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
        <title>CSS Styled Form</title>
        <style>
        dl{}
        dt{
                font-family:    Tahoma,Verdana;
                font-size:      13px;
        }
        dd{
                margin-top:     -15px;
                margin-left:    200px;
        }
        dd input{
                width:          200px;
                border:         1px solid #dddddd;
        }
        </style>
</head>

<body>
<?php
require_once "HTML/Form.php";
$form = new HTML_Form('05_formhandler.php');
$form->start();
?>
<dl>
        <dt>Name:</dt>
        <dd><?php $form->displayText('name'); ?></dd>
        <dt>Email:</dt>
        <dd><?php $form->displayText('email'); ?></dd>
        <dt>Industry:</dt>
        <dd><?php $form->displaySelect('industry', ~CCC
        array('adv' => 'Advertising', 'it' => 'Information Technology', 'web' => 'Web Development'), '', 1, 'Please Select'); ?></dd>
        <dt>Subscribe:</dt>
        <dd><?php $form->displayCheckbox('subscribe', true); ?></dd>
        <dt>&nbsp;</dt>
        <dd><?php $form->displaySubmit('submit', 'Submit'); ?></dd></dl>
<?php
$form->end();
?>
</body>
</html>
