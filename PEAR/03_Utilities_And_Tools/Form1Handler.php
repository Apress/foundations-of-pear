<?php
require_once 'Event/Dispatcher.php';
class Form1Handler
{
	var $someData = ""; 
	
	function btnClick_OnClick(&$notification)
	{
		echo 'Handling event for btnClick!';
		$notification->someData = "Data1";
	}
	
	function btnClick2_OnClick(&$notification)
	{
		echo 'Handling event for btnClick2!';
		$notification->someData = "Data2";
	}
}
?>
