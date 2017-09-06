<?php
session_start();
if (isset($_SESSION['username'])) {
	$con = new PDO("mysql:host=localhost;dbname=practice","root","");
	$update = $con->prepare("UPDATE users SET status = 0 WHERE username = ? ");
	$update->bindParam(1,$_SESSION['username']);
	$update->execute();
	session_destroy();
	header("location:index.php");
}
else
{
	header("location:index.php");
}
?>