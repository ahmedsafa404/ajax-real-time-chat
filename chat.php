<?php
require_once("class/class.php");

if(isset($_POST))
{
	$chat = new Chat();
	$chat->chat($_POST);
}

if(isset($_POST))
{
	$display = new Chat();
	$display = $display->Display($_POST);
}

?>

<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/style.css">

<?php foreach ($display as $key => $value) { ?>
	<h5 style="text-align: left;"><?php echo $value['firstname']." ".$value['lastname'];?></h5>
	<h6 style="text-align: left;"><?php echo date("F j, Y, g:i a",strtotime($value['created_at']));?></h6>
	
	<p style="text-align: left;">
		<?php echo $value['message'];?>
	</p>
	<hr>
	<?php } ?>
