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

$view = new Chat();
$view->viewStatus();

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $userInfo['firstname']." ".$userInfo['lastname'];?>'s Newsfeed.</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>
<div class="container-fluid">
<nav class="navbar navbar-default" style="background-color: #b3b7b5;">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="home.php">ChatApp</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" size="40" placeholder="Search People">
        </div>
        <button type="submit" class="btn btn-default glyphicon glyphicon-search"></button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="profile.php">
        <?php if($userInfo['profile_pic']) {?>
        <img src="<?php echo $userInfo['profile_pic'];?>" style="height: 22px;width: 22px;">
        <?php }else { ?>
        <img src="images/avater.png" style="height: 22px;width: 22px;">
        <?php }?>
         Profile</a>
        </li>
        <li><a href="#">Find Friends</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Messages</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Notifications</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="row">
	<div class="col-md-2">
		<ul style="list-style-type: none;">
			<li><h4><a href="profile.php"><?php echo $userInfo['firstname']." ".$userInfo['lastname'];?></a></h4></li>
			<li><a href="profile.php">
			<?php if($userInfo['profile_pic']) {?>
			<img src="<?php echo $userInfo['profile_pic'];?>" style="height: 120px;width: 120px;" class="img-thumbnail">
			<?php } else {?>
			<img src="images/avater.png" style="height: 120px;width: 120px;" class="img-thumbnail">
			<?php }?>
			</a></li>
			<li><a href="#">Edit Profile</a></li>
			<li><a href="#">Friends</a></li>
			<li><a href="#">Groups</a></li>
			<li><a href="#">Create group</a></li>
		</ul>
	</div>
	<div class="col-md-6">
		<form method="post">
			<div class="form-group">
				<label for="status">Update Status | </label>
				<a href="#">Upload Photo</a>
				<textarea class="form-control" id="status" rows="5" cols="50" placeholder="What's on your mind."></textarea>
			</div>
			<button type="submit" id="submit" class="btn btn-primary" style="float: right;">Post</button>
			<input type="hidden" id="userID" value="<?php echo $userInfo['id'];?>">
		</form>
		<br><br>
		<div id="status-list" style="height: auto;overflow: auto;">
		<hr>
			
		</div>
	</div>
	<div class="col-md-4"><?php require_once('lib/sidebar.php');?></div>
</div>
</div>
</body>
<script type="text/javascript">

$(document).ready(function()
	{
		setInterval(function()
			{
				$("#status-list").load("viewStatus.php");
			},500);
	});


	$("#submit").click(function()
		{
			var status = $("#status").val();
			var userID = $("#userID").val();

			if(status == '')
			{
				alert("Update a Post.");
				return;
			}

			$.ajax({
				url : "status.php",
				method : "POST",
				async : false,
				data :{
					"post" : 1,
					"status" : status,
					"userID" : userID 
				},

				success:function(data)
				{
					viewStatus();
					$("#status").val("");
				}
			});
		});
</script>
</html>