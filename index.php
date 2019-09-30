<?php
//LAJKI
//komentarji --> do konca
//CSS profile/upload/discover/info/search/edit
//spremenit slike

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
<section id="posts">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
			<?php
	include_once("database.php");
	$username = $_SESSION['user'];
	$post = mysqli_query($con,"SELECT u.profile_picture, u.ime, u.priimek, p.slika_url, p.id, u.id FROM users u
								INNER JOIN posts p ON  u.id=p.user_id
								LEFT OUTER JOIN lajki l ON p.id=l.post_id
								WHERE u.email <> '$username'
								ORDER BY p.datum DESC") or die(mysqli_error($con). " errorcic ");
	$all = mysqli_fetch_all($post);
	
    foreach($all as &$i){ 
		echo '<div class="main-post-div">
				<div class="post-div-header-left">
					<img  class="post-user-icon"src="'.$i[0].'" alt="user-picture">
					<a class="post-user-link" href="profile.php?id='.$i[4].'">'.$i[1]." ".$i[2].'</a>	
				</div>
				<div class="post-div-img">
					<a href="post.php?id='.$i[4].'&name='.$i[1].$i[2].'"><img class="post-img" src="'.$i[3].'"></a>
				</div>
				<div class="post-div-likes">
						<a href="like_process.php" class="buttons a_bl"><i class="far fa-heart button"></i></a>
						<a href="comments.php?p_id='.$i[4].'&u_id='.$i[5].'" class="buttons"><i class="far fa-comment button"></i></a>
						<a href="#" class="buttons"><i class="far fa-share-square button"></i></a>
						<a href="#" class="bookmark buttons"><i class="far fa-bookmark button"></i></a>
				</div>
		</div>';         
        //echo '<a href="profile.php$id='.$i[4].'"><div><img src="'.$i[0].'"> '.$i[1]." ".$i[2].'</a><a href="post.php$id='.$i[4].'$name='.$i[1].$i[2].'"><br><img style="width:100;height:auto;" src="'.$i[3].'"></a></div></a>';  
    }

	$user = mysqli_query($con,"SELECT id, ime, priimek FROM users WHERE email='$username' LIMIT 1") or die(mysqli_error($con). " errorcic ");
	$i = mysqli_fetch_array($user, MYSQLI_ASSOC);
	mysqli_close($con);

		/*<!-- <div class="post-div-header-right">
							<a style="display: inline-block;"href="#">Imagine</a>
					</div> -->		*/
				
			echo '</div>
			<div class="col-lg-4 right-container">
				<div class="side-post-div-header">
					<img class="post-user-icon-lg"src="images/femaleIcon.png" alt="user-profile-img">
					<div class="side-post-div-img">
					<a class="post-user-link" href="profile.php?id='.$i["id"].'">moj_profil</a>
					<p class="post-user-name-top">'.$i["ime"].' '.$i["priimek"].'</p>
				</div>
					</div>
					<div class="side-post-div">
						<div>
							<h3>Stories</h3>
						</div>

						<div style="padding-bottom: 1rem;">
							<a class="" href="index.php"><img class="post-user-icon" src="images/uniIcon.png" alt="user-profile-img"></a>
							<div class="side-post-div-img">
							<a class="post-user-link-right-bottom" href="index.php">profil_1</a>
							<p class="story-upload-time">10 hours ago</p>
						</div>
						<div class="">
							<a class="" href="index.php"><img class="post-user-icon" src="images/uniIcon.png" alt="user-profile-img"></a>
							<div class="side-post-div-img">
							<a class="post-user-link-right-bottom" href="index.php">profil_2</a>
							<p class="story-upload-time">17 hours ago</p>
						</div>
						<div class="">
							<a class="" href="index.php"><img class="post-user-icon" src="images/uniIcon.png" alt="user-profile-img"></a>
							<div class="side-post-div-img">
							<a class="post-user-link-right-bottom" href="index.php">profil_3</a>
							<p class="story-upload-time">20 hours ago</p>
						</div>
					</div>
				</div>
			</div>';
					?>
				</div>
			</div>
		</div>
		<br><a href="logout.php" style="clear:both;">logout</a>
	</div>
	<a href="upload.php">
		<img class="plus" src="images/plus.png">
</a>
</section>
</body>
</html>
