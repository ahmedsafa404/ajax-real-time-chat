<?php
require_once('class/class.php');
$view = new Chat();
$viewStatus = $view->viewStatus($_POST);

?>
<?php foreach($viewStatus as $user => $post) {?>
<?php if($post['profile_pic']) {?>
<img src="<?php echo $post['profile_pic'];?>" style="height: 50px;width: 50px;" class="img-thumbnail">
<?php }else { ?>
	<img src="images/avater.png" style="height: 50px;width: 50px;" class="img-thumbnail">
	<?php }?>
			<br>

			<h3><?php echo $post['firstname']." ".$post['lastname'];?></h3>
			<?php 
			$time = $post['time'];
			$different = ($time / 60);
			$current = (int)$different;
			$hour = ceil($current / 60);
			?>
			<?php
			if($current <= 1 ){?>
			<strong>at <?php echo "just now.";?></strong>
			<?php } elseif($current <= 59 ) {?>
			<strong>at <?php echo $current;?> minutes ago.</strong>
			<?php } else { $hour = ceil($current / 60);?>
			<strong>at <?php echo $hour."hour's ago";}?></strong>
			<br>
			<br>
			<p>
				<?php echo $post['status'];?>
			</p>
			<a href="#"> <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true">Like |</span></a> 
			<a href="#"><span class="glyphicon glyphicon-thumbs-down">Dislike |</span></a> 
			<a href="#">Comment |</span></a> <a href="#"> 
			Share </span></a>
			<hr>
<?php }?>