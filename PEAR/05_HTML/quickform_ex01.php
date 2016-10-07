<?php
require_once 'HTML/QuickForm.php';
$form = new HTML_QuickForm('subscribeform');
if ($form->isSubmitted()) {
        if ($form->validate()) {
                echo '<pre>';
                print_r($form->getSubmitValues());
                echo '</pre>';  
         }
} else {
             $form->addElement('text', 'name', 'Name:');
             $form->addElement('text', 'email', 'Email:');
             $form->addElement('select', 'industry', 'Industry', array('' => 'Please select', 'adv' => 'Advertising', 'it' => 'Information Technology', 'web' => 'Web Development'));
             $form->addElement('checkbox', 'subscribe', 'Subscribe:', null, array('checked' => 'checked'));
             $form->addElement('submit', null, 'Submit');
             $form->applyFilter('name', 'trim');
             $form->applyFilter('email', 'trim');
             $form->addRule('name', 'Please enter your name', 'required', null, 'client');
             $form->addRule('email', 'Please enter your email address', 'required', null,'client');
             $form->addRule('email', 'Please enter a valid email address', 'email', null,'client');
             $form->addRule('industry', 'Please select the industry in which you work', 'required', null, 'client');
             $form->display();
}
?>
