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
			<strong>at just now.</strong>
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