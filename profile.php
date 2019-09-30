<?php
	include_once("config.php");
	include_once("head.php");
	if (!isset($_SESSION['user'])) {
		header('Location: login.php');
		exit;
	}
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		include_once('database.php');
		$result = mysqli_query($con,"SELECT email FROM users WHERE id='$id'") or die(mysqli_error($con));
		$row = mysqli_fetch_array($result);
		$username = $row['email'];
	}
	else{
		$username = $_SESSION['user'];
	}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

		<title>InstaS</title>

<!-- Stylesheets -->

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/post.css">

<!-- Bootstrap scripts -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<!-- Font Awesome - Icon emojis -->
  <script src="https://kit.fontawesome.com/196e2f7040.js" crossorigin="anonymous"></script>
	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800|Roboto:100,400,900|Satisfy&display=swap" rel="stylesheet">
</head>

<body>
	<div class="container" style="margin-top: 30px">
	
<?php
	include_once("head.php");
	
	$result = mysqli_query($con,"SELECT p.naslov, p.slika_url, p.opis FROM users u INNER JOIN posts p ON u.id=p.user_id WHERE u.email='$username';") 
				or die(mysqli_error($con));

    /*if(!mysql_num_rows($result)){
        $message = "your email isn't registerd yet!";
    }*/
    //$_SESSION['error'] = mysqli_error($con);

	$all = mysqli_fetch_all($result);
	foreach($all as &$i){
        //$slika = $i[1];
        echo "<div id='profile-post'>".$i[0]."<br><img id='post-img' src='".$i[1]."'><br>".$i[2]."</div>";
	}
	mysqli_close($con);
?>

		<br><a href="logout.php">logout</a>
	</div>
</body>
</html>