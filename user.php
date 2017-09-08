<?php
require_once("lib/header.php");
$receiverID = htmlspecialchars(htmlentities(stripcslashes(strip_tags($_GET['id']))));
$senderID = $userInfo['id'];

$friendInfo = new Chat();
$friendInfo = $friendInfo->friendInfo($receiverID);

?>
<p>
	<center><strong><h4><span style="color: #33d26e;"><?php echo $friendInfo['firstname']." ".$friendInfo['lastname'];?></span>'s Messages.</h4></strong></center>
</p>
<div id="message-box">
	<div class="chat">
			
	<div class="chat-history" id="chatbox">
				
		<div class="chat-message clearfix">
					
			<img src="http://lorempixum.com/32/32/people" alt="" width="32" height="32">

			<div class="chat-message-content clearfix">
						
				<span class="chat-time">13:35</span>

					<h5><?php echo $friendInfo['firstname']." ".$friendInfo['lastname'];?></h5>

			</div> <!-- end chat-message-content -->

	</div> <!-- end chat-message -->

			<hr>

</div>
			<form method="post" action="send.php">
				<div class="form-group">
					<textarea id="msg" class="form-control" rows="3" cols="40" placeholder="Write message"></textarea>
				</div>
				Press Enter to Send
				<input type="hidden" id="senderID" value="<?php echo $senderID;?>">
				<input type="hidden" id="receiverID" value="<?php echo $receiverID;?>">
			</form>

</div>
<?php require_once("lib/sidebar.php");?>


<script type="text/javascript">

	$('document').ready(function()
		{
			setInterval(showMessage,500);
		});
	$("#msg").keyup(function(enter)
		{
			var messages = $("#msg").val();
			var senderID = $("#senderID").val();
			var receiverID = $("#receiverID").val();

			if(messages == '')
			{
				alert("Please Write Message");
				return;
			}

			if(enter.keyCode == 13)
			{
				$.ajax({
				url : "send.php",
				method : "POST",
				async : false,
				data : {
					"send" : 1,
					"message" : messages,
					"senderID" : senderID,
					"receiverID" : receiverID,
				},

				success:function(data)
				{
					showMessage();
					$("#msg").val('');
				}
			});
			}
			
			
		});

	function showMessage()
	{
		var senderID = $("#senderID").val();
		var receiverID = $("#receiverID").val();

		$.ajax({
			url : "send.php",
			type : "POST",
			async : false,
			data : {
				"get" : 1,
				"senderID" : senderID,
				"receiverID" : receiverID
			},

			success:function(data)
			{
				
				$("#chatbox").html(data);
			}
			
		}
		);
	}
</script>	