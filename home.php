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
		<form>
			<div class="form-group">
				<label for="status">Update Status | </label>
				<a href="#">Upload Photo</a>
				<textarea class="form-control" id="status" rows="5" cols="50" placeholder="What's on your mind."></textarea>
			</div>
			<button type="submit" id="submit" class="btn btn-primary" style="float: right;">Post</button>
		</form>
		<br><br>
		<div id="status-list" style="height: auto;overflow: auto;">
		<hr>
			<h3><img src="<?php echo $userInfo['profile_pic'];?>" style="height: 50px;width: 50px;" class="img-thumbnail">
			<br>
			<?php echo $userInfo['firstname']." ".$userInfo['lastname'];?></h3>
			<strong>at just now.</strong>
			<br>
			<p>
				Why do we use it?
It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
			</p>
			<a href="#"> <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true">Like </span></a> 
			<a href="#"><span class="glyphicon glyphicon-thumbs-down">Dislike</span></a> 
			<a href="#">Comment </span></a> <a href="#"> 
			Share </span></a>
			<hr>
			<h3><img src="<?php echo $userInfo['profile_pic'];?>" style="height: 50px;width: 50px;" class="img-thumbnail">
			<br><?php echo $userInfo['firstname']." ".$userInfo['lastname'];?></h3>
			<strong>at 45min ago.</strong>
			<br>
			<p>
				Why do we use it?
It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
			</p>
			<a href="#"> <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true">Like </span></a> 
			<a href="#"><span class="glyphicon glyphicon-thumbs-down">Dislike</span></a> 
			<a href="#">Comment </span></a> <a href="#"> 
			Share </span></a>
			<hr>
			<h3><img src="<?php echo $userInfo['profile_pic'];?>" style="height: 50px;width: 50px;" class="img-thumbnail">
			<br><?php echo $userInfo['firstname']." ".$userInfo['lastname'];?></h3>
			<strong>at 1hr ago.</strong>
			<br>
			<p>
				Why do we use it?
It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
			</p>
			<a href="#"> <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true">Like </span></a> 
			<a href="#"><span class="glyphicon glyphicon-thumbs-down">Dislike</span></a> 
			<a href="#">Comment </span></a> <a href="#"> 
			Share </span></a>
			<hr>
			<h3><img src="<?php echo $userInfo['profile_pic'];?>" style="height: 50px;width: 50px;" class="img-thumbnail">
			<br><?php echo $userInfo['firstname']." ".$userInfo['lastname'];?></h3>
			<strong>at 6hrs ago.</strong>
			<br>
			<p>
				Why do we use it?
It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
			</p>
			<a href="#"> <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true">Like </span></a> 
			<a href="#"><span class="glyphicon glyphicon-thumbs-down">Dislike</span></a> 
			<a href="#">Comment </span></a> <a href="#"> 
			Share </span></a>
			<hr>
			<h3><img src="<?php echo $userInfo['profile_pic'];?>" style="height: 50px;width: 50px;" class="img-thumbnail">
			<br><?php echo $userInfo['firstname']." ".$userInfo['lastname'];?></h3>
			<strong>at 12hrs ago.</strong>
			<br>
			<p>

				Why do we use it?
It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
			</p>
			<a href="#"> <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true">Like </span></a> 
			<a href="#"><span class="glyphicon glyphicon-thumbs-down">Dislike</span></a> 
			<a href="#">Comment </span></a> <a href="#"> 
			Share </span></a>
		</div>
	</div>
	<div class="col-md-4"><?php require_once('lib/sidebar.php');?></div>
</div>
</div>
</body>
</html>