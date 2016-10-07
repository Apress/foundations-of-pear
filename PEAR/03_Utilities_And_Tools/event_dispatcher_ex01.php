<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--  Handling a click event on a web page -->
<head>
<title>Event_Dispatcher Example</title>
<script type="text/javascript" language="javascript">
function __handlePost(s) {
	document.form1.submitSource.value = s;
	document.form1.submit();
}
</script>
</head>
<body>
<form name="form1" 
action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" 
method="post">  
<input type="hidden" name="submitSource" 
	value="<?php
echo isset ($_POST['submitSource']) ? $_POST['submitSource'] : '';
?>" />
<?php

require_once 'Form1Handler.php';
require_once 'Event/Dispatcher.php';

class Form1 
{
	var $_dispatcher = null;
	    
	function Form1(&$dispatcher) 
	{
		$this->_dispatcher = &$dispatcher;
	}
	
	function buttonClick() 
	{
		$notification = &$this->_dispatcher->post($this, 'onButtonClick', '...');
		echo "<br/><b>Finished handling event!</b>";
		/* This property is set now by the callback that was 
		 * fired by the notification.
		 */
		echo $notification->someData;
	}
}

$dispatcher = &Event_Dispatcher::getInstance();
$sender = &new Form1($dispatcher);
$receiver = new Form1Handler();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	/* The callback name is dynamically generated, so you
	 * can quickly add buttons and event handlers to 
	 * handle them in the Form1Handler class.
	 */	
	$dispatcher->addObserver(array(&$receiver, 
		sprintf('%s_OnClick', $_POST['submitSource'])));
	/* Handle the event for that button */
	$sender->buttonClick();
}
?>
<p>Click this button to test me.</p>
	<input type="button" name="btnClick" value="Click Here!" 
		onclick="javascript:__handlePost('btnClick');"/>
	<input type="button" name="btnClick2" value="Or click Here!" 
		onclick="javascript:__handlePost('btnClick2');"/>
</form>
</body>
</html>

