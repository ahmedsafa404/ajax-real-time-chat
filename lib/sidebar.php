
<div id="live-chat">

		<span style="color: green;font-size: 250%; background: inherit;">Online Friends</span>
		<header class="clearfix">
			
			<h3><ul>
				<?php foreach($online_user_info as $online=>$value) {?>
							
							<li><a href="user.php?id=<?php echo $value['id'];?>"><span>
							<?php if($value['profile_pic']){ ?>
							<img src=<?php echo $value['profile_pic'];?> style="height: 50px;width: 50px;display: inline;">
							<?php } else { ?>
							<img src="images/avater.png" style="height: 50px;width: 50px;display: inline;">
							<?php }?>
							<?php echo $value['firstname']." ".$value['lastname']; ?></span></a></li>

				<?php } ?>
				</ul>
			</h3>

		</header>

	</div>