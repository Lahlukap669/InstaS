<?php
	include_once("config.php");
	include_once("head.php");
	if (!isset($_SESSION['user'])) {
		header('Location: login.php');
		exit;
	}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Discover</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>
	<div class="container" style="margin-top: 30px">
	
<?php
	include("database.php");
	include_once("head.php");
	$username = $_SESSION['user'];
	
	$result = mysqli_query($con,"SELECT naslov, opis, slika_url  FROM posts WHERE user_id=(SELECT id FROM users WHERE email='$username')") 
                or die(mysqli_error());

    /*if(!mysql_num_rows($result)){
        $message = "your email isn't registerd yet!";
    }*/
    $_SESSION['error'] = mysqli_error($con);

    $row = mysqli_fetch_array($result);
    foreach($row as &$i){
        $slika = $i['slika_url'];
        echo "<div>".$i['naslov']."<br><img src='".$slika."'><br>".$i['opis']."</div>";
    }
?>

		<br><a href="logout.php" style="clear:both;">logout</a>
	</div>
</body>
</html>