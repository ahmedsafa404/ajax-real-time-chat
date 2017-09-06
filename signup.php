<?php
require_once('class/class.php');

if (isset($_POST)) 
{
	$signup = new Chat();
	$signup->signup($_POST);
}

?>