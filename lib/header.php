<?php
session_start();
require_once('class/class.php');
require_once('class/route.php');
if(!isset($_SESSION['username']))
{
	Redirect::to('index.php');
	exit;
}

$username = $_SESSION['username'];

$userInfo = new Chat();
$userInfo = $userInfo->userInfo($username);

$user = new Chat();
$user->online($username);

$online_user = new Chat();
$online_user = $online_user->online_user_count();

$online_user_info = new Chat();
$online_user_info = $online_user_info->online_user_info();

$offline = new Chat();
$offline = $offline->offline();


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
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/chat.js"></script>

</head>
<body>
<div class="container-fluid" style="padding-top: 20px;">
	<center><h3>Welcome <span style="color: #33d26e"><?php echo $userInfo['firstname']." ".$userInfo['lastname'];?></span></h3><a href="home.php">Home</a>|<a href="profile.php">Profile</a>|<a href="#">Messages</a>|<a href="logout.php">Logout</a>
	<br>
	<span style="color: black">Online : </span><?php echo $online_user['user'];?>
	</center>

	