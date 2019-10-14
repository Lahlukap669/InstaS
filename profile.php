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
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		include_once('database.php');
		$result = mysqli_query($con,"SELECT email FROM users WHERE id='$id'") or die(mysqli_error($con));
		$row = mysqli_fetch_array($result);
		$username = $row['email'];
		$me_username = $_SESSION['user'];

		$result = mysqli_query($con,"SELECT id FROM users WHERE email='$me_username' LIMIT 1") or die(mysqli_error($con));
		$row = mysqli_fetch_array($result);
		$u_id = $row['id'];

		include_once("database.php");
		$username = $_SESSION['user'];
		$result = mysqli_query($con,"SELECT ime, priimek, email, profile_picture FROM users WHERE id='$id'") or die(mysqli_error($con));
		$row = mysqli_fetch_array($result);
		$profilepic = $row['profile_picture'];
		$username = $row['email'];
		
		echo '<div class="scale60 propic floatl"><div class="clearfix">
		<img src="'.$profilepic.'" class="float-left pull-left mr-2">
		<p class="mrinfo">Email <b>'.$username.'</b><br>
		Name <b>'.$row['ime'].' '.$row['priimek'].'</b><br>';

		$followed_id = $id;
		$followed = mysqli_query($con,"SELECT follower_id FROM followers WHERE followed_id='$followed_id' AND follower_id='$u_id' LIMIT 1") or die(mysqli_error($con));
		$row = mysqli_fetch_array($followed);
		if( $row==null ){
		echo '<a href=follow_process.php?f_id='.$id.'&u_id='.$u_id.' class="badge badge-primary followbtn">Follow</a></div></p>';
		}else{
			echo '<a href=unfollow_process.php?f_id='.$id.'&u_id='.$u_id.' class="badge badge-primary followbtn">Unfollow</a></div>';
		}
		
		
		echo '</div><hr>
		
		</div>';
		}

	else{
		include_once("database.php");
		$username = $_SESSION['user'];
		$result = mysqli_query($con,"SELECT ime, priimek, email, profile_picture, id FROM users WHERE email='$username'") or die(mysqli_error($con));
		$row = mysqli_fetch_array($result);
		$profilepic = $row['profile_picture'];
		$id = $row['id'];
		echo '<div class="scale60 propic floatl"><div class="clearfix">
		<img src="'.$profilepic.'" class="float-left pull-left mr-2">
		<p class="mrinfo">Email <b>'.$username.'</b><br>
		Name <b>'.$row['ime'].' '.$row['priimek'].'</b><br>
		<a href="info.php">Edit</a></p>
		</div><hr>
		
		</div>';
		}

?>
    <div class="album py-5 bg-light" style="clear:both;">
        <div class="container">
			<div class="row">     
	
	
<?php
	

	$result = mysqli_query($con,"SELECT p.naslov, p.slika_url, p.opis, p.datum, p.id FROM users u INNER JOIN posts p ON u.id=p.user_id WHERE u.email='$username';") 
				or die(mysqli_error($con));

    /*if(!mysql_num_rows($result)){
        $message = "your email isn't registerd yet!";
    }*/
    //$_SESSION['error'] = mysqli_error($con);

	$all = mysqli_fetch_all($result);

	foreach($all as &$i){
		//$slika = $i[1];
		echo '
		<div class="col-md-4">
		  <div class="card mb-4 box-shadow">
			<a href="comments.php?p_id='.$i[4].'&u_id='.$id.'"><img class="card-img-top" src="'.$i[1].'" alt="Card image cap"></a>
			<div class="card-body">
			  <p class="card-text opis"><b>'.$i[0].'</b> '.$i[2].'</p>
			  <div class="d-flex justify-content-between align-items-center">
				<div class="btn-group">
				  <span onclick="openModal(`'.$i[1].'`);" class="btn btn-sm btn-outline-secondary">View</span>

				  <div id="myModal" class="modal"><span class="close">&times;</span><img class="modal-content" id="img01"><div id="caption"></div></div>

				</div>';
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
		//$min = $since_start->i;
		//$date = date ("d-m-Y H:i", strtotime($i[3]));
		echo '<small class="text-muted">'.$min.' '.$ext.' ago</small>
		</div>
			</div>
		  </div></div>
		';//<div id='profile-post'>".$i[0]."<br><img id='post-img' src='".$i[1]."'><br>".$i[2]."</div>";
	}
	mysqli_close($con);
?>
		</div>
	</div>
</div>

</body>
<script>
var modal = document.getElementById("myModal");	
function openModal(img_link){
	var modalImg = document.getElementById("img01");
	var captionText = document.getElementById("caption");

	modal.style.display = "block";
	modalImg.src = img_link;

	var span = document.getElementsByClassName("close")[0];

	span.onclick = function() {
	modal.style.display = "none";
	}}
    
	$('.opis').each((i, obj) => { 
    let string = $(obj).text();
    let result = (string.replace(/#(\S*)/g,'<a class="badge badge-info" href="hashsearch.php?hash=$1">#$1</a>'));
    $(obj).html(result);
});
	
</script>
</html>