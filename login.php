<?php
require_once("class/class.php");

if(isset($_POST))
{
	$login = new Chat();
	$login->login($_POST);
}

?>