<?php
session_start();
require_once('class/class.php');
if(!isset($_SESSION['username']))
{
	header("location:index.php");
	exit;
}

$username = $_SESSION['username'];

$userInfo = new Chat();
$userInfo = $userInfo->userInfo($username);

$online = new Chat();
$user = $online->Online();

?>

<!doctype html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<title><?php echo $userInfo['firstname']." ".$userInfo['lastname'];?> - Ajax Real Time Chat App.</title>

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/chat.js"></script>

</head>
<body>
<div class="container-fluid" style="padding-top: 20px;">
	<center><h3>Welcome <span style="color: #33d26e"><?php echo $userInfo['firstname']." ".$userInfo['lastname'];?></span></h3><a href="logout.php">Logout</a></center>
	<hr>