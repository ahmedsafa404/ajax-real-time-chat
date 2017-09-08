<?php
session_start();
require_once('class/class.php');
require_once('class/route.php');
if(isset($_SESSION['username']))
{
	Route::to('index.php');
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ajax Real Time Chat - Login</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-12">
		<center><h2>Welcome to Ajax Chat App.</h2></center>
		<hr>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-4" id="login-form">
			<h3>Login</h3>
			<hr>
			<form method="post" action="login.php">
				<div class="form-group">
					<label for="username">Username:</label>
					<input type="text" id="username" name="username" class="form-control" placeholder="Enter your username">
				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
				</div>
				<button type="submit" id="login_btn" class="btn btn-success">Login</button>
			</form>
		</div>
		<div class="col-md-2"></div>
		<div class="col-md-6" id="signup-form">
			<h3>Signup</h3>
			<hr>
			<form method="post">
				<div class="form-group">
					<label for="firstname">First Name:</label>
					<input type="text" id="firstname" class="form-control" placeholder="Enter your firstname">
				</div>
				<div class="form-group">
					<label for="lastname">Last Name:</label>
					<input type="text" id="lastname" class="form-control" placeholder="Enter your lastname">
				</div>
				<div class="form-group">
					<label for="username">Choose an username:</label>
					<input type="text" id="user" class="form-control" placeholder="Enter your username">
				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input type="password" id="pass" class="form-control" placeholder="Enter your password">
				</div>
				<button type="submit" id="signup_btn" class="btn btn-primary">Signup</button>
			</form>
			<div id="registration"></div>
		</div>
	</div>
</div>
</body>
<script type="text/javascript">
	$("#signup_btn").click(function()

		{
			var firstname = $("#firstname").val();
			var lastname = $("#lastname").val();
			var username = $("#user").val();
			var password = $("#pass").val();

					
			if(firstname == '' || lastname == '' || username == '' || password == '')
				{
					alert(" Fields are required.");
					return;
				}

			$.ajax({
				url : "signup.php",
				method : "POST",
				async : false,
				data : {
					"save" : 1,
					"firstname" : firstname,
					"lastname" : lastname,
					"username" : username,
					"password" : password
				},

				success:function(data)
				{
					
					$("#registration").html(data);

					$("#firstname").val('');
					$("#lastname").val('');
					$("#username").val('');
					$("#password").val('');
				}
			});	
		});
		
</script>
</html>