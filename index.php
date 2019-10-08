<?php

	 include_once("config.php");
	 include_once("head.php");
	  if (!isset($_SESSION['user'])) {
	  	header('Location: login.php');
	  	exit();
		}
	/*function likes($p_id){
			$user = $row['email'];
			$result = mysqli_query($con,"SELECT id FROM users WHERE email='$user' LIMIT 1") 
						or die("failed to query database");
	
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$l_u_id = $row["id"];
	
			mysqli_query($con,"INSERT INTO lajki (post_id, user_id) Values ('$l_u_id', '$p_id')")
								or die("failed to query database"); 
}*/
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

	$result = mysqli_query($con,"SELECT id FROM users WHERE email='$username' LIMIT 1") or die(mysqli_error($con));
    $row = mysqli_fetch_array($result);
	$id = $row['id'];
	
	$post = mysqli_query($con,"SELECT DISTINCT u.profile_picture, u.ime, u.priimek, p.slika_url, p.id, u.id FROM users u
								INNER JOIN posts p ON  u.id=p.user_id
								LEFT OUTER JOIN lajki l ON p.id=l.post_id
								WHERE u.email <> '$username'
								ORDER BY p.datum DESC") or die(mysqli_error($con). " errorcic ");
	$all = mysqli_fetch_all($post);
	
    foreach($all as &$i){
		$f_id = $i[5];
		$p_id = $i[4];
		$followed = mysqli_query($con,"SELECT DISTINCT followed_id FROM followers WHERE followed_id='$f_id' AND follower_id='$id'") or die(mysqli_error($con). " errorcic ");
		$all1 = mysqli_fetch_all($followed);
		foreach($all1 as &$a){
			if($a[0]==$i[5]){
				echo '<div class="main-post-div">
				<div class="post-div-header-left">
					<img  class="post-user-icon" src="'.$i[0].'" alt="user-picture">
					<a class="post-user-link" href="profile.php?id='.$i[5].'">'.$i[1]." ".$i[2].'</a>	
				</div>
				<div class="post-div-img">
					<a href="post.php?id='.$i[4].'&name='.$i[1].$i[2].'"><img class="post-img" src="'.$i[3].'"></a>
				</div>
				<div class="post-div-likes">';
				$likes = mysqli_query($con,"SELECT COUNT(id) as counted FROM lajki WHERE user_id='$id' AND post_id='$p_id' LIMIT 1") or die(mysqli_error($con). " errorcic ");
				$likenum = mysqli_fetch_array($likes, MYSQLI_ASSOC);
						if($likenum["counted"]==1){
							echo '<a id="like" href="like_process.php?p_id='.$i[4].'" class="buttons a_bl"><i class="fas fa-heart button"></i></a>';
						}
						else{
							echo '<a id="like" href="like_process.php?p_id='.$i[4].'" class="buttons a_bl"><i class="far fa-heart button"></i></a>';
						}
						$likes = mysqli_query($con,"SELECT COUNT(id) as counted FROM lajki WHERE post_id='$p_id' LIMIT 1") or die(mysqli_error($con). " errorcic ");
						$likenum = mysqli_fetch_array($likes, MYSQLI_ASSOC);
						$numl = $likenum["counted"];
						echo '<a id="numOfLikes" class="buttons">'.$numl.'</a>
						<a href="comments.php?p_id='.$i[4].'&u_id='.$i[5].'" class="buttons"><i class="far fa-comment button"></i></a>
						<a id="share" href="" onclick="clipboard();" class="buttons"><i class="far fa-share-square button"></i></a>
						<a href="" class="bookmark buttons"><i class="far fa-bookmark button"></i></a>
				</div>
		</div>';         
        //echo '<a href="profile.php$id='.$i[4].'"><div><img src="'.$i[0].'"> '.$i[1]." ".$i[2].'</a><a href="post.php$id='.$i[4].'$name='.$i[1].$i[2].'"><br><img style="width:100;height:auto;" src="'.$i[3].'"></a></div></a>';  
    }


			}}
	$user = mysqli_query($con,"SELECT id, ime, priimek, profile_picture FROM users WHERE email='$username' LIMIT 1") or die(mysqli_error($con). " errorcic ");
	$i = mysqli_fetch_array($user, MYSQLI_ASSOC);

		/*<!-- <div class="post-div-header-right">
							<a style="display: inline-block;"href="#">Imagine</a>
					</div> -->		*/
				
			echo '</div>
			<div class="col-lg-4 right-container">
				<div class="side-post-div-header">
					<img class="post-user-icon-lg"src="'.$i["profile_picture"].'" alt="user-profile-img">
					<div class="side-post-div-img">
					<a class="post-user-link" href="profile.php">moj_profil</a>
					<p class="post-user-name-top">'.$i["ime"].' '.$i["priimek"].'</p>
				</div>
					</div>
					<div class="side-post-div">
						<div>
							<h3>Stories</h3>
						</div>';

			$story = mysqli_query($con,"SELECT u.id, u.ime, u.priimek, s.story_url, s.datum FROM users u INNER JOIN stories s ON u.id=s.user_id WHERE 
										s.datum > DATE_SUB(NOW(), INTERVAL 24 HOUR) AND u.email <> '$username'") or die(mysqli_error($con). " errorcic ");
			$all = mysqli_fetch_all($story);
			
			foreach($all as &$i){
				$cur = time();
		$date = strtotime($i[4]);
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
						
						echo '<div style="padding-bottom: 1rem;">
							<a href="'.$i[3].'"><img class="post-user-icon" src="'.$i[3].'" alt="user-profile-img"></a>
							<div class="side-post-div-img">
							<div><a class="post-user-link-right-bottom" href="profile.php?id='.$i[0].'">'.$i[1].' '.$i[2].'</a></div>
							<p class="story-upload-time">'.$min.' '.$ext.' ago</p>
						</div>';}
						
					echo '</div>
				</div>
			</div>';
		

			mysqli_close($con);?>
				</div>
			</div>
		</div>
	</div>
	<a href="upload.php">
		<img class="plus" src="images/plus.png">
</a>
</section>

</body>
<script type="text/javascript">
function clipboard() {
	var dummy = document.createElement('input'),
    text = window.location.href;

	document.body.appendChild(dummy);
	dummy.value = text;
	dummy.select();
	document.execCommand('copy');
	alert("Copied the text: " + dummy.value);
	document.body.removeChild(dummy);

}</script>
</html>
