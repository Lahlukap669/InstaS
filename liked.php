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
	<link rel="stylesheet" type="text/css" href="css/album.css">

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
<?php
	include_once("config.php");
	include_once("head.php");
	if (!isset($_SESSION['user'])) {
		header('Location: login.php');
		exit;
	}
		$username = $_SESSION['user'];
		include_once("database.php");
		$username = $_SESSION['user'];
		$result = mysqli_query($con,"SELECT ime, priimek, email, profile_picture, id FROM users WHERE email='$username'") or die(mysqli_error($con));
		$row = mysqli_fetch_array($result);
		$profilepic = $row['profile_picture'];
		echo '<div class="scale60 propic floatl"><div class="clearfix">
		<img src="'.$profilepic.'" class="float-left pull-left mr-2">
		<p class="mrinfo">Email <b>'.$username.'</b><br>
		Name <b>'.$row['ime'].' '.$row['priimek'].'</b><br>
		<b>LIKED POSTS</b></p>
		</div><hr>
		</div>';

?>
<div class="album py-5 bg-light" style="clear:both;">
        <div class="container">

          
	
	
<?php
	
    $id = $row["id"];
	$result = mysqli_query($con,"SELECT p.naslov, p.slika_url, p.opis, p.datum, p.id FROM posts p INNER JOIN lajki l ON p.id=l.post_id WHERE l.user_id='$id';") 
				or die(mysqli_error($con));

	$all = mysqli_fetch_all($result);
	foreach($all as &$i){
		//$slika = $i[1];
		$cur = time();
		$date = strtotime($i[3]);
		$min = round(abs($date - $cur) / 60);
		$ext = 'min';
		if($min>59){
			$min = round($min/60);
			$ext = 'h';
			if($min>23){
                $min = round($min/24);
                $ext = 'days';
                if($min==1)
                {$ext = 'day';}
				if($min>6){
					$min = round($min/7);
                    $ext = 'weeks';
                    if($min==1)
                    {$ext = 'week';}}
			}			
		}
        echo '<div class="row">
		<div class="col-md-4">
		  <div class="card mb-4 box-shadow">
		  <img class="card-img-top" src="'.$i[1].'" alt="Card image cap">
			<div class="card-body">
			  <p class="card-text"><b>'.$i[0].'</b> '.$i[2].'</p>
			  <div class="d-flex justify-content-between align-items-center">
				<div class="btn-group">
				  <a href="'.$i[1].'" class="btn btn-sm btn-outline-secondary">View</a>
				</div>
				<small class="text-muted">'.$min." ".$ext.' ago</small>
			  </div>
			</div>
		  </div>
		</div>';//<div id='profile-post'>".$i[0]."<br><img id='post-img' src='".$i[1]."'><br>".$i[2]."</div>";
	}
	mysqli_close($con);
?>
</div>
</div>
</body>
</html>