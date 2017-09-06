<div id="live-chat">
		<span style="color: green;font-size: 250%; background: inherit;">Online Friends</span>
		<header class="clearfix">
			
			<h3><ul>
				<?php foreach($user as $online=>$value) {?>
					
						<li><span><a href="user.php?id=<?php echo $value['id'];?>"><?php echo $value['firstname']." ".$value['lastname'];?></a></span></li>
				<?php } ?>
				</ul>
			</h3>

			<span class="chat-message-counter">3</span>

		</header>

	</div>