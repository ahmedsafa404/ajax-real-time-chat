<?php
session_start();
session_destroy();
require_once('class/route.php');
Redirect::to('index.php');
?>