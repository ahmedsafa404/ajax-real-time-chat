<?php
require_once('route.php');
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
		$password = htmlspecialchars(htmlentities(stripslashes(strip_tags(md5(sha1($info['password']))))));

		$login = $this->con->prepare("SELECT * FROM users WHERE username = ? and password = ? LIMIT 1");
		$login->bindParam(1,$username);
		$login->bindParam(2,$password);
		$login->execute();

		if($login->rowCount() == 1)
			{
				session_start();
				$_SESSION['username'] = $username;
				Redirect::to('home.php');
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
			$password = htmlspecialchars(htmlentities(stripcslashes(strip_tags(md5(sha1($_POST['password']))))));


			$signup = $this->con->prepare("INSERT INTO users(firstname,lastname,username,password) VALUES(:firstname,:lastname,:username,:password)");
			$signup->bindParam(':firstname',$firstname);
			$signup->bindParam(':lastname',$lastname);
			$signup->bindParam(':username',$username);
			$signup->bindParam(':password',$password);

			$signup->execute();

			echo "<script>alert('Signup Complete')</script>";


		}
	}

	public function upload($info = '')
    {
        
        $userId    = (int)htmlspecialchars(htmlentities(stripslashes(strip_tags($info['userid']))));
        $imageName = htmlspecialchars(htmlentities(stripslashes(strip_tags($_FILES['image']['name']))));
        $imageType = htmlspecialchars(htmlentities(stripslashes(strip_tags($_FILES['image']['type']))));
        $imageSize = htmlspecialchars(htmlentities(stripslashes(strip_tags($_FILES['image']['size']))));
        $imageTmp  = $_FILES['image']['tmp_name'];

        $imageHash = md5($imageName);

        $validext = array('jpg','png','gif','jpeg');
        $ext = strtolower(substr($imageName,strpos($imageName,'.')+1));

        $maxSize = 2097152;

        $path = 'uploads/';

        if(!is_dir($path))
        {
            mkdir($path,"0777",true);
        }
        else
        {
            if(!in_array($ext,$validext))
            {
                exit("Invalid File!");
            }
            elseif (!($imageType == 'image/jpeg' or $imageType == 'image/png' or $imageType == 'image/gif'))
            {
                die("Invalid File Type");
            }
            elseif ($imageSize > $maxSize)
            {
                exit("File size more than 2MB.Please choose less than 2MB.");
            }
            else
            {
                move_uploaded_file($imageTmp,$save = $path.md5($imageName));

                $image = $this->con->prepare("UPDATE users SET profile_pic = ? WHERE id = ? LIMIT 1");

                $image->bindParam(1,$save);
                $image->bindParam(2,$userId);
                $image->execute();

                header("location:home.php");
            }
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

			$store = $this->con->prepare("INSERT INTO messages(sender_id,message) VALUES(:userID,:message,:status)");
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

	public function sendTo($info = '')
	{
		if(isset($_POST['send']))
		{
			$sender = htmlspecialchars(htmlentities(stripcslashes(strip_tags($_POST['senderID']))));
			$receiver = htmlspecialchars(htmlentities(stripcslashes(strip_tags($_POST['receiverID']))));
			$message = htmlspecialchars(htmlentities(stripcslashes(strip_tags($_POST['message']))));
			$send = $this->con->prepare("INSERT INTO messages(sender_id,receiver_id,message,status) VALUES(:sender,:receiver,:message,:status)");
			$send->bindParam(':sender',$sender);
			$send->bindParam(':receiver',$receiver);
			$send->bindParam(':message',$message);
			$send->bindValue(':status',1);

			$send->execute();
		}
	}

	public function getMessage($info = '')
	{
		if(isset($_POST['get']))
		{

			$sender = htmlspecialchars(htmlentities(stripcslashes(strip_tags($_POST['senderID']))));
			$receiver = htmlspecialchars(htmlentities(stripcslashes(strip_tags($_POST['receiverID']))));

			$message = $this->con->prepare("SELECT users.firstname,users.lastname,users.profile_pic, messages.message,messages.created_at from messages inner join users on messages.sender_id = users.id where (sender_id = ? and receiver_id = ?) OR (sender_id = ? && receiver_id = ?) ORDER BY messages.id DESC");
			$message->bindParam(1,$sender);
			$message->bindParam(2,$receiver);
			$message->bindParam(3,$receiver);
			$message->bindParam(4,$sender);

			$message->execute();

			$message = $message->fetchAll(PDO::FETCH_ASSOC);

			return $message;
		}
	}

	public function online($username = '')
	{
		$username  = $username;
		$last_page = $_SERVER['REQUEST_URI'];
		$user_ip   = $_SERVER['REMOTE_ADDR'];
		$user_browser = $_SERVER['HTTP_USER_AGENT'];

		$insert = $this->con->prepare("REPLACE INTO online_user SET username = ?,last_activity = NOW(), last_page = ?, user_ip = ? , user_browser = ?");
		$insert->bindParam(1,$username);
		$insert->bindParam(2,$last_page);
		$insert->bindParam(3,$user_ip);
		$insert->bindParam(4,$user_browser);

		$insert->execute();
	}

	public function online_user_count()
	{
		$get_online_user = $this->con->prepare("SELECT COUNT(username) AS user FROM online_user");
		$get_online_user->execute();
		$get_online_user = $get_online_user->fetch(PDO::FETCH_ASSOC);

		return $get_online_user;
	}

	public function online_user_info()
	{
		$info = $this->con->prepare("SELECT users.id,users.firstname,users.lastname,users.profile_pic FROM users,online_user WHERE online_user.username = users.username ");
		$info->execute();
		$info = $info->fetchAll(PDO::FETCH_ASSOC);

		return $info;
	}

	public function offline()
	{
		$offline = $this->con->prepare("DELETE FROM online_user WHERE TIMESTAMPDIFF(MINUTE,last_activity,NOW()) > 15 ");
		$offline->execute();
	}
}

?>