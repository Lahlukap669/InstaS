<?php
	include_once("config.php");
	include_once("head.php");
	if (!isset($_SESSION['user'])) {
		header('Location: login.php');
		exit();
	}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Instas</title>
	<link rel="stylesheet" type="text/css" href="css/post.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>
	<div class="container" style="margin-top: 30px">
	
	<img src="images/post.png" class="post">
	<img src="images/chat.png" class="chat">

		<br><a href="logout.php" style="clear:both;">logout</a>
	</div>
	<a href="upload.php" class="plus"><img src="images/plus.png"></a>
</body>
</html>