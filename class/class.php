<?php

class Chat
{
	private $con;

	public function __construct()
	{
		return $this->con = new PDO("mysql:host=localhost;dbname=practice","root","");
	}

	public function login($info = '')
	{
		
		$username = htmlspecialchars(htmlentities(stripslashes(strip_tags($info['username']))));
		$password = htmlspecialchars(htmlentities(stripslashes(strip_tags($info['password']))));

		$login = $this->con->prepare("SELECT * FROM users WHERE username = ? and password = ? LIMIT 1");
		$login->bindParam(1,$username);
		$login->bindParam(2,$password);
		$login->execute();

		if($login->rowCount() == 1)
			{
				session_start();
				$_SESSION['username'] = $username;
				$update = $this->con->prepare("UPDATE users SET status = 1 WHERE username = ? ");
				$update->bindParam(1,$_SESSION['username']);
				$update->execute();
				header("location:home.php");
			}
		else
			{
				echo "Incorrect username or password";
			}

	}

	public function signup($info = '')
	{
		if(isset($_POST['save']))
		{
			$firstname = htmlspecialchars(htmlentities(stripslashes(strip_tags($_POST['firstname']))));
			$lastname = htmlspecialchars(htmlentities(stripcslashes(strip_tags($_POST['lastname']))));
			$username = htmlspecialchars(htmlentities(stripcslashes(strip_tags($_POST['username']))));
			$password = htmlspecialchars(htmlentities(stripcslashes(strip_tags($_POST['password']))));

			$signup = $this->con->prepare("INSERT INTO users(firstname,lastname,username,password) VALUES(:firstname,:lastname,:username,:password)");
			$signup->bindParam(':firstname',$firstname);
			$signup->bindParam(':lastname',$lastname);
			$signup->bindParam(':username',$username);
			$signup->bindParam(':password',$password);

			$signup->execute();

			echo "<script>alert('Signup Complete')</script>";


		}
	}

	public function userInfo($info = '')
	{
		$username = $info;

		$user = $this->con->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
		$user->bindParam(1,$username);
		$user->execute();

		$user = $user->fetch(PDO::FETCH_ASSOC);

		return $user;
	}

	public function friendInfo($info = '')
	{
		$friendID = htmlspecialchars(htmlentities(stripcslashes(strip_tags($info))));

		$friendInfo = $this->con->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
		$friendInfo->bindParam(1,$friendID);
		$friendInfo->execute();
		$friendInfo = $friendInfo->fetch(PDO::FETCH_ASSOC);

		return $friendInfo;
	}

	public function chat($info = '')
	{
		if(isset($_POST['save']))
		{
			$message = htmlspecialchars(htmlentities(stripslashes(strip_tags($_POST['user_text']))));
			$userID = $_POST['userID'];

			$store = $this->con->prepare("INSERT INTO messages(sender_id,message) VALUES(:userID,:message)");
			$store->bindParam(':userID',$userID);
			$store->bindParam(':message',$message);
			$store->execute();
		}
	}

	public function Display($info = '')
	{
		if(isset($_POST['show']))
		{
			$msg = $this->con->prepare("SELECT users.id,users.firstname,users.lastname,messages.message,messages.created_at FROM users,messages WHERE messages.sender_id = users.id ORDER BY messages.id DESC");
			$msg->execute();

			$msg = $msg->fetchAll(PDO::FETCH_ASSOC);

			return $msg;
		}
	}

	public function Online()
	{
		$online = $this->con->prepare("SELECT * FROM users WHERE status = 1 ORDER BY id DESC");
		$online->execute();

		$online = $online->fetchAll(PDO::FETCH_ASSOC);

		return $online;
	}

	public function sendTo($info = '')
	{
		if(isset($_POST['send']))
		{
			$sender = htmlspecialchars(htmlentities(stripcslashes(strip_tags($_POST['senderID']))));
			$receiver = htmlspecialchars(htmlentities(stripcslashes(strip_tags($_POST['receiverID']))));
			$message = htmlspecialchars(htmlentities(stripcslashes(strip_tags($_POST['message']))));
			$send = $this->con->prepare("INSERT INTO messages(sender_id,receiver_id,message) VALUES(:sender,:receiver,:message)");
			$send->bindParam(':sender',$sender);
			$send->bindParam(':receiver',$receiver);
			$send->bindParam(':message',$message);

			$send->execute();
		}
	}

	public function getMessage($info = '')
	{

		if(isset($_POST['get']))
		{

			$sender = htmlspecialchars(htmlentities(stripcslashes(strip_tags($_POST['senderID']))));
			$receiver = htmlspecialchars(htmlentities(stripcslashes(strip_tags($_POST['receiverID']))));

			$message = $this->con->prepare("SELECT users.firstname,users.lastname, messages.message from messages inner join users on messages.sender_id = users.id where (sender_id = ? and receiver_id = ?) OR (sender_id = ? && receiver_id = ?) ORDER BY messages.id DESC");
			$message->bindParam(1,$sender);
			$message->bindParam(2,$receiver);
			$message->bindParam(3,$receiver);
			$message->bindParam(4,$sender);

			$message->execute();

			$message = $message->fetchAll(PDO::FETCH_ASSOC);

			return $message;
		}
	}
}

?>