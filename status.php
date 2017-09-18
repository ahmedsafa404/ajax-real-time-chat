<?php

session_start();
require_once('class/class.php');
require_once('class/route.php');
if(!isset($_SESSION['username']))
{
	Redirect::to('index.php');
	exit;
}
if(isset($_POST))
{
	$status = new Chat();
	$status->postStatus($_POST);
}

?>
			