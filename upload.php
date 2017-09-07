<?php
require_once("class/class.php");

if(isset($_POST))
{
	$upload = new Chat();
	$upload->upload($_POST);
}
