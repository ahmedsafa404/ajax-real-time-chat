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
		$time = strtotime($value['created_at']);
		$time = date("F j, Y, g:i a",$time);
		 ?>
		 <?php if($value['profile_pic']) { ?>
		 <img src=<?php echo $value['profile_pic'];?> style="height: 30px;width: 30px; vertical-align: middle;">
		 <?php } else { ?>
		 <img src="images/avater.png" style="height: 30px;width: 30px; vertical-align: middle;">
		 <?php }?>
		 <h5 style="text-align: left; color: #35373a; vertical-align: middle; display: inline;"><strong><?php echo $value['firstname']." ".$value['lastname'];?></strong></h5>
		 <br>
		 <span><?php echo $time;?></span>
	
	
	<p style="text-align: left; color: black">
		<?php echo $value['message'];?>
	</p>
	<hr>
	<br>
	<?php } ?>
</div>




