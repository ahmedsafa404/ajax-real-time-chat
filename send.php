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

if(isset($_POST))
{
	$user = new Chat();
	$user->sendTo($_POST);
}

if(isset($_POST))
{
	$getMessage = new Chat();
	$getMessage = $getMessage->getMessage($_POST);

}

?>

<div id="user-message">
	<?php foreach ($getMessage as $key => $value) { 
		//$time = strtotime($value['created_at']);
		//$time = date("F j, Y, g:i a",$time);
		 ?>
		 <?php if($value['profile_pic']) { ?>
		 <img src=<?php echo $value['profile_pic'];?> style="height: 30px;width: 30px; vertical-align: middle;">
		 <?php } else { ?>
		 <img src="images/avater.png" style="height: 30px;width: 30px; vertical-align: middle;">
		 <?php }?>
		 <h5 style="text-align: left; color: black; vertical-align: middle; display: inline;"><?php echo $value['firstname']." ".$value['lastname'];?></h5>
	
	
	<p style="text-align: left;">
		<?php echo $value['message'];?>
	</p>
	<hr>
	<br>
	<?php } ?>
</div>




