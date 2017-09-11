<?php require_once("lib/header.php");?>
<div class="row">
	<div class="col-md-4">
		<h2 style="color: #33d26e"><?php echo $userInfo['firstname']." ".$userInfo['lastname'];?></h2>
		<br>
		<?php if($userInfo['profile_pic']) {?>
		<img src=<?php echo $userInfo['profile_pic'];?> style="height: 170px;width: 170px;">
		<?php } else {?>
		<img src="images/avater.png" style="height: 170px;width: 170px;">
		<?php } ?>
		Upload Profile Picture
		<form method="post" action="upload.php" enctype="multipart/form-data">
			<input type="file" name="image">
			<br>
			<input type="submit" value="Upload">
			<input type="hidden" name="userid" value="<?php echo $userInfo['id'];?>">
		</form>
	</div>
</div>
<?php require_once("lib/sidebar.php");?>